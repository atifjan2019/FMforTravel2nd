<x-layout title="🛒 Purchase Details - Al Nafi Travels">
    <x-page-header
        title="🛒 Purchase Details"
        icon="🛒"
        backUrl="/purchases"
    />

    <style>
        .purchase-header {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            color: white;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
        }
        .purchase-header .amount {
            font-size: 36px;
            font-weight: bold;
            margin: 10px 0;
        }
        .purchase-header .date {
            font-size: 14px;
            opacity: 0.9;
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
            border-left: 4px solid #8b5cf6;
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
        
        .purchase-breakdown {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            color: white;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        
        .purchase-breakdown h3 {
            margin-bottom: 20px;
            font-size: 18px;
        }
        
        .breakdown-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }
        
        .breakdown-item {
            text-align: center;
            padding: 15px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
        }
        
        .breakdown-item .label {
            font-size: 12px;
            opacity: 0.9;
            margin-bottom: 8px;
            text-transform: uppercase;
        }
        
        .breakdown-item .value {
            font-size: 24px;
            font-weight: bold;
        }
        
        .notes-box {
            background: #f8fafc;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #8b5cf6;
            margin-bottom: 20px;
        }
        
        .notes-box .label {
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
            font-weight: 600;
            margin-bottom: 10px;
            letter-spacing: 0.5px;
        }
        
        .notes-box .text {
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
            .purchase-header .amount { font-size: 28px; }
            .info-grid { grid-template-columns: 1fr; gap: 15px; }
            .breakdown-grid { grid-template-columns: 1fr; gap: 15px; }
            .breakdown-item .value { font-size: 20px; }
            .info-card { padding: 15px; }
            .notes-box { padding: 15px; }
        }
    </style>

    <div class="purchase-header">
        <div class="date">📅 {{ $purchase->purchase_date->format('d M Y') }}</div>
        <div class="amount">Rs {{ number_format($purchase->total_amount) }}</div>
    </div>

    <div class="card">
        <h3 style="margin-bottom: 20px; color: #8b5cf6;">📋 Purchase Information</h3>
        
        <div class="info-grid">
            <div class="info-card">
                <div class="info-label">🏢 Supplier</div>
                <div class="info-value">{{ $purchase->supplier->name }}</div>
            </div>
            
            <div class="info-card">
                <div class="info-label">📦 Item</div>
                <div class="info-value">{{ $purchase->item->name }}</div>
            </div>
            
            <div class="info-card">
                <div class="info-label">🔖 Reference Number</div>
                <div class="info-value">{{ $purchase->reference_no ?? 'Not provided' }}</div>
            </div>
        </div>
    </div>

    <div class="purchase-breakdown">
        <h3>📊 Purchase Breakdown</h3>
        <div class="breakdown-grid">
            <div class="breakdown-item">
                <div class="label">Quantity</div>
                <div class="value">{{ $purchase->quantity }}</div>
            </div>
            
            <div class="breakdown-item">
                <div class="label">Unit Price</div>
                <div class="value">Rs {{ number_format($purchase->unit_price) }}</div>
            </div>
            
            <div class="breakdown-item">
                <div class="label">Total Amount</div>
                <div class="value">Rs {{ number_format($purchase->total_amount) }}</div>
            </div>
        </div>
    </div>

    @if($purchase->notes)
    <div class="card">
        <div class="notes-box">
            <div class="label">📝 Notes</div>
            <div class="text">{{ $purchase->notes }}</div>
        </div>
    </div>
    @endif

    <div class="card">
        <div class="action-buttons">
            <a href="/purchases/{{ $purchase->id }}/edit" class="btn btn-success">✏️ Edit Purchase</a>
            <a href="/purchases" class="btn btn-secondary">← Back to Purchases</a>
        </div>
    </div>
</x-layout>
