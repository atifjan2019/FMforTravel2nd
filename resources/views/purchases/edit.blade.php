<x-layout title="✏️ Edit Purchase - Al Nafi Travels">
    <x-page-header
        title="✏️ Edit Purchase"
        icon="🛒"
        backUrl="/purchases"
    />

    <div class="card">
            <form action="/purchases/{{ $purchase->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="supplier_id">Supplier *</label>
                    <select id="supplier_id" name="supplier_id" required>
                        <option value="">Select Supplier</option>
                        @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ $purchase->supplier_id == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="item_id">Item/Service *</label>
                    <select id="item_id" name="item_id" required>
                        <option value="">Select Item</option>
                        @foreach($items as $item)
                        <option value="{{ $item->id }}" {{ $purchase->item_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid">
                    <div class="form-group">
                        <label for="quantity">Quantity *</label>
                        <input type="number" id="quantity" name="quantity" step="0.01" value="{{ $purchase->quantity }}" required>
                    </div>
                    <div class="form-group">
                        <label for="unit_price">Unit Price (Rs) *</label>
                        <input type="number" id="unit_price" name="unit_price" step="0.01" value="{{ $purchase->unit_price }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="purchase_date">Purchase Date *</label>
                    <input type="date" id="purchase_date" name="purchase_date" value="{{ $purchase->purchase_date->format('Y-m-d') }}" required>
                </div>
                <div class="form-group">
                    <label for="paid_amount">Paid Amount (Rs)</label>
                    <input type="number" id="paid_amount" name="paid_amount" step="0.01" value="{{ $purchase->paid_amount }}" min="0">
                    <small style="color: #666; display: block; margin-top: 5px;">Current: Rs {{ number_format($purchase->paid_amount) }} | Remaining: Rs {{ number_format($purchase->remaining_amount) }}</small>
                </div>
                <div class="form-group">
                    <label for="reference_no">Reference No</label>
                    <input type="text" id="reference_no" name="reference_no" value="{{ $purchase->reference_no }}">
                    <small style="color: #666; display: block; margin-top: 5px;">
                        Payment Status: 
                        @if($purchase->payment_status == 'paid')
                            <span style="color: #10b981; font-weight: bold;">✓ Paid</span>
                        @elseif($purchase->payment_status == 'partial')
                            <span style="color: #f59e0b; font-weight: bold;">◐ Partial</span>
                        @else
                            <span style="color: #ef4444; font-weight: bold;">✗ Unpaid</span>
                        @endif
                    </small>
                </div>
                <div class="form-group">
                    <label for="notes">Notes</label>
                    <textarea id="notes" name="notes">{{ $purchase->notes }}</textarea>
                </div>
                <div style="margin-top: 30px;">
                    <button type="submit" class="btn btn-primary">💾 Update Purchase</button>
                    <a href="/purchases" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
            
            <form action="/purchases/{{ $purchase->id }}" method="POST" style="margin-top: 30px; padding-top: 30px; border-top: 2px solid #eee;" onsubmit="return confirm('Are you sure you want to delete this purchase? This action cannot be undone.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">🗑️ Delete Purchase</button>
            </form>
        </div>
    </div>
<script src="/js/mobile-menu.js"></script>
</x-layout>
