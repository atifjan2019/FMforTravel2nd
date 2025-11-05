<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers - Al Nafi Travels</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f7fa; }
        .container { max-width: 1400px; margin: 0 auto; padding: 20px; }
        header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px 30px; border-radius: 10px; margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center; }
        header h1 { font-size: 24px; }
        .btn { padding: 5px 15px; border-radius: 5px; text-decoration: none; font-weight: 600; transition: all 0.3s; display: inline-block; border: none; cursor: pointer; font-size: 14px; }
        .btn-primary { background: #667eea; color: white; }
        .btn-primary:hover { background: #5568d3; }
        .btn-success { background: #10b981; color: white; }
        .btn-success:hover { background: #059669; }
        .btn-danger { background: #ef4444; color: white; }
        .btn-danger:hover { background: #dc2626; }
        .card { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #eee; vertical-align: middle; }
        th { background: #f8fafc; font-weight: 600; color: #666; }
        .badge { padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 600; }
        .badge-success { background: #d1fae5; color: #047857; }
        .badge-danger { background: #fee2e2; color: #991b1b; }
        .actions { display: flex; gap: 8px; align-items: center; flex-wrap: nowrap; }
        nav a { color: white; text-decoration: none; margin-right: 20px; opacity: 0.9; }
        nav a:hover { opacity: 1; }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div>
                <h1>👥 Customers</h1>
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
            <a href="/customers/create" class="btn btn-success">+ Add Customer</a>
        </header>

        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Total Incomes</th>
                        <th>Total Payments</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $customer)
                    <tr>
                        <td><strong>{{ $customer->name }}</strong></td>
                        <td>{{ $customer->phone ?? 'N/A' }}</td>
                        <td>{{ $customer->email ?? 'N/A' }}</td>
                        <td>{{ $customer->address ?? 'N/A' }}</td>
                        <td>{{ $customer->incomes_count }}</td>
                        <td>{{ $customer->payments_count }}</td>
                        <td>
                            <span class="badge {{ $customer->status == 'active' ? 'badge-success' : 'badge-danger' }}">
                                {{ ucfirst($customer->status) }}
                            </span>
                        </td>
                        <td class="actions">
                            <a href="/customers/{{ $customer->id }}" class="btn btn-primary">View</a>
                            <a href="/customers/{{ $customer->id }}/ledger" class="btn btn-primary">Ledger</a>
                            <a href="/customers/{{ $customer->id }}/edit" class="btn btn-primary">Edit</a>
                            <form action="/customers/{{ $customer->id }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this customer?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="text-align: center; color: #999; padding: 40px;">No customers found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            
            @if($customers->hasPages())
            <div style="margin-top: 20px; text-align: center;">
                {{ $customers->links() }}
            </div>
            @endif
        </div>
    </div>
</body>
</html>
