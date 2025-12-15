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

        .print-only, .print-header, .print-footer { display: none; }

        @media print {
        body { background: white; -webkit-print-color-adjust: exact; }
        .no-print, .sidebar, .top-bar, .sale-header { display: none !important; }
        .print-only { display: block; }

        .print-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        border-bottom: 2px solid var(--primary);
        padding-bottom: 20px;
        }

        .print-footer {
        display: block;
        text-align: center;
        margin-top: 50px;
        padding-top: 20px;
        border-top: 1px solid #ddd;
        font-size: 12px;
        color: #666;
        }

        .main-content { margin: 0; padding: 0; }
        .card { box-shadow: none; border: none; padding: 0; }

        .info-grid { grid-template-columns: repeat(2, 1fr); gap: 20px; }
        .info-card { background: white; border: 1px solid #ddd; padding: 15px; }
        .section-title { font-size: 16px; margin-top: 30px; border-bottom: 2px solid #eee; }
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

    <!-- Print Header (Visible only on print) -->
    <div class="print-header">
        <div class="logo">
            <span style="font-size: 32px;">✈️</span>
            <div>
                <h1 style="margin: 0; font-size: 24px; color: var(--text);">FM Travel</h1>
                <p style="margin: 2px 0 0; font-size: 12px; color: var(--text-light);">Management System</p>
            </div>
        </div>
        <div class="invoice-details" style="text-align: right;">
            <h2 style="margin: 0 0 4px; font-size: 20px; color: var(--primary-dark);">INVOICE</h2>
            <p style="margin: 0; font-size: 12px; color: var(--text);">Date: {{ $income->income_date->format('d M Y') }}
            </p>
            <p style="margin: 0; font-size: 12px; color: var(--text);">Ref: {{ $income->reference_no ?? 'N/A' }}</p>
        </div>
    </div>

    <div class="card fit-print">
        <h3 class="section-title">📋 Transaction Details</h3>
        <div class="info-grid">
            <div class="info-card">
                <div class="info-label">👤 Customer</div>
                <div class="info-value">
                    <a href="{{ route('customers.ledger', $income->customer->id) }}"
                        style="color: var(--primary-dark); text-decoration: none;" class="no-print">
                        {{ $income->customer->name }}
                    </a>
                    <span class="print-only" style="font-size: 14px; color: #000;">{{ $income->customer->name }}</span>
                    <div class="print-only" style="font-size: 11px; margin-top: 4px; font-weight: normal;">
                        {{ $income->customer->phone }}<br>
                        {{ $income->customer->address }}
                    </div>
                </div>
            </div>
            <div class="info-card">
                <div class="info-label">📦 Item</div>
                <div class="info-value">{{ $income->item->name ?? 'N/A' }}</div>
            </div>
            <div class="info-card no-print">
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
            <div class="info-card no-print">
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

    <!-- Print Footer -->
    <div class="print-footer">
        <p>Thank you for your business!</p>
        <p style="font-size: 10px; margin-top: 5px; color: #999;">Generated by FM Travel Management System</p>
    </div>

    <div class="card no-print">
        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
            <a href="/incomes/{{ $income->id }}/edit" class="btn btn-success">✏️ Edit</a>
            <button onclick="window.print()" class="btn btn-primary">🖨️ Print</button>
            <a href="/incomes" class="btn btn-secondary">← Back</a>
        </div>
    </div>
</x-layout>