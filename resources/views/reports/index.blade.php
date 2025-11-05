<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports - Al Nafi Travels</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f7fa; }
        .container { max-width: 1400px; margin: 0 auto; padding: 20px; }
        header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; border-radius: 10px; margin-bottom: 30px; }
        header h1 { font-size: 32px; margin-bottom: 5px; }
        header p { opacity: 0.9; }
        .report-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; }
        .report-card { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); text-decoration: none; color: #333; transition: all 0.3s; display: block; }
        .report-card:hover { transform: translateY(-5px); box-shadow: 0 4px 12px rgba(0,0,0,0.15); }
        .report-card .icon { font-size: 48px; margin-bottom: 15px; }
        .report-card h2 { font-size: 20px; margin-bottom: 10px; color: #333; }
        .report-card p { color: #666; font-size: 14px; line-height: 1.6; }
        nav a { color: white; text-decoration: none; margin-right: 20px; opacity: 0.9; }
        nav a:hover { opacity: 1; }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>📊 Reports</h1>
            <p>Financial reports and analytics</p>
            <nav style="margin-top: 15px;">
                <a href="/">🏠 Dashboard</a>
                <a href="/customers">Customers</a>
                <a href="/suppliers">Suppliers</a>
                <a href="/items">Items</a>
                <a href="/purchases">Purchases</a>
                <a href="/incomes">Incomes</a>
                <a href="/expenses">Expenses</a>
                <a href="/reports">Reports</a>
            </nav>
        </header>

        <div class="report-grid">
            <a href="/reports/profit-loss" class="report-card">
                <div class="icon">💹</div>
                <h2>Profit & Loss Report</h2>
                <p>View income, expenses, and net profit for any date range. Analyze your business profitability.</p>
            </a>

            <a href="/reports/customer-ledger" class="report-card">
                <div class="icon">👥</div>
                <h2>Customer Ledger</h2>
                <p>Detailed transaction history for each customer. View all incomes and payments with running balances.</p>
            </a>

            <a href="/reports/supplier-ledger" class="report-card">
                <div class="icon">🏢</div>
                <h2>Supplier Ledger</h2>
                <p>Complete supplier transaction records. Track all purchases and payments made to suppliers.</p>
            </a>

            <a href="/reports/cash-flow" class="report-card">
                <div class="icon">💰</div>
                <h2>Cash Flow Report</h2>
                <p>Monitor cash inflows and outflows. See actual money movements in your business.</p>
            </a>

            <a href="/reports/sales" class="report-card">
                <div class="icon">📈</div>
                <h2>Sales Report</h2>
                <p>Analyze sales by customer and item. Identify your top performers and revenue sources.</p>
            </a>

            <a href="/reports/purchases" class="report-card">
                <div class="icon">🛒</div>
                <h2>Purchase Report</h2>
                <p>Review purchases by supplier and item. Track spending patterns and supplier performance.</p>
            </a>
        </div>
    </div>
</body>
</html>
