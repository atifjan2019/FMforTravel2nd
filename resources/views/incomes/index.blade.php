<x-layout title="Sales - Al Nafi Travels" pageTitle="Sales" pageSubtitle="Track all your sales and income">
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

        .table-container {
        overflow-x: auto;
        }

        table {
        width: 100%;
        border-collapse: collapse;
        font-size: 12px;
        }

        th, td {
        padding: 10px 12px;
        text-align: left;
        border-bottom: 1px solid var(--border);
        }

        th {
        background: #f9f5eb;
        font-weight: 600;
        font-size: 10px;
        color: var(--text-light);
        text-transform: uppercase;
        }

        tr:hover { background: #fffdf7; }

        .customer-link {
        color: var(--primary-dark);
        text-decoration: none;
        font-weight: 600;
        }

        .customer-link:hover { text-decoration: underline; }

        .amount-col { font-weight: 700; color: var(--text); }
        .paid-col { color: #2e7d32; font-size: 11px; }
        .remaining-col { color: #c62828; font-size: 10px; }

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
        max-width: 500px;
        margin: 15px;
        box-shadow: 0 15px 50px rgba(0,0,0,0.3);
        position: relative;
        max-height: 90vh;
        overflow-y: auto;
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

        .form-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px; }
        .form-grid .full-width { grid-column: 1 / -1; }
        .form-group { margin-bottom: 12px; }
        .form-group label { display: block; font-size: 11px; font-weight: 600; color: var(--text); margin-bottom: 4px; }
        .form-group input, .form-group select, .form-group textarea { width: 100%; padding: 8px 12px; border: 1.5px
        solid var(--border); border-radius: 6px; font-size: 12px; font-family: 'Poppins', sans-serif; background: white;
        }
        .form-group textarea { min-height: 50px; resize: vertical; }
        .form-group input:focus, .form-group select:focus, .form-group textarea:focus { outline: none; border-color:
        var(--primary); }
        .form-group small { color: var(--text-light); font-size: 10px; }
        .form-actions { display: flex; gap: 10px; margin-top: 18px; padding-top: 15px; border-top: 1px solid
        var(--border); }

        .alert { padding: 12px 16px; border-radius: 10px; margin-bottom: 15px; font-size: 12px; }
        .alert-success { background: #e8f5e9; color: #2e7d32; }
        .alert-error { background: #ffebee; color: #c62828; }
    </x-slot:styles>

    @if(session('success'))
        <div class="alert alert-success">✅ {{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">❌ {{ session('error') }}</div>
    @endif

    <div class="page-actions">
        <div class="search-box">
            <input type="text" id="searchInput" placeholder="Search sales..." onkeyup="filterTable()">
        </div>
        <button class="btn btn-success" onclick="openCreateModal()">
            <span>➕</span> New Sale
        </button>
    </div>

    <div class="filter-tabs" style="margin-bottom: 18px;">
        <button class="filter-tab active" onclick="filterByStatus('all')">📋 All</button>
        <button class="filter-tab" onclick="filterByStatus('paid')">✅ Paid</button>
        <button class="filter-tab" onclick="filterByStatus('partial')">⏳ Partial</button>
        <button class="filter-tab" onclick="filterByStatus('unpaid')">❌ Unpaid</button>
    </div>

    <div class="card">
        <div class="table-container">
            <table id="salesTable">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Customer</th>
                        <th>Item</th>
                        <th>Amount</th>
                        <th>Paid</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($incomes as $income)
                        <tr data-status="{{ $income->payment_status }}"
                            data-customer="{{ strtolower($income->customer->name ?? '') }}">
                            <td>{{ $income->income_date->format('d M Y') }}</td>
                            <td>
                                @if($income->customer)
                                    <a href="{{ route('customers.ledger', $income->customer->id) }}"
                                        class="customer-link">{{ $income->customer->name }}</a>
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>{{ $income->item->name ?? 'N/A' }}</td>
                            <td class="amount-col">Rs {{ number_format($income->amount) }}</td>
                            <td>
                                <span class="paid-col">Rs {{ number_format($income->paid_amount) }}</span>
                                @if($income->remaining_amount > 0)
                                    <br><span class="remaining-col">Due: Rs
                                        {{ number_format($income->remaining_amount) }}</span>
                                @endif
                            </td>
                            <td>
                                @if($income->payment_status == 'paid')
                                    <span class="badge badge-success">✓ Paid</span>
                                @elseif($income->payment_status == 'partial')
                                    <span class="badge badge-warning">◐ Partial</span>
                                @else
                                    <span class="badge badge-danger">✗ Unpaid</span>
                                @endif
                            </td>
                            <td class="actions">
                                @if($income->payment_status != 'paid')
                                    <button class="btn btn-success btn-sm"
                                        onclick="openPaymentModal({{ $income->id }}, {{ $income->remaining_amount }})">💵</button>
                                @endif
                                <a href="/incomes/{{ $income->id }}" class="btn btn-primary btn-sm">👁️</a>
                                <a href="/incomes/{{ $income->id }}/edit" class="btn btn-secondary btn-sm">✏️</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 40px; color: var(--text-light);">No sales
                                found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($incomes->hasPages())
        <div style="margin-top: 20px; text-align: center;">{{ $incomes->links() }}</div>
    @endif

    <!-- Create Sale Modal -->
    <div class="modal-overlay" id="createModal">
        <div class="modal-content">
            <button class="modal-close" onclick="closeCreateModal()">&times;</button>
            <div class="modal-header">
                <div class="modal-icon">💰</div>
                <h3 class="modal-title">New Sale</h3>
            </div>
            <form action="/incomes" method="POST">
                @csrf
                <div class="form-grid">
                    <div class="form-group">
                        <label for="customer_id">Customer *</label>
                        <select id="customer_id" name="customer_id" required>
                            <option value="">Select Customer</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="item_id">Item/Service</label>
                        <select id="item_id" name="item_id">
                            <option value="">Optional</option>
                            @foreach($items as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount (Rs) *</label>
                        <input type="number" id="amount" name="amount" step="0.01" required placeholder="0.00">
                    </div>
                    <div class="form-group">
                        <label for="paid_amount">Paid (Rs)</label>
                        <input type="number" id="paid_amount" name="paid_amount" step="0.01" value="0" min="0">
                        <small>0 = unpaid</small>
                    </div>
                    <div class="form-group">
                        <label for="income_date">Date *</label>
                        <input type="date" id="income_date" name="income_date" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="reference_no">Reference</label>
                        <input type="text" id="reference_no" name="reference_no" placeholder="Invoice #">
                    </div>
                    <div class="form-group">
                        <label for="status">Status *</label>
                        <select id="status" name="status" required>
                            <option value="completed">Completed</option>
                            <option value="pending">Pending</option>
                        </select>
                    </div>
                    <div class="form-group full-width">
                        <label for="description">Notes</label>
                        <textarea id="description" name="description" placeholder="Optional notes..."></textarea>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-success" style="flex: 1;">💾 Save</button>
                    <button type="button" class="btn btn-secondary" onclick="closeCreateModal()"
                        style="flex: 1;">Cancel</button>
                </div>
            </form>
        </div>
    </div>

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
                <div class="form-group">
                    <label>Amount (Rs) *</label>
                    <input type="number" id="payment_amount" name="amount" min="1" step="0.01" required>
                    <small>Remaining: Rs <span id="modal_remaining">0</span></small>
                </div>
                <div class="form-group">
                    <label>Method *</label>
                    <select name="payment_method" required>
                        <option value="Cash">💵 Cash</option>
                        <option value="Online">📱 Online</option>
                        <option value="Check">📝 Check</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Reference</label>
                    <input type="text" name="person_reference" placeholder="Notes...">
                </div>
                <div class="form-group">
                    <label>Date *</label>
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
        function filterTable() {
            const search = document.getElementById('searchInput').value.toLowerCase();
            document.querySelectorAll('#salesTable tbody tr').forEach(row => {
                const customer = row.getAttribute('data-customer') || '';
                row.style.display = customer.includes(search) ? '' : 'none';
            });
        }

        function filterByStatus(status) {
            document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
            event.target.classList.add('active');
            document.querySelectorAll('#salesTable tbody tr').forEach(row => {
                const rowStatus = row.getAttribute('data-status');
                row.style.display = (status === 'all' || rowStatus === status) ? '' : 'none';
            });
        }

        function openCreateModal() { document.getElementById('createModal').style.display = 'flex'; }
        function closeCreateModal() { document.getElementById('createModal').style.display = 'none'; }

        function openPaymentModal(id, remaining) {
            document.getElementById('paymentModal').style.display = 'flex';
            document.getElementById('modal_remaining').innerText = Number(remaining).toLocaleString();
            document.getElementById('payment_amount').max = remaining;
            document.getElementById('payment_amount').value = '';
            const now = new Date();
            document.getElementById('payment_date').value = `${now.getFullYear()}-${String(now.getMonth() + 1).padStart(2, '0')}-${String(now.getDate()).padStart(2, '0')}T${String(now.getHours()).padStart(2, '0')}:${String(now.getMinutes()).padStart(2, '0')}`;
            document.getElementById('paymentForm').action = '/incomes/' + id + '/add-payment';
        }
        function closePaymentModal() { document.getElementById('paymentModal').style.display = 'none'; }

        document.addEventListener('keydown', e => { if (e.key === 'Escape') { closeCreateModal(); closePaymentModal(); } });
    </script>
</x-layout>