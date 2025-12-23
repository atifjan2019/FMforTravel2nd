<x-layout title="Supplier Ledger - Al Nafi Travels" pageTitle="Supplier Ledger"
    pageSubtitle="Payables tracking and supplier balances">
    <x-slot:styles>
        .print-header { display: none; }

        .table-card {
        background: var(--card-bg);
        border-radius: 14px;
        padding: 18px;
        box-shadow: var(--shadow);
        margin-bottom: 20px;
        overflow-x: auto;
        }

        .section-title { font-size: 14px; font-weight: 600; color: var(--text); margin-bottom: 14px; }

        table { width: 100%; border-collapse: collapse; font-size: 12px; }
        th, td { padding: 10px 12px; text-align: left; border-bottom: 1px solid var(--border); }
        th { background: #f9f5eb; font-weight: 600; font-size: 10px; color: var(--text-light); text-transform:
        uppercase; }
        .positive { color: #2e7d32; font-weight: 600; }
        .negative { color: #c62828; font-weight: 600; }
        .supplier-link { color: var(--primary-dark); text-decoration: none; font-weight: 600; }
        .supplier-link:hover { text-decoration: underline; }

        @media print {
        @page { margin: 1cm; size: landscape; }
        body { background: white !important; color: black !important; }
        .no-print, .sidebar, .top-bar, .actions, .btn { display: none !important; }
        .app-container { display: block !important; margin: 0 !important; }
        .main-content { margin: 0 !important; padding: 0 !important; width: 100% !important; }
        .card, .table-card { box-shadow: none !important; border: 1px solid #eee !important; padding: 10px !important;
        margin-bottom: 20px !important; break-inside: avoid; }

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
        !important; }
        .document-info p { margin: 0; font-size: 12px; color: #333 !important; }

        /* Table Improvements */
        table { width: 100% !important; border-collapse: collapse !important; font-size: 9pt !important; }
        th { background: #f8f8f8 !important; color: black !important; font-weight: bold !important; border-bottom: 2px
        solid #000 !important; padding: 8px !important; }
        td { border-bottom: 1px solid #ddd !important; padding: 8px !important; color: black !important; }
        tr:last-child td { border-bottom: none !important; }
        }
    </x-slot:styles>

    <div class="print-header">
        <div class="company-branding">
            <div class="company-logo">✈️</div>
            <div class="company-info">
                <h1>Al Nafi Travels</h1>
                <p>Management System</p>
            </div>
        </div>
        <div class="document-info">
            <h2>Supplier Balances Report</h2>
            <p>Generated: {{ now()->format('d M Y') }}</p>
        </div>
    </div>

    <div style="display: flex; gap: 10px; margin-bottom: 18px; flex-wrap: wrap;">
        <button onclick="window.print()" class="btn btn-success no-print">🖨️ Print Report</button>
        <a href="/reports" class="btn btn-secondary no-print">← Back</a>
    </div>

    <div class="table-card">
        <div class="section-title">🏢 All Suppliers Balance Summary</div>
        <table>
            <thead>
                <tr>
                    <th>Supplier</th>
                    <th>Total Purchases</th>
                    <th>We Paid</th>
                    <th>Balance</th>
                    <th>Payment Status</th>
                    <th>Status</th>
                    <th class="no-print">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($suppliers as $supplier)
                    @php
                        $totalPurchases = $supplier->total_purchases;
                        $totalPaid = $supplier->total_paid;
                        if ($totalPaid >= $totalPurchases && $totalPurchases > 0) {
                            $paymentStatus = 'paid';
                        } elseif ($totalPaid > 0 && $totalPaid < $totalPurchases) {
                            $paymentStatus = 'partial';
                        } else {
                            $paymentStatus = 'unpaid';
                        }
                    @endphp
                    <tr>
                        <td>
                            <a href="{{ route('suppliers.ledger', $supplier->id) }}"
                                class="supplier-link">{{ $supplier->name }}</a>
                        </td>
                        <td class="negative">Rs {{ number_format($supplier->total_purchases) }}</td>
                        <td class="positive">Rs {{ number_format($supplier->total_paid) }}</td>
                        <td class="{{ $supplier->balance > 0 ? 'negative' : ($supplier->balance < 0 ? 'positive' : '') }}">
                            <strong>Rs {{ number_format(abs($supplier->balance)) }}</strong>
                            @if($supplier->balance > 0) (Payable) @elseif($supplier->balance < 0) (Advance) @endif
                        </td>
                        <td>
                            @if($paymentStatus == 'paid')
                                <span class="badge badge-success">✓ Paid</span>
                            @elseif($paymentStatus == 'partial')
                                <span class="badge badge-warning">◐ Partial</span>
                            @else
                                <span class="badge badge-danger">✗ Unpaid</span>
                            @endif
                        </td>
                        <td>{{ ucfirst($supplier->status) }}</td>
                        <td class="no-print">
                            <a href="/suppliers/{{ $supplier->id }}/ledger" class="btn btn-primary btn-sm">📋 Ledger</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 40px;">No suppliers found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layout>