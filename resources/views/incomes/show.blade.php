<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Income Details - Al Nafi Travels</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f7fa; }
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px 30px; border-radius: 10px; margin-bottom: 30px; }
        .btn { padding: 5px 15px; font-size: 14px; border-radius: 5px; text-decoration: none; font-weight: 600; display: inline-block; }
        .btn-primary { background: #667eea; color: white; }
        .card { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .info-row { display: grid; grid-template-columns: 200px 1fr; padding: 15px 0; border-bottom: 1px solid #eee; }
        .info-label { font-weight: 600; color: #666; }
        nav a { color: white; text-decoration: none; margin-right: 20px; opacity: 0.9; }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>💰 Income Details</h1>
            <nav style="margin-top: 10px;"><a href="/">🏠 Dashboard</a><a href="/incomes">← Back to Incomes</a></nav>
        </header>
        <div class="card">
            <div class="info-row"><div class="info-label">Income Date:</div><div>{{ $income->income_date->format('d M Y') }}</div></div>
            <div class="info-row"><div class="info-label">Customer:</div><div>{{ $income->customer->name }}</div></div>
            <div class="info-row"><div class="info-label">Item:</div><div>{{ $income->item->name ?? 'N/A' }}</div></div>
            <div class="info-row"><div class="info-label">Amount:</div><div><strong>Rs {{ number_format($income->amount) }}</strong></div></div>
            <div class="info-row"><div class="info-label">Reference:</div><div>{{ $income->reference_no ?? 'N/A' }}</div></div>
            <div class="info-row"><div class="info-label">Description:</div><div>{{ $income->description ?? 'N/A' }}</div></div>
            <div class="info-row"><div class="info-label">Status:</div><div>{{ ucfirst($income->status) }}</div></div>
            <div style="margin-top: 20px;"><a href="/incomes" class="btn btn-primary">Back to List</a></div>
        </div>
    </div>
</body>
</html>
