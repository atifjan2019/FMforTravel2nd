<x-layout title="➕ Add New Supplier - Al Nafi Travels">
    <x-page-header
        title="➕ Add New Supplier"
        icon="🏢"
        backUrl="/suppliers"
    />

    <div class="card">
            <form action="/suppliers" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Supplier Name *</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number *</label>
                    <input type="text" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea id="address" name="address"></textarea>
                </div>
                <div class="form-group">
                    <label for="status">Status *</label>
                    <select id="status" name="status" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div style="margin-top: 30px;">
                    <button type="submit" class="btn btn-primary">💾 Save Supplier</button>
                    <a href="/suppliers" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
<script src="/js/mobile-menu.js"></script>
</x-layout>
