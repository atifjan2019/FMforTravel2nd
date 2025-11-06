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
        .customer-details { display: none; }
        
        @media print {
            body { background: white; }
            .container { padding: 0; max-width: 100%; }
            header { display: none !important; }
            nav, .btn-print { display: none !important; }
            .card { box-shadow: none; border: 1px solid #ddd; }
            th { background: #f0f0f0 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            .summary { display: flex !important; flex-direction: row !important; gap: 15px !important; }
            .summary-item { border: 1px solid #ddd; flex: 1; }
            @page { margin: 1cm; }
            
            .floating-print-btn { display: none !important; }
            
            .print-header { 
                display: flex !important; 
                justify-content: space-between; 
                align-items: center; 
                padding: 20px 0; 
                border-bottom: 3px solid #333; 
                margin-bottom: 20px; 
            }
            .print-header img { 
                height: 60px; 
                width: auto; 
            }
            .print-header .customer-name { 
                font-size: 22px; 
                font-weight: bold; 
                color: #333; 
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
            <div class="customer-name">Invoice</div>
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
                        <th>Type</th>
                        <th>Description</th>
                        <th>Income (+)</th>
                        <!-- Removed Payment (-) column -->
                        <th>Payment Status</th>
                        <th>Reference</th>
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
                            'remaining_amount' => $income->remaining_amount
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
                        <td><strong>{{ $transaction['type'] }}</strong></td>
                        <td>{{ $transaction['description'] }}</td>
                        <td class="income">
                            {{ $transaction['income'] > 0 ? 'Rs ' . number_format($transaction['income']) : '' }}
                            @if($transaction['income'] > 0 && isset($transaction['paid_amount']))
                                <br><small style="color: #3b82f6;">Paid: Rs {{ number_format($transaction['paid_amount']) }}</small>
                            @endif
                        </td>
                        <!-- Removed Payment (-) cell -->
                        <td>
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
                        <td>{{ $transaction['reference'] ?? 'N/A' }}</td>
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
    </div>
</body>
</html>
