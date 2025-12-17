<x-layout title="Payment History - FM Travel Manager" pageTitle="Payment History"
    pageSubtitle="Tracking payments for Item: {{ $income->item->name ?? 'Service' }}">

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

        .customer-avatar {
        width: 60px;
        height: 60px;
        background: var(--primary);
        color: var(--accent);
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
        color: var(--primary-dark);
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
        .no-print { display: none !important; }
        body { background: white; margin: 0; padding: 0; }
        .app-container { display: block; margin: 0; }
        .sidebar, .top-bar { display: none; }
        .main-content { margin: 0; padding: 0; }
        }
    </x-slot:styles>

    <!-- Top Summary Card -->
    <div class="summary-card">
        <div class="summary-info">
            <div class="customer-avatar">
                {{ strtoupper(substr($income->customer->name, 0, 1)) }}
            </div>
            <div class="info-group">
                <h2>{{ $income->customer->name }}</h2>
                <p>Ref: {{ $income->reference_no ?? 'N/A' }} • Date: {{ $income->income_date->format('d M Y') }}</p>
            </div>
        </div>

        <div class="financial-stats">
            <div class="stat-badge">
                <div class="label">Total Amount</div>
                <div class="value">Rs {{ number_format($income->amount) }}</div>
            </div>
            <div class="stat-badge">
                <div class="label">Received</div>
                <div class="value" style="color: var(--success)">Rs {{ number_format($income->paid_amount) }}</div>
            </div>
            <div class="stat-badge highlight">
                <div class="label">Remaining</div>
                <div class="value" style="color: var(--danger)">Rs {{ number_format($income->remaining_amount) }}</div>
            </div>
        </div>
    </div>

    <!-- History Table Card -->
    <div class="history-card">
        <div class="action-bar">
            <h3 class="card-title">Transaction History</h3>
            <div class="action-buttons no-print">
                @if($income->remaining_amount > 0)
                    <button onclick="openIncomePaymentModal()" class="btn btn-success">
                        💰 Receive Payment
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
                    @forelse($income->paymentHistory as $payment)
                        <tr>
                            <td>{{ $payment->payment_date->format('d M Y, h:i A') }}</td>
                            <td><strong style="color: var(--success);">Rs {{ number_format($payment->amount) }}</strong>
                            </td>
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
                                <p>No payments received yet.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div style="margin-top: 24px;" class="no-print">
        <a href="{{ route('customers.ledger', $income->customer_id) }}" class="btn btn-secondary">← Back to Ledger</a>
    </div>

    <!-- Payment Modal -->
    <div id="incomePaymentModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Receive Payment</h3>
                <button onclick="closeIncomePaymentModal()"
                    style="background:none; border:none; font-size:24px; cursor:pointer;">&times;</button>
            </div>
            <form id="incomePaymentForm" action="/incomes/{{ $income->id }}/add-payment" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Amount (Rs) <span style="color:var(--danger)">*</span></label>
                        <input type="number" name="amount" min="1" step="0.01" max="{{ $income->remaining_amount }}"
                            value="{{ $income->remaining_amount }}" required autofocus>
                        <small style="color:var(--text-light); margin-top:4px; display:block;">
                            Max Payable: Rs {{ number_format($income->remaining_amount) }}
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
                            <input type="datetime-local" id="income_payment_date" name="payment_date" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Reference / Person</label>
                        <input type="text" name="person_reference" placeholder="e.g. John Doe / INV-001">
                    </div>

                    <div class="form-actions" style="justify-content: flex-end; margin-top: 10px;">
                        <button type="button" class="btn btn-secondary"
                            onclick="closeIncomePaymentModal()">Cancel</button>
                        <button type="submit" class="btn btn-success">Confirm Payment</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openIncomePaymentModal() {
            const modal = document.getElementById('incomePaymentModal');
            modal.style.display = 'flex';

            // Set current date/time
            const now = new Date();
            now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
            document.getElementById('income_payment_date').value = now.toISOString().slice(0, 16);
        }

        function closeIncomePaymentModal() {
            document.getElementById('incomePaymentModal').style.display = 'none';
        }

        // Close on outside click
        window.onclick = function (event) {
            const modal = document.getElementById('incomePaymentModal');
            if (event.target == modal) {
                closeIncomePaymentModal();
            }
        }

        // Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeIncomePaymentModal();
        });
    </script>
</x-layout>