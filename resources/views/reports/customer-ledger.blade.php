<x-layout title="📒 Customer Ledger - Al Nafi Travels">
    <x-page-header
        title="📒 Customer Ledger"
        icon="👥"
        backUrl="/reports"
    >
        <button onclick="window.print()" class="btn btn-success" style="background: #10b981; color: white; padding: 8px 18px; border: none; border-radius: 6px; cursor: pointer; font-weight: 600;">🖨️ Print Report</button>
    </x-page-header>

    <style>
        .print-header { display: none; }
        
        @media print {
            body { background: white; }
            header, nav, .page-header .btn, button { display: none !important; }
            .card { box-shadow: none; border: 1px solid #ddd; page-break-inside: avoid; }
            table { page-break-inside: auto; }
            tr { page-break-inside: avoid; page-break-after: auto; }
            thead { display: table-header-group; }
            th { background: #f0f0f0 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            @page { margin: 1cm; size: landscape; }
            .print-title { display: none !important; }
            
            .print-header { 
                display: flex !important; 
                justify-content: space-between; 
                align-items: center; 
                padding: 20px 0; 
                border-bottom: 3px solid #333; 
                margin-bottom: 30px; 
            }
            .print-header img { 
                height: 60px; 
                width: auto; 
            }
            .print-header .report-title { 
                font-size: 22px; 
                font-weight: bold; 
                color: #333; 
            }
        }
        .print-title { display: none; }
    </style>

    <div class="print-header">
        <img src="/images/alnafi.png" alt="Al Nafi Travels Logo">
        <div class="report-title">Customer Ledger Report</div>
    </div>

    <h1 class="print-title">📒 Customer Ledger Report - Al Nafi Travels</h1>

    <div class="card">
            <h2 style="margin-bottom: 20px;">All Customers Balance Summary</h2>
            <table>
                <thead>
                    <tr><th>Customer Name</th><th>Address</th><th>Total Income</th><th>Total Paid</th><th>Balance</th><th>Status</th></tr>
                </thead>
                <tbody>
                    @forelse($customers as $customer)
                    <tr>
                        <td><strong>{{ $customer->name }}</strong></td>
                        <td>{{ $customer->address ?? '-' }}</td>
                        <td>Rs {{ number_format($customer->total_income) }}</td>
                        <td class="positive">Rs {{ number_format($customer->total_paid) }}</td>
                        <td class="{{ $customer->balance > 0 ? 'negative' : ($customer->balance < 0 ? 'positive' : '') }}">
                            <strong>Rs {{ number_format(abs($customer->balance)) }}</strong>
                            @if($customer->balance > 0) (Receivable) @elseif($customer->balance < 0) (Advance) @endif
                        </td>
                        <td>{{ ucfirst($customer->status) }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="6" style="text-align: center; padding: 40px;">No customers found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
<script src="/js/mobile-menu.js"></script>
</x-layout>
