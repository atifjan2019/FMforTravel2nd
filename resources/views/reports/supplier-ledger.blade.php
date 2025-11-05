<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Ledger Report - Al Nafi Travels</title>
    <link rel="stylesheet" href="/css/responsive.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f7fa; }
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px 30px; border-radius: 10px; margin-bottom: 30px; }
        nav a { color: white; text-decoration: none; margin-right: 20px; opacity: 0.9; }
        .card { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #f8f9fa; font-weight: 600; color: #666; }
        .positive { color: #10b981; }
        .negative { color: #ef4444; }
        a.supplier-link { color: #667eea; text-decoration: none; font-weight: 600; }
        a.supplier-link:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>🏢 Supplier Ledger Report</h1>
            <nav style="margin-top: 10px;"><a href="/">🏠 Dashboard</a><a href="/reports">← Back to Reports</a></nav>
        </header>

        <div class="card">
            <h2 style="margin-bottom: 20px;">All Suppliers Balance Summary</h2>
            <table>
                <thead>
                    <tr><th>Supplier Name</th><th>Total Purchases</th><th>Total Paid</th><th>Balance</th><th>Status</th><th>Action</th></tr>
                </thead>
                <tbody>
                    @forelse($suppliers as $supplier)
                    <tr>
                        <td><strong>{{ $supplier->name }}</strong></td>
                        <td class="negative">Rs {{ number_format($supplier->total_purchases) }}</td>
                        <td class="positive">Rs {{ number_format($supplier->total_paid) }}</td>
                        <td class="{{ $supplier->balance > 0 ? 'negative' : ($supplier->balance < 0 ? 'positive' : '') }}">
                            <strong>Rs {{ number_format(abs($supplier->balance)) }}</strong>
                            @if($supplier->balance > 0) (Payable) @elseif($supplier->balance < 0) (Advance) @endif
                        </td>
                        <td>{{ ucfirst($supplier->status) }}</td>
                        <td><a href="/suppliers/{{ $supplier->id }}/ledger" class="supplier-link">View Ledger →</a></td>
                    </tr>
                    @empty
                    <tr><td colspan="6" style="text-align: center; padding: 40px;">No suppliers found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
