<x-layout title="✏️ Edit Item - Al Nafi Travels">
    <x-page-header
        title="✏️ Edit Item"
        icon="📦"
        backUrl="/items"
    />

    <div class="card">
            <form action="/items/{{ $item->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Item/Service Name *</label>
                    <input type="text" id="name" name="name" value="{{ $item->name }}" required>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <input type="text" id="category" name="category" value="{{ $item->category }}">
                </div>
                <div class="form-group">
                    <label for="unit">Unit *</label>
                    <input type="text" id="unit" name="unit" value="{{ $item->unit }}" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description">{{ $item->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="status">Status *</label>
                    <select id="status" name="status" required>
                        <option value="active" {{ $item->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $item->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div style="margin-top: 30px;">
                    <button type="submit" class="btn btn-primary">💾 Update Item</button>
                    <a href="/items" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
            
            <form action="/items/{{ $item->id }}" method="POST" style="margin-top: 30px; padding-top: 30px; border-top: 2px solid #eee;" onsubmit="return confirm('Are you sure you want to delete this item? This action cannot be undone.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">🗑️ Delete Item</button>
            </form>
        </div>
    </div>
<script src="/js/mobile-menu.js"></script>
</x-layout>
