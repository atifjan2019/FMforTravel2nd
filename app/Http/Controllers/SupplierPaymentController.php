<?php

namespace App\Http\Controllers;

use App\Models\SupplierPayment;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierPaymentController extends Controller
{
    public function index()
    {
        $payments = SupplierPayment::with('supplier')->latest()->paginate(20);
        return view('supplier-payments.index', compact('payments'));
    }

    public function create()
    {
        $suppliers = Supplier::where('status', 'active')->get();
        return view('supplier-payments.create', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'payment_method' => 'required|string|max:255',
            'reference_no' => 'nullable|string|max:255',
            'notes' => 'nullable|string'
        ]);

        SupplierPayment::create($validated);

        return redirect()->route('supplier-payments.index')
            ->with('success', 'Supplier payment recorded successfully');
    }

    public function show(SupplierPayment $supplierPayment)
    {
        $supplierPayment->load('supplier');
        return view('supplier-payments.show', compact('supplierPayment'));
    }

    public function edit(SupplierPayment $supplierPayment)
    {
        $suppliers = Supplier::where('status', 'active')->get();
        return view('supplier-payments.edit', compact('supplierPayment', 'suppliers'));
    }

    public function update(Request $request, SupplierPayment $supplierPayment)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'payment_method' => 'required|string|max:255',
            'reference_no' => 'nullable|string|max:255',
            'notes' => 'nullable|string'
        ]);

        $supplierPayment->update($validated);

        return redirect()->route('supplier-payments.index')
            ->with('success', 'Supplier payment updated successfully');
    }

    public function destroy(SupplierPayment $supplierPayment)
    {
        $supplierPayment->delete();
        return redirect()->route('supplier-payments.index')
            ->with('success', 'Supplier payment deleted successfully');
    }
}
