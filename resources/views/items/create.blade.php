<x-layout title="➕ Add New Item - Al Nafi Travels">
    <x-page-header
        title="➕ Add New Item"
        icon="📦"
        backUrl="/items"
    />

    <div class="card">
            <form action="/items" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Item/Service Name *</label>
                    <input type="text" id="name" name="name" required placeholder="e.g., Hajj Package, Umrah Package">
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <input type="text" id="category" name="category" placeholder="e.g., Tour Package, Visa, Insurance">
                </div>
                <div class="form-group">
                    <label for="unit">Unit *</label>
                    <input type="text" id="unit" name="unit" required placeholder="e.g., Package, Person, Service">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" placeholder="Additional details about this item/service"></textarea>
                </div>
                <div class="form-group">
                    <label for="status">Status *</label>
                    <select id="status" name="status" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div style="margin-top: 30px;">
                    <button type="submit" class="btn btn-primary">💾 Save Item</button>
                    <a href="/items" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
<script src="/js/mobile-menu.js"></script>
</x-layout>
