<x-layout title="🏢 Supplier Details - Al Nafi Travels">
    <x-page-header
        title="🏢 Supplier Details"
        icon="🏢"
        backUrl="/suppliers"
    />

    <style>
        .supplier-header {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .supplier-header h2 {
            font-size: 24px;
            margin: 0;
        }
        .supplier-header .status {
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
            border-left: 4px solid #f59e0b;
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
        
        .financial-summary {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        
        .financial-summary h3 {
            margin-bottom: 20px;
            font-size: 18px;
        }
        
        .financial-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }
        
        .financial-item {
            text-align: center;
            padding: 15px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
        }
        
        .financial-item .label {
            font-size: 12px;
            opacity: 0.9;
            margin-bottom: 8px;
            text-transform: uppercase;
        }
        
        .financial-item .amount {
            font-size: 24px;
            font-weight: bold;
        }
        
        .action-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        
        @media (max-width: 768px) {
            .supplier-header h2 { font-size: 20px; }
            .info-grid { grid-template-columns: 1fr; gap: 15px; }
            .financial-grid { grid-template-columns: 1fr; gap: 15px; }
            .financial-item .amount { font-size: 20px; }
            .info-card { padding: 15px; }
        }
    </style>

    <div class="supplier-header">
        <h2>
            <a href="{{ route('suppliers.ledger', $supplier->id) }}" style="color:inherit; text-decoration:none;">
                {{ $supplier->name }}
            </a>
        </h2>
        <div class="status">
            <span class="badge badge-success">{{ ucfirst($supplier->status) }}</span>
        </div>
    </div>

    <div class="card">
        <h3 style="margin-bottom: 20px; color: #f59e0b;">📋 Contact Information</h3>
        
        <div class="info-grid">
            <div class="info-card">
                <div class="info-label">📞 Phone Number</div>
                <div class="info-value">{{ $supplier->phone ?? 'Not provided' }}</div>
            </div>
            
            <div class="info-card">
                <div class="info-label">📧 Email Address</div>
                <div class="info-value">{{ $supplier->email ?? 'Not provided' }}</div>
            </div>
            
            <div class="info-card">
                <div class="info-label">📍 Address</div>
                <div class="info-value">{{ $supplier->address ?? 'Not provided' }}</div>
            </div>
        </div>
    </div>

    <div class="financial-summary">
        <h3>💰 Financial Summary</h3>
        <div class="financial-grid">
            <div class="financial-item">
                <div class="label">Total Purchases</div>
                <div class="amount">Rs {{ number_format($supplier->total_purchases) }}</div>
            </div>
            
            <div class="financial-item">
                <div class="label">Total Paid</div>
                <div class="amount">Rs {{ number_format($supplier->total_paid) }}</div>
            </div>
            
            <div class="financial-item">
                <div class="label">Balance Due</div>
                <div class="amount">Rs {{ number_format($supplier->balance) }}</div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="action-buttons">
            <a href="/suppliers/{{ $supplier->id }}/ledger" class="btn btn-primary">📒 View Ledger</a>
            <a href="/suppliers/{{ $supplier->id }}/edit" class="btn btn-success">✏️ Edit Supplier</a>
            <a href="/suppliers" class="btn btn-secondary">← Back to Suppliers</a>
        </div>
    </div>
</x-layout>
