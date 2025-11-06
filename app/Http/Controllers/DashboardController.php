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
        
        // Financial Summary - CURRENT MONTH ONLY
        $totalIncome = Income::whereBetween('income_date', [$currentMonthStart, $currentMonthEnd])->sum('amount');
        $totalExpenses = Expense::whereBetween('expense_date', [$currentMonthStart, $currentMonthEnd])->sum('amount');
        $totalPurchases = Purchase::whereBetween('purchase_date', [$currentMonthStart, $currentMonthEnd])->sum('total_amount');
        $totalCustomerPayments = CustomerPayment::whereBetween('payment_date', [$currentMonthStart, $currentMonthEnd])->sum('amount');
        $totalSupplierPayments = SupplierPayment::whereBetween('payment_date', [$currentMonthStart, $currentMonthEnd])->sum('amount');
        
        // Calculate balances - using remaining_amount from incomes for accurate receivables
        $customerReceivables = Income::whereBetween('income_date', [$currentMonthStart, $currentMonthEnd])
            ->whereIn('payment_status', ['unpaid', 'partial'])
            ->sum('remaining_amount');
        $supplierPayables = $totalPurchases - $totalSupplierPayments;
        $netProfit = $totalIncome - $totalExpenses - $totalPurchases;
        
        // Payment status breakdown for current month - INCOMES
        $totalPaidAmount = Income::whereBetween('income_date', [$currentMonthStart, $currentMonthEnd])->sum('paid_amount');
        $paidIncomesCount = Income::whereBetween('income_date', [$currentMonthStart, $currentMonthEnd])
            ->where('payment_status', 'paid')->count();
        $partialIncomesCount = Income::whereBetween('income_date', [$currentMonthStart, $currentMonthEnd])
            ->where('payment_status', 'partial')->count();
        $unpaidIncomesCount = Income::whereBetween('income_date', [$currentMonthStart, $currentMonthEnd])
            ->where('payment_status', 'unpaid')->count();
        
        // Payment status breakdown for current month - PURCHASES
        $totalPurchasesPaid = Purchase::whereBetween('purchase_date', [$currentMonthStart, $currentMonthEnd])->sum('paid_amount');
        $supplierPayables = Purchase::whereBetween('purchase_date', [$currentMonthStart, $currentMonthEnd])
            ->whereIn('payment_status', ['unpaid', 'partial'])
            ->sum('remaining_amount');
        $paidPurchasesCount = Purchase::whereBetween('purchase_date', [$currentMonthStart, $currentMonthEnd])
            ->where('payment_status', 'paid')->count();
        $partialPurchasesCount = Purchase::whereBetween('purchase_date', [$currentMonthStart, $currentMonthEnd])
            ->where('payment_status', 'partial')->count();
        $unpaidPurchasesCount = Purchase::whereBetween('purchase_date', [$currentMonthStart, $currentMonthEnd])
            ->where('payment_status', 'unpaid')->count();
        
        // Recent transactions - CURRENT MONTH ONLY
        $recentIncomes = Income::with(['customer', 'item'])
            ->whereBetween('income_date', [$currentMonthStart, $currentMonthEnd])
            ->latest()
            ->take(10)
            ->get();
        $recentExpenses = Expense::whereBetween('expense_date', [$currentMonthStart, $currentMonthEnd])
            ->latest()
            ->take(10)
            ->get();
        $recentPurchases = Purchase::with(['supplier', 'item'])
            ->whereBetween('purchase_date', [$currentMonthStart, $currentMonthEnd])
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
            'paidPurchasesCount',
            'partialPurchasesCount',
            'unpaidPurchasesCount',
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
