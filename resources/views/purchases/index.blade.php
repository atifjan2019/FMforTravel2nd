<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchases - Al Nafi Travels</title>
    <link rel="stylesheet" href="/css/responsive.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f7fa; }
        .container { max-width: 1400px; margin: 0 auto; padding: 20px; }
        header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px 30px; border-radius: 10px; margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center; }
        header h1 { font-size: 24px; }
        .btn { padding: 5px 15px; font-size: 14px; border-radius: 5px; text-decoration: none; font-weight: 600; transition: all 0.3s; display: inline-block; }
        .btn-primary { background: #667eea; color: white; }
        .btn-success { background: #10b981; color: white; }
        .card { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #eee; vertical-align: middle; }
        th { background: #f8fafc; font-weight: 600; color: #666; }
        nav a { color: white; text-decoration: none; margin-right: 20px; opacity: 0.9; }
        nav a:hover { opacity: 1; }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div>
                <h1>🛒 Purchases</h1>
                <nav style="margin-top: 10px;">
                    <a href="/">🏠 Dashboard</a>
                    <a href="/customers">Customers</a>
                    <a href="/suppliers">Suppliers</a>
                    <a href="/items">Items</a>
                    <a href="/purchases">Purchases</a>
                    <a href="/incomes">Incomes</a>
                    <a href="/expenses">Expenses</a>
                </nav>
            </div>
            <a href="/purchases/create" class="btn btn-success">+ Add Purchase</a>
        </header>

        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Supplier</th>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total Amount</th>
                        <th>Reference</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($purchases as $purchase)
                    <tr>
                        <td>{{ $purchase->purchase_date->format('d M Y') }}</td>
                        <td>{{ $purchase->supplier->name ?? 'N/A' }}</td>
                        <td>{{ $purchase->item->name ?? 'N/A' }}</td>
                        <td>{{ $purchase->quantity }}</td>
                        <td>Rs {{ number_format($purchase->unit_price) }}</td>
                        <td><strong>Rs {{ number_format($purchase->total_amount) }}</strong></td>
                        <td>{{ $purchase->reference_no ?? 'N/A' }}</td>
                        <td>
                            <a href="/purchases/{{ $purchase->id }}" class="btn btn-primary">View</a>
                            <a href="/purchases/{{ $purchase->id }}/edit" class="btn btn-primary">Edit</a>
                            <form action="/purchases/{{ $purchase->id }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this purchase?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="text-align: center; color: #999; padding: 40px;">No purchases found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
