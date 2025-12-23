<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Supplier;
use App\Models\Purchase;
use App\Models\Income;
use App\Models\Expense;
use App\Models\CustomerPayment;
use App\Models\SupplierPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Current Month dates
        $currentMonthStart = now()->startOfMonth();
        $currentMonthEnd = now()->endOfMonth();

        // Financial Summary - LIFETIME
        $totalIncome = Income::sum('amount');
        $totalExpenses = Expense::sum('amount');
        $totalPurchases = Purchase::sum('total_amount');
        $totalCustomerPayments = CustomerPayment::sum('amount');
        $totalSupplierPayments = SupplierPayment::sum('amount');

        // Calculate balances - using remaining_amount from incomes for accurate receivables
        $customerReceivables = Income::whereIn('payment_status', ['unpaid', 'partial'])
            ->sum('remaining_amount');
        $supplierPayables = $totalPurchases - $totalSupplierPayments;
        $netProfit = $totalIncome - $totalExpenses - $totalPurchases;

        // Payment status breakdown - INCOMES
        $totalPaidAmount = Income::sum('paid_amount');
        $paidIncomesCount = Income::where('payment_status', 'paid')->count();
        $partialIncomesCount = Income::where('payment_status', 'partial')->count();
        $unpaidIncomesCount = Income::where('payment_status', 'unpaid')->count();
        $incomesCount = Income::count(); // Total Transactions

        // Payment status breakdown - PURCHASES
        $totalPurchasesPaid = Purchase::sum('paid_amount');
        $supplierPayables = Purchase::whereIn('payment_status', ['unpaid', 'partial'])
            ->sum('remaining_amount');
        $paidPurchasesCount = Purchase::where('payment_status', 'paid')->count();
        $partialPurchasesCount = Purchase::where('payment_status', 'partial')->count();
        $unpaidPurchasesCount = Purchase::where('payment_status', 'unpaid')->count();
        $purchasesCount = Purchase::count(); // Total Transactions

        // Recent transactions
        $recentIncomes = Income::with(['customer', 'item'])
            ->latest()
            ->take(10)
            ->get();
        $recentExpenses = Expense::latest()
            ->take(10)
            ->get();
        $recentPurchases = Purchase::with(['supplier', 'item'])
            ->latest()
            ->take(10)
            ->get();

        // Monthly trends (last 6 months) - MySQL compatible
        $monthlyIncome = Income::selectRaw("DATE_FORMAT(income_date, '%Y-%m') as month, SUM(amount) as total")
            ->where('income_date', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $monthlyExpenses = Expense::selectRaw("DATE_FORMAT(expense_date, '%Y-%m') as month, SUM(amount) as total")
            ->where('expense_date', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Top customers and suppliers
        $topCustomers = Customer::withCount('incomes')
            ->orderBy('incomes_count', 'desc')
            ->take(5)
            ->get();

        $topSuppliers = Supplier::withCount('purchases')
            ->orderBy('purchases_count', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalIncome',
            'totalExpenses',
            'totalPurchases',
            'customerReceivables',
            'supplierPayables',
            'netProfit',
            'totalPaidAmount',
            'totalPurchasesPaid',
            'paidIncomesCount',
            'partialIncomesCount',
            'unpaidIncomesCount',
            'incomesCount',
            'paidPurchasesCount',
            'partialPurchasesCount',
            'unpaidPurchasesCount',
            'purchasesCount',
            'recentIncomes',
            'recentExpenses',
            'recentPurchases',
            'monthlyIncome',
            'monthlyExpenses',
            'topCustomers',
            'topSuppliers'
        ));
    }
}
