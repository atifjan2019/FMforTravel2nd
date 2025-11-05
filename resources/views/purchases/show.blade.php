<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/responsive.css">
    <title>Purchase Details - Al Nafi Travels</title>
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
            <h1>🛒 Purchase Details</h1>
            <nav style="margin-top: 10px;"><a href="/">🏠 Dashboard</a><a href="/purchases">← Back to Purchases</a></nav>
        </header>
        <div class="card">
            <div class="info-row"><div class="info-label">Purchase Date:</div><div>{{ $purchase->purchase_date->format('d M Y') }}</div></div>
            <div class="info-row"><div class="info-label">Supplier:</div><div>{{ $purchase->supplier->name }}</div></div>
            <div class="info-row"><div class="info-label">Item:</div><div>{{ $purchase->item->name }}</div></div>
            <div class="info-row"><div class="info-label">Quantity:</div><div>{{ $purchase->quantity }}</div></div>
            <div class="info-row"><div class="info-label">Unit Price:</div><div>Rs {{ number_format($purchase->unit_price) }}</div></div>
            <div class="info-row"><div class="info-label">Total Amount:</div><div><strong>Rs {{ number_format($purchase->total_amount) }}</strong></div></div>
            <div class="info-row"><div class="info-label">Reference:</div><div>{{ $purchase->reference_no ?? 'N/A' }}</div></div>
            <div class="info-row"><div class="info-label">Notes:</div><div>{{ $purchase->notes ?? 'N/A' }}</div></div>
            <div style="margin-top: 20px;"><a href="/purchases" class="btn btn-primary">Back to List</a></div>
        </div>
    </div>
<script src="/js/mobile-menu.js"></script>
</body>
</html>
