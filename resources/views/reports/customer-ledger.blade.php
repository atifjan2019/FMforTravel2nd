<x-layout title="Customer Ledger - Al Nafi Travels" pageTitle="Customer Ledger"
    pageSubtitle="Receivables tracking and customer balances">
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
        .customer-link { color: var(--primary-dark); text-decoration: none; font-weight: 600; }
        .customer-link:hover { text-decoration: underline; }

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
            <h2>Customer Balances Report</h2>
            <p>Generated: {{ now()->format('d M Y') }}</p>
        </div>
    </div>

    <div style="display: flex; gap: 10px; margin-bottom: 18px; flex-wrap: wrap;">
        <button onclick="window.print()" class="btn btn-success no-print">🖨️ Print Report</button>
        <a href="/reports" class="btn btn-secondary no-print">← Back</a>
    </div>

    <div class="table-card">
        <div class="section-title">👥 All Customers Balance Summary</div>
        <table>
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Address</th>
                    <th>Total Sales</th>
                    <th>Paid</th>
                    <th>Balance</th>
                    <th>Payment Status</th>
                    <th class="no-print">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($customers as $customer)
                    @php
                        $totalIncome = $customer->total_income;
                        $totalPaid = $customer->total_paid;
                        if ($totalPaid >= $totalIncome && $totalIncome > 0) {
                            $paymentStatus = 'paid';
                        } elseif ($totalPaid > 0 && $totalPaid < $totalIncome) {
                            $paymentStatus = 'partial';
                        } else {
                            $paymentStatus = 'unpaid';
                        }
                    @endphp
                    <tr>
                        <td>
                            <a href="{{ route('customers.ledger', $customer->id) }}"
                                class="customer-link">{{ $customer->name }}</a>
                        </td>
                        <td>{{ $customer->address ?? '-' }}</td>
                        <td>Rs {{ number_format($customer->total_income) }}</td>
                        <td class="positive">Rs {{ number_format($customer->total_paid) }}</td>
                        <td class="{{ $customer->balance > 0 ? 'negative' : ($customer->balance < 0 ? 'positive' : '') }}">
                            <strong>Rs {{ number_format(abs($customer->balance)) }}</strong>
                            @if($customer->balance > 0) (Receivable) @elseif($customer->balance < 0) (Advance) @endif
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
                        <td class="no-print">
                            <a href="/customers/{{ $customer->id }}/ledger" class="btn btn-primary btn-sm">📋 Ledger</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 40px;">No customers found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layout>