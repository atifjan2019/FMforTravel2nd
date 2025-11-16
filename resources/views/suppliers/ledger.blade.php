<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Ledger · {{ $supplier->name }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        :root {
            --indigo: #4f46e5;
            --indigo-dark: #312e81;
            --teal: #14b8a6;
            --amber: #f59e0b;
            --slate-50: #f8fafc;
            --slate-100: #e2e8f0;
            --slate-500: #64748b;
            --slate-700: #334155;
            --danger: #ef4444;
        }
        * { box-sizing: border-box; }
        body {
            font-family: 'Inter', 'Segoe UI', system-ui, -apple-system, sans-serif;
            margin: 0;
            background: linear-gradient(135deg, #eef2ff 0%, #f8fafc 65%, #ecfeff 100%);
            color: #0f172a;
        }
        .page {
            max-width: 1200px;
            margin: 0 auto;
            padding: 32px 20px 80px;
        }
        a { text-decoration: none; color: inherit; }
        .hero {
            background: radial-gradient(circle at top right, rgba(99,102,241,0.30), rgba(255,255,255,0) 40%), var(--indigo);
            border-radius: 28px;
            padding: 32px;
            color: #fff;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 24px;
            position: relative;
            overflow: hidden;
        }
        .hero::after {
            content: '';
            position: absolute;
            inset: 0;
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 28px;
            pointer-events: none;
        }
        .hero__text {
            max-width: 600px;
        }
        .eyebrow {
            font-size: 0.88rem;
            letter-spacing: 0.07em;
            text-transform: uppercase;
            opacity: 0.8;
            margin-bottom: 6px;
        }
        h1 {
            font-size: clamp(2rem, 4vw, 2.8rem);
            margin: 0 0 12px 0;
        }
        .hero__subtitle {
            margin: 0;
            opacity: 0.9;
            font-weight: 500;
        }
        .hero__actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }
        .btn {
            border: none;
            border-radius: 999px;
            padding: 12px 22px;
            font-weight: 600;
            font-size: 0.95rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            text-decoration: none;
        }
        .btn-ghost {
            background: rgba(255,255,255,0.15);
            color: #fff;
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.18);
        }
        .btn-white {
            background: #fff;
            color: var(--indigo);
            box-shadow: 0 15px 25px rgba(15,23,42,0.15);
        }
        .btn:hover { transform: translateY(-2px); }
        .btn:focus { outline: 3px solid rgba(255,255,255,0.45); }
        .card {
            background: #fff;
            border-radius: 22px;
            padding: 28px;
            box-shadow: 0 30px 80px rgba(15, 23, 42, 0.08);
            margin-top: 32px;
        }
        .card--glass {
            background: rgba(255,255,255,0.65);
            backdrop-filter: blur(6px);
            border: 1px solid rgba(15,23,42,0.05);
        }
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 18px;
            margin-top: 24px;
        }
        .summary-card {
            border-radius: 18px;
            padding: 22px;
            background: #0f172a;
            color: #fff;
            position: relative;
            overflow: hidden;
        }
        .summary-card::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 18px;
            border: 1px solid rgba(255,255,255,0.12);
            opacity: 0.6;
            pointer-events: none;
        }
        .summary-card:nth-child(1) { background: linear-gradient(135deg, #fef08a, #facc15); color: #422006; }
        .summary-card:nth-child(2) { background: linear-gradient(135deg, #a7f3d0, #34d399); color: #064e3b; }
        .summary-card:nth-child(3) { background: linear-gradient(135deg, #c7d2fe, #4338ca); }
        .summary-card h3 {
            margin: 0;
            font-size: 0.9rem;
            letter-spacing: 0.07em;
            text-transform: uppercase;
            opacity: 0.85;
        }
        .summary-card strong {
            display: block;
            font-size: 1.8rem;
            margin-top: 16px;
        }
        .bulk-pay {
            background: linear-gradient(135deg, #f97316, #facc15);
            color: #431407;
            border: none;
            border-radius: 18px;
            padding: 18px 26px;
            font-size: 1.1rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            cursor: pointer;
            width: 100%;
            box-shadow: 0 16px 30px rgba(249, 115, 22, 0.25);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .bulk-pay:hover { transform: translateY(-3px); box-shadow: 0 24px 40px rgba(249, 115, 22, 0.35); }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
        }
        thead th {
            text-align: left;
            font-size: 0.78rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--slate-500);
            padding: 14px 12px;
            border-bottom: 1px solid var(--slate-100);
            background: #f8fafc;
        }
        tbody td {
            padding: 18px 12px;
            border-bottom: 1px solid rgba(15,23,42,0.06);
            font-size: 0.97rem;
        }
        tbody tr:hover {
            background: #f8fafc;
        }
        .transaction-type {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 0.85rem;
            font-weight: 600;
        }
        .transaction-type--purchase {
            background: rgba(239,68,68,0.12);
            color: var(--danger);
        }
        .transaction-type--payment {
            background: rgba(20,184,166,0.12);
            color: var(--teal);
        }
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 6px 12px;
            border-radius: 10px;
            font-size: 0.78rem;
            font-weight: 600;
        }
        .badge-success { background: rgba(16,185,129,0.15); color: #047857; }
        .badge-warning { background: rgba(251,191,36,0.2); color: #92400e; }
        .badge-muted { background: rgba(148,163,184,0.2); color: #475569; }
        .print-header {
            display: none;
            align-items: flex-start;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 18px;
            padding-bottom: 12px;
            border-bottom: 2px solid #0f172a;
        }
        .print-header img { height: 70px; flex-shrink: 0; }
        .print-header .print-meta {
            font-size: 12px;
            color: #475569;
            line-height: 1.4;
        }
        .print-footer {
            display: none;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px 16px;
            font-size: 11px;
            color: #475569;
            border-top: 1px solid #cbd5f5;
            padding-top: 8px;
            margin-top: 20px;
            text-align: center;
        }
        .floating-print-btn {
            position: fixed;
            bottom: 28px;
            right: 28px;
            border: none;
            border-radius: 999px;
            background: #0ea5e9;
            color: #fff;
            font-size: 1rem;
            font-weight: 600;
            padding: 14px 22px;
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            box-shadow: 0 18px 35px rgba(14,165,233,0.35);
        }
        .floating-print-btn:hover {
            transform: translateY(-2px);
        }
        .developer-credit {
            text-align: center;
            margin: 40px 0 0;
            font-size: 12px;
            color: #94a3b8;
        }
        .developer-credit a {
            color: inherit;
            text-decoration: none;
        }
        @media (max-width: 640px) {
            .hero { padding: 24px; }
            .hero__actions { width: 100%; }
            .summary-card strong { font-size: 1.5rem; }
            .card { padding: 20px; }
            tbody td, thead th { padding: 12px 8px; }
            .floating-print-btn { width: calc(100% - 40px); left: 20px; right: 20px; justify-content: center; }
        }
        @media print {
            body { background: #fff; }
            .page { padding: 0 12px; }
            .hero, .floating-print-btn { display: none !important; }
            .card { box-shadow: none; border: 1px solid #cbd5f5; border-radius: 6px; margin-top: 16px; padding: 18px; }
            .summary-card { border: 1px solid #cbd5f5; box-shadow: none; }
            .summary-card::after { display: none; }
            .print-header { display: flex !important; margin-bottom: 12px; }
            table { font-size: 12px; }
            thead th { font-size: 0.72rem; padding: 10px 8px; }
            tbody td { padding: 10px 8px; }
            .print-footer { display: flex !important; }
            .print-hide { display: none !important; }
            .developer-credit { display: none !important; }
            a { color: inherit !important; text-decoration: none !important; }
        }
    </style>
</head>
<body>
    @php
        $transactions = collect();
        foreach ($supplier->purchases as $purchase) {
            $createdTimestamp = $purchase->created_at instanceof \Carbon\Carbon ? $purchase->created_at->timestamp : ($purchase->created_at ? strtotime($purchase->created_at) : 0);
            $dateTimestamp = $purchase->purchase_date instanceof \Carbon\Carbon ? $purchase->purchase_date->timestamp : ($purchase->purchase_date ? strtotime($purchase->purchase_date) : 0);
            $sortPrimary = $createdTimestamp ?: $dateTimestamp;
            $secondaryTimestamp = $dateTimestamp ?: $createdTimestamp;
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
                'sort_primary' => $sortPrimary,
                'sort_secondary' => $secondaryTimestamp,
            ]);
        }
        foreach ($supplier->payments as $payment) {
            $createdTimestamp = $payment->created_at instanceof \Carbon\Carbon ? $payment->created_at->timestamp : ($payment->created_at ? strtotime($payment->created_at) : 0);
            $dateTimestamp = $payment->payment_date instanceof \Carbon\Carbon ? $payment->payment_date->timestamp : ($payment->payment_date ? strtotime($payment->payment_date) : 0);
            $sortPrimary = $createdTimestamp ?: $dateTimestamp;
            $secondaryTimestamp = $dateTimestamp ?: $createdTimestamp;
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
                'sort_primary' => $sortPrimary,
                'sort_secondary' => $secondaryTimestamp,
            ]);
        }
        $transactions = $transactions->sort(function ($a, $b) {
            $primaryComparison = ($b['sort_primary'] ?? 0) <=> ($a['sort_primary'] ?? 0);
            if ($primaryComparison !== 0) {
                return $primaryComparison;
            }
            return ($b['sort_secondary'] ?? 0) <=> ($a['sort_secondary'] ?? 0);
        })->values();
    @endphp

    <div class="page">
        <div class="print-header">
            <img src="/images/alnafi.png" alt="Al Nafi Travels logo">
            <div style="flex:1; text-align:right;">
                <h2 style="margin:0;">Supplier Ledger</h2>
            </div>
        </div>

        <header class="hero">
            <div class="hero__text">
                <p class="eyebrow">Suppliers / Ledger</p>
                <h1>Ledger for {{ $supplier->name }}</h1>
                <p class="hero__subtitle">Complete breakdown of purchases, payments, and outstanding exposure.</p>
            </div>
            <div class="hero__actions">
                <a href="/" class="btn btn-ghost">🏠 Dashboard</a>
                <a href="/suppliers" class="btn btn-ghost">← Back to Suppliers</a>
                @if($supplier->balance > 0)
                    <button type="button" class="btn btn-white" onclick="openSupplierPaymentModal({{ $supplier->id }}, {{ $supplier->balance }}, true)">
                        💸 Record Bulk Payment
                    </button>
                @endif
            </div>
        </header>

        <section class="card card--glass">
            <div class="summary-grid">
                <div class="summary-card">
                    <h3>Total Amount</h3>
                    <strong>Rs {{ number_format($supplier->total_purchases) }}</strong>
                    <small>{{ $supplier->purchases->count() }} purchases</small>
                </div>
                <div class="summary-card">
                    <h3>Total Paid</h3>
                    <strong>Rs {{ number_format($supplier->total_paid) }}</strong>
                    <small>{{ $supplier->payments->count() }} payments</small>
                </div>
                <div class="summary-card">
                    <h3>Balance Due</h3>
                    <strong>Rs {{ number_format($supplier->balance) }}</strong>
                    <small>{{ $supplier->balance > 0 ? 'Outstanding with supplier' : 'All settled' }}</small>
                </div>
            </div>
        </section>

        <section class="card" style="margin-top:28px;">
            <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px; margin-bottom:10px;">
                <div>
                    <h2 style="margin:0; font-size:1.25rem;">Transaction History</h2>
                    <p style="margin:6px 0 0 0; color:var(--slate-500);">Latest purchases and payments are shown first.</p>
                </div>
            </div>
            <div style="overflow-x:auto;">
                <table>
                    <thead>
                        <tr>
                            <th style="min-width:120px;">Date</th>
                            <th class="print-hide" style="min-width:120px;">Reference</th>
                            <th style="min-width:140px;">Type</th>
                            <th>Description</th>
                            <th style="min-width:130px;">Purchase (+)</th>
                            <th style="min-width:130px;">Payment (-)</th>
                            <th class="print-hide" style="min-width:140px;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction['date'] ? $transaction['date']->format('d M Y') : '-' }}</td>
                                <td class="print-hide">{{ $transaction['reference'] ?? '—' }}</td>
                                <td class="print-hide">
                                    @php $typeClass = $transaction['type'] === 'purchase' ? 'transaction-type--purchase' : 'transaction-type--payment'; @endphp
                                    <span class="transaction-type {{ $typeClass }}">
                                        {{ ucfirst($transaction['type']) }}
                                    </span>
                                </td>
                                <td>
                                    @if($transaction['type'] === 'purchase' && $transaction['purchase_id'])
                                        <a href="/purchases/{{ $transaction['purchase_id'] }}/payment-history" style="color:var(--indigo); text-decoration:underline;">
                                            {{ $transaction['description'] }}
                                        </a>
                                    @else
                                        {{ $transaction['description'] }}
                                    @endif
                                </td>
                                <td style="color:var(--danger); font-weight:600;">
                                    {{ $transaction['credit'] > 0 ? 'Rs ' . number_format($transaction['credit']) : '—' }}
                                    @if($transaction['credit'] > 0 && $transaction['paid_amount'])
                                        <div style="font-size:0.78rem; color:var(--slate-500);">Paid: Rs {{ number_format($transaction['paid_amount']) }}</div>
                                    @endif
                                </td>
                                <td style="color:var(--teal); font-weight:600;">
                                    {{ $transaction['debit'] > 0 ? 'Rs ' . number_format($transaction['debit']) : '—' }}
                                </td>
                                <td>
                                    @if($transaction['type'] === 'purchase')
                                        @php
                                            $status = $transaction['status'] ?? 'pending';
                                            $statusLabel = ucwords(str_replace('_', ' ', $status));
                                            $statusClass = 'badge-muted';
                                            if ($status === 'paid') {
                                                $statusClass = 'badge-success';
                                            } elseif ($status === 'partial') {
                                                $statusClass = 'badge-warning';
                                            }
                                        @endphp
                                        <span class="badge {{ $statusClass }}">{{ $statusLabel }}</span>
                                    @else
                                        <span class="badge badge-success">Payment</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="text-align:center; padding:40px; color:var(--slate-500);">
                                    No transactions recorded yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <div class="print-footer">
        <span>Al Nafi Travels</span>
        <span>+92 312 544 6922 · alnafitravels24@gmail.com</span>
        <span>Office no C9, 3rd Floor, Abbas Khan Block, Ghafoor Market Charsadda, Pakistan</span>
        <span style="font-size:10px; color:#94a3b8; display:inline-block; width:100%;">Developed by webspires.com.pk</span>
    </div>

    <div class="developer-credit">
        Developed by <a href="https://webspires.com.pk" target="_blank" rel="noopener">webspires.com.pk</a>
    </div>

    <div id="supplierPaymentModal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.45); z-index:1200; align-items:center; justify-content:center; padding:20px;">
        <div style="background:#fff; padding:28px; border-radius:18px; width:min(420px, 100%); box-shadow:0 25px 80px rgba(15,23,42,0.25); position:relative;">
            <h3 style="margin-top:0; margin-bottom:18px; color:var(--indigo); font-size:1.25rem;">💸 Record Payment</h3>
            <form id="supplierPaymentForm" method="POST" action="{{ route('supplier-payments.create-direct') }}">
                @csrf
                <input type="hidden" name="supplier_id" id="supplier_payment_supplier_id" value="{{ $supplier->id }}">

                <div style="margin-bottom:16px;">
                    <label for="supplier_payment_amount" style="display:block; font-weight:600; margin-bottom:6px;">Amount (Rs) *</label>
                    <input type="number" name="amount" id="supplier_payment_amount" min="1" step="0.01" required style="width:100%; padding:10px 12px; border-radius:10px; border:1px solid #e2e8f0;">
                    <small style="color:var(--slate-500); display:block; margin-top:4px;">Outstanding: Rs <span id="supplier_modal_remaining">{{ number_format($supplier->balance) }}</span></small>
                </div>

                <div style="margin-bottom:16px;">
                    <label for="supplier_payment_method" style="display:block; font-weight:600; margin-bottom:6px;">Payment Method *</label>
                    <select name="payment_method" id="supplier_payment_method" required style="width:100%; padding:10px 12px; border-radius:10px; border:1px solid #e2e8f0;">
                        <option value="Cash">Cash</option>
                        <option value="Bank Transfer">Bank Transfer</option>
                        <option value="Check">Check</option>
                        <option value="Online">Online</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div style="margin-bottom:16px;">
                    <label for="supplier_payment_reference" style="display:block; font-weight:600; margin-bottom:6px;">Reference / Notes</label>
                    <input type="text" name="reference_no" id="supplier_payment_reference" placeholder="e.g. Bank Slip #123" style="width:100%; padding:10px 12px; border-radius:10px; border:1px solid #e2e8f0; margin-bottom:10px;">
                    <textarea name="notes" id="supplier_payment_notes" rows="3" placeholder="Internal notes (optional)" style="width:100%; padding:10px 12px; border-radius:12px; border:1px solid #e2e8f0; resize:vertical;"></textarea>
                </div>

                <div style="margin-bottom:18px;">
                    <label for="supplier_payment_date" style="display:block; font-weight:600; margin-bottom:6px;">Date & Time *</label>
                    <input type="datetime-local" name="payment_date" id="supplier_payment_date" required style="width:100%; padding:10px 12px; border-radius:10px; border:1px solid #e2e8f0;">
                </div>

                <div style="display:flex; gap:12px;">
                    <button type="submit" class="btn btn-white" style="flex:1; justify-content:center;">✔ Save Payment</button>
                    <button type="button" class="btn btn-ghost" style="flex:1; justify-content:center; background:#e2e8f0; color:#0f172a;" onclick="closeSupplierPaymentModal()">Cancel</button>
                </div>
            </form>
            <button onclick="closeSupplierPaymentModal()" style="position:absolute; top:14px; right:16px; background:none; border:none; font-size:24px; color:#94a3b8; cursor:pointer;">&times;</button>
        </div>
    </div>

    <button class="floating-print-btn" onclick="window.print()">
        🖨 Print Ledger
    </button>

    <script>
        function openSupplierPaymentModal(supplierId, remaining, focusAmount) {
            const modal = document.getElementById('supplierPaymentModal');
            modal.style.display = 'flex';
            document.getElementById('supplier_payment_supplier_id').value = supplierId;
            const remainingEl = document.getElementById('supplier_modal_remaining');
            if (typeof remaining !== 'undefined' && remaining !== null && remainingEl) {
                remainingEl.innerText = Number(remaining).toLocaleString();
                const amountInput = document.getElementById('supplier_payment_amount');
                if (amountInput) {
                    amountInput.max = remaining > 0 ? remaining : null;
                    if (focusAmount) amountInput.focus();
                }
            }
            const now = new Date();
            const formatted = `${now.getFullYear()}-${String(now.getMonth() + 1).padStart(2, '0')}-${String(now.getDate()).padStart(2, '0')}T${String(now.getHours()).padStart(2, '0')}:${String(now.getMinutes()).padStart(2, '0')}`;
            document.getElementById('supplier_payment_date').value = formatted;
        }

        function closeSupplierPaymentModal() {
            const modal = document.getElementById('supplierPaymentModal');
            modal.style.display = 'none';
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeSupplierPaymentModal();
            }
        });
    </script>
</body>
</html>
