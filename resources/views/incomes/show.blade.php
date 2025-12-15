<x-layout title="Sale Details - FM Travel Manager" pageTitle="Sale Details"
    pageSubtitle="View sale transaction details">
    <x-slot:styles>
        .sale-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: var(--accent);
        padding: 24px;
        border-radius: 16px;
        margin-bottom: 20px;
        text-align: center;
        }

        .sale-header .date {
        font-size: 12px;
        opacity: 0.9;
        margin-bottom: 8px;
        }

        .sale-header .amount {
        font-size: 32px;
        font-weight: bold;
        margin-bottom: 10px;
        }

        .sale-header .badges {
        display: flex;
        justify-content: center;
        gap: 8px;
        }

        .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 15px;
        margin-bottom: 20px;
        }

        .info-card {
        background: #f9f5eb;
        padding: 16px;
        border-radius: 12px;
        border-left: 4px solid var(--primary);
        }

        .info-card.success { border-left-color: #2e7d32; }
        .info-card.warning { border-left-color: #f57c00; }
        .info-card.danger { border-left-color: #c62828; }

        .info-label {
        font-size: 10px;
        color: var(--text-light);
        text-transform: uppercase;
        font-weight: 600;
        margin-bottom: 6px;
        }

        .info-value {
        font-size: 14px;
        color: var(--text);
        font-weight: 600;
        }

        .info-value.success { color: #2e7d32; }
        .info-value.warning { color: #f57c00; }
        .info-value.danger { color: #c62828; }

        .section-title {
        font-size: 14px;
        font-weight: 600;
        color: var(--text);
        margin: 20px 0 15px;
        padding-bottom: 8px;
        border-bottom: 1px solid var(--border);
        }

        .desc-box {
        background: #f9f5eb;
        padding: 14px;
        border-radius: 10px;
        font-size: 13px;
        color: var(--text);
        margin-bottom: 20px;
        }
    </x-slot:styles>

    <div class="sale-header">
        <div class="date">📅 {{ $income->income_date->format('d M Y') }}</div>
        <div class="amount">Rs {{ number_format($income->amount) }}</div>
        <div class="badges">
            <span class="badge badge-info">{{ ucfirst($income->status) }}</span>
            @if($income->payment_status == 'paid')
                <span class="badge badge-success">✓ Paid</span>
            @elseif($income->payment_status == 'partial')
                <span class="badge badge-warning">◐ Partial</span>
            @else
                <span class="badge badge-danger">✗ Unpaid</span>
            @endif
        </div>
    </div>

    <div class="card">
        <h3 class="section-title">📋 Transaction Details</h3>
        <div class="info-grid">
            <div class="info-card">
                <div class="info-label">👤 Customer</div>
                <div class="info-value">
                    <a href="{{ route('customers.ledger', $income->customer->id) }}"
                        style="color: var(--primary-dark); text-decoration: none;">
                        {{ $income->customer->name }}
                    </a>
                </div>
            </div>
            <div class="info-card">
                <div class="info-label">📦 Item</div>
                <div class="info-value">{{ $income->item->name ?? 'N/A' }}</div>
            </div>
            <div class="info-card">
                <div class="info-label">🏷️ Reference</div>
                <div class="info-value">{{ $income->reference_no ?? 'N/A' }}</div>
            </div>
        </div>

        <h3 class="section-title">💰 Payment Information</h3>
        <div class="info-grid">
            <div class="info-card success">
                <div class="info-label">💵 Total</div>
                <div class="info-value success">Rs {{ number_format($income->amount) }}</div>
            </div>
            <div class="info-card">
                <div class="info-label">✓ Paid</div>
                <div class="info-value">Rs {{ number_format($income->paid_amount) }}</div>
            </div>
            <div class="info-card {{ $income->remaining_amount > 0 ? 'danger' : 'success' }}">
                <div class="info-label">📊 Remaining</div>
                <div class="info-value {{ $income->remaining_amount > 0 ? 'danger' : 'success' }}">
                    Rs {{ number_format($income->remaining_amount) }}
                </div>
            </div>
            <div class="info-card">
                <div class="info-label">🏷️ Status</div>
                <div class="info-value">
                    @if($income->payment_status == 'paid')
                        <span class="badge badge-success">✓ Paid</span>
                    @elseif($income->payment_status == 'partial')
                        <span class="badge badge-warning">◐ Partial</span>
                    @else
                        <span class="badge badge-danger">✗ Unpaid</span>
                    @endif
                </div>
            </div>
        </div>

        @if($income->description)
            <h3 class="section-title">📝 Description</h3>
            <div class="desc-box">{{ $income->description }}</div>
        @endif
    </div>

    <div class="card">
        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
            <a href="/incomes/{{ $income->id }}/edit" class="btn btn-success">✏️ Edit</a>
            <a href="/incomes" class="btn btn-secondary">← Back</a>
        </div>
    </div>
</x-layout>