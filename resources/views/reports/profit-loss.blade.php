<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profit & Loss Report - Al Nafi Travels</title>
    <link rel="stylesheet" href="/css/responsive.css">
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
        .positive { color: #10b981; font-weight: bold; }
        .negative { color: #ef4444; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>📊 Profit & Loss Report</h1>
            <nav style="margin-top: 10px;"><a href="/">🏠 Dashboard</a><a href="/reports">← Back to Reports</a></nav>
        </header>

        <div class="summary">
            <div class="stat-card" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                <h3>Total Income</h3>
                <div class="amount">Rs {{ number_format($totalIncome) }}</div>
            </div>
            <div class="stat-card" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);">
                <h3>Total Expenses</h3>
                <div class="amount">Rs {{ number_format($totalExpenses) }}</div>
            </div>
            <div class="stat-card" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                <h3>Total Purchases</h3>
                <div class="amount">Rs {{ number_format($totalPurchases) }}</div>
            </div>
            <div class="stat-card" style="background: linear-gradient(135deg, {{ $netProfit >= 0 ? '#8b5cf6, #7c3aed' : '#ef4444, #dc2626' }} 100%);">
                <h3>Net Profit/Loss</h3>
                <div class="amount">Rs {{ number_format($netProfit) }}</div>
            </div>
        </div>

        <div class="card">
            <h2 style="margin-bottom: 20px;">Monthly Breakdown</h2>
            <table>
                <thead>
                    <tr><th>Month</th><th>Income</th><th>Expenses</th><th>Purchases</th><th>Net Profit</th></tr>
                </thead>
                <tbody>
                    @foreach($monthlyData as $data)
                    <tr>
                        <td>{{ $data['month'] }}</td>
                        <td class="positive">Rs {{ number_format($data['income']) }}</td>
                        <td class="negative">Rs {{ number_format($data['expenses']) }}</td>
                        <td class="negative">Rs {{ number_format($data['purchases']) }}</td>
                        <td class="{{ $data['profit'] >= 0 ? 'positive' : 'negative' }}">Rs {{ number_format($data['profit']) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
