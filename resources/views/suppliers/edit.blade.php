<x-layout title="✏️ Edit Supplier - Al Nafi Travels">
    <x-page-header
        title="✏️ Edit Supplier"
        icon="🏢"
        backUrl="/suppliers"
    />

    <div class="card">
            <form action="/suppliers/{{ $supplier->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Supplier Name *</label>
                    <input type="text" id="name" name="name" value="{{ $supplier->name }}" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number *</label>
                    <input type="text" id="phone" name="phone" value="{{ $supplier->phone }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ $supplier->email }}">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea id="address" name="address">{{ $supplier->address }}</textarea>
                </div>
                <div class="form-group">
                    <label for="status">Status *</label>
                    <select id="status" name="status" required>
                        <option value="active" {{ $supplier->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $supplier->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div style="margin-top: 30px;">
                    <button type="submit" class="btn btn-primary">💾 Update Supplier</button>
                    <a href="/suppliers" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
            
            <form action="/suppliers/{{ $supplier->id }}" method="POST" style="margin-top: 30px; padding-top: 30px; border-top: 2px solid #eee;" onsubmit="return confirm('Are you sure you want to delete this supplier? This action cannot be undone.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">🗑️ Delete Supplier</button>
            </form>
        </div>
    </div>
<script src="/js/mobile-menu.js"></script>
</x-layout>
