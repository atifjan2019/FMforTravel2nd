<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::paginate(20);
        return view('items.index', compact('items'));
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'unit' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive'
        ]);

        Item::create($validated);

        return redirect()->route('items.index')
            ->with('success', 'Item created successfully');
    }

    public function show(Item $item)
    {
        $item->load(['purchases', 'incomes']);
        return view('items.show', compact('item'));
    }

    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'unit' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive'
        ]);

        $item->update($validated);

        return redirect()->route('items.index')
            ->with('success', 'Item updated successfully');
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('items.index')
            ->with('success', 'Item deleted successfully');
    }
}
