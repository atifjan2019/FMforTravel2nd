<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::latest()->paginate(20);
        return view('expenses.index', compact('expenses'));
    }

    public function create()
    {
        return view('expenses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'expense_date' => 'required|date',
            'reference_no' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,paid,cancelled'
        ]);

        Expense::create($validated);

        return redirect()->route('expenses.index')
            ->with('success', 'Expense created successfully');
    }

    public function show(Expense $expense)
    {
        return view('expenses.show', compact('expense'));
    }

    public function edit(Expense $expense)
    {
        return view('expenses.edit', compact('expense'));
    }

    public function update(Request $request, Expense $expense)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'expense_date' => 'required|date',
            'reference_no' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,paid,cancelled'
        ]);

        $expense->update($validated);

        return redirect()->route('expenses.index')
            ->with('success', 'Expense updated successfully');
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('expenses.index')
            ->with('success', 'Expense deleted successfully');
    }
}
