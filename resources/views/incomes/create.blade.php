<x-layout title="➕ Add Income (Sell) - Al Nafi Travels">
    <x-page-header
        title="➕ Add Income (Sell)"
        icon="💰"
        backUrl="/incomes"
    />

    <div class="card">
            <form action="/incomes" method="POST">
                @csrf
                <div class="form-group">
                    <label for="customer_id">Customer *</label>
                    <select id="customer_id" name="customer_id" required>
                        <option value="">Select Customer</option>
                        @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="item_id">Item/Service</label>
                    <select id="item_id" name="item_id">
                        <option value="">Select Item (Optional)</option>
                        @foreach($items as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="amount">Amount (Rs) *</label>
                    <input type="number" id="amount" name="amount" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="paid_amount">Paid Amount (Rs)</label>
                    <input type="number" id="paid_amount" name="paid_amount" step="0.01" value="0" min="0">
                    <small style="color: #666; display: block; margin-top: 5px;">Enter 0 for unpaid, full amount for paid, or partial amount</small>
                </div>
                <div class="form-group">
                    <label for="income_date">Income Date *</label>
                    <input type="date" id="income_date" name="income_date" value="{{ date('Y-m-d') }}" required>
                </div>
                <div class="form-group">
                    <label for="reference_no">Reference No</label>
                    <input type="text" id="reference_no" name="reference_no" placeholder="Invoice/Reference number">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" placeholder="Additional details"></textarea>
                </div>
                <div class="form-group">
                    <label for="status">Status *</label>
                    <select id="status" name="status" required>
                        <option value="completed">Completed (Service Delivered)</option>
                        <option value="pending">Pending (Service Not Delivered)</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                    <small style="color: #666; display: block; margin-top: 5px;">Completed = Service delivered to customer</small>
                </div>
                <div style="margin-top: 30px;">
                    <button type="submit" class="btn btn-primary">💾 Save Income (Sell)</button>
                    <a href="/incomes" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
<script src="/js/mobile-menu.js"></script>
</x-layout>
