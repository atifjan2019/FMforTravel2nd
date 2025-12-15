<x-layout title="Suppliers - FM Travel Manager" pageTitle="Suppliers" pageSubtitle="Manage your suppliers and vendors">
    <x-slot:styles>
        .supplier-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 15px;
        margin-top: 15px;
        }

        .supplier-card {
        background: var(--card-bg);
        border-radius: 14px;
        padding: 18px;
        box-shadow: var(--shadow);
        transition: all 0.3s ease;
        border: 2px solid transparent;
        }

        .supplier-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-hover);
        border-color: var(--primary);
        }

        .supplier-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 14px;
        }

        .supplier-avatar {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: linear-gradient(135deg, #5d4e37 0%, #8b7355 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 16px;
        font-weight: 600;
        }

        .supplier-name {
        font-size: 14px;
        font-weight: 600;
        color: var(--text);
        margin-bottom: 2px;
        }

        .supplier-phone {
        font-size: 11px;
        color: var(--text-light);
        }

        .supplier-stats {
        display: flex;
        gap: 12px;
        margin-bottom: 14px;
        padding: 12px;
        background: #f9f5eb;
        border-radius: 10px;
        }

        .supplier-stat {
        flex: 1;
        text-align: center;
        }

        .supplier-stat .label {
        font-size: 9px;
        color: var(--text-light);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        }

        .supplier-stat .value {
        font-size: 16px;
        font-weight: 700;
        color: var(--text);
        margin-top: 2px;
        }

        .supplier-stat .value.paid { color: #2e7d32; }

        .supplier-actions {
        display: flex;
        gap: 8px;
        }

        .supplier-actions .btn {
        flex: 1;
        justify-content: center;
        }

        @media (max-width: 640px) {
        .supplier-grid {
        grid-template-columns: 1fr;
        }
        }

        .list-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        }
    </x-slot:styles>

    <div class="card">
        <div class="list-header">
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Search suppliers..." onkeyup="filterSuppliers()">
            </div>
            <a href="/suppliers/create" class="btn btn-success">
                <span>➕</span> Add Supplier
            </a>
        </div>

        <div class="supplier-grid" id="supplierGrid">
            @forelse($suppliers as $supplier)
                <div class="supplier-card" data-name="{{ strtolower($supplier->name) }}">
                    <div class="supplier-header">
                        <div class="supplier-avatar">
                            {{ strtoupper(substr($supplier->name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="supplier-name">{{ $supplier->name }}</div>
                            <div class="supplier-phone">📱 {{ $supplier->phone ?? 'No phone' }}</div>
                        </div>
                        <span class="badge {{ $supplier->status == 'active' ? 'badge-success' : 'badge-danger' }}"
                            style="margin-left: auto;">
                            {{ ucfirst($supplier->status) }}
                        </span>
                    </div>

                    <div class="supplier-stats">
                        <div class="supplier-stat">
                            <div class="label">Purchases</div>
                            <div class="value">{{ $supplier->purchases_count }}</div>
                        </div>
                        <div class="supplier-stat">
                            <div class="label">Payments</div>
                            <div class="value paid">{{ $supplier->payments_count }}</div>
                        </div>
                    </div>

                    <div class="supplier-actions">
                        <a href="/suppliers/{{ $supplier->id }}" class="btn btn-primary btn-sm">👁️ View</a>
                        <a href="{{ route('suppliers.ledger', $supplier->id) }}" class="btn btn-secondary btn-sm">📄
                            Ledger</a>
                        <a href="/suppliers/{{ $supplier->id }}/edit" class="btn btn-secondary btn-sm">✏️ Edit</a>
                    </div>
                </div>
            @empty
                <div class="empty-state" style="grid-column: 1 / -1;">
                    <div class="icon">🏢</div>
                    <h3>No suppliers yet</h3>
                    <p>Add your first supplier to get started</p>
                    <a href="/suppliers/create" class="btn btn-success">Add Supplier</a>
                </div>
            @endforelse
        </div>

        @if($suppliers->hasPages())
            <div style="margin-top: 20px; text-align: center;">
                {{ $suppliers->links() }}
            </div>
        @endif
    </div>

    <script>
        function filterSuppliers() {
            const search = document.getElementById('searchInput').value.toLowerCase();
            const cards = document.querySelectorAll('.supplier-card');

            cards.forEach(card => {
                const name = card.getAttribute('data-name');
                if (name.includes(search)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    </script>
</x-layout>