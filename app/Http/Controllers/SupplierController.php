<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

    public function ledger(Request $request, Supplier $supplier)
    {
        $range = $request->input('range', 'all');
        $customStartInput = $request->input('start_date');
        $customEndInput = $request->input('end_date');

        $startDate = null;
        $endDate = null;
        $rangeLabel = 'All time';

        switch ($range) {
            case 'today':
                $startDate = Carbon::today()->startOfDay();
                $endDate = Carbon::today()->endOfDay();
                $rangeLabel = 'Today (' . Carbon::today()->format('d M Y') . ')';
                break;
            case 'yesterday':
                $startDate = Carbon::yesterday()->startOfDay();
                $endDate = Carbon::yesterday()->endOfDay();
                $rangeLabel = 'Yesterday (' . Carbon::yesterday()->format('d M Y') . ')';
                break;
            case 'last7':
                $startDate = Carbon::today()->subDays(6)->startOfDay();
                $endDate = Carbon::today()->endOfDay();
                $rangeLabel = 'Last 7 days (' . $startDate->format('d M Y') . ' - ' . $endDate->format('d M Y') . ')';
                break;
            case 'last30':
                $startDate = Carbon::today()->subDays(29)->startOfDay();
                $endDate = Carbon::today()->endOfDay();
                $rangeLabel = 'Last 30 days (' . $startDate->format('d M Y') . ' - ' . $endDate->format('d M Y') . ')';
                break;
            case 'custom':
                if ($customStartInput) {
                    $startDate = Carbon::parse($customStartInput)->startOfDay();
                    if ($customEndInput) {
                        $endDate = Carbon::parse($customEndInput)->endOfDay();
                    } else {
                        $endDate = (clone $startDate)->endOfDay();
                    }
                    $rangeLabel = 'Custom (' . $startDate->format('d M Y') . ' - ' . $endDate->format('d M Y') . ')';
                }
                break;
            default:
                $range = 'all';
                break;
        }

        $supplier->load(['purchases' => function($q) use ($startDate, $endDate) {
            if ($startDate && $endDate) {
                $q->whereBetween('purchase_date', [$startDate, $endDate]);
            }
            $q->orderBy('purchase_date', 'desc');
        }, 'payments' => function($q) use ($startDate, $endDate) {
            if ($startDate && $endDate) {
                $q->whereBetween('payment_date', [$startDate, $endDate]);
            }
            $q->orderBy('payment_date', 'desc');
        }]);
        
        return view('suppliers.ledger', [
            'supplier' => $supplier,
            'activeRange' => $range,
            'filterStart' => $range === 'custom' ? $customStartInput : '',
            'filterEnd' => $range === 'custom' ? $customEndInput : '',
            'rangeLabel' => $rangeLabel,
        ]);
    }
}
