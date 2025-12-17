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
        @page { margin: 1cm; size: A4; }
        body { background: white !important; color: black !important; }
        .no-print, .sidebar, .top-bar, .actions, .btn, .sale-header { display: none !important; }
        .app-container { display: block !important; margin: 0 !important; }
        .main-content { margin: 0 !important; padding: 0 !important; width: 100% !important; }
        .card {
        box-shadow: none !important;
        border: 1px solid #eee !important;
        padding: 0 !important;
        margin-bottom: 20px !important;
        break-inside: avoid;
        background: white !important;
        }

        /* Header Visibility */
        .print-header {
        display: flex !important;
        justify-content: space-between;
        align-items: center;
        border-bottom: 2px solid #000;
        padding-bottom: 15px;
        margin-bottom: 25px;
        }
        .company-branding { display: flex; align-items: center; gap: 15px; }
        .company-logo { font-size: 32px; }
        .company-info h1 { margin: 0; font-size: 24px; font-weight: bold; color: black !important; letter-spacing: 1px;
        }
        .company-info p { margin: 2px 0 0; font-size: 11px; color: #555 !important; text-transform: uppercase;
        letter-spacing: 2px;}
        .document-info { text-align: right; }
        .document-info h2 { margin: 0 0 5px; font-size: 18px; font-weight: bold; text-transform: uppercase; color: black
        !important; padding: 5px 10px; border: 2px solid #000; display: inline-block;}
        .document-info p { margin: 4px 0 0; font-size: 12px; color: #333 !important; }

        .info-grid { grid-template-columns: repeat(2, 1fr) !important; gap: 20px !important; margin-bottom: 20px
        !important; }
        .info-card { background: white !important; border: 1px solid #ddd !important; padding: 15px !important; }
        .section-title { font-size: 14px !important; margin-top: 20px !important; border-bottom: 1px solid #000
        !important; margin-bottom: 15px !important; }

        .print-footer {
        display: block;
        text-align: center;
        margin-top: 50px;
        padding-top: 10px;
        border-top: 1px solid #000;
        font-size: 10px;
        }
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
        <div class="company-branding">
            <div class="company-logo">✈️</div>
            <div class="company-info">
                <h1>FM Travel</h1>
                <p>Management System</p>
            </div>
        </div>
        <div class="document-info">
            <h2>INVOICE</h2>
            <p><strong>Ref:</strong> {{ $income->reference_no ?? 'N/A' }}</p>
            <p><strong>Date:</strong> {{ $income->income_date->format('d M Y') }}</p>
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