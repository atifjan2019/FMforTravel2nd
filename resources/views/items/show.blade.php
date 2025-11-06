<x-layout title="📦 Item Details - Al Nafi Travels">
    <x-page-header
        title="📦 Item Details"
        icon="📦"
        backUrl="/items"
    />

    <style>
        .item-header {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .item-header h2 {
            font-size: 24px;
            margin: 0;
        }
        .item-header .status {
            margin-top: 10px;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .info-card {
            background: #f8fafc;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #3b82f6;
        }
        
        .info-label {
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
            font-weight: 600;
            margin-bottom: 8px;
            letter-spacing: 0.5px;
        }
        
        .info-value {
            font-size: 16px;
            color: #333;
            font-weight: 600;
        }
        
        .description-box {
            background: #f8fafc;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #3b82f6;
            margin-bottom: 20px;
        }
        
        .description-box .label {
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
            font-weight: 600;
            margin-bottom: 10px;
            letter-spacing: 0.5px;
        }
        
        .description-box .text {
            font-size: 15px;
            color: #333;
            line-height: 1.6;
        }
        
        .action-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        
        @media (max-width: 768px) {
            .item-header h2 { font-size: 20px; }
            .info-grid { grid-template-columns: 1fr; gap: 15px; }
            .info-card { padding: 15px; }
            .description-box { padding: 15px; }
        }
    </style>

    <div class="item-header">
        <h2>{{ $item->name }}</h2>
        <div class="status">
            <span class="badge badge-success">{{ ucfirst($item->status) }}</span>
        </div>
    </div>

    <div class="card">
        <h3 style="margin-bottom: 20px; color: #3b82f6;">📋 Item Information</h3>
        
        <div class="info-grid">
            <div class="info-card">
                <div class="info-label">📁 Category</div>
                <div class="info-value">{{ $item->category ?? 'Not specified' }}</div>
            </div>
            
            <div class="info-card">
                <div class="info-label">📏 Unit of Measurement</div>
                <div class="info-value">{{ $item->unit }}</div>
            </div>
        </div>
        
        @if($item->description)
        <div class="description-box">
            <div class="label">📝 Description</div>
            <div class="text">{{ $item->description }}</div>
        </div>
        @endif
    </div>

    <div class="card">
        <div class="action-buttons">
            <a href="/items/{{ $item->id }}/edit" class="btn btn-success">✏️ Edit Item</a>
            <a href="/items" class="btn btn-secondary">← Back to Items</a>
        </div>
    </div>
</x-layout>
