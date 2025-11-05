<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Purchase - Al Nafi Travels</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f7fa; }
        .container { max-width: 900px; margin: 0 auto; padding: 20px; }
        header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px 30px; border-radius: 10px; margin-bottom: 30px; }
        nav a { color: white; text-decoration: none; margin-right: 20px; opacity: 0.9; }
        .card { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; font-weight: 600; color: #333; }
        input, select, textarea { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px; }
        textarea { resize: vertical; min-height: 80px; }
        .btn { padding: 12px 30px; border: none; border-radius: 5px; font-weight: 600; cursor: pointer; text-decoration: none; display: inline-block; }
        .btn-primary { background: #667eea; color: white; }
        .btn-secondary { background: #6c757d; color: white; margin-left: 10px; }
        .btn:hover { opacity: 0.9; }
        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>➕ Add New Purchase</h1>
            <nav style="margin-top: 10px;"><a href="/">🏠 Dashboard</a><a href="/purchases">← Back to Purchases</a></nav>
        </header>
        <div class="card">
            <form action="/purchases" method="POST">
                @csrf
                <div class="form-group">
                    <label for="supplier_id">Supplier *</label>
                    <select id="supplier_id" name="supplier_id" required>
                        <option value="">Select Supplier</option>
                        @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="item_id">Item/Service *</label>
                    <select id="item_id" name="item_id" required>
                        <option value="">Select Item</option>
                        @foreach($items as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid">
                    <div class="form-group">
                        <label for="quantity">Quantity *</label>
                        <input type="number" id="quantity" name="quantity" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="unit_price">Unit Price (Rs) *</label>
                        <input type="number" id="unit_price" name="unit_price" step="0.01" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="purchase_date">Purchase Date *</label>
                    <input type="date" id="purchase_date" name="purchase_date" value="{{ date('Y-m-d') }}" required>
                </div>
                <div class="form-group">
                    <label for="reference_no">Reference No</label>
                    <input type="text" id="reference_no" name="reference_no" placeholder="Invoice/Reference number">
                </div>
                <div class="form-group">
                    <label for="notes">Notes</label>
                    <textarea id="notes" name="notes" placeholder="Additional notes"></textarea>
                </div>
                <div style="margin-top: 30px;">
                    <button type="submit" class="btn btn-primary">💾 Save Purchase</button>
                    <a href="/purchases" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
