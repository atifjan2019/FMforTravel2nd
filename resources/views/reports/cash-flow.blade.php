<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cash Flow Report - Al Nafi Travels</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f7fa; }
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px 30px; border-radius: 10px; margin-bottom: 30px; }
        nav a { color: white; text-decoration: none; margin-right: 20px; opacity: 0.9; }
        .card { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 20px; }
        .summary { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px; }
        .stat-card { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px; border-radius: 10px; text-align: center; }
        .stat-card h3 { font-size: 14px; opacity: 0.9; margin-bottom: 10px; }
        .stat-card .amount { font-size: 28px; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #f8f9fa; font-weight: 600; color: #666; }
        .cash-in { color: #10b981; font-weight: bold; }
        .cash-out { color: #ef4444; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>💵 Cash Flow Report</h1>
            <nav style="margin-top: 10px;"><a href="/">🏠 Dashboard</a><a href="/reports">← Back to Reports</a></nav>
        </header>

        <div class="summary">
            <div class="stat-card" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                <h3>Total Cash In</h3>
                <div class="amount">Rs {{ number_format($totalCashIn) }}</div>
            </div>
            <div class="stat-card" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);">
                <h3>Total Cash Out</h3>
                <div class="amount">Rs {{ number_format($totalCashOut) }}</div>
            </div>
            <div class="stat-card" style="background: linear-gradient(135deg, {{ $netCashFlow >= 0 ? '#8b5cf6, #7c3aed' : '#ef4444, #dc2626' }} 100%);">
                <h3>Net Cash Flow</h3>
                <div class="amount">Rs {{ number_format($netCashFlow) }}</div>
            </div>
        </div>

        <div class="card">
            <h2 style="margin-bottom: 20px;">Monthly Cash Flow</h2>
            <table>
                <thead>
                    <tr><th>Month</th><th>Cash In</th><th>Cash Out</th><th>Net Flow</th></tr>
                </thead>
                <tbody>
                    @foreach($monthlyData as $data)
                    <tr>
                        <td><strong>{{ $data['month'] }}</strong></td>
                        <td class="cash-in">Rs {{ number_format($data['cash_in']) }}</td>
                        <td class="cash-out">Rs {{ number_format($data['cash_out']) }}</td>
                        <td class="{{ $data['net_flow'] >= 0 ? 'cash-in' : 'cash-out' }}">Rs {{ number_format($data['net_flow']) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card">
            <h2 style="margin-bottom: 20px;">Cash In Details</h2>
            <table>
                <thead>
                    <tr><th>Source</th><th>Amount</th></tr>
                </thead>
                <tbody>
                    <tr><td>Customer Payments</td><td class="cash-in">Rs {{ number_format($customerPayments) }}</td></tr>
                    <tr><td>Income Transactions</td><td class="cash-in">Rs {{ number_format($incomeTransactions) }}</td></tr>
                    <tr style="background: #f8f9fa;"><td><strong>Total Cash In</strong></td><td class="cash-in"><strong>Rs {{ number_format($totalCashIn) }}</strong></td></tr>
                </tbody>
            </table>
        </div>

        <div class="card">
            <h2 style="margin-bottom: 20px;">Cash Out Details</h2>
            <table>
                <thead>
                    <tr><th>Category</th><th>Amount</th></tr>
                </thead>
                <tbody>
                    <tr><td>Supplier Payments</td><td class="cash-out">Rs {{ number_format($supplierPayments) }}</td></tr>
                    <tr><td>Purchase Transactions</td><td class="cash-out">Rs {{ number_format($purchaseTransactions) }}</td></tr>
                    <tr><td>Expenses</td><td class="cash-out">Rs {{ number_format($expenses) }}</td></tr>
                    <tr style="background: #f8f9fa;"><td><strong>Total Cash Out</strong></td><td class="cash-out"><strong>Rs {{ number_format($totalCashOut) }}</strong></td></tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
