<x-layout title="Sale Details - FM Travel Manager" pageTitle="Sale Details"
    pageSubtitle="View sale transaction details for Item: {{ $income->item->name ?? 'BS' }}">

    <x-slot:styles>
        .invoice-card {
        background: white;
        border-radius: 16px;
        box-shadow: var(--shadow);
        border: 1px solid var(--border);
        overflow: hidden;
        margin-bottom: 24px;
        }

        .invoice-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: var(--accent);
        padding: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        }

        .invoice-brand h1 {
        font-size: 24px;
        font-weight: 800;
        margin-bottom: 5px;
        display: flex;
        align-items: center;
        gap: 10px;
        }

        .invoice-brand p {
        opacity: 0.9;
        font-size: 13px;
        }

        .invoice-meta {
        text-align: right;
        }

        .invoice-meta .status {
        display: inline-block;
        background: rgba(255,255,255,0.2);
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 8px;
        backdrop-filter: blur(4px);
        }

        .invoice-meta .ref {
        font-size: 14px;
        font-weight: 500;
        }

        .invoice-body {
        padding: 30px;
        }

        .client-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 40px;
        margin-bottom: 40px;
        border-bottom: 1px solid var(--border);
        padding-bottom: 30px;
        }

        .client-col h3 {
        font-size: 12px;
        text-transform: uppercase;
        color: var(--text-light);
        margin-bottom: 15px;
        font-weight: 700;
        letter-spacing: 0.5px;
        }

        .client-info h4 {
        font-size: 18px;
        color: var(--text);
        font-weight: 700;
        margin-bottom: 5px;
        }

        .client-info p {
        font-size: 14px;
        color: var(--text-light);
        line-height: 1.5;
        }

        .summary-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 20px;
        background: var(--bg);
        padding: 20px;
        border-radius: 12px;
        }

        .summary-item .label {
        font-size: 11px;
        text-transform: uppercase;
        color: var(--text-light);
        margin-bottom: 5px;
        }

        .summary-item .value {
        font-size: 20px;
        font-weight: 700;
        color: var(--text);
        }

        .summary-item.total .value { color: var(--primary-dark); }
        .summary-item.paid .value { color: #10b981; }
        .summary-item.due .value { color: #ef4444; }

        .desc-section {
        margin-top: 30px;
        }

        .desc-section h3 {
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 10px;
        }

        .desc-box {
        background: #f9fafb;
        padding: 15px;
        border-radius: 8px;
        font-size: 14px;
        color: var(--text);
        border: 1px solid var(--border);
        }

        .action-bar {
        padding: 20px 30px;
        background: #f9fafb;
        border-top: 1px solid var(--border);
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        }

        /* Print Styles */
        @media print {
        @page { margin: 1cm; size: A4; }
        body {
        background: white !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
        font-family: sans-serif;
        }
        .no-print, .sidebar, .top-bar, .actions, .btn, .action-bar, .invoice-header { display: none !important; }
        .app-container { display: block !important; margin: 0 !important; }
        .main-content { margin: 0 !important; padding: 0 !important; width: 100% !important; }

        .invoice-card {
        box-shadow: none !important;
        border: none !important;
        padding: 0 !important;
        margin: 0 !important;
        border-radius: 0 !important;
        }

        .invoice-body { padding: 0 !important; }

        /* Header */
        .print-header {
        display: flex !important;
        justify-content: space-between;
        align-items: center;
        border-bottom: 3px solid #b8860b;
        padding-bottom: 20px;
        margin-bottom: 40px;
        }
        .document-info { text-align: right; }

        /* Client Grid */
        .client-grid {
        border-bottom: none !important;
        margin-bottom: 30px !important;
        padding-bottom: 0 !important;
        }

        /* Summary Grid - Colorful & Clean */
        .summary-grid {
        background: transparent !important;
        padding: 0 !important;
        display: flex !important;
        justify-content: flex-end !important;
        gap: 50px !important;
        border: none !important;
        margin-top: 20px !important;
        }

        .summary-item { text-align: right !important; }

        .summary-item .label {
        font-size: 11px;
        color: #666;
        margin-bottom: 4px;
        }

        .summary-item .value { font-size: 24px; }

        .summary-item.total .value { color: #3b82f6 !important; }
        .summary-item.paid .value { color: #10b981 !important; }
        .summary-item.due .value { color: #ef4444 !important; }

        .desc-box {
        border: none !important;
        background: transparent !important;
        padding: 0 !important;
        margin-top: 10px !important;
        }

        .print-footer {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        text-align: center;
        border-top: 1px solid #ddd;
        padding-top: 10px;
        font-size: 10px;
        color: #888;
        display: block !important;
        }
        }
        .print-header, .print-footer { display: none; }
    </x-slot:styles>

    <!-- Print Header -->
    <div class="print-header">
        <div class="company-branding">
            <img src="/images/alnafi.png" alt="Al Nafi Travels" style="height: 80px; width: auto;">
        </div>
        <div class="document-info">
            <h2 style="font-size: 24px; font-weight: 800; color: #b8860b; margin-bottom: 5px;">INVOICE</h2>
            <p><strong>Ref:</strong> {{ $income->reference_no ?? 'N/A' }}</p>
            <p><strong>Date:</strong> {{ $income->income_date->format('d M Y') }}</p>
        </div>
    </div>

    <div class="invoice-card">
        <!-- Screen Header -->
        <div class="invoice-header no-print">
            <div class="invoice-brand">
                <h1>{{ $income->item->name ?? 'Service' }}</h1>
                <p>Transaction ID: {{ $income->id }}</p>
            </div>
            <div class="invoice-meta">
                <span class="status">
                    {{ ucfirst($income->status) }}
                    @if($income->payment_status == 'paid') • Paid
                    @elseif($income->payment_status == 'partial') • Partial
                    @else • Unpaid @endif
                </span>
                <div class="ref">Ref: {{ $income->reference_no ?? 'N/A' }}</div>
            </div>
        </div>

        <div class="invoice-body">
            <!-- Client & Company Info Grid -->
            <div class="client-grid">
                <div class="client-col">
                    <h3>Bill To</h3>
                    <div class="client-info">
                        <h4>{{ $income->customer->name }}</h4>
                        <p>{{ $income->customer->phone ?? 'No Phone' }}</p>
                        <p>{{ $income->customer->address ?? '' }}</p>
                    </div>
                </div>
                <div class="client-col">
                    <h3>Service Details</h3>
                    <div class="client-info">
                        <h4>{{ $income->item->name ?? 'General Service' }}</h4>
                        <p>Date: {{ $income->income_date->format('d M Y') }}</p>
                        <p>Agent: {{ auth()->user()->name ?? 'Admin' }}</p>
                    </div>
                </div>
            </div>

            <!-- Financial Summary -->
            <div class="summary-grid">
                <div class="summary-item total">
                    <div class="label">Total Amount</div>
                    <div class="value">Rs {{ number_format($income->amount) }}</div>
                </div>
                <div class="summary-item paid">
                    <div class="label">Amount Paid</div>
                    <div class="value">Rs {{ number_format($income->paid_amount) }}</div>
                </div>
                <div class="summary-item due">
                    <div class="label">Balance Due</div>
                    <div class="value">Rs {{ number_format($income->remaining_amount) }}</div>
                </div>
            </div>

            @if($income->description)
                <div class="desc-section">
                    <h3>Description / Notes</h3>
                    <div class="desc-box">
                        {{ $income->description }}
                    </div>
                </div>
            @endif
        </div>

        <!-- Action Bar -->
        <div class="action-bar no-print">
            <a href="{{ route('customers.ledger', $income->customer->id) }}" class="btn btn-secondary">← Back to
                Ledger</a>
            <a href="/incomes/{{ $income->id }}/edit" class="btn btn-secondary">✏️ Edit</a>
            <a href="/incomes/{{ $income->id }}/payment-history" class="btn btn-success">💰 Payments</a>
            <button onclick="window.print()" class="btn btn-primary">🖨️ Print Invoice</button>
        </div>
    </div>

    <!-- Print Footer -->
    <div class="print-footer">
        <p>Thank you for choosing Al Nafi Travels!</p>
        <p>This is a computer-generated document and does not require a signature.</p>
    </div>
</x-layout>