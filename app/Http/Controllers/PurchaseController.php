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
            'notes' => 'nullable|string',
            'paid_amount' => 'nullable|numeric|min:0'
        ]);

        $validated['total_amount'] = $validated['quantity'] * $validated['unit_price'];
        $validated['paid_amount'] = $validated['paid_amount'] ?? 0;
        $validated['remaining_amount'] = $validated['total_amount'] - $validated['paid_amount'];
        
        $purchase = Purchase::create($validated);
        $purchase->updatePaymentStatus();

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
            'notes' => 'nullable|string',
            'paid_amount' => 'nullable|numeric|min:0'
        ]);

        $validated['total_amount'] = $validated['quantity'] * $validated['unit_price'];
        $validated['paid_amount'] = $validated['paid_amount'] ?? $purchase->paid_amount;
        $validated['remaining_amount'] = $validated['total_amount'] - $validated['paid_amount'];
        
        $purchase->update($validated);
        $purchase->updatePaymentStatus();

        return redirect()->route('purchases.index')
            ->with('success', 'Purchase updated successfully');
    }

    public function destroy(Purchase $purchase)
    {
        $purchase->delete();
        return redirect()->route('purchases.index')
            ->with('success', 'Purchase deleted successfully');
    }

    public function addPayment(Request $request, Purchase $purchase)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'payment_method' => 'required|string|in:Cash,Online,Check',
            'person_reference' => 'nullable|string|max:255',
            'payment_date' => 'required|date'
        ]);

        try {
            // Record payment history
            $purchase->paymentHistory()->create([
                'amount' => $validated['amount'],
                'payment_method' => $validated['payment_method'],
                'person_reference' => $validated['person_reference'] ?? null,
                'payment_date' => $validated['payment_date']
            ]);
            
            // Update purchase paid amount
            $purchase->addPayment($validated['amount']);
            
            return redirect()->back()
                ->with('success', 'Payment added successfully');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', $e->getMessage());
        }
    }
    
    public function paymentHistory(Purchase $purchase)
    {
        $purchase->load(['supplier', 'item', 'paymentHistory']);
        return view('purchases.payment-history', compact('purchase'));
    }
}
