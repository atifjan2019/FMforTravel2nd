<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Details - Al Nafi Travels</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f7fa; }
        .container { max-width: 1400px; margin: 0 auto; padding: 20px; }
        header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px 30px; border-radius: 10px; margin-bottom: 30px; }
        header h1 { font-size: 24px; }
        .btn { padding: 5px 15px; font-size: 14px; border-radius: 5px; text-decoration: none; font-weight: 600; display: inline-block; margin-top: 10px; }
        .btn-primary { background: #667eea; color: white; }
        .card { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 20px; }
        .info-row { display: grid; grid-template-columns: 200px 1fr; padding: 15px 0; border-bottom: 1px solid #eee; }
        .info-row:last-child { border-bottom: none; }
        .info-label { font-weight: 600; color: #666; }
        .info-value { color: #333; }
        .badge { padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 600; }
        .badge-success { background: #d1fae5; color: #047857; }
        nav a { color: white; text-decoration: none; margin-right: 20px; opacity: 0.9; }
        nav a:hover { opacity: 1; }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>🏢 Supplier Details</h1>
            <nav style="margin-top: 10px;">
                <a href="/">🏠 Dashboard</a>
                <a href="/suppliers">← Back to Suppliers</a>
            </nav>
        </header>

        <div class="card">
            <h2 style="margin-bottom: 20px;">{{ $supplier->name }}</h2>
            
            <div class="info-row">
                <div class="info-label">Phone:</div>
                <div class="info-value">{{ $supplier->phone ?? 'N/A' }}</div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Email:</div>
                <div class="info-value">{{ $supplier->email ?? 'N/A' }}</div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Address:</div>
                <div class="info-value">{{ $supplier->address ?? 'N/A' }}</div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Status:</div>
                <div class="info-value">
                    <span class="badge badge-success">{{ ucfirst($supplier->status) }}</span>
                </div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Total Purchases:</div>
                <div class="info-value"><strong>Rs {{ number_format($supplier->total_purchases) }}</strong></div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Total Paid:</div>
                <div class="info-value"><strong>Rs {{ number_format($supplier->total_paid) }}</strong></div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Balance Due:</div>
                <div class="info-value"><strong>Rs {{ number_format($supplier->balance) }}</strong></div>
            </div>
            
            <div style="margin-top: 30px;">
                <a href="/suppliers/{{ $supplier->id }}/ledger" class="btn btn-primary">View Ledger</a>
                <a href="/suppliers" class="btn btn-primary">Back to List</a>
            </div>
        </div>
    </div>
</body>
</html>
