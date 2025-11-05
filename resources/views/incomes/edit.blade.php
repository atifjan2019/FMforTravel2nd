<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Income - Al Nafi Travels</title>
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
        .btn-danger { background: #dc3545; color: white; margin-left: 10px; }
        .btn:hover { opacity: 0.9; }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>✏️ Edit Income</h1>
            <nav style="margin-top: 10px;"><a href="/">🏠 Dashboard</a><a href="/incomes">← Back to Incomes</a></nav>
        </header>
        <div class="card">
            <form action="/incomes/{{ $income->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="customer_id">Customer *</label>
                    <select id="customer_id" name="customer_id" required>
                        <option value="">Select Customer</option>
                        @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" {{ $income->customer_id == $customer->id ? 'selected' : '' }}>{{ $customer->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="item_id">Item/Service</label>
                    <select id="item_id" name="item_id">
                        <option value="">Select Item (Optional)</option>
                        @foreach($items as $item)
                        <option value="{{ $item->id }}" {{ $income->item_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="amount">Amount (Rs) *</label>
                    <input type="number" id="amount" name="amount" step="0.01" value="{{ $income->amount }}" required>
                </div>
                <div class="form-group">
                    <label for="income_date">Income Date *</label>
                    <input type="date" id="income_date" name="income_date" value="{{ $income->income_date->format('Y-m-d') }}" required>
                </div>
                <div class="form-group">
                    <label for="reference_no">Reference No</label>
                    <input type="text" id="reference_no" name="reference_no" value="{{ $income->reference_no }}">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description">{{ $income->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="status">Status *</label>
                    <select id="status" name="status" required>
                        <option value="confirmed" {{ $income->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="pending" {{ $income->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="cancelled" {{ $income->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <div style="margin-top: 30px;">
                    <button type="submit" class="btn btn-primary">💾 Update Income</button>
                    <a href="/incomes" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
            
            <form action="/incomes/{{ $income->id }}" method="POST" style="margin-top: 30px; padding-top: 30px; border-top: 2px solid #eee;" onsubmit="return confirm('Are you sure you want to delete this income? This action cannot be undone.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">🗑️ Delete Income</button>
            </form>
        </div>
    </div>
</body>
</html>
