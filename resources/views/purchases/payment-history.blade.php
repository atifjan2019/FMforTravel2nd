<x-layout title="Payment History - FM Travel Manager" pageTitle="Payment History"
    pageSubtitle="Tracking payments for Purchase: {{ $purchase->item->name ?? 'Item' }}">

    <x-slot:styles>
        .summary-card {
        background: white;
        padding: 24px;
        border-radius: 16px;
        box-shadow: var(--shadow);
        border: 1px solid var(--border);
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 20px;
        }

        .summary-info {
        display: flex;
        align-items: center;
        gap: 20px;
        }

        .supplier-avatar {
        width: 60px;
        height: 60px;
        background: #ef4444;
        color: white;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        font-weight: 700;
        }

        .info-group h2 {
        font-size: 20px;
        color: var(--text);
        font-weight: 700;
        margin-bottom: 4px;
        }

        .info-group p {
        color: var(--text-light);
        font-size: 13px;
        }

        .financial-stats {
        display: flex;
        gap: 15px;
        }

        .stat-badge {
        padding: 10px 16px;
        border-radius: 10px;
        background: var(--bg);
        border: 1px solid var(--border);
        text-align: center;
        }

        .stat-badge .label {
        font-size: 10px;
        text-transform: uppercase;
        color: var(--text-light);
        margin-bottom: 2px;
        }

        .stat-badge .value {
        font-size: 16px;
        font-weight: 700;
        color: var(--text);
        }

        .stat-badge.highlight .value {
        color: #ef4444;
        }

        .history-card {
        background: white;
        border-radius: 16px;
        box-shadow: var(--shadow);
        border: 1px solid var(--border);
        }

        .action-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        border-bottom: 1px solid var(--border);
        }

        .action-buttons {
        display: flex;
        gap: 10px;
        }

        /* Modal Styles */
        .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        z-index: 9999;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(4px);
        }

        .modal-content {
        background: white;
        width: 100%;
        max-width: 500px;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        animation: slideUp 0.3s ease;
        }

        .modal-header {
        padding: 20px;
        border-bottom: 1px solid var(--border);
        display: flex;
        justify-content: space-between;
        align-items: center;
        }

        .modal-header h3 {
        font-size: 18px;
        font-weight: 600;
        }

        .modal-body {
        padding: 24px;
        }

        @keyframes slideUp {
        from { transform: translateY(20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
        }

        /* Print Styles */
        @media print {
        @page { margin: 1cm; size: A4; }
        body { background: white !important; color: black !important; }
        .no-print, .sidebar, .top-bar, .actions, .btn, .action-buttons { display: none !important; }
        .app-container { display: block !important; margin: 0 !important; }
        .main-content { margin: 0 !important; padding: 0 !important; width: 100% !important; }
        .card, .table-card, .summary-card, .history-card {
        box-shadow: none !important;
        border: 1px solid #eee !important;
        padding: 10px !important;
        margin-bottom: 20px !important;
        break-inside: avoid;
        background: white !important;
        }
        .summary-card { border-left-width: 4px !important; }

        /* Header Visibility */
        .print-header {
        display: flex !important;
        justify-content: space-between;
        align-items: center;
        border-bottom: 2px solid #000;
        padding-bottom: 15px;
        margin-bottom: 25px;
        }
        .company-branding { display: flex; align-items: center; gap: 15px; }
        .company-logo { font-size: 32px; }
        .company-info h1 { margin: 0; font-size: 24px; font-weight: bold; color: black !important; letter-spacing: 1px;
        }
        .company-info p { margin: 2px 0 0; font-size: 11px; color: #555 !important; text-transform: uppercase;
        letter-spacing: 2px;}
        .document-info { text-align: right; }
        .document-info h2 { margin: 0 0 5px; font-size: 18px; font-weight: bold; text-transform: uppercase; color: black
        !important; }
        .document-info p { margin: 0; font-size: 12px; color: #333 !important; }

        /* Table Improvements */
        table { width: 100% !important; border-collapse: collapse !important; font-size: 9pt !important; }
        th { background: #f8f8f8 !important; color: black !important; font-weight: bold !important; border-bottom: 2px
        solid #000 !important; padding: 8px !important; }
        td { border-bottom: 1px solid #ddd !important; padding: 8px !important; color: black !important; }
        tr:last-child td { border-bottom: none !important; }
        }
        .print-header { display: none; }
    </x-slot:styles>

    <!-- Print Header -->
    <div class="print-header">
        <div class="company-branding">
            <img src="/images/alnafi.png" alt="Al Nafi Travels" style="height: 80px; width: auto;">
        </div>
        <div class="document-info">
            <p><strong>Date:</strong> {{ now()->format('d M Y') }}</p>
        </div>
    </div>

    <!-- Top Summary Card -->
    <div class="summary-card">
        <div class="summary-info">
            <div class="supplier-avatar">
                {{ strtoupper(substr($purchase->supplier->name, 0, 1)) }}
            </div>
            <div class="info-group">
                <h2>{{ $purchase->supplier->name }}</h2>
                <p>Ref: {{ $purchase->reference_no ?? 'N/A' }} • Date: {{ $purchase->purchase_date->format('d M Y') }}
                </p>
            </div>
        </div>

        <div class="financial-stats">
            <div class="stat-badge">
                <div class="label">Total Amount</div>
                <div class="value">Rs {{ number_format($purchase->total_amount) }}</div>
            </div>
            <div class="stat-badge">
                <div class="label">Paid</div>
                <div class="value" style="color: var(--success)">Rs {{ number_format($purchase->paid_amount) }}</div>
            </div>
            <div class="stat-badge highlight">
                <div class="label">Remaining</div>
                <div class="value" style="color: var(--danger)">Rs {{ number_format($purchase->remaining_amount) }}
                </div>
            </div>
        </div>
    </div>

    <!-- History Table Card -->
    <div class="history-card">
        <div class="action-bar">
            <h3 class="card-title">Transaction History</h3>
            <div class="action-buttons no-print">
                @if($purchase->remaining_amount > 0)
                    <button onclick="openPurchasePaymentModal()" class="btn btn-warning"
                        style="background: #f59e0b; color: white;">
                        💰 Add Payment
                    </button>
                @endif
                <button onclick="window.print()" class="btn btn-secondary">
                    🖨️ Print
                </button>
            </div>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Date & Time</th>
                        <th>Amount</th>
                        <th>Method</th>
                        <th>Reference / Person</th>
                        <th>Notes</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($purchase->paymentHistory as $payment)
                        <tr>
                            <td>{{ $payment->payment_date->format('d M Y, h:i A') }}</td>
                            <td><strong style="color: #ef4444;">Rs {{ number_format($payment->amount) }}</strong></td>
                            <td>
                                <span class="badge 
                                            {{ $payment->payment_method == 'Cash' ? 'badge-success' : '' }}
                                            {{ $payment->payment_method == 'Online' ? 'badge-info' : '' }}
                                            {{ $payment->payment_method == 'Check' ? 'badge-warning' : '' }}">
                                    {{ $payment->payment_method }}
                                </span>
                            </td>
                            <td>{{ $payment->person_reference ?? '-' }}</td>
                            <td>{{ $payment->notes ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="empty-state">
                                <div class="icon" style="font-size: 30px; margin-bottom: 10px;">💸</div>
                                <p>No payments recorded yet.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div style="margin-top: 24px;" class="no-print">
        <a href="{{ route('suppliers.ledger', $purchase->supplier_id) }}" class="btn btn-secondary">← Back to Ledger</a>
    </div>

    <!-- Payment Modal -->
    <div id="purchasePaymentModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add Payment</h3>
                <button onclick="closePurchasePaymentModal()"
                    style="background:none; border:none; font-size:24px; cursor:pointer;">&times;</button>
            </div>
            <form id="purchasePaymentForm" action="/purchases/{{ $purchase->id }}/add-payment" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Amount (Rs) <span style="color:var(--danger)">*</span></label>
                        <input type="number" name="amount" min="1" step="0.01" max="{{ $purchase->remaining_amount }}"
                            value="{{ $purchase->remaining_amount }}" required autofocus>
                        <small style="color:var(--text-light); margin-top:4px; display:block;">
                            Max Payable: Rs {{ number_format($purchase->remaining_amount) }}
                        </small>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Payment Method</label>
                            <select name="payment_method" required>
                                <option value="Cash">Cash</option>
                                <option value="Online">Online</option>
                                <option value="Check">Check</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Payment Date</label>
                            <input type="datetime-local" id="purchase_payment_date" name="payment_date" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Reference / Person</label>
                        <input type="text" name="person_reference" placeholder="e.g. John Doe / PO-001">
                    </div>

                    <div class="form-actions" style="justify-content: flex-end; margin-top: 10px;">
                        <button type="button" class="btn btn-secondary"
                            onclick="closePurchasePaymentModal()">Cancel</button>
                        <button type="submit" class="btn btn-primary"
                            style="background: #f59e0b; border-color: #f59e0b;">Confirm Payment</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openPurchasePaymentModal() {
            const modal = document.getElementById('purchasePaymentModal');
            modal.style.display = 'flex';

            // Set current date/time
            const now = new Date();
            now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
            document.getElementById('purchase_payment_date').value = now.toISOString().slice(0, 16);
        }

        function closePurchasePaymentModal() {
            document.getElementById('purchasePaymentModal').style.display = 'none';
        }

        // Close on outside click
        window.onclick = function (event) {
            const modal = document.getElementById('purchasePaymentModal');
            if (event.target == modal) {
                closePurchasePaymentModal();
            }
        }

        // Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closePurchasePaymentModal();
        });
    </script>
</x-layout>