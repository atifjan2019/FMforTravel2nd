<x-layout title="Customer Ledger - FM Travel Manager" pageTitle="Customer Ledger"
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
        body { background: white; }
        header, nav, .page-header .btn, button, .no-print { display: none !important; }
        .card, .table-card { box-shadow: none; border: 1px solid #ddd; }
        .print-header {
        display: flex !important;
        justify-content: space-between;
        align-items: flex-start;
        padding: 10px 0;
        border-bottom: 2px solid #333;
        margin-bottom: 16px;
        }
        .print-header img { height: 60px; }
        @page { margin: 1cm; size: landscape; }
        }
    </x-slot:styles>

    <div class="print-header">
        <img src="/images/alnafi.png" alt="Logo">
        <div style="flex:1;">
            <div style="font-size:18px; font-weight:700;">Customer Ledger Report</div>
            <div style="font-size:11px; color:#666;">Generated: {{ now()->format('d M Y') }}</div>
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