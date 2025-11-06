<x-layout title="✏️ Edit Income - Al Nafi Travels">
    <x-page-header
        title="✏️ Edit Income"
        icon="💰"
        backUrl="/incomes"
    />

    <div class="card">
            <form action="/incomes/{{ $income->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="customer_id">Customer *</label>
                    <select id="customer_id" name="customer_id" required>
                        <option value="">Select Customer</option>
                        @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" {{ $income->customer_id == $customer->id ? 'selected' : '' }}>{{ $customer->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="item_id">Item/Service</label>
                    <select id="item_id" name="item_id">
                        <option value="">Select Item (Optional)</option>
                        @foreach($items as $item)
                        <option value="{{ $item->id }}" {{ $income->item_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="amount">Amount (Rs) *</label>
                    <input type="number" id="amount" name="amount" step="0.01" value="{{ $income->amount }}" required>
                </div>
                <div class="form-group">
                    <label for="income_date">Income Date *</label>
                    <input type="date" id="income_date" name="income_date" value="{{ $income->income_date->format('Y-m-d') }}" required>
                </div>
                <div class="form-group">
                    <label for="reference_no">Reference No</label>
                    <input type="text" id="reference_no" name="reference_no" value="{{ $income->reference_no }}">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description">{{ $income->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="status">Status *</label>
                    <select id="status" name="status" required>
                        <option value="completed" {{ $income->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="pending" {{ $income->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="cancelled" {{ $income->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <div style="margin-top: 30px;">
                    <button type="submit" class="btn btn-primary">💾 Update Income</button>
                    <a href="/incomes" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
            
            <form action="/incomes/{{ $income->id }}" method="POST" style="margin-top: 30px; padding-top: 30px; border-top: 2px solid #eee;" onsubmit="return confirm('Are you sure you want to delete this income? This action cannot be undone.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">🗑️ Delete Income</button>
            </form>
        </div>
    </div>
<script src="/js/mobile-menu.js"></script>
</x-layout>
