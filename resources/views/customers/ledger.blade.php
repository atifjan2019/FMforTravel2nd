<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Ledger - Al Nafi Travels</title>
    <link rel="stylesheet" href="/css/responsive.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f7fa; }
        .container { max-width: 1400px; margin: 0 auto; padding: 20px; }
        header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px 30px; border-radius: 10px; margin-bottom: 30px; }
        header h1 { font-size: 24px; }
        .btn { padding: 8px 18px; font-size: 14px; border-radius: 5px; text-decoration: none; font-weight: 600; display: inline-block; border: none; cursor: pointer; }
        .btn-primary { background: #667eea; color: white; }
        .btn-print { background: #10b981; color: white; margin-left: 10px; }
        .card { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 20px; }
        .summary { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 30px; }
        .summary-item { text-align: center; padding: 20px; background: #f8fafc; border-radius: 8px; }
        .summary-item .label { color: #666; font-size: 14px; margin-bottom: 5px; }
        .summary-item .value { font-size: 24px; font-weight: bold; color: #333; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #f8fafc; font-weight: 600; color: #666; }
        .income { color: #10b981; }
        .payment { color: #3b82f6; }
        nav a { color: white; text-decoration: none; margin-right: 20px; opacity: 0.9; }
        nav a:hover { opacity: 1; }
        .header-actions { display: flex; justify-content: space-between; align-items: center; }
        
        .floating-print-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: #10b981;
            color: white;
            border: none;
            border-radius: 50px;
            padding: 15px 25px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
            z-index: 1000;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }
        .floating-print-btn:hover {
            background: #059669;
            box-shadow: 0 6px 16px rgba(16, 185, 129, 0.5);
            transform: translateY(-2px);
        }
        
        .print-header { display: none; }
        .income-column .print-label { display: none; }
        .print-footer {
            display: none;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px 16px;
            font-size: 11px;
            color: #475569;
            border-top: 1px solid #ddd;
            padding-top: 8px;
            margin-top: 20px;
            text-align: center;
        }
        .customer-details { display: none; }
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
        
        @media print {
            body { background: white; }
            .container { padding: 0; max-width: 100%; }
            header { display: none !important; }
            nav, .btn-print { display: none !important; }
            .card { box-shadow: none; border: 1px solid #ddd; }
            table { font-size: 12px; }
            th { background: #f0f0f0 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; font-size: 0.72rem; padding: 10px 8px; }
            td { padding: 10px 8px; }
            .summary { display: flex !important; flex-direction: row !important; gap: 15px !important; }
            .summary-item { border: 1px solid #ddd; flex: 1; }
            .print-footer { display: flex !important; }
            .print-hide { display: none !important; }
            .income-column .screen-label { display: none; }
            .income-column .print-label { display: inline; }
            .developer-credit { display: none !important; }
            @page { margin: 1cm; }
            
            .floating-print-btn { display: none !important; }
            
            .print-header { 
                display: flex !important; 
                justify-content: space-between; 
                align-items: flex-start; 
                gap: 20px;
                padding: 10px 0; 
                border-bottom: 2px solid #333; 
                margin-bottom: 16px; 
            }
            .print-header img { 
                height: 60px; 
                width: auto; 
            }
            .print-header .customer-meta { 
                font-size: 12px; 
                color: #475569; 
                line-height: 1.4; 
            }
            
            .customer-details {
                display: block !important;
                background: #f8fafc;
                padding: 20px;
                border-radius: 8px;
                margin-bottom: 25px;
                border: 1px solid #ddd;
            }
            .customer-details h3 {
                margin: 0 0 15px 0;
                font-size: 16px;
                color: #333;
                border-bottom: 2px solid #667eea;
                padding-bottom: 8px;
            }
            .details-grid {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }
            .detail-item {
                display: flex;
                gap: 10px;
            }
            .detail-label {
                font-weight: 600;
                color: #555;
                min-width: 100px;
            }
            .detail-value {
                color: #333;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="print-header">
            <img src="/images/alnafi.png" alt="Al Nafi Travels Logo">
            <div style="flex:1; text-align:right;">
                <h2 style="margin:0;">Invoice</h2>
            </div>
        </div>
        
        <header>
            <h1>📒 Customer Ledger: {{ $customer->name }}</h1>
            <nav style="margin-top: 10px;">
                <a href="/">🏠 Dashboard</a>
                <a href="/customers">← Back to Customers</a>
            </nav>
        </header>

        <div class="customer-details">
            <h3>Customer Information</h3>
            <div class="details-grid">
                <div class="detail-item">
                    <span class="detail-label">Name:</span>
                    <span class="detail-value">{{ $customer->name }}</span>
                </div>
                @if($customer->phone)
                <div class="detail-item">
                    <span class="detail-label">Phone:</span>
                    <span class="detail-value">{{ $customer->phone }}</span>
                </div>
                @endif
                @if($customer->email)
                <div class="detail-item">
                    <span class="detail-label">Email:</span>
                    <span class="detail-value">{{ $customer->email }}</span>
                </div>
                @endif
                @if($customer->address)
                <div class="detail-item">
                    <span class="detail-label">Address:</span>
                    <span class="detail-value">{{ $customer->address }}</span>
                </div>
                @endif
            </div>
        </div>

        <div class="summary">
            <div class="summary-item">
                <div class="label">Total Amount</div>
                <div class="value income">Rs {{ number_format($customer->total_income) }}</div>
            </div>
            <div class="summary-item">
                <div class="label">Customer Paid</div>
                <div class="value payment">Rs {{ number_format($customer->total_paid) }}</div>
            </div>
            <div class="summary-item">
                <div class="label">Balance Due</div>
                <div class="value">Rs {{ number_format($customer->balance) }}</div>
            </div>
        </div>

        <div class="card">
            <h2 style="margin-bottom: 20px;">Transaction History</h2>
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th class="print-hide">Type</th>
                        <th>Description</th>
                        <th class="income-column">
                            <span class="screen-label">Income (+)</span>
                            <span class="print-label">Payment</span>
                        </th>
                        <!-- Removed Payment (-) column -->
                        <th class="print-hide">Payment Status</th>
                        <th class="print-hide">Credit/Debit</th>
                        <th class="print-hide">Reference</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $transactions = collect();
                    foreach($customer->incomes as $income) {
                        $transactions->push([
                            'date' => $income->income_date,
                            'type' => 'Income',
                            'description' => $income->item->name ?? 'N/A',
                            'income' => $income->amount,
                            // Removed payment column
                            'reference' => $income->reference_no,
                            'payment_status' => $income->payment_status,
                            'paid_amount' => $income->paid_amount,
                            'remaining_amount' => $income->remaining_amount,
                            'income_id' => $income->id
                        ]);
                    }
                    foreach($customer->payments as $payment) {
                        $transactions->push([
                            'date' => $payment->payment_date,
                            'type' => 'Payment',
                            'description' => $payment->payment_method,
                            'income' => 0,
                            'payment' => $payment->amount,
                            'reference' => $payment->reference_no,
                            'payment_status' => null,
                            'paid_amount' => 0,
                            'remaining_amount' => 0
                        ]);
                    }
                    $transactions = $transactions->sortByDesc('date');
                    @endphp

                    @forelse($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction['date']->format('d M Y') }}</td>
                        <td class="print-hide"><strong>{{ $transaction['type'] }}</strong></td>
                        <td>
                            @if($transaction['type'] == 'Income' && isset($transaction['income_id']))
                                <a href="/incomes/{{ $transaction['income_id'] }}/payment-history" style="color: #667eea; text-decoration: underline;">
                                    {{ $transaction['description'] }}
                                </a>
                            @else
                                {{ $transaction['description'] }}
                            @endif
                        </td>
                        <td class="income">
                            {{ $transaction['income'] > 0 ? 'Rs ' . number_format($transaction['income']) : '' }}
                            @if($transaction['income'] > 0 && isset($transaction['paid_amount']))
                                <br><small class="print-hide" style="color: #3b82f6;">Paid: Rs {{ number_format($transaction['paid_amount']) }}</small>
                            @endif
                        </td>
                        <!-- Removed Payment (-) cell -->
                        <td class="print-hide">
                            @if($transaction['payment_status'] == 'paid')
                                <span style="background: #10b981; color: white; padding: 4px 10px; border-radius: 4px; font-size: 12px; font-weight: 600;">✓ Paid</span>
                            @elseif($transaction['payment_status'] == 'partial')
                                <span style="background: #f59e0b; color: white; padding: 4px 10px; border-radius: 4px; font-size: 12px; font-weight: 600;">◐ Partial</span>
                                <br><small style="color: #ef4444;">Remaining: Rs {{ number_format($transaction['remaining_amount']) }}</small>
                            @elseif($transaction['payment_status'] == 'unpaid')
                                <span style="background: #ef4444; color: white; padding: 4px 10px; border-radius: 4px; font-size: 12px; font-weight: 600;">✗ Unpaid</span>
                            @else
                                -
                            @endif
                        </td>
                        <td class="print-hide">
                            @if($transaction['type'] == 'Income')
                                @if($transaction['payment_status'] == 'partial')
                                    <button class="btn btn-success btn-sm" onclick="openCustomerPaymentModal({{ $transaction['income_id'] ?? 0 }}, {{ $transaction['remaining_amount'] ?? 0 }})" style="padding: 4px 10px; font-size: 12px;">Receive Payment</button>
                                @elseif($transaction['payment_status'] == 'unpaid')
                                    <button class="btn btn-warning btn-sm" onclick="openCustomerPaymentModal({{ $transaction['income_id'] ?? 0 }}, {{ $transaction['remaining_amount'] ?? 0 }})" style="padding: 4px 10px; font-size: 12px;">Receive Now</button>
                                @else
                                    <span style="color: #10b981;">✓</span>
                                @endif
                            @endif
                        </td>
                        <td class="print-hide">{{ $transaction['reference'] ?? 'N/A' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="text-align: center; color: #999; padding: 40px;">No transactions found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Floating Print Button -->
        <button onclick="window.print()" class="floating-print-btn">
            🖨️ Print Ledger
        </button>
        
        <!-- Customer Payment Modal -->
        <div id="customerPaymentModal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.5); z-index:9999; align-items:center; justify-content:center;">
            <div style="background:white; padding:30px; border-radius:10px; min-width:400px; max-width:90vw; box-shadow:0 4px 12px rgba(0,0,0,0.3); position:relative;">
                <h3 style="margin-bottom:20px; color:#10b981;">💰 Receive Payment from Customer</h3>
                <form id="customerPaymentForm" action="" method="POST">
                    @csrf
                    <input type="hidden" name="income_id" id="customer_payment_income_id" value="">
                    
                    <div style="margin-bottom:15px;">
                        <label for="customer_payment_amount" style="display:block; margin-bottom:5px; font-weight:600;">Amount (Rs) *</label>
                        <input type="number" id="customer_payment_amount" name="amount" min="1" step="0.01" required style="width:100%; padding:10px; border-radius:5px; border:1px solid #ddd;">
                        <small style="color:#666; font-size:12px;">Remaining: Rs <span id="customer_modal_remaining"></span></small>
                    </div>
                    
                    <div style="margin-bottom:15px;">
                        <label for="customer_payment_method" style="display:block; margin-bottom:5px; font-weight:600;">Payment Method *</label>
                        <select id="customer_payment_method" name="payment_method" required style="width:100%; padding:10px; border-radius:5px; border:1px solid #ddd;">
                            <option value="Cash" selected>Cash</option>
                            <option value="Online">Online</option>
                            <option value="Check">Check</option>
                        </select>
                    </div>
                    
                    <div style="margin-bottom:15px;">
                        <label for="customer_payment_person" style="display:block; margin-bottom:5px; font-weight:600;">Person + Reference</label>
                        <input type="text" id="customer_payment_person" name="person_reference" style="width:100%; padding:10px; border-radius:5px; border:1px solid #ddd;" placeholder="e.g., Jane Smith - INV-456">
                    </div>
                    
                    <div style="margin-bottom:20px;">
                        <label for="customer_payment_date" style="display:block; margin-bottom:5px; font-weight:600;">Date & Time *</label>
                        <input type="datetime-local" id="customer_payment_date" name="payment_date" required style="width:100%; padding:10px; border-radius:5px; border:1px solid #ddd;">
                    </div>
                    
                    <div style="display:flex; gap:10px;">
                        <button type="submit" class="btn btn-primary" style="flex:1;">Receive Payment</button>
                        <button type="button" class="btn btn-secondary" onclick="closeCustomerPaymentModal()" style="flex:1;">Cancel</button>
                    </div>
                </form>
                <button onclick="closeCustomerPaymentModal()" style="position:absolute; top:10px; right:15px; background:none; border:none; font-size:24px; color:#888; cursor:pointer;">&times;</button>
            </div>
        </div>
        
        <script>
        function openCustomerPaymentModal(incomeId, remaining) {
            document.getElementById('customerPaymentModal').style.display = 'flex';
            document.getElementById('customer_payment_income_id').value = incomeId;
            document.getElementById('customerPaymentForm').action = '/incomes/' + incomeId + '/add-payment';
            document.getElementById('customer_modal_remaining').innerText = Number(remaining).toLocaleString();
            document.getElementById('customer_payment_amount').max = remaining;
            document.getElementById('customer_payment_amount').value = '';
            
            // Set current date and time
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const day = String(now.getDate()).padStart(2, '0');
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            document.getElementById('customer_payment_date').value = `${year}-${month}-${day}T${hours}:${minutes}`;
        }
        
        function closeCustomerPaymentModal() {
            document.getElementById('customerPaymentModal').style.display = 'none';
        }
        
        // Close modal on ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeCustomerPaymentModal();
        });
        </script>
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
</body>
</html>
