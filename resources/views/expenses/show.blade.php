<x-layout title="💸 Expense Details - Al Nafi Travels">
    <x-page-header
        title="💸 Expense Details"
        icon="💸"
        backUrl="/expenses"
    />

    <style>
        .expense-header {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
        }
        .expense-header .amount {
            font-size: 36px;
            font-weight: bold;
            margin: 10px 0;
        }
        .expense-header .date {
            font-size: 14px;
            opacity: 0.9;
        }
        .expense-header .status {
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
            border-left: 4px solid #ef4444;
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
            border-left: 4px solid #ef4444;
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
            .expense-header .amount { font-size: 28px; }
            .info-grid { grid-template-columns: 1fr; gap: 15px; }
            .info-card { padding: 15px; }
            .description-box { padding: 15px; }
        }
    </style>

    <div class="expense-header">
        <div class="date">📅 {{ $expense->expense_date->format('d M Y') }}</div>
        <div class="amount">Rs {{ number_format($expense->amount) }}</div>
        <div class="status">
            <span class="badge badge-success">{{ ucfirst($expense->status) }}</span>
        </div>
    </div>

    <div class="card">
        <h3 style="margin-bottom: 20px; color: #ef4444;">📋 Expense Details</h3>
        
        <div class="info-grid">
            <div class="info-card">
                <div class="info-label">📁 Category</div>
                <div class="info-value">{{ $expense->category }}</div>
            </div>
            
            <div class="info-card">
                <div class="info-label">🔖 Reference Number</div>
                <div class="info-value">{{ $expense->reference_no ?? 'Not provided' }}</div>
            </div>
        </div>
        
        @if($expense->description)
        <div class="description-box">
            <div class="label">📝 Description</div>
            <div class="text">{{ $expense->description }}</div>
        </div>
        @endif
    </div>

    <div class="card">
        <div class="action-buttons">
            <a href="/expenses/{{ $expense->id }}/edit" class="btn btn-success">✏️ Edit Expense</a>
            <a href="/expenses" class="btn btn-secondary">← Back to Expenses</a>
        </div>
    </div>
</x-layout>
