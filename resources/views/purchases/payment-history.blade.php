<x-layout title="Payment History - Al Nafi Travels">
    <x-page-header
        title="💰 Payment History"
        icon="💵"
        backUrl="/suppliers/{{ $purchase->supplier_id }}/ledger"
    />

    <div style="margin-bottom: 20px; text-align: right;">
        <a href="/purchases/create" class="btn btn-primary" style="background: #667eea; color: white; padding: 10px 20px; border: none; border-radius: 6px; text-decoration: none; display: inline-block; font-weight: 600; font-size: 14px; margin-right: 10px;">+ New Purchase</a>
        @if($purchase->remaining_amount > 0)
            <button onclick="openPurchasePaymentModal()" class="btn btn-warning" style="background: #f59e0b; color: white; padding: 10px 20px; border: none; border-radius: 6px; cursor: pointer; font-weight: 600; font-size: 14px; margin-right: 10px;">💰 Add Payment</button>
        @endif
        <button onclick="window.print()" class="btn btn-success" style="background: #10b981; color: white; padding: 10px 20px; border: none; border-radius: 6px; cursor: pointer; font-weight: 600; font-size: 14px;">🖨️ Print History</button>
    </div>

    <style>
        .purchase-info {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .purchase-info h2 {
            margin-bottom: 15px;
            font-size: 20px;
        }
        .purchase-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }
        .detail-item {
            background: rgba(255, 255, 255, 0.1);
            padding: 12px;
            border-radius: 6px;
        }
        .detail-label {
            font-size: 12px;
            opacity: 0.9;
            margin-bottom: 5px;
        }
        .detail-value {
            font-size: 16px;
            font-weight: 600;
        }
        .payment-summary {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }
        .summary-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            text-align: center;
        }
        .summary-card .label {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
        }
        .summary-card .value {
            font-size: 28px;
            font-weight: bold;
        }
        .summary-card .value.total { color: #ef4444; }
        .summary-card .value.paid { color: #3b82f6; }
        .summary-card .value.remaining { color: #f59e0b; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #f8fafc; font-weight: 600; color: #666; }
        .badge { padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 600; }
        .badge-cash { background: #d1fae5; color: #047857; }
        .badge-online { background: #dbeafe; color: #1e40af; }
        .badge-check { background: #fef3c7; color: #92400e; }
        
        @media print {
            body { background: white; }
            header, nav, .page-header .btn, button, a.btn { display: none !important; }
            .card { box-shadow: none; border: 1px solid #ddd; page-break-inside: avoid; }
            .purchase-info { 
                background: #ef4444 !important; 
                -webkit-print-color-adjust: exact; 
                print-color-adjust: exact; 
            }
            .summary-card { border: 1px solid #ddd; }
            th { background: #f0f0f0 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            .badge-cash, .badge-online, .badge-check { 
                -webkit-print-color-adjust: exact; 
                print-color-adjust: exact; 
            }
            @page { margin: 1cm; }
        }
    </style>

    <div class="purchase-info">
        <h2>Purchase Details</h2>
        <div class="purchase-details">
            <div class="detail-item">
                <div class="detail-label">Supplier</div>
                <div class="detail-value">
                    <a href="{{ route('suppliers.ledger', $purchase->supplier->id) }}" style="color:#2563eb; text-decoration:none;">
                        {{ $purchase->supplier->name }}
                    </a>
                </div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Item</div>
                <div class="detail-value">{{ $purchase->item->name ?? 'N/A' }}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Purchase Date</div>
                <div class="detail-value">{{ $purchase->purchase_date->format('d M Y') }}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Reference No</div>
                <div class="detail-value">{{ $purchase->reference_no ?? 'N/A' }}</div>
            </div>
        </div>
    </div>

    <div class="payment-summary">
        <div class="summary-card">
            <div class="label">Total Amount</div>
            <div class="value total">Rs {{ number_format($purchase->total_amount) }}</div>
        </div>
        <div class="summary-card">
            <div class="label">Total Paid</div>
            <div class="value paid">Rs {{ number_format($purchase->paid_amount) }}</div>
        </div>
        <div class="summary-card">
            <div class="label">Remaining</div>
            <div class="value remaining">Rs {{ number_format($purchase->remaining_amount) }}</div>
        </div>
    </div>

    <div class="card">
        <h2 style="margin-bottom: 20px;">💰 Payment History</h2>
        <table>
            <thead>
                <tr>
                    <th>Date & Time</th>
                    <th>Amount</th>
                    <th>Payment Method</th>
                    <th>Person + Reference</th>
                    <th>Notes</th>
                </tr>
            </thead>
            <tbody>
                @forelse($purchase->paymentHistory as $payment)
                <tr>
                    <td>{{ $payment->payment_date->format('d M Y, h:i A') }}</td>
                    <td><strong style="color: #10b981;">Rs {{ number_format($payment->amount) }}</strong></td>
                    <td>
                        @if($payment->payment_method == 'Cash')
                            <span class="badge badge-cash">💵 Cash</span>
                        @elseif($payment->payment_method == 'Online')
                            <span class="badge badge-online">💳 Online</span>
                        @else
                            <span class="badge badge-check">🏦 Check</span>
                        @endif
                    </td>
                    <td>{{ $payment->person_reference ?? '-' }}</td>
                    <td>{{ $payment->notes ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: #999; padding: 40px;">No payments recorded yet</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="card" style="margin-top: 20px;">
        <a href="/suppliers/{{ $purchase->supplier_id }}/ledger" class="btn btn-secondary">← Back to Supplier Ledger</a>
        <a href="/purchases/{{ $purchase->id }}" class="btn btn-primary" style="margin-left: 10px;">View Purchase Details</a>
    </div>

    <!-- Purchase Payment Modal -->
    <div id="purchasePaymentModal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.5); z-index:9999; align-items:center; justify-content:center;">
        <div style="background:white; padding:30px; border-radius:10px; min-width:400px; max-width:90vw; box-shadow:0 4px 12px rgba(0,0,0,0.3); position:relative;">
            <h3 style="margin-bottom:20px; color:#ef4444;">💰 Add Payment to Supplier</h3>
            <form id="purchasePaymentForm" action="/purchases/{{ $purchase->id }}/add-payment" method="POST">
                @csrf
                
                <div style="margin-bottom:15px;">
                    <label for="purchase_payment_amount" style="display:block; margin-bottom:5px; font-weight:600;">Amount (Rs) *</label>
                    <input type="number" id="purchase_payment_amount" name="amount" min="1" step="0.01" max="{{ $purchase->remaining_amount }}" required style="width:100%; padding:10px; border-radius:5px; border:1px solid #ddd;">
                    <small style="color:#666; font-size:12px;">Remaining: Rs {{ number_format($purchase->remaining_amount) }}</small>
                </div>
                
                <div style="margin-bottom:15px;">
                    <label for="purchase_payment_method" style="display:block; margin-bottom:5px; font-weight:600;">Payment Method *</label>
                    <select id="purchase_payment_method" name="payment_method" required style="width:100%; padding:10px; border-radius:5px; border:1px solid #ddd;">
                        <option value="Cash" selected>Cash</option>
                        <option value="Online">Online</option>
                        <option value="Check">Check</option>
                    </select>
                </div>
                
                <div style="margin-bottom:15px;">
                    <label for="purchase_person_reference" style="display:block; margin-bottom:5px; font-weight:600;">Person + Reference</label>
                    <input type="text" id="purchase_person_reference" name="person_reference" style="width:100%; padding:10px; border-radius:5px; border:1px solid #ddd;" placeholder="e.g., John Doe - PO-123">
                </div>
                
                <div style="margin-bottom:20px;">
                    <label for="purchase_payment_date" style="display:block; margin-bottom:5px; font-weight:600;">Date & Time *</label>
                    <input type="datetime-local" id="purchase_payment_date" name="payment_date" required style="width:100%; padding:10px; border-radius:5px; border:1px solid #ddd;">
                </div>
                
                <div style="display:flex; gap:10px;">
                    <button type="submit" class="btn btn-primary" style="flex:1;">Add Payment</button>
                    <button type="button" class="btn btn-secondary" onclick="closePurchasePaymentModal()" style="flex:1;">Cancel</button>
                </div>
            </form>
            <button onclick="closePurchasePaymentModal()" style="position:absolute; top:10px; right:15px; background:none; border:none; font-size:24px; color:#888; cursor:pointer;">&times;</button>
        </div>
    </div>

    <script>
    function openPurchasePaymentModal() {
        document.getElementById('purchasePaymentModal').style.display = 'flex';
        
        // Set current date and time
        const now = new Date();
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const day = String(now.getDate()).padStart(2, '0');
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        document.getElementById('purchase_payment_date').value = `${year}-${month}-${day}T${hours}:${minutes}`;
    }
    
    function closePurchasePaymentModal() {
        document.getElementById('purchasePaymentModal').style.display = 'none';
    }
    
    // Close modal on ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closePurchasePaymentModal();
    });
    </script>
</x-layout>
