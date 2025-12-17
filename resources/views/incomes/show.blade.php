<x-layout title="Sale Details - FM Travel Manager" pageTitle="Sale Details"
    pageSubtitle="View sale transaction details for Item: {{ $income->item->name ?? 'BS' }}">

    <x-slot:styles>
        /* Polished Invoice Card */
        .invoice-box {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        border: 1px solid #e5e7eb;
        max-width: 900px;
        margin: 0 auto;
        overflow: hidden;
        }

        /* Header Section */
        .invoice-header {
        padding: 40px;
        border-bottom: 2px solid #f3f4f6;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        }

        .company-brand h1 {
        font-size: 28px;
        font-weight: 800;
        color: var(--primary-dark); /* Golden/Brown Theme */
        margin-bottom: 8px;
        letter-spacing: -0.5px;
        }

        .company-brand .subtitle {
        font-size: 14px;
        color: #6b7280;
        font-weight: 500;
        }

        .invoice-details {
        text-align: right;
        }

        .invoice-title {
        font-size: 16px;
        font-weight: 700;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 10px;
        }

        .invoice-meta p {
        font-size: 14px;
        color: #374151;
        margin-bottom: 4px;
        }

        /* Content Body */
        .invoice-body {
        padding: 40px;
        }

        .client-section {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        margin-bottom: 50px;
        }

        .info-col h3 {
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        color: #9ca3af;
        letter-spacing: 1px;
        margin-bottom: 15px;
        }

        .info-col h4 {
        font-size: 18px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 8px;
        }

        .info-col p {
        font-size: 14px;
        color: #4b5563;
        line-height: 1.6;
        }

        /* Stats Bar */
        .stats-bar {
        background: #f9fafb;
        border-radius: 12px;
        padding: 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border: 1px solid #e5e7eb;
        }

        .stat-item {
        text-align: center;
        }

        .stat-item .label {
        font-size: 11px;
        text-transform: uppercase;
        font-weight: 600;
        color: #6b7280;
        margin-bottom: 6px;
        }

        .stat-item .value {
        font-size: 22px;
        font-weight: 700;
        color: #111827;
        }

        .stat-item.total .value { color: #2563eb; }
        .stat-item.paid .value { color: #059669; }
        .stat-item.due .value { color: #dc2626; }

        /* Notes Area */
        .notes-area {
        margin-top: 40px;
        padding-top: 30px;
        border-top: 1px solid #f3f4f6;
        }

        .notes-area h3 {
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 10px;
        }

        .notes-content {
        font-size: 14px;
        color: #6b7280;
        background: #ffffff;
        padding: 15px;
        border-left: 3px solid #d1d5db;
        }

        /* Action Footer */
        .invoice-footer-actions {
        margin-top: 30px;
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        }

        /* Print Override */
        @media print {
        @page { margin: 1cm; size: A4; }
        body {
        background: white !important;
        -webkit-print-color-adjust: exact !important;
        }
        .sidebar, .top-bar, .invoice-footer-actions, .no-print { display: none !important; }
        .app-container { display: block !important; margin: 0 !important; }
        .main-content { padding: 0 !important; }

        .invoice-box {
        box-shadow: none !important;
        border: none !important;
        max-width: 100% !important;
        }
        .stats-bar {
        background-color: #f9fafb !important;
        border: 1px solid #eee !important;
        }
        }
        .print-logo { display: none; }
        @media print { .print-logo { display: block; margin-bottom: 10px; height: 60px; } }
    </x-slot:styles>

    <div class="invoice-box">
        <!-- Header -->
        <div class="invoice-header">
            <div class="company-brand">
                <img src="/images/alnafi.png" alt="Logo" class="print-logo">
                <h1 class="no-print">INVOICE</h1>
                <div class="subtitle">FM Travel Management System</div>
            </div>
            <div class="invoice-details">
                <div class="invoice-title">#{{ $income->reference_no ?? $income->id }}</div>
                <div class="invoice-meta">
                    <p>Date: <strong>{{ $income->income_date->format('d M Y') }}</strong></p>
                    <p>Status:
                        <span style="
                            display: inline-block; 
                            background: {{ $income->payment_status == 'paid' ? '#d1fae5' : ($income->payment_status == 'partial' ? '#fef3c7' : '#fee2e2') }};
                            color: {{ $income->payment_status == 'paid' ? '#065f46' : ($income->payment_status == 'partial' ? '#92400e' : '#991b1b') }};
                            padding: 2px 8px; 
                            border-radius: 4px; 
                            font-size: 12px; 
                            font-weight: 600;">
                            {{ ucfirst($income->payment_status) }}
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Body -->
        <div class="invoice-body">

            <div class="client-section">
                <!-- Bill To -->
                <div class="info-col">
                    <h3>Bill To</h3>
                    <h4>{{ $income->customer->name }}</h4>
                    <p>{{ $income->customer->phone ?? 'No Phone' }}</p>
                    <p>{{ $income->customer->address ?? '' }}</p>
                </div>

                <!-- Service Info -->
                <div class="info-col" style="text-align: right;">
                    <h3>Service Details</h3>
                    <h4>{{ $income->item->name ?? 'General Service' }}</h4>
                    <p>Agent: {{ auth()->user()->name ?? 'Admin' }}</p>
                    <p class="no-print">Generated: {{ now()->format('d M Y') }}</p>
                </div>
            </div>

            <!-- Financials Bar -->
            <div class="stats-bar">
                <div class="stat-item total">
                    <div class="label">Total Amount</div>
                    <div class="value">Rs {{ number_format($income->amount) }}</div>
                </div>
                <div class="stat-item paid">
                    <div class="label">Amount Paid</div>
                    <div class="value">Rs {{ number_format($income->paid_amount) }}</div>
                </div>
                <div class="stat-item due">
                    <div class="label">Balance Due</div>
                    <div class="value">Rs {{ number_format($income->remaining_amount) }}</div>
                </div>
            </div>

            @if($income->description)
                <div class="notes-area">
                    <h3>Notes</h3>
                    <div class="notes-content">
                        {{ $income->description }}
                    </div>
                </div>
            @endif

        </div>
    </div>

    <!-- Actions -->
    <div class="invoice-footer-actions no-print">
        <a href="{{ route('customers.ledger', $income->customer->id) }}" class="btn btn-secondary">
            ← Back to Ledger
        </a>
        <a href="/incomes/{{ $income->id }}/payment-history" class="btn btn-success">
            💰 View Payments
        </a>
        <button onclick="window.print()" class="btn btn-primary">
            🖨️ Print Invoice
        </button>
    </div>

</x-layout>