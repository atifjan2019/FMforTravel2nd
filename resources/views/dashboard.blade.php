<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Al Nafi Travels - Financial Dashboard</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f7fa; }
        .container { max-width: 1400px; margin: 0 auto; padding: 20px; }
        header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; border-radius: 10px; margin-bottom: 30px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        header h1 { font-size: 32px; margin-bottom: 5px; }
        header p { opacity: 0.9; }
        .stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px; }
        .stat-card { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .stat-card h3 { color: #666; font-size: 14px; font-weight: 600; text-transform: uppercase; margin-bottom: 10px; }
        .stat-card .value { font-size: 28px; font-weight: bold; color: #333; }
        .stat-card .value.positive { color: #10b981; }
        .stat-card .value.negative { color: #ef4444; }
        .stat-card .value.info { color: #3b82f6; }
        .menu { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-bottom: 30px; }
        .menu-item { background: white; padding: 20px; border-radius: 10px; text-align: center; text-decoration: none; color: #333; box-shadow: 0 2px 4px rgba(0,0,0,0.1); transition: all 0.3s; }
        .menu-item:hover { transform: translateY(-5px); box-shadow: 0 4px 8px rgba(0,0,0,0.15); }
        .menu-item .icon { font-size: 32px; margin-bottom: 10px; }
        .menu-item .label { font-weight: 600; }
        .recent-section { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 20px; }
        .recent-section h2 { margin-bottom: 20px; color: #333; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #f8fafc; font-weight: 600; color: #666; }
        .badge { padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 600; }
        .badge-success { background: #d1fae5; color: #047857; }
        .badge-warning { background: #fef3c7; color: #92400e; }
        footer { text-align: center; padding: 20px; color: #666; font-size: 14px; }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>🌍 Al Nafi Travels</h1>
            <p>Financial Management System - Dashboard ({{ now()->format('F Y') }})</p>
        </header>

        <div class="stats">
            <div class="stat-card">
                <h3>Current Month Income</h3>
                <div class="value positive">Rs {{ number_format($totalIncome ?? 0) }}</div>
            </div>
            <div class="stat-card">
                <h3>Current Month Expenses</h3>
                <div class="value negative">Rs {{ number_format($totalExpenses ?? 0) }}</div>
            </div>
            <div class="stat-card">
                <h3>Current Month Receivables</h3>
                <div class="value info">Rs {{ number_format($customerReceivables ?? 0) }}</div>
            </div>
            <div class="stat-card">
                <h3>Current Month Net Profit</h3>
                <div class="value {{ ($netProfit ?? 0) >= 0 ? 'positive' : 'negative' }}">Rs {{ number_format($netProfit ?? 0) }}</div>
            </div>
        </div>

        <div class="menu">
            <a href="/customers" class="menu-item">
                <div class="icon">👥</div>
                <div class="label">Customers</div>
            </a>
            <a href="/suppliers" class="menu-item">
                <div class="icon">🏢</div>
                <div class="label">Suppliers</div>
            </a>
            <a href="/items" class="menu-item">
                <div class="icon">📦</div>
                <div class="label">Items/Services</div>
            </a>
            <a href="/purchases" class="menu-item">
                <div class="icon">🛒</div>
                <div class="label">Purchases</div>
            </a>
            <a href="/incomes" class="menu-item">
                <div class="icon">💰</div>
                <div class="label">Incomes</div>
            </a>
            <a href="/expenses" class="menu-item">
                <div class="icon">💸</div>
                <div class="label">Expenses</div>
            </a>
            <a href="/customer-payments" class="menu-item">
                <div class="icon">💳</div>
                <div class="label">Customer Payments</div>
            </a>
            <a href="/supplier-payments" class="menu-item">
                <div class="icon">💵</div>
                <div class="label">Supplier Payments</div>
            </a>
            <a href="/reports" class="menu-item">
                <div class="icon">📊</div>
                <div class="label">Reports</div>
            </a>
        </div>

        <div class="recent-section">
            <h2>💰 Current Month Incomes ({{ now()->format('F Y') }})</h2>
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Customer</th>
                        <th>Item</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentIncomes ?? [] as $income)
                    <tr>
                        <td>{{ $income->income_date->format('d M Y') }}</td>
                        <td>{{ $income->customer->name ?? 'N/A' }}</td>
                        <td>{{ $income->item->name ?? 'N/A' }}</td>
                        <td><strong>Rs {{ number_format($income->amount) }}</strong></td>
                        <td><span class="badge badge-success">{{ ucfirst($income->status) }}</span></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align: center; color: #999;">No incomes this month</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <footer>
            <p>&copy; 2025 Al Nafi Travels. Financial Management System.</p>
            <p style="margin-top: 10px;">
                <strong>Login:</strong> admin@alnafi.com | <strong>Password:</strong> password
            </p>
        </footer>
    </div>
</body>
</html>
