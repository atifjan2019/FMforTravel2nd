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
            'status' => 'required|in:pending,completed,cancelled'
        ]);

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
            'status' => 'required|in:pending,completed,cancelled'
        ]);

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
}
