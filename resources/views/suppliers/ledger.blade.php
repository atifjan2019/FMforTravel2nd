<x-layout title="Supplier Ledger - FM Travel Manager" pageTitle="{{ $supplier->name }}"
    pageSubtitle="Purchase and payment history">
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
        border-left: 4px solid #8b7355;
        }

        .summary-card.purchase { border-left-color: #c62828; }
        .summary-card.payment { border-left-color: #2e7d32; }
        .summary-card.balance { border-left-color: #f57c00; }

        .summary-label { font-size: 11px; color: var(--text-light); text-transform: uppercase; font-weight: 600;
        margin-bottom: 6px; }
        .summary-value { font-size: 22px; font-weight: 700; }
        .summary-value.purchase { color: #c62828; }
        .summary-value.payment { color: #2e7d32; }
        .summary-value.balance { color: #f57c00; }
        .summary-small { font-size: 11px; color: var(--text-light); margin-top: 4px; }

        .supplier-info {
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
        .purchase { color: #c62828; font-weight: 600; }
        .payment { color: #2e7d32; font-weight: 600; }

        .floating-print-btn {
        position: fixed;
        bottom: 24px;
        right: 24px;
        background: #8b7355;
        color: white;
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
        .floating-print-btn, .modal-overlay, .no-print, .sidebar, .top-bar { display: none !important; }
        .card, .table-card { box-shadow: none; border: none !important; padding: 0 !important; }
        body { background: white; }
        .main-content { margin: 0 !important; padding: 0 !important; }

        .print-header {
        display: flex !important;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        border-bottom: 2px solid #8b7355;
        padding-bottom: 20px;
        }
        .section-title { font-size: 16px; border-bottom: 2px solid #ccc; padding-bottom: 5px; margin-top: 20px;}

        .summary-grid {
        gap: 20px;
        margin-bottom: 30px;
        border-bottom: 1px solid #eee;
        padding-bottom: 20px;
        }
        .summary-card {
        background: white !important;
        border: 1px solid #ddd;
        box-shadow: none !important;
        padding: 10px !important;
        }
        .summary-value { font-size: 18px !important; }

        table th { background: #eee !important; color: black !important; border-bottom: 2px solid #ccc !important; }
        table td { border-bottom: 1px solid #eee !important; color: black !important; }
        }

        .print-header { display: none; }
    </x-slot:styles>

    @if($supplier->balance > 0)
        <div style="margin-bottom: 18px;">
            <button class="btn btn-success no-print"
                onclick="openPaymentModal({{ $supplier->id }}, {{ $supplier->balance }})">
                💸 Record Bulk Payment
            </button>
        </div>
    @endif

    <div class="supplier-info no-print">
        <div class="info-item">
            <strong>📞 Phone</strong>
            {{ $supplier->phone ?? 'Not provided' }}
        </div>
        <div class="info-item">
            <strong>📧 Email</strong>
            {{ $supplier->email ?? 'Not provided' }}
        </div>
        <div class="info-item">
            <strong>📍 Address</strong>
            {{ $supplier->address ?? 'Not provided' }}
        </div>
    </div>

    <!-- Print Header -->
    <div class="print-header">
        <div class="logo">
            <span style="font-size: 32px;">✈️</span>
            <div>
                <h1 style="margin: 0; font-size: 24px; color: var(--text);">FM Travel</h1>
                <p style="margin: 2px 0 0; font-size: 12px; color: var(--text-light);">Management System</p>
            </div>
        </div>
        <div class="invoice-details" style="text-align: right;">
            <h2 style="margin: 0 0 4px; font-size: 20px; color: #8b7355;">SUPPLIER LEDGER</h2>
            <div style="font-size: 14px; font-weight: bold; margin-bottom: 5px;">{{ $supplier->name }}</div>
            <p style="margin: 0; font-size: 11px; color: var(--text);">{{ $supplier->phone }}</p>
            <p style="margin: 0; font-size: 11px; color: var(--text);">Date: {{ now()->format('d M Y') }}</p>
        </div>
    </div>

    <div class="summary-grid fit-print">
        <div class="summary-card purchase">
            <div class="summary-label">Total Purchases</div>
            <div class="summary-value purchase">Rs {{ number_format($supplier->total_purchases) }}</div>
            <div class="summary-small">{{ $supplier->purchases->count() }} purchases</div>
        </div>
        <div class="summary-card payment">
            <div class="summary-label">We Paid</div>
            <div class="summary-value payment">Rs {{ number_format($supplier->total_paid) }}</div>
            <div class="summary-small">{{ $supplier->payments->count() }} payments</div>
        </div>
        <div class="summary-card balance">
            <div class="summary-label">Balance Due</div>
            <div class="summary-value balance">Rs {{ number_format($supplier->balance) }}</div>
            <div class="summary-small">{{ $supplier->balance > 0 ? 'Outstanding' : 'All settled' }}</div>
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
                    <th>Purchase (+)</th>
                    <th>Payment (-)</th>
                    <th class="no-print">Status</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $transactions = collect();
                    foreach ($supplier->purchases as $purchase) {
                        $transactions->push([
                            'date' => $purchase->purchase_date,
                            'type' => 'purchase',
                            'description' => $purchase->item->name ?? 'Purchase',
                            'credit' => $purchase->total_amount,
                            'debit' => 0,
                            'reference' => $purchase->reference_no,
                            'status' => $purchase->payment_status,
                            'purchase_id' => $purchase->id,
                            'paid_amount' => $purchase->paid_amount,
                        ]);
                    }
                    foreach ($supplier->payments as $payment) {
                        $transactions->push([
                            'date' => $payment->payment_date,
                            'type' => 'payment',
                            'description' => $payment->payment_method,
                            'credit' => 0,
                            'debit' => $payment->amount,
                            'reference' => $payment->reference_no,
                            'status' => null,
                            'purchase_id' => null,
                            'paid_amount' => null,
                        ]);
                    }
                    $transactions = $transactions->sortByDesc('date');
                @endphp

                @forelse($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction['date'] ? $transaction['date']->format('d M Y') : '-' }}</td>
                        <td class="no-print">
                            @if($transaction['type'] == 'purchase')
                                <span class="badge badge-danger">Purchase</span>
                            @else
                                <span class="badge badge-success">Payment</span>
                            @endif
                        </td>
                        <td>
                            @if($transaction['type'] === 'purchase' && $transaction['purchase_id'])
                                <a href="/purchases/{{ $transaction['purchase_id'] }}/payment-history"
                                    style="color: var(--primary-dark);">{{ $transaction['description'] }}</a>
                            @else
                                {{ $transaction['description'] }}
                            @endif
                        </td>
                        <td class="purchase">
                            {{ $transaction['credit'] > 0 ? 'Rs ' . number_format($transaction['credit']) : '—' }}
                            @if($transaction['credit'] > 0 && $transaction['paid_amount'])
                                <br><small style="color: #2e7d32;">Paid: Rs
                                    {{ number_format($transaction['paid_amount']) }}</small>
                            @endif
                        </td>
                        <td class="payment">
                            {{ $transaction['debit'] > 0 ? 'Rs ' . number_format($transaction['debit']) : '—' }}
                        </td>
                        <td class="no-print">
                            @if($transaction['type'] === 'purchase')
                                @if($transaction['status'] == 'paid')
                                    <span class="badge badge-success">✓ Paid</span>
                                @elseif($transaction['status'] == 'partial')
                                    <span class="badge badge-warning">◐ Partial</span>
                                @else
                                    <span class="badge badge-danger">✗ Unpaid</span>
                                @endif
                            @else
                                <span class="badge badge-success">✓ Payment</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 40px;">No transactions recorded yet</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 20px;">
        <a href="/suppliers" class="btn btn-secondary no-print">← Back to Suppliers</a>
    </div>

    <button onclick="window.print()" class="floating-print-btn no-print">🖨️ Print</button>

    <!-- Payment Modal -->
    <div class="modal-overlay" id="paymentModal">
        <div class="modal-content">
            <button class="modal-close" onclick="closePaymentModal()">&times;</button>
            <h3 style="margin: 0 0 18px; font-size: 16px;">💸 Pay Supplier</h3>
            <form id="paymentForm" method="POST" action="{{ route('supplier-payments.create-direct') }}">
                @csrf
                <input type="hidden" name="supplier_id" value="{{ $supplier->id }}">
                <div class="form-group">
                    <label>Amount (Rs) *</label>
                    <input type="number" id="payment_amount" name="amount" min="1" step="0.01" required>
                    <small>Outstanding: Rs <span
                            id="modal_remaining">{{ number_format($supplier->balance) }}</span></small>
                </div>
                <div class="form-group">
                    <label>Method *</label>
                    <select name="payment_method" required>
                        <option value="Cash">💵 Cash</option>
                        <option value="Bank Transfer">🏦 Bank Transfer</option>
                        <option value="Online">📱 Online</option>
                        <option value="Check">📝 Check</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Reference</label>
                    <input type="text" name="reference_no" placeholder="Bank Slip #, etc.">
                </div>
                <div class="form-group">
                    <label>Notes</label>
                    <textarea name="notes" rows="2" placeholder="Optional notes..."></textarea>
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
        function openPaymentModal(suppId, remaining) {
            document.getElementById('paymentModal').style.display = 'flex';
            document.getElementById('modal_remaining').innerText = Number(remaining).toLocaleString();
            document.getElementById('payment_amount').max = remaining;
            document.getElementById('payment_amount').value = '';
            const now = new Date();
            document.getElementById('payment_date').value = `${now.getFullYear()}-${String(now.getMonth() + 1).padStart(2, '0')}-${String(now.getDate()).padStart(2, '0')}T${String(now.getHours()).padStart(2, '0')}:${String(now.getMinutes()).padStart(2, '0')}`;
        }
        function closePaymentModal() { document.getElementById('paymentModal').style.display = 'none'; }
        document.addEventListener('keydown', e => { if (e.key === 'Escape') closePaymentModal(); });
    </script>
</x-layout>