<x-layout title="📕 Supplier Ledger - Al Nafi Travels">
    <x-page-header
        title="📕 Supplier Ledger"
        icon="🏢"
        backUrl="/reports"
    >
        <button onclick="window.print()" class="btn btn-success" style="background: #10b981; color: white; padding: 8px 18px; border: none; border-radius: 6px; cursor: pointer; font-weight: 600;">🖨️ Print Report</button>
    </x-page-header>

    <style>
        .print-header { display: none; }
        
        @media print {
            body { background: white; }
            header, nav, .page-header .btn, button { display: none !important; }
            .card { box-shadow: none; border: 1px solid #ddd; page-break-inside: avoid; padding: 16px; }
            table { page-break-inside: auto; font-size: 12px; }
            tr { page-break-inside: avoid; page-break-after: auto; }
            thead { display: table-header-group; }
            th { background: #f0f0f0 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; font-size: 0.72rem; padding: 10px 8px; }
            td { padding: 10px 8px; }
            @page { margin: 1cm; size: landscape; }
            .print-title { display: none !important; }
            
            .print-header { 
                display: flex !important; 
                justify-content: space-between; 
                align-items: flex-start; 
                gap: 20px;
                padding: 10px 0; 
                border-bottom: 2px solid #333; 
                margin-bottom: 16px; 
            }
            .print-header img { 
                height: 60px; 
                width: auto; 
            }
            .print-header .report-meta { 
                font-size: 12px; 
                color: #475569; 
                line-height: 1.4; 
            }
        }
        .print-title { display: none; }
    </style>

    <div class="print-header">
        <img src="/images/alnafi.png" alt="Al Nafi Travels Logo">
        <div style="flex:1;">
            <div class="report-title" style="font-size:22px; font-weight:700; color:#111827; margin:0;">Supplier Ledger Report</div>
            <div class="report-meta">
                <div>+92 312 544 6922</div>
                <div>alnafitravels24@gmail.com</div>
                <div>Office no C9, 3rd Floor, Abbas Khan Block, Ghafoor Market Charsadda, Pakistan</div>
            </div>
        </div>
    </div>

    <h1 class="print-title">📕 Supplier Ledger Report - Al Nafi Travels</h1>

    <div class="card">
            <h2 style="margin-bottom: 20px;">All Suppliers Balance Summary</h2>
            <table>
                <thead>
                    <tr><th>Supplier Name</th><th>Total Purchases</th><th>We Paid</th><th>Balance Due</th><th>Payment Status</th><th>Status</th><th>Action</th></tr>
                </thead>
                <tbody>
                    @forelse($suppliers as $supplier)
                    <tr>
                        <td>
                            <strong>
                                <a href="{{ route('suppliers.ledger', $supplier->id) }}" style="color:#4f46e5; text-decoration:none;">
                                    {{ $supplier->name }}
                                </a>
                            </strong>
                        </td>
                        <td class="negative">Rs {{ number_format($supplier->total_purchases) }}</td>
                        <td class="positive">Rs {{ number_format($supplier->total_paid) }}</td>
                        <td class="{{ $supplier->balance > 0 ? 'negative' : ($supplier->balance < 0 ? 'positive' : '') }}">
                            <strong>Rs {{ number_format(abs($supplier->balance)) }}</strong>
                            @if($supplier->balance > 0) (Payable) @elseif($supplier->balance < 0) (Advance) @endif
                        </td>
                        <td>
                            @php
                                $totalPurchases = $supplier->total_purchases;
                                $totalPaid = $supplier->total_paid;
                                if($totalPaid >= $totalPurchases && $totalPurchases > 0) {
                                    $paymentStatus = 'paid';
                                } elseif($totalPaid > 0 && $totalPaid < $totalPurchases) {
                                    $paymentStatus = 'partial';
                                } else {
                                    $paymentStatus = 'unpaid';
                                }
                            @endphp
                            @if($paymentStatus == 'paid')
                                <span style="background: #10b981; color: white; padding: 4px 10px; border-radius: 4px; font-size: 12px; font-weight: 600;">✓ Paid</span>
                            @elseif($paymentStatus == 'partial')
                                <span style="background: #f59e0b; color: white; padding: 4px 10px; border-radius: 4px; font-size: 12px; font-weight: 600;">◐ Partial</span>
                            @else
                                <span style="background: #ef4444; color: white; padding: 4px 10px; border-radius: 4px; font-size: 12px; font-weight: 600;">✗ Unpaid</span>
                            @endif
                        </td>
                        <td>{{ ucfirst($supplier->status) }}</td>
                        <td><a href="/suppliers/{{ $supplier->id }}/ledger" class="supplier-link">View Ledger →</a></td>
                    </tr>
                    @empty
                    <tr><td colspan="7" style="text-align: center; padding: 40px;">No suppliers found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
<script src="/js/mobile-menu.js"></script>
</x-layout>
