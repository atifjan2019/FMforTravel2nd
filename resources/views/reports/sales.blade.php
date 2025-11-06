<x-layout title="🛍️ Sales Report - Al Nafi Travels">
    <x-page-header
        title="🛍️ Sales Report"
        icon="💰"
        backUrl="/reports"
    />


    <style>
        .report-section { display: flex; flex-wrap: wrap; gap: 24px; margin-bottom: 32px; }
        .report-card-metric { flex: 1 1 220px; min-width: 220px; background: #fff; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); padding: 28px 24px 20px 24px; display: flex; flex-direction: column; align-items: flex-start; position: relative; }
        .report-card-metric .metric-label { font-size: 15px; color: #888; margin-bottom: 8px; font-weight: 500; }
        .report-card-metric .metric-value { font-size: 2.1rem; font-weight: 700; margin-bottom: 0; }
        .report-card-metric.sales { border-left: 6px solid #10b981; }
        .report-card-metric.transactions { border-left: 6px solid #6366f1; }
        .report-card-metric.average { border-left: 6px solid #f59e0b; }
        .report-card-metric .metric-icon { font-size: 2.2rem; position: absolute; top: 18px; right: 18px; opacity: 0.13; }
        .report-section-title { font-size: 1.2rem; font-weight: 600; color: #333; margin-bottom: 18px; margin-top: 10px; }
        .report-table-card { background: #fff; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); padding: 28px 24px 20px 24px; margin-bottom: 32px; }
        .report-table-card table { width: 100%; border-collapse: collapse; }
        .report-table-card th, .report-table-card td { padding: 12px 10px; border-bottom: 1px solid #f1f1f1; text-align: left; }
        .report-table-card th { background: #f8fafc; color: #667eea; font-weight: 700; font-size: 15px; }
        .report-table-card td.sales { color: #10b981; font-weight: 600; }
        .report-table-card td { font-size: 15px; }
        @media (max-width: 900px) { .report-section { flex-direction: column; gap: 18px; } .report-card-metric { min-width: 0; width: 100%; } }
        @media (max-width: 600px) { .report-table-card { padding: 12px 4px; } .report-card-metric { padding: 18px 10px; } }
    </style>

    <div class="report-section">
        <div class="report-card-metric sales">
            <span class="metric-label">Total Sales (This Month)</span>
            <span class="metric-value">Rs {{ number_format($currentMonthSales) }}</span>
            <span class="metric-icon">💰</span>
        </div>
        <div class="report-card-metric transactions">
            <span class="metric-label">Total Transactions (This Month)</span>
            <span class="metric-value">{{ $currentMonthTransactions }}</span>
            <span class="metric-icon">🧾</span>
        </div>
        <div class="report-card-metric average">
            <span class="metric-label">Average Sale (This Month)</span>
            <span class="metric-value">Rs {{ number_format($currentMonthAverageSale) }}</span>
            <span class="metric-icon">📊</span>
        </div>
    </div>

    <div class="report-table-card">
        <div class="report-section-title">Monthly Sales</div>
        <table>
            <thead>
                <tr><th>Month</th><th>Transactions</th><th>Total Sales</th><th>Average</th></tr>
            </thead>
            <tbody>
                @foreach($monthlySales as $sale)
                <tr>
                    <td><strong>{{ $sale['month'] }}</strong></td>
                    <td>{{ $sale['count'] }}</td>
                    <td class="sales">Rs {{ number_format($sale['total']) }}</td>
                    <td>Rs {{ number_format($sale['average']) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="report-table-card">
        <div class="report-section-title">Sales by Item/Service</div>
        <table>
            <thead>
                <tr><th>Item/Service</th><th>Transactions</th><th>Total Sales</th></tr>
            </thead>
            <tbody>
                @foreach($salesByItem as $item)
                <tr>
                    <td><strong>{{ $item->item_name ?? 'N/A' }}</strong></td>
                    <td>{{ $item->count }}</td>
                    <td class="sales">Rs {{ number_format($item->total) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="report-table-card">
        <div class="report-section-title">Top Customers</div>
        <table>
            <thead>
                <tr><th>Customer</th><th>Transactions</th><th>Total Amount</th></tr>
            </thead>
            <tbody>
                @foreach($topCustomers as $customer)
                <tr>
                    <td><strong>{{ $customer->customer_name }}</strong></td>
                    <td>{{ $customer->count }}</td>
                    <td class="sales">Rs {{ number_format($customer->total) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="report-table-card">
        <div class="report-section-title">Recent Transactions</div>
        <table>
            <thead>
                <tr><th>Date</th><th>Customer</th><th>Item</th><th>Amount</th><th>Paid</th><th>Payment Status</th><th>Service Status</th></tr>
            </thead>
            <tbody>
                @foreach($recentTransactions as $transaction)
                <tr>
                    <td>{{ $transaction->income_date->format('d M Y') }}</td>
                    <td><strong>{{ $transaction->customer->name ?? 'N/A' }}</strong></td>
                    <td>{{ $transaction->item->name ?? 'N/A' }}</td>
                    <td class="sales">Rs {{ number_format($transaction->amount) }}</td>
                    <td style="color: #3b82f6; font-weight: 600;">Rs {{ number_format($transaction->paid_amount) }}</td>
                    <td>
                        @if($transaction->payment_status == 'paid')
                            <span style="background: #10b981; color: white; padding: 4px 10px; border-radius: 4px; font-size: 12px; font-weight: 600;">✓ Paid</span>
                        @elseif($transaction->payment_status == 'partial')
                            <span style="background: #f59e0b; color: white; padding: 4px 10px; border-radius: 4px; font-size: 12px; font-weight: 600;">◐ Partial</span>
                        @else
                            <span style="background: #ef4444; color: white; padding: 4px 10px; border-radius: 4px; font-size: 12px; font-weight: 600;">✗ Unpaid</span>
                        @endif
                    </td>
                    <td>
                        <span style="color: {{ $transaction->status == 'completed' ? '#10b981' : ($transaction->status == 'cancelled' ? '#ef4444' : '#f59e0b') }}; font-weight: 600;">
                            {{ ucfirst($transaction->status) }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
<script src="/js/mobile-menu.js"></script>
</x-layout>
