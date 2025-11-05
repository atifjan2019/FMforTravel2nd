<x-layout title="✏️ Edit Customer - Al Nafi Travels">
    <x-page-header
        title="✏️ Edit Customer"
        icon="👥"
        backUrl="/customers"
    />

    <div class="card">
            <form action="/customers/{{ $customer->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Customer Name *</label>
                    <input type="text" id="name" name="name" value="{{ $customer->name }}" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number *</label>
                    <input type="text" id="phone" name="phone" value="{{ $customer->phone }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ $customer->email }}">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea id="address" name="address">{{ $customer->address }}</textarea>
                </div>
                <div class="form-group">
                    <label for="status">Status *</label>
                    <select id="status" name="status" required>
                        <option value="active" {{ $customer->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $customer->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div style="margin-top: 30px;">
                    <button type="submit" class="btn btn-primary">💾 Update Customer</button>
                    <a href="/customers" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
            
            <form action="/customers/{{ $customer->id }}" method="POST" style="margin-top: 30px; padding-top: 30px; border-top: 2px solid #eee;" onsubmit="return confirm('Are you sure you want to delete this customer? This action cannot be undone.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">🗑️ Delete Customer</button>
            </form>
        </div>
    </div>
</x-layout>
