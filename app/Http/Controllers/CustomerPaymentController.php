<?php

namespace App\Http\Controllers;

use App\Models\CustomerPayment;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerPaymentController extends Controller
{
    public function index()
    {
        $payments = CustomerPayment::with('customer')->latest()->paginate(20);
        return view('customer-payments.index', compact('payments'));
    }

    public function create()
    {
        $customers = Customer::where('status', 'active')->get();
        return view('customer-payments.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'payment_method' => 'required|string|max:255',
            'reference_no' => 'nullable|string|max:255',
            'notes' => 'nullable|string'
        ]);

        CustomerPayment::create($validated);

        return redirect()->route('customer-payments.index')
            ->with('success', 'Customer payment recorded successfully');
    }

    public function show(CustomerPayment $customerPayment)
    {
        $customerPayment->load('customer');
        return view('customer-payments.show', compact('customerPayment'));
    }

    public function edit(CustomerPayment $customerPayment)
    {
        $customers = Customer::where('status', 'active')->get();
        return view('customer-payments.edit', compact('customerPayment', 'customers'));
    }

    public function update(Request $request, CustomerPayment $customerPayment)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'payment_method' => 'required|string|max:255',
            'reference_no' => 'nullable|string|max:255',
            'notes' => 'nullable|string'
        ]);

        $customerPayment->update($validated);

        return redirect()->route('customer-payments.index')
            ->with('success', 'Customer payment updated successfully');
    }

    public function destroy(CustomerPayment $customerPayment)
    {
        $customerPayment->delete();
        return redirect()->route('customer-payments.index')
            ->with('success', 'Customer payment deleted successfully');
    }
}
