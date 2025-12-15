<x-layout title="Purchase Details - FM Travel Manager" pageTitle="Purchase Details"
    pageSubtitle="View purchase transaction details">
    <x-slot:styles>
        .purchase-header {
        background: linear-gradient(135deg, #5d4e37 0%, #8b7355 100%);
        color: white;
        padding: 24px;
        border-radius: 16px;
        margin-bottom: 20px;
        text-align: center;
        }

        .purchase-header .date { font-size: 12px; opacity: 0.9; margin-bottom: 8px; }
        .purchase-header .amount { font-size: 32px; font-weight: bold; margin-bottom: 10px; }
        .purchase-header .badges { display: flex; justify-content: center; gap: 8px; }

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
        border-left: 4px solid #8b7355;
        }

        .info-card.success { border-left-color: #2e7d32; }
        .info-card.danger { border-left-color: #c62828; }

        .info-label { font-size: 10px; color: var(--text-light); text-transform: uppercase; font-weight: 600;
        margin-bottom: 6px; }
        .info-value { font-size: 14px; color: var(--text); font-weight: 600; }
        .info-value.success { color: #2e7d32; }
        .info-value.danger { color: #c62828; }

        .section-title { font-size: 14px; font-weight: 600; color: var(--text); margin: 20px 0 15px; padding-bottom:
        8px; border-bottom: 1px solid var(--border); }

        .breakdown-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        background: linear-gradient(135deg, #8b7355 0%, #6b5b4a 100%);
        padding: 20px;
        border-radius: 14px;
        margin-bottom: 20px;
        }

        .breakdown-item { text-align: center; padding: 14px; background: rgba(255,255,255,0.15); border-radius: 10px;
        color: white; }
        .breakdown-item .label { font-size: 10px; opacity: 0.9; margin-bottom: 6px; text-transform: uppercase; }
        .breakdown-item .value { font-size: 18px; font-weight: bold; }

        @media (max-width: 640px) { .breakdown-grid { grid-template-columns: 1fr; } }

        .print-only, .print-header, .print-footer { display: none; }

        @media print {
        body { background: white; -webkit-print-color-adjust: exact; }
        .no-print, .sidebar, .top-bar, .purchase-header { display: none !important; }
        .print-only { display: block; }

        .print-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        border-bottom: 2px solid #8b7355;
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
        .breakdown-grid {
        background: white;
        border: 1px solid #ddd;
        color: #000;
        padding: 10px;
        }
        .breakdown-item {
        background: white;
        color: #000;
        border: 1px solid #eee;
        }
        .breakdown-item .value { color: #000; }

        .info-grid { grid-template-columns: repeat(2, 1fr); gap: 20px; }
        .info-card { background: white; border: 1px solid #ddd; padding: 15px; }
        .section-title { font-size: 16px; margin-top: 30px; border-bottom: 2px solid #eee; }
        }
    </x-slot:styles>

    <div class="purchase-header">
        <div class="date">📅 {{ $purchase->purchase_date->format('d M Y') }}</div>
        <div class="amount">Rs {{ number_format($purchase->total_amount) }}</div>
        <div class="badges">
            @if($purchase->payment_status == 'paid')
                <span class="badge badge-success">✓ Paid</span>
            @elseif($purchase->payment_status == 'partial')
                <span class="badge badge-warning">◐ Partial</span>
            @else
                <span class="badge badge-danger">✗ Unpaid</span>
            @endif
        </div>
    </div>

    <!-- Print Header -->
    <div class="print-header">
        <div class="logo">
            <span style="font-size: 32px;">✈️</span>
            <div>
                <h1 style="margin: 0; font-size: 24px; color: var(--text);">FM Travel</h1>
                <p style="margin: 2px 0 0; font-size: 12px; color: var(--text-light);">Management System</p>
            </div>
        </div>
        <div class="invoice-details" style="text-align: right;">
            <h2 style="margin: 0 0 4px; font-size: 20px; color: #8b7355;">PURCHASE</h2>
            <p style="margin: 0; font-size: 12px; color: var(--text);">Date:
                {{ $purchase->purchase_date->format('d M Y') }}
            </p>
            <p style="margin: 0; font-size: 12px; color: var(--text);">Ref: {{ $purchase->reference_no ?? 'N/A' }}</p>
        </div>
    </div>

    <div class="card fit-print">
        <h3 class="section-title">📋 Purchase Information</h3>
        <div class="info-grid">
            <div class="info-card">
                <div class="info-label">🏢 Supplier</div>
                <div class="info-value">
                    <a href="{{ route('suppliers.ledger', $purchase->supplier->id) }}"
                        style="color: var(--primary-dark);" class="no-print">{{ $purchase->supplier->name }}</a>
                    <span class="print-only"
                        style="font-size: 14px; color: #000;">{{ $purchase->supplier->name }}</span>
                    <div class="print-only" style="font-size: 11px; margin-top: 4px; font-weight: normal;">
                        {{ $purchase->supplier->phone }}<br>
                        {{ $purchase->supplier->address }}
                    </div>
                </div>
            </div>
            <div class="info-card">
                <div class="info-label">📦 Item</div>
                <div class="info-value">{{ $purchase->item->name }}</div>
            </div>
            <div class="info-card no-print">
                <div class="info-label">🏷️ Reference</div>
                <div class="info-value">{{ $purchase->reference_no ?? 'N/A' }}</div>
            </div>
        </div>
    </div>

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
            <div class="label">Total</div>
            <div class="value">Rs {{ number_format($purchase->total_amount) }}</div>
        </div>
    </div>

    <div class="card fit-print">
        <h3 class="section-title">💰 Payment Information</h3>
        <div class="info-grid">
            <div class="info-card success">
                <div class="info-label">✓ Paid</div>
                <div class="info-value success">Rs {{ number_format($purchase->paid_amount) }}</div>
            </div>
            <div class="info-card {{ $purchase->remaining_amount > 0 ? 'danger' : 'success' }}">
                <div class="info-label">📊 Remaining</div>
                <div class="info-value {{ $purchase->remaining_amount > 0 ? 'danger' : 'success' }}">Rs
                    {{ number_format($purchase->remaining_amount) }}
                </div>
            </div>
            <div class="info-card no-print">
                <div class="info-label">🏷️ Status</div>
                <div class="info-value">
                    @if($purchase->payment_status == 'paid')
                        <span class="badge badge-success">✓ Paid</span>
                    @elseif($purchase->payment_status == 'partial')
                        <span class="badge badge-warning">◐ Partial</span>
                    @else
                        <span class="badge badge-danger">✗ Unpaid</span>
                    @endif
                </div>
            </div>
        </div>

        @if($purchase->notes)
            <h3 class="section-title">📝 Notes</h3>
            <div style="background: #f9f5eb; padding: 14px; border-radius: 10px; font-size: 13px;">{{ $purchase->notes }}
            </div>
        @endif
    </div>

    <!-- Print Footer -->
    <div class="print-footer">
        <p>Authorized Signature</p>
        <div style="height: 40px; border-bottom: 1px solid #000; width: 200px; margin: 0 auto;"></div>
        <p style="font-size: 10px; margin-top: 15px; color: #999;">Generated by FM Travel Management System</p>
    </div>

    <div class="card no-print">
        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
            <a href="/purchases/{{ $purchase->id }}/edit" class="btn btn-success">✏️ Edit</a>
            <button onclick="window.print()" class="btn btn-primary">🖨️ Print</button>
            <a href="/purchases" class="btn btn-secondary">← Back</a>
        </div>
    </div>
</x-layout>