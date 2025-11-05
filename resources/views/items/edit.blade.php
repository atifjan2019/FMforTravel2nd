<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/responsive.css">
    <title>Edit Item - Al Nafi Travels</title>
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
        textarea { resize: vertical; min-height: 100px; }
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
            <h1>✏️ Edit Item/Service</h1>
            <nav style="margin-top: 10px;"><a href="/">🏠 Dashboard</a><a href="/items">← Back to Items</a></nav>
        </header>
        <div class="card">
            <form action="/items/{{ $item->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Item/Service Name *</label>
                    <input type="text" id="name" name="name" value="{{ $item->name }}" required>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <input type="text" id="category" name="category" value="{{ $item->category }}">
                </div>
                <div class="form-group">
                    <label for="unit">Unit *</label>
                    <input type="text" id="unit" name="unit" value="{{ $item->unit }}" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description">{{ $item->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="status">Status *</label>
                    <select id="status" name="status" required>
                        <option value="active" {{ $item->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $item->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div style="margin-top: 30px;">
                    <button type="submit" class="btn btn-primary">💾 Update Item</button>
                    <a href="/items" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
            
            <form action="/items/{{ $item->id }}" method="POST" style="margin-top: 30px; padding-top: 30px; border-top: 2px solid #eee;" onsubmit="return confirm('Are you sure you want to delete this item? This action cannot be undone.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">🗑️ Delete Item</button>
            </form>
        </div>
    </div>
<script src="/js/mobile-menu.js"></script>
</body>
</html>
