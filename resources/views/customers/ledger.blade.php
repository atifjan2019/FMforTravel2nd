<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Ledger - Al Nafi Travels</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f7fa; }
        .container { max-width: 1400px; margin: 0 auto; padding: 20px; }
        header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px 30px; border-radius: 10px; margin-bottom: 30px; }
        header h1 { font-size: 24px; }
        .btn { padding: 5px 15px; font-size: 14px; border-radius: 5px; text-decoration: none; font-weight: 600; display: inline-block; }
        .btn-primary { background: #667eea; color: white; }
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
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>📒 Customer Ledger: {{ $customer->name }}</h1>
            <nav style="margin-top: 10px;">
                <a href="/">🏠 Dashboard</a>
                <a href="/customers">← Back to Customers</a>
            </nav>
        </header>

        <div class="summary">
            <div class="summary-item">
                <div class="label">Total Income</div>
                <div class="value income">Rs {{ number_format($customer->total_income) }}</div>
            </div>
            <div class="summary-item">
                <div class="label">Total Paid</div>
                <div class="value payment">Rs {{ number_format($customer->total_paid) }}</div>
            </div>
            <div class="summary-item">
                <div class="label">Balance</div>
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
                        <th>Payment (-)</th>
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
                            'payment' => 0,
                            'reference' => $income->reference_no
                        ]);
                    }
                    foreach($customer->payments as $payment) {
                        $transactions->push([
                            'date' => $payment->payment_date,
                            'type' => 'Payment',
                            'description' => $payment->payment_method,
                            'income' => 0,
                            'payment' => $payment->amount,
                            'reference' => $payment->reference_no
                        ]);
                    }
                    $transactions = $transactions->sortByDesc('date');
                    @endphp

                    @forelse($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction['date']->format('d M Y') }}</td>
                        <td><strong>{{ $transaction['type'] }}</strong></td>
                        <td>{{ $transaction['description'] }}</td>
                        <td class="income">{{ $transaction['income'] > 0 ? 'Rs ' . number_format($transaction['income']) : '' }}</td>
                        <td class="payment">{{ $transaction['payment'] > 0 ? 'Rs ' . number_format($transaction['payment']) : '' }}</td>
                        <td>{{ $transaction['reference'] ?? 'N/A' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align: center; color: #999; padding: 40px;">No transactions found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
