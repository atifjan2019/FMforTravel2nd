<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Customer;
use App\Models\Item;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function index()
    {
        $incomes = Income::with(['customer', 'item'])->latest()->paginate(20);
        return view('incomes.index', compact('incomes'));
    }

    public function create()
    {
        $customers = Customer::where('status', 'active')->get();
        $items = Item::where('status', 'active')->get();
        return view('incomes.create', compact('customers', 'items'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'item_id' => 'nullable|exists:items,id',
            'amount' => 'required|numeric|min:0',
            'income_date' => 'required|date',
            'reference_no' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,completed,cancelled',
            'paid_amount' => 'nullable|numeric|min:0'
        ]);

        // Calculate payment status
        $amount = $validated['amount'];
        $paidAmount = $validated['paid_amount'] ?? 0;
        $validated['paid_amount'] = $paidAmount;
        $validated['remaining_amount'] = $amount - $paidAmount;
        
        if ($paidAmount == 0) {
            $validated['payment_status'] = 'unpaid';
        } elseif ($paidAmount >= $amount) {
            $validated['payment_status'] = 'paid';
            $validated['paid_amount'] = $amount;
            $validated['remaining_amount'] = 0;
        } else {
            $validated['payment_status'] = 'partial';
        }

        Income::create($validated);

        return redirect()->route('incomes.index')
            ->with('success', 'Income created successfully');
    }

    public function show(Income $income)
    {
        $income->load(['customer', 'item']);
        return view('incomes.show', compact('income'));
    }

    public function edit(Income $income)
    {
        $customers = Customer::where('status', 'active')->get();
        $items = Item::where('status', 'active')->get();
        return view('incomes.edit', compact('income', 'customers', 'items'));
    }

    public function update(Request $request, Income $income)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'item_id' => 'nullable|exists:items,id',
            'amount' => 'required|numeric|min:0',
            'income_date' => 'required|date',
            'reference_no' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,completed,cancelled',
            'paid_amount' => 'nullable|numeric|min:0'
        ]);

        // Calculate payment status
        $amount = $validated['amount'];
        $paidAmount = $validated['paid_amount'] ?? $income->paid_amount;
        $validated['paid_amount'] = $paidAmount;
        $validated['remaining_amount'] = $amount - $paidAmount;
        
        if ($paidAmount == 0) {
            $validated['payment_status'] = 'unpaid';
        } elseif ($paidAmount >= $amount) {
            $validated['payment_status'] = 'paid';
            $validated['paid_amount'] = $amount;
            $validated['remaining_amount'] = 0;
        } else {
            $validated['payment_status'] = 'partial';
        }

        $income->update($validated);

        return redirect()->route('incomes.index')
            ->with('success', 'Income updated successfully');
    }

    public function destroy(Income $income)
    {
        $income->delete();
        return redirect()->route('incomes.index')
            ->with('success', 'Income deleted successfully');
    }

    public function addPayment(Request $request, Income $income)
    {
        $validated = $request->validate([
            'payment_amount' => 'required|numeric|min:0.01|max:' . $income->remaining_amount
        ]);

        $income->addPayment($validated['payment_amount']);

        return redirect()->back()
            ->with('success', 'Payment added successfully');
    }
}
