<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::withCount(['incomes', 'payments'])->paginate(20);
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive'
        ]);

        Customer::create($validated);

        return redirect()->route('customers.index')
            ->with('success', 'Customer created successfully');
    }

    public function show(Customer $customer)
    {
        $customer->load(['incomes', 'payments']);
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive'
        ]);

        $customer->update($validated);

        return redirect()->route('customers.index')
            ->with('success', 'Customer updated successfully');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')
            ->with('success', 'Customer deleted successfully');
    }

    public function ledger(Customer $customer)
    {
        $customer->load(['incomes' => function($q) {
            $q->orderBy('income_date', 'desc');
        }, 'payments' => function($q) {
            $q->orderBy('payment_date', 'desc');
        }]);
        
        return view('customers.ledger', compact('customer'));
    }
}
