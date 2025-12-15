<x-layout title="Customer Ledger - FM Travel Manager" pageTitle="{{ $customer->name }}"
    pageSubtitle="Transaction history and balance summary">
    <x-slot:styles>
        .summary-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        margin-bottom: 24px;
        }

        .summary-card {
        background: var(--card-bg);
        border-radius: 14px;
        padding: 18px;
        box-shadow: var(--shadow);
        text-align: center;
        border-left: 4px solid var(--primary);
        }

        .summary-card.income { border-left-color: #2e7d32; }
        .summary-card.payment { border-left-color: #1565c0; }
        .summary-card.balance { border-left-color: #c62828; }

        .summary-label { font-size: 11px; color: var(--text-light); text-transform: uppercase; font-weight: 600;
        margin-bottom: 6px; }
        .summary-value { font-size: 22px; font-weight: 700; }
        .summary-value.income { color: #2e7d32; }
        .summary-value.payment { color: #1565c0; }
        .summary-value.balance { color: #c62828; }

        .customer-info {
        background: #f9f5eb;
        border-radius: 12px;
        padding: 16px;
        margin-bottom: 20px;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 12px;
        }

        .info-item { font-size: 12px; }
        .info-item strong { color: var(--text-light); font-size: 10px; text-transform: uppercase; display: block;
        margin-bottom: 3px; }

        .table-card {
        background: var(--card-bg);
        border-radius: 14px;
        padding: 18px;
        box-shadow: var(--shadow);
        overflow-x: auto;
        }

        table { width: 100%; border-collapse: collapse; font-size: 12px; }
        th, td { padding: 10px 12px; text-align: left; border-bottom: 1px solid var(--border); }
        th { background: #f9f5eb; font-weight: 600; font-size: 10px; color: var(--text-light); text-transform:
        uppercase; }
        .income { color: #2e7d32; font-weight: 600; }
        .payment { color: #1565c0; font-weight: 600; }

        .floating-print-btn {
        position: fixed;
        bottom: 24px;
        right: 24px;
        background: var(--primary);
        color: var(--accent);
        border: none;
        border-radius: 50px;
        padding: 12px 20px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        display: flex;
        align-items: center;
        gap: 8px;
        z-index: 100;
        }

        .floating-print-btn:hover { transform: translateY(-2px); }

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
        max-width: 400px;
        margin: 15px;
        box-shadow: 0 15px 50px rgba(0,0,0,0.3);
        position: relative;
        }

        .modal-close { position: absolute; top: 12px; right: 16px; background: none; border: none; font-size: 22px;
        color: var(--text-light); cursor: pointer; }

        @media (max-width: 640px) {
        .summary-grid { grid-template-columns: 1fr; }
        .summary-value { font-size: 18px; }
        }

        @media print {
        .floating-print-btn, .modal-overlay, .no-print { display: none !important; }
        .card, .table-card { box-shadow: none; border: 1px solid #ddd; }
        }
    </x-slot:styles>

    <div class="customer-info">
        <div class="info-item">
            <strong>📞 Phone</strong>
            {{ $customer->phone ?? 'Not provided' }}
        </div>
        <div class="info-item">
            <strong>📧 Email</strong>
            {{ $customer->email ?? 'Not provided' }}
        </div>
        <div class="info-item">
            <strong>📍 Address</strong>
            {{ $customer->address ?? 'Not provided' }}
        </div>
    </div>

    <div class="summary-grid">
        <div class="summary-card income">
            <div class="summary-label">Total Sales</div>
            <div class="summary-value income">Rs {{ number_format($customer->total_income) }}</div>
        </div>
        <div class="summary-card payment">
            <div class="summary-label">Customer Paid</div>
            <div class="summary-value payment">Rs {{ number_format($customer->total_paid) }}</div>
        </div>
        <div class="summary-card balance">
            <div class="summary-label">Balance Due</div>
            <div class="summary-value balance">Rs {{ number_format($customer->balance) }}</div>
        </div>
    </div>

    <div class="table-card">
        <h3 style="margin: 0 0 16px; font-size: 14px;">📋 Transaction History</h3>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th class="no-print">Type</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th class="no-print">Status</th>
                    <th class="no-print">Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $transactions = collect();
                    foreach ($customer->incomes as $income) {
                        $transactions->push([
                            'date' => $income->income_date,
                            'type' => 'Income',
                            'description' => $income->item->name ?? 'N/A',
                            'amount' => $income->amount,
                            'reference' => $income->reference_no,
                            'payment_status' => $income->payment_status,
                            'paid_amount' => $income->paid_amount,
                            'remaining_amount' => $income->remaining_amount,
                            'income_id' => $income->id
                        ]);
                    }
                    foreach ($customer->payments as $payment) {
                        $transactions->push([
                            'date' => $payment->payment_date,
                            'type' => 'Payment',
                            'description' => $payment->payment_method,
                            'amount' => $payment->amount,
                            'reference' => $payment->reference_no,
                            'payment_status' => null,
                            'paid_amount' => 0,
                            'remaining_amount' => 0,
                            'income_id' => null
                        ]);
                    }
                    $transactions = $transactions->sortByDesc('date');
                @endphp

                @forelse($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction['date']->format('d M Y') }}</td>
                        <td class="no-print"><strong>{{ $transaction['type'] }}</strong></td>
                        <td>
                            @if($transaction['type'] == 'Income' && isset($transaction['income_id']))
                                <a href="/incomes/{{ $transaction['income_id'] }}/payment-history"
                                    style="color: var(--primary-dark);">{{ $transaction['description'] }}</a>
                            @else
                                {{ $transaction['description'] }}
                            @endif
                        </td>
                        <td class="{{ $transaction['type'] == 'Income' ? 'income' : 'payment' }}">
                            Rs {{ number_format($transaction['amount']) }}
                            @if($transaction['type'] == 'Income' && $transaction['paid_amount'] > 0)
                                <br><small style="color: #1565c0;">Paid: Rs
                                    {{ number_format($transaction['paid_amount']) }}</small>
                            @endif
                        </td>
                        <td class="no-print">
                            @if($transaction['payment_status'] == 'paid')
                                <span class="badge badge-success">✓ Paid</span>
                            @elseif($transaction['payment_status'] == 'partial')
                                <span class="badge badge-warning">◐ Partial</span>
                            @elseif($transaction['payment_status'] == 'unpaid')
                                <span class="badge badge-danger">✗ Unpaid</span>
                            @else
                                -
                            @endif
                        </td>
                        <td class="no-print">
                            @if($transaction['type'] == 'Income' && $transaction['payment_status'] != 'paid')
                                <button class="btn btn-success btn-sm"
                                    onclick="openPaymentModal({{ $transaction['income_id'] ?? 0 }}, {{ $transaction['remaining_amount'] ?? 0 }})">💵
                                    Receive</button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 40px;">No transactions found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 20px;">
        <a href="/customers" class="btn btn-secondary no-print">← Back to Customers</a>
    </div>

    <button onclick="window.print()" class="floating-print-btn no-print">🖨️ Print</button>

    <!-- Payment Modal -->
    <div class="modal-overlay" id="paymentModal">
        <div class="modal-content">
            <button class="modal-close" onclick="closePaymentModal()">&times;</button>
            <h3 style="margin: 0 0 18px; font-size: 16px;">💰 Receive Payment</h3>
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
        function openPaymentModal(incomeId, remaining) {
            document.getElementById('paymentModal').style.display = 'flex';
            document.getElementById('modal_remaining').innerText = Number(remaining).toLocaleString();
            document.getElementById('payment_amount').max = remaining;
            document.getElementById('payment_amount').value = '';
            document.getElementById('paymentForm').action = '/incomes/' + incomeId + '/add-payment';
            const now = new Date();
            document.getElementById('payment_date').value = `${now.getFullYear()}-${String(now.getMonth() + 1).padStart(2, '0')}-${String(now.getDate()).padStart(2, '0')}T${String(now.getHours()).padStart(2, '0')}:${String(now.getMinutes()).padStart(2, '0')}`;
        }
        function closePaymentModal() { document.getElementById('paymentModal').style.display = 'none'; }
        document.addEventListener('keydown', e => { if (e.key === 'Escape') closePaymentModal(); });
    </script>
</x-layout>