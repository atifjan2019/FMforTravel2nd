<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Payments - Al Nafi Travels</title>
    <link rel="stylesheet" href="/css/responsive.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f7fa; }
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px 30px; border-radius: 10px; margin-bottom: 30px; }
        nav a { color: white; text-decoration: none; margin-right: 20px; opacity: 0.9; }
        .card { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #eee; vertical-align: middle; }
        th { background: #f8f9fa; font-weight: 600; color: #666; }
        .btn { padding: 5px 15px; border-radius: 5px; text-decoration: none; font-weight: 600; transition: all 0.3s; display: inline-block; border: none; cursor: pointer; font-size: 14px; }
        .btn-primary { background: #667eea; color: white; }
        .btn-danger { background: #ef4444; color: white; }
        .actions { display: flex; gap: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>💵 Customer Payments</h1>
            <nav style="margin-top: 10px;"><a href="/">🏠 Dashboard</a><a href="/customers">👥 Customers</a></nav>
        </header>
        <div class="card">
            <h3 style="margin-bottom: 20px;">💵 Customer Payment Records: {{ $payments->count() }}</h3>
            <table>
                <thead>
                    <tr><th>Date</th><th>Customer</th><th>Amount</th><th>Method</th><th>Reference</th><th>Notes</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    @forelse($payments as $payment)
                    <tr>
                        <td>{{ $payment->payment_date->format('d M Y') }}</td>
                        <td><a href="/customers/{{ $payment->customer->id }}" style="color: #667eea; text-decoration: none; font-weight: 600;">{{ $payment->customer->name }}</a></td>
                        <td><strong style="color: #10b981;">Rs {{ number_format($payment->amount) }}</strong></td>
                        <td><span style="background: #e0e7ff; padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 600;">{{ ucfirst($payment->payment_method) }}</span></td>
                        <td>{{ $payment->reference_no ?? 'N/A' }}</td>
                        <td>{{ $payment->notes ?? '-' }}</td>
                        <td class="actions">
                            <a href="/customer-payments/{{ $payment->id }}/edit" class="btn btn-primary">Edit</a>
                            <form action="/customer-payments/{{ $payment->id }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this payment?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" style="text-align: center; padding: 40px; color: #999;">No payments found</td></tr>
                    @endforelse
                </tbody>
            </table>
            @if($payments->hasPages())
            <div style="margin-top: 20px; text-align: center;">
                {{ $payments->links() }}
            </div>
            @endif
        </div>
    </div>
<script src="/js/mobile-menu.js"></script>
</body>
</html>
