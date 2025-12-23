<x-layout title="Payment History - Al Nafi Travels" pageTitle="Payment History"
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
        @page { margin: 1cm; size: A4; }
        body {
        background: white !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
        font-family: sans-serif;
        }
        .no-print, .sidebar, .top-bar, .actions, .btn, .action-buttons, .card-title, .customer-avatar, .summary-info {
        display: none !important; }
        .app-container { display: block !important; margin: 0 !important; }
        .main-content { margin: 0 !important; padding: 0 !important; width: 100% !important; }

        /* Remove Box Styles & Backgrounds */
        .card, .table-card, .summary-card, .history-card {
            box-shadow: none !important;
            border: none !important;
            padding: 0 !important;
            margin: 0 !important;
            background: white !important; /* Force white */
            background-color: white !important;
        }

        /* Header Styling */
        .print-header {
        display: flex !important;
        justify-content: space-between;
        align-items: center;
        border-bottom: 3px solid #b8860b;
        padding-bottom: 20px;
        margin-bottom: 30px;
        }
        .document-info { text-align: right; }

        /* Stats Row - Simple & Colorful */
        .financial-stats {
        display: flex !important;
        justify-content: flex-end !important; /* Align to right or space-between */
        gap: 40px !important;
        margin-bottom: 40px !important;
        }
        .stat-badge {
        background: transparent !important;
        border: none !important;
        padding: 0 !important;
        text-align: right !important;
        }
        .stat-badge .label {
        font-size: 11px;
        color: #888;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 5px;
        display: block;
        }
        .stat-badge .value {
        font-size: 24px;
        font-weight: 800;
        }
        /* Colorful Values */
        .stat-badge:nth-child(1) .value { color: #3b82f6 !important; } /* Blue for Total */
        .stat-badge:nth-child(2) .value { color: #10b981 !important; } /* Green for Paid */
        .stat-badge:nth-child(3) .value { color: #ef4444 !important; } /* Red for Remaining */

        /* Table - Clean & Colorful */
        .table-container { margin-top: 20px; }
        table { width: 100% !important; border-collapse: separate !important; border-spacing: 0 4px !important;
        font-size: 10pt !important; }
        th {
        background: #b8860b !important; /* Primary Brand Color */
        color: white !important;
        font-weight: 600 !important;
        padding: 12px 15px !important;
        text-transform: uppercase;
        font-size: 9px;
        letter-spacing: 1px;
        border: none !important;
        }
        th:first-child { border-top-left-radius: 6px; border-bottom-left-radius: 6px; }
        th:last-child { border-top-right-radius: 6px; border-bottom-right-radius: 6px; }

        td {
            background-color: white !important;
            padding: 12px 15px !important;
            color: #333;
            border-bottom: 1px solid #eee !important;
        }
        tr:nth-child(even) td { background-color: white !important; }

        /* Hide badge backgrounds for cleaner text look in table, or keep them if really desired.
        User asked for colorful, so badges are okay. */
        .badge {
        border: none !important;
        padding: 4px 8px !important;
        border-radius: 4px !important;
        }
        .badge-success { background-color: #d1fae5 !important; color: #065f46 !important; }
        .badge-warning { background-color: #fef3c7 !important; color: #92400e !important; }
        .badge-danger { background-color: #fee2e2 !important; color: #991b1b !important; }
        .badge-info { background-color: #dbeafe !important; color: #1e40af !important; }
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