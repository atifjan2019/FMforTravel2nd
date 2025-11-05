<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Expense - Al Nafi Travels</title>
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
            <h1>✏️ Edit Expense</h1>
            <nav style="margin-top: 10px;"><a href="/">🏠 Dashboard</a><a href="/expenses">← Back to Expenses</a></nav>
        </header>
        <div class="card">
            <form action="/expenses/{{ $expense->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="category">Category *</label>
                    <select id="category" name="category" required>
                        <option value="">Select Category</option>
                        <option value="Rent" {{ $expense->category == 'Rent' ? 'selected' : '' }}>Rent</option>
                        <option value="Salaries" {{ $expense->category == 'Salaries' ? 'selected' : '' }}>Salaries</option>
                        <option value="Utilities" {{ $expense->category == 'Utilities' ? 'selected' : '' }}>Utilities</option>
                        <option value="Marketing" {{ $expense->category == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                        <option value="Office Supplies" {{ $expense->category == 'Office Supplies' ? 'selected' : '' }}>Office Supplies</option>
                        <option value="Transportation" {{ $expense->category == 'Transportation' ? 'selected' : '' }}>Transportation</option>
                        <option value="Communication" {{ $expense->category == 'Communication' ? 'selected' : '' }}>Communication</option>
                        <option value="Insurance" {{ $expense->category == 'Insurance' ? 'selected' : '' }}>Insurance</option>
                        <option value="Maintenance" {{ $expense->category == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                        <option value="Other" {{ $expense->category == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="amount">Amount (Rs) *</label>
                    <input type="number" id="amount" name="amount" step="0.01" value="{{ $expense->amount }}" required>
                </div>
                <div class="form-group">
                    <label for="expense_date">Expense Date *</label>
                    <input type="date" id="expense_date" name="expense_date" value="{{ $expense->expense_date->format('Y-m-d') }}" required>
                </div>
                <div class="form-group">
                    <label for="reference_no">Reference No</label>
                    <input type="text" id="reference_no" name="reference_no" value="{{ $expense->reference_no }}">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description">{{ $expense->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="status">Status *</label>
                    <select id="status" name="status" required>
                        <option value="paid" {{ $expense->status == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="pending" {{ $expense->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="cancelled" {{ $expense->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <div style="margin-top: 30px;">
                    <button type="submit" class="btn btn-primary">💾 Update Expense</button>
                    <a href="/expenses" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
            
            <form action="/expenses/{{ $expense->id }}" method="POST" style="margin-top: 30px; padding-top: 30px; border-top: 2px solid #eee;" onsubmit="return confirm('Are you sure you want to delete this expense? This action cannot be undone.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">🗑️ Delete Expense</button>
            </form>
        </div>
    </div>
</body>
</html>
