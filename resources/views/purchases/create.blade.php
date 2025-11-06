<x-layout title="➕ Add New Purchase - Al Nafi Travels">
    <x-page-header
        title="➕ Add New Purchase"
        icon="🛒"
        backUrl="/purchases"
    />

    <div class="card">
            <form action="/purchases" method="POST">
                @csrf
                <div class="form-group">
                    <label for="supplier_id">Supplier *</label>
                    <select id="supplier_id" name="supplier_id" required>
                        <option value="">Select Supplier</option>
                        @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="item_id">Item/Service *</label>
                    <select id="item_id" name="item_id" required>
                        <option value="">Select Item</option>
                        @foreach($items as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid">
                    <div class="form-group">
                        <label for="quantity">Quantity *</label>
                        <input type="number" id="quantity" name="quantity" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="unit_price">Unit Price (Rs) *</label>
                        <input type="number" id="unit_price" name="unit_price" step="0.01" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="purchase_date">Purchase Date *</label>
                    <input type="date" id="purchase_date" name="purchase_date" value="{{ date('Y-m-d') }}" required>
                </div>
                <div class="form-group">
                    <label for="paid_amount">Paid Amount (Rs)</label>
                    <input type="number" id="paid_amount" name="paid_amount" step="0.01" value="0" min="0">
                    <small style="color: #666; display: block; margin-top: 5px;">Enter the amount paid to supplier. Leave 0 for unpaid, enter partial for partial payment, or full amount for paid.</small>
                </div>
                <div class="form-group">
                    <label for="reference_no">Reference No</label>
                    <input type="text" id="reference_no" name="reference_no" placeholder="Invoice/Reference number">
                </div>
                <div class="form-group">
                    <label for="notes">Notes</label>
                    <textarea id="notes" name="notes" placeholder="Additional notes"></textarea>
                </div>
                <div style="margin-top: 30px;">
                    <button type="submit" class="btn btn-primary">💾 Save Purchase</button>
                    <a href="/purchases" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
<script src="/js/mobile-menu.js"></script>
</x-layout>
