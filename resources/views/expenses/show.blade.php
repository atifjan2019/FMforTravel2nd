<x-layout title="Expense Details - FM Travel Manager" pageTitle="Expense Details"
    pageSubtitle="View expense transaction details">
    <x-slot:styles>
        .expense-header {
        background: linear-gradient(135deg, var(--accent) 0%, #3d3d3d 100%);
        color: white;
        padding: 24px;
        border-radius: 16px;
        margin-bottom: 20px;
        text-align: center;
        }

        .expense-header .date { font-size: 12px; opacity: 0.9; margin-bottom: 8px; }
        .expense-header .amount { font-size: 32px; font-weight: bold; margin-bottom: 10px; color: #ef5350; }
        .expense-header .category { font-size: 14px; opacity: 0.9; }

        .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-bottom: 20px;
        }

        .info-card {
        background: #f9f5eb;
        padding: 16px;
        border-radius: 12px;
        border-left: 4px solid var(--accent);
        }

        .info-label { font-size: 10px; color: var(--text-light); text-transform: uppercase; font-weight: 600;
        margin-bottom: 6px; }
        .info-value { font-size: 14px; color: var(--text); font-weight: 600; }

        .desc-box {
        background: #f9f5eb;
        padding: 14px;
        border-radius: 10px;
        font-size: 13px;
        color: var(--text);
        }
    </x-slot:styles>

    <div class="expense-header">
        <div class="date">📅 {{ $expense->expense_date->format('d M Y') }}</div>
        <div class="amount">-Rs {{ number_format($expense->amount) }}</div>
        <div class="category">
            {{ $expense->category }} •
            <span
                class="badge {{ $expense->status == 'paid' ? 'badge-success' : ($expense->status == 'pending' ? 'badge-warning' : 'badge-danger') }}">
                {{ ucfirst($expense->status) }}
            </span>
        </div>
    </div>

    <div class="card">
        <h3 class="card-title" style="margin-bottom: 16px;">📋 Expense Details</h3>
        <div class="info-grid">
            <div class="info-card">
                <div class="info-label">📁 Category</div>
                <div class="info-value">{{ $expense->category }}</div>
            </div>
            <div class="info-card">
                <div class="info-label">🏷️ Reference</div>
                <div class="info-value">{{ $expense->reference_no ?? 'N/A' }}</div>
            </div>
            <div class="info-card">
                <div class="info-label">📅 Date</div>
                <div class="info-value">{{ $expense->expense_date->format('d M Y') }}</div>
            </div>
        </div>

        @if($expense->description)
            <h3 class="card-title" style="margin: 20px 0 12px;">📝 Description</h3>
            <div class="desc-box">{{ $expense->description }}</div>
        @endif
    </div>

    <div class="card">
        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
            <a href="/expenses/{{ $expense->id }}/edit" class="btn btn-success">✏️ Edit</a>
            <a href="/expenses" class="btn btn-secondary">← Back</a>
        </div>
    </div>
</x-layout>