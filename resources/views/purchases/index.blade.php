<x-layout title="Purchases - Al Nafi Travels" pageTitle="Purchases"
    pageSubtitle="Track all your purchases from suppliers">
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

        .table-container { overflow-x: auto; }

        table { width: 100%; border-collapse: collapse; font-size: 12px; }
        th, td { padding: 10px 12px; text-align: left; border-bottom: 1px solid var(--border); }
        th { background: #f9f5eb; font-weight: 600; font-size: 10px; color: var(--text-light); text-transform:
        uppercase; }
        tr:hover { background: #fffdf7; }

        .supplier-link { color: var(--primary-dark); text-decoration: none; font-weight: 600; }
        .supplier-link:hover { text-decoration: underline; }

        .amount-col { font-weight: 700; color: var(--text); }
        .paid-col { color: #2e7d32; font-size: 11px; }
        .remaining-col { color: #c62828; font-size: 10px; }

        .modal-overlay {
        display: none;
        position: fixed;
        top: 0; left: 0; width: 100vw; height: 100vh;
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

        .modal-header { display: flex; align-items: center; gap: 10px; margin-bottom: 20px; }
        .modal-icon { width: 40px; height: 40px; border-radius: 12px; background: linear-gradient(135deg, #5d4e37 0%,
        #8b7355 100%); display: flex; align-items: center; justify-content: center; font-size: 18px; }
        .modal-title { font-size: 16px; font-weight: 600; color: var(--text); }
        .modal-close { position: absolute; top: 12px; right: 16px; background: none; border: none; font-size: 22px;
        color: var(--text-light); cursor: pointer; }

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
    </x-slot:styles>

    <div class="page-actions">
        <div class="search-box">
            <input type="text" id="searchInput" placeholder="Search purchases..." onkeyup="filterTable()">
        </div>
        <button class="btn btn-success" onclick="openCreateModal()">
            <span>➕</span> New Purchase
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
            <table id="purchasesTable">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Supplier</th>
                        <th>Item</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Paid</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($purchases as $purchase)
                        <tr data-status="{{ $purchase->payment_status }}"
                            data-supplier="{{ strtolower($purchase->supplier->name ?? '') }}">
                            <td>{{ $purchase->purchase_date->format('d M Y') }}</td>
                            <td>
                                @if($purchase->supplier)
                                    <a href="{{ route('suppliers.ledger', $purchase->supplier->id) }}"
                                        class="supplier-link">{{ $purchase->supplier->name }}</a>
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>{{ $purchase->item->name ?? 'N/A' }}</td>
                            <td>{{ $purchase->quantity }}</td>
                            <td class="amount-col">Rs {{ number_format($purchase->total_amount) }}</td>
                            <td>
                                <span class="paid-col">Rs {{ number_format($purchase->paid_amount) }}</span>
                                @if($purchase->remaining_amount > 0)
                                    <br><span class="remaining-col">Due: Rs
                                        {{ number_format($purchase->remaining_amount) }}</span>
                                @endif
                            </td>
                            <td>
                                @if($purchase->payment_status == 'paid')
                                    <span class="badge badge-success">✓ Paid</span>
                                @elseif($purchase->payment_status == 'partial')
                                    <span class="badge badge-warning">◐ Partial</span>
                                @else
                                    <span class="badge badge-danger">✗ Unpaid</span>
                                @endif
                            </td>
                            <td class="actions">
                                @if($purchase->payment_status != 'paid')
                                    <button class="btn btn-success btn-sm"
                                        onclick="openPaymentModal({{ $purchase->id }}, {{ $purchase->remaining_amount }})">💵</button>
                                @endif
                                <a href="/purchases/{{ $purchase->id }}" class="btn btn-primary btn-sm">👁️</a>
                                <a href="/purchases/{{ $purchase->id }}/edit" class="btn btn-secondary btn-sm">✏️</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="text-align: center; padding: 40px; color: var(--text-light);">No
                                purchases found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Create Purchase Modal -->
    <div class="modal-overlay" id="createModal">
        <div class="modal-content">
            <button class="modal-close" onclick="closeCreateModal()">&times;</button>
            <div class="modal-header">
                <div class="modal-icon">🛒</div>
                <h3 class="modal-title">New Purchase</h3>
            </div>
            <form action="/purchases" method="POST">
                @csrf
                <div class="form-grid">
                    <div class="form-group">
                        <label>Supplier *</label>
                        <select name="supplier_id" required>
                            <option value="">Select Supplier</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Item *</label>
                        <select name="item_id" required>
                            <option value="">Select Item</option>
                            @foreach($items as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Quantity *</label>
                        <input type="number" name="quantity" step="0.01" required placeholder="1">
                    </div>
                    <div class="form-group">
                        <label>Unit Price (Rs) *</label>
                        <input type="number" name="unit_price" step="0.01" required placeholder="0.00">
                    </div>
                    <div class="form-group">
                        <label>Date *</label>
                        <input type="date" name="purchase_date" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Paid (Rs)</label>
                        <input type="number" name="paid_amount" step="0.01" value="0" min="0">
                        <small>0 = unpaid</small>
                    </div>
                    <div class="form-group">
                        <label>Reference</label>
                        <input type="text" name="reference_no" placeholder="Invoice #">
                    </div>
                    <div class="form-group full-width">
                        <label>Notes</label>
                        <textarea name="notes" placeholder="Optional notes..."></textarea>
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
                <h3 class="modal-title">Pay Supplier</h3>
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
                    <button type="submit" class="btn btn-success" style="flex: 1;">✅ Pay</button>
                    <button type="button" class="btn btn-secondary" onclick="closePaymentModal()"
                        style="flex: 1;">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function filterTable() {
            const search = document.getElementById('searchInput').value.toLowerCase();
            document.querySelectorAll('#purchasesTable tbody tr').forEach(row => {
                const supplier = row.getAttribute('data-supplier') || '';
                row.style.display = supplier.includes(search) ? '' : 'none';
            });
        }

        function filterByStatus(status) {
            document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
            event.target.classList.add('active');
            document.querySelectorAll('#purchasesTable tbody tr').forEach(row => {
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
            document.getElementById('paymentForm').action = '/purchases/' + id + '/add-payment';
        }
        function closePaymentModal() { document.getElementById('paymentModal').style.display = 'none'; }

        document.addEventListener('keydown', e => { if (e.key === 'Escape') { closeCreateModal(); closePaymentModal(); } });
    </script>
</x-layout>