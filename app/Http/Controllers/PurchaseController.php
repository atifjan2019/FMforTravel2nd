<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Item;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with(['supplier', 'item'])->latest()->paginate(20);
        return view('purchases.index', compact('purchases'));
    }

    public function create()
    {
        $suppliers = Supplier::where('status', 'active')->get();
        $items = Item::where('status', 'active')->get();
        return view('purchases.create', compact('suppliers', 'items'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|numeric|min:0',
            'unit_price' => 'required|numeric|min:0',
            'purchase_date' => 'required|date',
            'reference_no' => 'nullable|string|max:255',
            'notes' => 'nullable|string'
        ]);

        $validated['total_amount'] = $validated['quantity'] * $validated['unit_price'];
        Purchase::create($validated);

        return redirect()->route('purchases.index')
            ->with('success', 'Purchase created successfully');
    }

    public function show(Purchase $purchase)
    {
        $purchase->load(['supplier', 'item']);
        return view('purchases.show', compact('purchase'));
    }

    public function edit(Purchase $purchase)
    {
        $suppliers = Supplier::where('status', 'active')->get();
        $items = Item::where('status', 'active')->get();
        return view('purchases.edit', compact('purchase', 'suppliers', 'items'));
    }

    public function update(Request $request, Purchase $purchase)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|numeric|min:0',
            'unit_price' => 'required|numeric|min:0',
            'purchase_date' => 'required|date',
            'reference_no' => 'nullable|string|max:255',
            'notes' => 'nullable|string'
        ]);

        $validated['total_amount'] = $validated['quantity'] * $validated['unit_price'];
        $purchase->update($validated);

        return redirect()->route('purchases.index')
            ->with('success', 'Purchase updated successfully');
    }

    public function destroy(Purchase $purchase)
    {
        $purchase->delete();
        return redirect()->route('purchases.index')
            ->with('success', 'Purchase deleted successfully');
    }
}
