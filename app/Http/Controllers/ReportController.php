<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Expense;
use App\Models\Purchase;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\CustomerPayment;
use App\Models\SupplierPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function profitLoss(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth());
        $endDate = $request->input('end_date', now()->endOfMonth());

        $incomes = Income::whereBetween('income_date', [$startDate, $endDate])
            ->where('status', 'completed')
            ->sum('amount');

        $expenses = Expense::whereBetween('expense_date', [$startDate, $endDate])
            ->where('status', 'paid')
            ->sum('amount');

        $purchases = Purchase::whereBetween('purchase_date', [$startDate, $endDate])
            ->sum('total_amount');

        $netProfit = $incomes - $expenses - $purchases;
        $grossProfit = $incomes - $purchases;

        // Monthly data for the report
        $monthlyData = [];
        for ($i = 5; $i >= 0; $i--) {
            $monthStart = now()->subMonths($i)->startOfMonth();
            $monthEnd = now()->subMonths($i)->endOfMonth();
            
            $monthIncome = Income::whereBetween('income_date', [$monthStart, $monthEnd])->sum('amount');
            $monthExpenses = Expense::whereBetween('expense_date', [$monthStart, $monthEnd])->sum('amount');
            $monthPurchases = Purchase::whereBetween('purchase_date', [$monthStart, $monthEnd])->sum('total_amount');
            
            $monthlyData[] = [
                'month' => $monthStart->format('M Y'),
                'income' => $monthIncome,
                'expenses' => $monthExpenses,
                'purchases' => $monthPurchases,
                'profit' => $monthIncome - $monthExpenses - $monthPurchases
            ];
        }

        return view('reports.profit-loss', compact(
            'startDate',
            'endDate',
            'monthlyData'
        ) + [
            'totalIncome' => $incomes,
            'totalExpenses' => $expenses,
            'totalPurchases' => $purchases,
            'netProfit' => $netProfit
        ]);
    }

    public function customerLedger(Request $request)
    {
        $customers = Customer::with(['incomes', 'payments'])->where('status', 'active')->get();

        return view('reports.customer-ledger', compact('customers'));
    }

    public function supplierLedger(Request $request)
    {
        $suppliers = Supplier::with(['purchases', 'payments'])->where('status', 'active')->get();

        return view('reports.supplier-ledger', compact('suppliers'));
    }

    public function cashFlow(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth());
        $endDate = $request->input('end_date', now()->endOfMonth());

        // Cash inflows
        $customerPayments = CustomerPayment::whereBetween('payment_date', [$startDate, $endDate])->sum('amount');
        $incomeTransactions = Income::whereBetween('income_date', [$startDate, $endDate])->sum('amount');

        // Cash outflows
        $supplierPayments = SupplierPayment::whereBetween('payment_date', [$startDate, $endDate])->sum('amount');
        $purchaseTransactions = Purchase::whereBetween('purchase_date', [$startDate, $endDate])->sum('total_amount');
        $expenses = Expense::whereBetween('expense_date', [$startDate, $endDate])->sum('amount');

        $totalCashIn = $customerPayments + $incomeTransactions;
        $totalCashOut = $supplierPayments + $purchaseTransactions + $expenses;
        $netCashFlow = $totalCashIn - $totalCashOut;

        // Monthly data
        $monthlyData = [];
        for ($i = 5; $i >= 0; $i--) {
            $monthStart = now()->subMonths($i)->startOfMonth();
            $monthEnd = now()->subMonths($i)->endOfMonth();
            
            $cashIn = CustomerPayment::whereBetween('payment_date', [$monthStart, $monthEnd])->sum('amount');
            $cashOut = SupplierPayment::whereBetween('payment_date', [$monthStart, $monthEnd])->sum('amount') 
                     + Expense::whereBetween('expense_date', [$monthStart, $monthEnd])->sum('amount');
            
            $monthlyData[] = [
                'month' => $monthStart->format('M Y'),
                'cash_in' => $cashIn,
                'cash_out' => $cashOut,
                'net_flow' => $cashIn - $cashOut
            ];
        }

        return view('reports.cash-flow', compact(
            'startDate',
            'endDate',
            'customerPayments',
            'incomeTransactions',
            'supplierPayments',
            'purchaseTransactions',
            'expenses',
            'totalCashIn',
            'totalCashOut',
            'netCashFlow',
            'monthlyData'
        ));
    }

    public function salesReport(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth());
        $endDate = $request->input('end_date', now()->endOfMonth());

        $totalSales = Income::whereBetween('income_date', [$startDate, $endDate])->sum('amount');
        $totalTransactions = Income::whereBetween('income_date', [$startDate, $endDate])->count();
        $averageSale = $totalTransactions > 0 ? $totalSales / $totalTransactions : 0;

        // Monthly sales
        $monthlySales = [];
        for ($i = 5; $i >= 0; $i--) {
            $monthStart = now()->subMonths($i)->startOfMonth();
            $monthEnd = now()->subMonths($i)->endOfMonth();
            
            $monthTotal = Income::whereBetween('income_date', [$monthStart, $monthEnd])->sum('amount');
            $monthCount = Income::whereBetween('income_date', [$monthStart, $monthEnd])->count();
            
            $monthlySales[] = [
                'month' => $monthStart->format('M Y'),
                'total' => $monthTotal,
                'count' => $monthCount,
                'average' => $monthCount > 0 ? $monthTotal / $monthCount : 0
            ];
        }

        $salesByItem = Income::join('items', 'incomes.item_id', '=', 'items.id')
            ->whereBetween('income_date', [$startDate, $endDate])
            ->select('items.name as item_name', DB::raw('COUNT(*) as count, SUM(incomes.amount) as total'))
            ->groupBy('items.id', 'items.name')
            ->orderByDesc('total')
            ->get();

        $topCustomers = Income::join('customers', 'incomes.customer_id', '=', 'customers.id')
            ->whereBetween('income_date', [$startDate, $endDate])
            ->select('customers.name as customer_name', DB::raw('COUNT(*) as count, SUM(incomes.amount) as total'))
            ->groupBy('customers.id', 'customers.name')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        return view('reports.sales', compact(
            'startDate',
            'endDate',
            'totalSales',
            'totalTransactions',
            'averageSale',
            'monthlySales',
            'salesByItem',
            'topCustomers'
        ));
    }

    public function purchaseReport(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth());
        $endDate = $request->input('end_date', now()->endOfMonth());

        $totalPurchases = Purchase::whereBetween('purchase_date', [$startDate, $endDate])->sum('total_amount');
        $totalTransactions = Purchase::whereBetween('purchase_date', [$startDate, $endDate])->count();
        $averagePurchase = $totalTransactions > 0 ? $totalPurchases / $totalTransactions : 0;

        // Monthly purchases
        $monthlyPurchases = [];
        for ($i = 5; $i >= 0; $i--) {
            $monthStart = now()->subMonths($i)->startOfMonth();
            $monthEnd = now()->subMonths($i)->endOfMonth();
            
            $monthTotal = Purchase::whereBetween('purchase_date', [$monthStart, $monthEnd])->sum('total_amount');
            $monthCount = Purchase::whereBetween('purchase_date', [$monthStart, $monthEnd])->count();
            
            $monthlyPurchases[] = [
                'month' => $monthStart->format('M Y'),
                'total' => $monthTotal,
                'count' => $monthCount,
                'average' => $monthCount > 0 ? $monthTotal / $monthCount : 0
            ];
        }

        $purchasesByItem = Purchase::join('items', 'purchases.item_id', '=', 'items.id')
            ->whereBetween('purchase_date', [$startDate, $endDate])
            ->select('items.name as item_name', DB::raw('SUM(purchases.quantity) as quantity, SUM(purchases.total_amount) as total'))
            ->groupBy('items.id', 'items.name')
            ->orderByDesc('total')
            ->get();

        $topSuppliers = Purchase::join('suppliers', 'purchases.supplier_id', '=', 'suppliers.id')
            ->whereBetween('purchase_date', [$startDate, $endDate])
            ->select('suppliers.name as supplier_name', DB::raw('COUNT(*) as count, SUM(purchases.total_amount) as total'))
            ->groupBy('suppliers.id', 'suppliers.name')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        return view('reports.purchases', compact(
            'startDate',
            'endDate',
            'totalPurchases',
            'totalTransactions',
            'averagePurchase',
            'monthlyPurchases',
            'purchasesByItem',
            'topSuppliers'
        ));
    }
}
