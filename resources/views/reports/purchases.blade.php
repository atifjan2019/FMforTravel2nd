<x-layout title="🛒 Purchases Report - Al Nafi Travels">
    <x-page-header
        title="🛒 Purchases Report"
        icon="🛒"
        backUrl="/reports"
    />


    <style>
        .report-section { display: flex; flex-wrap: wrap; gap: 24px; margin-bottom: 32px; }
        .report-card-metric { flex: 1 1 220px; min-width: 220px; background: #fff; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); padding: 28px 24px 20px 24px; display: flex; flex-direction: column; align-items: flex-start; position: relative; }
        .report-card-metric .metric-label { font-size: 15px; color: #888; margin-bottom: 8px; font-weight: 500; }
        .report-card-metric .metric-value { font-size: 2.1rem; font-weight: 700; margin-bottom: 0; }
        .report-card-metric.purchases { border-left: 6px solid #ef4444; }
        .report-card-metric.transactions { border-left: 6px solid #6366f1; }
        .report-card-metric.average { border-left: 6px solid #f59e0b; }
        .report-card-metric .metric-icon { font-size: 2.2rem; position: absolute; top: 18px; right: 18px; opacity: 0.13; }
        .report-section-title { font-size: 1.2rem; font-weight: 600; color: #333; margin-bottom: 18px; margin-top: 10px; }
        .report-table-card { background: #fff; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); padding: 28px 24px 20px 24px; margin-bottom: 32px; }
        .report-table-card table { width: 100%; border-collapse: collapse; }
        .report-table-card th, .report-table-card td { padding: 12px 10px; border-bottom: 1px solid #f1f1f1; text-align: left; }
        .report-table-card th { background: #f8fafc; color: #667eea; font-weight: 700; font-size: 15px; }
        .report-table-card td.purchases { color: #ef4444; font-weight: 600; }
        .report-table-card td { font-size: 15px; }
        @media (max-width: 900px) { .report-section { flex-direction: column; gap: 18px; } .report-card-metric { min-width: 0; width: 100%; } }
        @media (max-width: 600px) { .report-table-card { padding: 12px 4px; } .report-card-metric { padding: 18px 10px; } }
    </style>

    <div class="report-section">
        <div class="report-card-metric purchases">
            <span class="metric-label">Total Purchases (This Month)</span>
            <span class="metric-value">Rs {{ number_format($currentMonthPurchases) }}</span>
            <span class="metric-icon">🛒</span>
        </div>
        <div class="report-card-metric transactions">
            <span class="metric-label">Total Transactions (This Month)</span>
            <span class="metric-value">{{ $currentMonthTransactions }}</span>
            <span class="metric-icon">🧾</span>
        </div>
        <div class="report-card-metric average">
            <span class="metric-label">Average Purchase (This Month)</span>
            <span class="metric-value">Rs {{ number_format($currentMonthAveragePurchase) }}</span>
            <span class="metric-icon">📊</span>
        </div>
    </div>

    <div class="report-table-card">
        <div class="report-section-title">Monthly Purchases</div>
        <table>
            <thead>
                <tr><th>Month</th><th>Transactions</th><th>Total Purchases</th><th>Average</th></tr>
            </thead>
            <tbody>
                @foreach($monthlyPurchases as $purchase)
                <tr>
                    <td><strong>{{ $purchase['month'] }}</strong></td>
                    <td>{{ $purchase['count'] }}</td>
                    <td class="purchases">Rs {{ number_format($purchase['total']) }}</td>
                    <td>Rs {{ number_format($purchase['average']) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="report-table-card">
        <div class="report-section-title">Purchases by Item</div>
        <table>
            <thead>
                <tr><th>Item</th><th>Quantity</th><th>Total Amount</th></tr>
            </thead>
            <tbody>
                @foreach($purchasesByItem as $item)
                <tr>
                    <td><strong>{{ $item->item_name }}</strong></td>
                    <td>{{ $item->quantity }}</td>
                    <td class="purchases">Rs {{ number_format($item->total) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="report-table-card">
        <div class="report-section-title">Top Suppliers</div>
        <table>
            <thead>
                <tr><th>Supplier</th><th>Transactions</th><th>Total Amount</th></tr>
            </thead>
            <tbody>
                @foreach($topSuppliers as $supplier)
                <tr>
                    <td><strong>{{ $supplier->supplier_name }}</strong></td>
                    <td>{{ $supplier->count }}</td>
                    <td class="purchases">Rs {{ number_format($supplier->total) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
<script src="/js/mobile-menu.js"></script>
</x-layout>
