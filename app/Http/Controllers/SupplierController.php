<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::withCount(['purchases', 'payments'])->paginate(20);
        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('suppliers.create');
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

        Supplier::create($validated);

        return redirect()->route('suppliers.index')
            ->with('success', 'Supplier created successfully');
    }

    public function show(Supplier $supplier)
    {
        $supplier->load(['purchases', 'payments']);
        return view('suppliers.show', compact('supplier'));
    }

    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive'
        ]);

        $supplier->update($validated);

        return redirect()->route('suppliers.index')
            ->with('success', 'Supplier updated successfully');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('suppliers.index')
            ->with('success', 'Supplier deleted successfully');
    }

    public function ledger(Supplier $supplier)
    {
        $supplier->load(['purchases' => function($q) {
            $q->orderBy('purchase_date', 'desc');
        }, 'payments' => function($q) {
            $q->orderBy('payment_date', 'desc');
        }]);
        
        return view('suppliers.ledger', compact('supplier'));
    }
}
