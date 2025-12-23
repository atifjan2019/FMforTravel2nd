<x-layout title="Customers - Al Nafi Travels" pageTitle="Customers" pageSubtitle="Manage all your customers here">
    <x-slot:styles>
        .customer-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 15px;
        margin-top: 15px;
        }

        .customer-card {
        background: var(--card-bg);
        border-radius: 14px;
        padding: 18px;
        box-shadow: var(--shadow);
        transition: all 0.3s ease;
        border: 2px solid transparent;
        }

        .customer-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-hover);
        border-color: var(--primary);
        }

        .customer-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 14px;
        }

        .customer-avatar {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: var(--accent);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-light);
        font-size: 16px;
        font-weight: 600;
        }

        .customer-name {
        font-size: 14px;
        font-weight: 600;
        color: var(--text);
        margin-bottom: 2px;
        }

        .customer-phone {
        font-size: 11px;
        color: var(--text-light);
        }

        .customer-stats {
        display: flex;
        gap: 12px;
        margin-bottom: 14px;
        padding: 12px;
        background: #f9f5eb;
        border-radius: 10px;
        }

        .customer-stat {
        flex: 1;
        text-align: center;
        }

        .customer-stat .label {
        font-size: 9px;
        color: var(--text-light);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        }

        .customer-stat .value {
        font-size: 16px;
        font-weight: 700;
        color: var(--text);
        margin-top: 2px;
        }

        .customer-stat .value.green { color: #2e7d32; }

        .customer-actions {
        display: flex;
        gap: 8px;
        }

        .customer-actions .btn {
        flex: 1;
        justify-content: center;
        }

        @media (max-width: 640px) {
        .customer-grid {
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
                <input type="text" id="searchInput" placeholder="Search customers..." onkeyup="filterCustomers()">
            </div>
            <a href="/customers/create" class="btn btn-success">
                <span>➕</span> Add Customer
            </a>
        </div>

        <div class="customer-grid" id="customerGrid">
            @forelse($customers as $customer)
                <div class="customer-card" data-name="{{ strtolower($customer->name) }}">
                    <div class="customer-header">
                        <div class="customer-avatar">
                            {{ strtoupper(substr($customer->name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="customer-name">{{ $customer->name }}</div>
                            <div class="customer-phone">📱 {{ $customer->phone ?? 'No phone' }}</div>
                        </div>
                        <span class="badge {{ $customer->status == 'active' ? 'badge-success' : 'badge-danger' }}"
                            style="margin-left: auto;">
                            {{ ucfirst($customer->status) }}
                        </span>
                    </div>

                    <div class="customer-stats">
                        <div class="customer-stat">
                            <div class="label">Sales</div>
                            <div class="value">{{ $customer->incomes_count }}</div>
                        </div>
                        <div class="customer-stat">
                            <div class="label">Payments</div>
                            <div class="value green">{{ $customer->payments_count }}</div>
                        </div>
                    </div>

                    <div class="customer-actions">
                        <a href="/customers/{{ $customer->id }}" class="btn btn-primary btn-sm">👁️ View</a>
                        <a href="{{ route('customers.ledger', $customer->id) }}" class="btn btn-secondary btn-sm">📄
                            Ledger</a>
                        <a href="/customers/{{ $customer->id }}/edit" class="btn btn-secondary btn-sm">✏️ Edit</a>
                    </div>
                </div>
            @empty
                <div class="empty-state" style="grid-column: 1 / -1;">
                    <div class="icon">👥</div>
                    <h3>No customers yet</h3>
                    <p>Add your first customer to get started</p>
                    <a href="/customers/create" class="btn btn-success">Add Customer</a>
                </div>
            @endforelse
        </div>

        @if($customers->hasPages())
            <div style="margin-top: 20px; text-align: center;">
                {{ $customers->links() }}
            </div>
        @endif
    </div>

    <script>
        function filterCustomers() {
            const search = document.getElementById('searchInput').value.toLowerCase();
            const cards = document.querySelectorAll('.customer-card');

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