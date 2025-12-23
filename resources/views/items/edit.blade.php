<x-layout title="Edit Item - Al Nafi Travels" pageTitle="Edit Item" pageSubtitle="Update item details">
    <x-slot:styles>
        .form-card { max-width: 500px; }
        .form-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px; }
        .form-grid .full-width { grid-column: 1 / -1; }
        .form-group { margin-bottom: 12px; }
        .form-group label { display: block; font-size: 11px; font-weight: 600; color: var(--text); margin-bottom: 4px; }
        .form-group input, .form-group select, .form-group textarea { width: 100%; padding: 8px 12px; border: 1.5px
        solid var(--border); border-radius: 6px; font-size: 12px; font-family: 'Poppins', sans-serif; background: white;
        }
        .form-group textarea { min-height: 50px; resize: vertical; }
        .form-group input:focus, .form-group select:focus, .form-group textarea:focus { outline: none; border-color:
        var(--primary); box-shadow: 0 0 0 2px rgba(212, 160, 23, 0.1); }
        .form-actions { display: flex; gap: 10px; margin-top: 18px; padding-top: 15px; border-top: 1px solid
        var(--border); }
        .danger-zone { margin-top: 20px; padding-top: 15px; border-top: 1px solid var(--border); }
        @media (max-width: 640px) { .form-grid { grid-template-columns: 1fr; } }
    </x-slot:styles>

    <div class="card form-card">
        <form action="/items/{{ $item->id }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-grid">
                <div class="form-group full-width">
                    <label for="name">Item Name *</label>
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
                    <label for="status">Status *</label>
                    <select id="status" name="status" required>
                        <option value="active" {{ $item->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $item->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="form-group full-width">
                    <label for="description">Description</label>
                    <textarea id="description" name="description">{{ $item->description }}</textarea>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-success">💾 Update</button>
                <a href="/items" class="btn btn-secondary">Cancel</a>
            </div>
        </form>

        <form action="/items/{{ $item->id }}" method="POST" class="danger-zone"
            onsubmit="return confirm('Delete this item?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">🗑️ Delete</button>
        </form>
    </div>
</x-layout>