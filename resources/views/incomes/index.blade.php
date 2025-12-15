<x-layout title="Sales - FM Travel Manager" pageTitle="Sales" pageSubtitle="Track all your sales and income">
    <x-slot:styles>
        .page-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 18px;
        }

        .filter-tabs {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        }

        .filter-tab {
        padding: 7px 14px;
        border-radius: 8px;
        background: white;
        border: 2px solid var(--border);
        font-size: 12px;
        font-weight: 500;
        color: var(--text-light);
        cursor: pointer;
        transition: all 0.3s ease;
        }

        .filter-tab:hover, .filter-tab.active {
        border-color: var(--primary);
        color: var(--primary-dark);
        background: #fff8e1;
        }

        .sale-card {
        background: var(--card-bg);
        border-radius: 14px;
        padding: 16px;
        box-shadow: var(--shadow);
        margin-bottom: 12px;
        border-left: 4px solid #d4a017;
        transition: all 0.3s ease;
        }

        .sale-card:hover {
        transform: translateX(3px);
        box-shadow: var(--shadow-hover);
        }

        .sale-card.unpaid { border-left-color: #c62828; }
        .sale-card.partial { border-left-color: #f57c00; }

        .sale-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 12px;
        flex-wrap: wrap;
        gap: 8px;
        }

        .sale-customer {
        display: flex;
        align-items: center;
        gap: 10px;
        }

        .sale-avatar {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: linear-gradient(135deg, #d4a017 0%, #f5c518 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #2d2d2d;
        font-size: 14px;
        font-weight: 600;
        }

        .sale-avatar.unpaid { background: linear-gradient(135deg, #c62828 0%, #e74c3c 100%); color: white; }
        .sale-avatar.partial { background: linear-gradient(135deg, #f57c00 0%, #ff9800 100%); color: white; }

        .sale-name {
        font-size: 13px;
        font-weight: 600;
        color: var(--text);
        }

        .sale-item {
        font-size: 11px;
        color: var(--text-light);
        }

        .sale-amount {
        text-align: right;
        }

        .sale-amount .total {
        font-size: 18px;
        font-weight: 700;
        color: var(--text);
        }

        .sale-amount .paid {
        font-size: 11px;
        color: #2e7d32;
        }

        .sale-amount .remaining {
        font-size: 10px;
        color: #c62828;
        }

        .sale-details {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 12px;
        border-top: 1px solid var(--border);
        flex-wrap: wrap;
        gap: 8px;
        }

        .sale-meta {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        }

        .sale-meta-item {
        font-size: 11px;
        color: var(--text-light);
        }

        .sale-meta-item strong {
        color: var(--text);
        }

        .sale-actions {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
        }

        .alert {
        padding: 12px 16px;
        border-radius: 10px;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 500;
        font-size: 12px;
        }

        .alert-success {
        background: #e8f5e9;
        color: #2e7d32;
        }

        .alert-error {
        background: #ffebee;
        color: #c62828;
        }

        /* Modal Styles */
        .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(0,0,0,0.5);
        z-index: 9999;
        align-items: center;
        justify-content: center;
        }

        .modal-content {
        background: #fffdf7;
        padding: 24px;
        border-radius: 18px;
        width: 100%;
        max-width: 380px;
        margin: 15px;
        box-shadow: 0 15px 50px rgba(0,0,0,0.3);
        position: relative;
        }

        .modal-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
        }

        .modal-icon {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        background: linear-gradient(135deg, #d4a017 0%, #f5c518 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        }

        .modal-title {
        font-size: 16px;
        font-weight: 600;
        color: var(--text);
        }

        .modal-close {
        position: absolute;
        top: 12px;
        right: 16px;
        background: none;
        border: none;
        font-size: 22px;
        color: var(--text-light);
        cursor: pointer;
        }

        @media (max-width: 640px) {
        .sale-header {
        flex-direction: column;
        }

        .sale-amount {
        text-align: left;
        }

        .page-actions {
        flex-direction: column;
        align-items: stretch;
        }
        }
    </x-slot:styles>

    @if(session('success'))
        <div class="alert alert-success">
            ✅ {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            ❌ {{ session('error') }}
        </div>
    @endif

    <div class="page-actions">
        <div class="search-box">
            <input type="text" id="searchInput" placeholder="Search sales..." onkeyup="filterSales()">
        </div>
        <a href="/incomes/create" class="btn btn-success">
            <span>➕</span> New Sale
        </a>
    </div>

    <div class="filter-tabs" style="margin-bottom: 18px;">
        <button class="filter-tab active" onclick="filterByStatus('all')">📋 All</button>
        <button class="filter-tab" onclick="filterByStatus('paid')">✅ Paid</button>
        <button class="filter-tab" onclick="filterByStatus('partial')">⏳ Partial</button>
        <button class="filter-tab" onclick="filterByStatus('unpaid')">❌ Unpaid</button>
    </div>

    <div id="salesList">
        @forelse($incomes as $income)
            @php
                $statusClass = $income->payment_status == 'paid' ? '' : ($income->payment_status == 'partial' ? 'partial' : 'unpaid');
            @endphp
            <div class="sale-card {{ $statusClass }}" data-name="{{ strtolower($income->customer->name ?? '') }}"
                data-status="{{ $income->payment_status }}">
                <div class="sale-header">
                    <div class="sale-customer">
                        <div class="sale-avatar {{ $statusClass }}">
                            {{ strtoupper(substr($income->customer->name ?? 'U', 0, 1)) }}
                        </div>
                        <div>
                            <div class="sale-name">
                                @if($income->customer)
                                    <a href="{{ route('customers.ledger', $income->customer->id) }}"
                                        style="color: inherit; text-decoration: none;">
                                        {{ $income->customer->name }}
                                    </a>
                                @else
                                    Unknown Customer
                                @endif
                            </div>
                            <div class="sale-item">{{ $income->item->name ?? 'N/A' }}</div>
                        </div>
                    </div>
                    <div class="sale-amount">
                        <div class="total">Rs {{ number_format($income->amount) }}</div>
                        @if($income->paid_amount > 0)
                            <div class="paid">✓ Paid: Rs {{ number_format($income->paid_amount) }}</div>
                        @endif
                        @if($income->remaining_amount > 0)
                            <div class="remaining">Remaining: Rs {{ number_format($income->remaining_amount) }}</div>
                        @endif
                    </div>
                </div>

                <div class="sale-details">
                    <div class="sale-meta">
                        <div class="sale-meta-item">
                            📅 <strong>{{ $income->income_date->format('d M Y') }}</strong>
                        </div>
                        @if($income->reference_no)
                            <div class="sale-meta-item">
                                🏷️ {{ $income->reference_no }}
                            </div>
                        @endif
                        <div class="sale-meta-item">
                            @if($income->payment_status == 'paid')
                                <span class="badge badge-success">✓ Paid</span>
                            @elseif($income->payment_status == 'partial')
                                <span class="badge badge-warning">◐ Partial</span>
                            @else
                                <span class="badge badge-danger">✗ Unpaid</span>
                            @endif
                        </div>
                    </div>

                    <div class="sale-actions">
                        @if($income->payment_status != 'paid')
                            <button class="btn btn-success btn-sm"
                                onclick="openPaymentModal({{ $income->id }}, {{ $income->remaining_amount }})">
                                💵 Pay
                            </button>
                        @endif
                        <a href="/incomes/{{ $income->id }}" class="btn btn-primary btn-sm">👁️</a>
                        <a href="/incomes/{{ $income->id }}/edit" class="btn btn-secondary btn-sm">✏️</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="card">
                <div class="empty-state">
                    <div class="icon">💰</div>
                    <h3>No sales yet</h3>
                    <p>Record your first sale to get started</p>
                    <a href="/incomes/create" class="btn btn-success">Add Sale</a>
                </div>
            </div>
        @endforelse
    </div>

    @if($incomes->hasPages())
        <div style="margin-top: 20px; text-align: center;">
            {{ $incomes->links() }}
        </div>
    @endif

    <!-- Payment Modal -->
    <div class="modal-overlay" id="paymentModal">
        <div class="modal-content">
            <button class="modal-close" onclick="closePaymentModal()">&times;</button>

            <div class="modal-header">
                <div class="modal-icon">💵</div>
                <h3 class="modal-title">Receive Payment</h3>
            </div>

            <form id="paymentForm" method="POST">
                @csrf
                <input type="hidden" id="modal_income_id">

                <div class="form-group">
                    <label for="payment_amount">Amount (Rs) *</label>
                    <input type="number" id="payment_amount" name="amount" min="1" step="0.01" required
                        placeholder="Enter amount">
                    <small style="color: var(--text-light); font-size: 10px; margin-top: 4px; display: block;">
                        Remaining: Rs <span id="modal_remaining">0</span>
                    </small>
                </div>

                <div class="form-group">
                    <label for="payment_method">Payment Method *</label>
                    <select id="payment_method" name="payment_method" required>
                        <option value="Cash" selected>💵 Cash</option>
                        <option value="Online">📱 Online</option>
                        <option value="Check">📝 Check</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="person_reference">Reference / Notes</label>
                    <input type="text" id="person_reference" name="person_reference" placeholder="e.g., Receipt #123">
                </div>

                <div class="form-group">
                    <label for="payment_date">Date & Time *</label>
                    <input type="datetime-local" id="payment_date" name="payment_date" required>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-success" style="flex: 1;">✅ Receive</button>
                    <button type="button" class="btn btn-secondary" onclick="closePaymentModal()"
                        style="flex: 1;">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function filterSales() {
            const search = document.getElementById('searchInput').value.toLowerCase();
            const cards = document.querySelectorAll('.sale-card');

            cards.forEach(card => {
                const name = card.getAttribute('data-name');
                if (name.includes(search)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        function filterByStatus(status) {
            const cards = document.querySelectorAll('.sale-card');
            const tabs = document.querySelectorAll('.filter-tab');

            tabs.forEach(tab => tab.classList.remove('active'));
            event.target.classList.add('active');

            cards.forEach(card => {
                const cardStatus = card.getAttribute('data-status');
                if (status === 'all' || cardStatus === status) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        function openPaymentModal(incomeId, remaining) {
            document.getElementById('paymentModal').style.display = 'flex';
            document.getElementById('modal_income_id').value = incomeId;
            document.getElementById('modal_remaining').innerText = Number(remaining).toLocaleString();
            document.getElementById('payment_amount').max = remaining;
            document.getElementById('payment_amount').value = '';

            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const day = String(now.getDate()).padStart(2, '0');
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            document.getElementById('payment_date').value = `${year}-${month}-${day}T${hours}:${minutes}`;

            document.getElementById('paymentForm').action = '/incomes/' + incomeId + '/add-payment';
        }

        function closePaymentModal() {
            document.getElementById('paymentModal').style.display = 'none';
        }

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closePaymentModal();
        });
    </script>
</x-layout>