<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report - Al Nafi Travels</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f7fa; }
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px 30px; border-radius: 10px; margin-bottom: 30px; }
        nav a { color: white; text-decoration: none; margin-right: 20px; opacity: 0.9; }
        .card { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 20px; }
        .summary { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px; }
        .stat-card { background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; padding: 20px; border-radius: 10px; text-align: center; }
        .stat-card h3 { font-size: 14px; opacity: 0.9; margin-bottom: 10px; }
        .stat-card .amount { font-size: 28px; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #f8f9fa; font-weight: 600; color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>📈 Sales Report</h1>
            <nav style="margin-top: 10px;"><a href="/">🏠 Dashboard</a><a href="/reports">← Back to Reports</a></nav>
        </header>

        <div class="summary">
            <div class="stat-card">
                <h3>Total Sales</h3>
                <div class="amount">Rs {{ number_format($totalSales) }}</div>
            </div>
            <div class="stat-card">
                <h3>Total Transactions</h3>
                <div class="amount">{{ $totalTransactions }}</div>
            </div>
            <div class="stat-card">
                <h3>Average Sale</h3>
                <div class="amount">Rs {{ number_format($averageSale) }}</div>
            </div>
        </div>

        <div class="card">
            <h2 style="margin-bottom: 20px;">Monthly Sales</h2>
            <table>
                <thead>
                    <tr><th>Month</th><th>Transactions</th><th>Total Sales</th><th>Average</th></tr>
                </thead>
                <tbody>
                    @foreach($monthlySales as $sale)
                    <tr>
                        <td><strong>{{ $sale['month'] }}</strong></td>
                        <td>{{ $sale['count'] }}</td>
                        <td style="color: #10b981; font-weight: bold;">Rs {{ number_format($sale['total']) }}</td>
                        <td>Rs {{ number_format($sale['average']) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card">
            <h2 style="margin-bottom: 20px;">Sales by Item/Service</h2>
            <table>
                <thead>
                    <tr><th>Item/Service</th><th>Transactions</th><th>Total Sales</th></tr>
                </thead>
                <tbody>
                    @foreach($salesByItem as $item)
                    <tr>
                        <td><strong>{{ $item->item_name ?? 'N/A' }}</strong></td>
                        <td>{{ $item->count }}</td>
                        <td style="color: #10b981; font-weight: bold;">Rs {{ number_format($item->total) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card">
            <h2 style="margin-bottom: 20px;">Top Customers</h2>
            <table>
                <thead>
                    <tr><th>Customer</th><th>Transactions</th><th>Total Amount</th></tr>
                </thead>
                <tbody>
                    @foreach($topCustomers as $customer)
                    <tr>
                        <td><strong>{{ $customer->customer_name }}</strong></td>
                        <td>{{ $customer->count }}</td>
                        <td style="color: #10b981; font-weight: bold;">Rs {{ number_format($customer->total) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
