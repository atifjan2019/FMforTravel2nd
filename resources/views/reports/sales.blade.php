<x-layout title="Sales Report - FM Travel Manager" pageTitle="Sales Report"
    pageSubtitle="Revenue analysis and top performers">
    <x-slot:styles>
        .metrics-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-bottom: 24px;
        }

        .metric-card {
        background: var(--card-bg);
        border-radius: 14px;
        padding: 18px;
        box-shadow: var(--shadow);
        position: relative;
        overflow: hidden;
        }

        .metric-card::before { content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 4px; }
        .metric-card.sales::before { background: #2e7d32; }
        .metric-card.trans::before { background: #1565c0; }
        .metric-card.avg::before { background: var(--primary); }

        .metric-label { font-size: 11px; color: var(--text-light); text-transform: uppercase; font-weight: 600;
        margin-bottom: 6px; }
        .metric-value { font-size: 22px; font-weight: 700; color: var(--text); }
        .metric-value.sales { color: #2e7d32; }
        .metric-icon { position: absolute; top: 14px; right: 14px; font-size: 28px; opacity: 0.15; }

        .section-title { font-size: 14px; font-weight: 600; color: var(--text); margin-bottom: 14px; }

        .table-card {
        background: var(--card-bg);
        border-radius: 14px;
        padding: 18px;
        box-shadow: var(--shadow);
        margin-bottom: 20px;
        overflow-x: auto;
        }

        table { width: 100%; border-collapse: collapse; font-size: 12px; }
        th, td { padding: 10px 12px; text-align: left; border-bottom: 1px solid var(--border); }
        th { background: #f9f5eb; font-weight: 600; font-size: 10px; color: var(--text-light); text-transform:
        uppercase; }
        .sales { color: #2e7d32; font-weight: 600; }
        .customer-link { color: var(--primary-dark); text-decoration: none; font-weight: 600; }
        .customer-link:hover { text-decoration: underline; }
    </x-slot:styles>

    <div class="metrics-grid">
        <div class="metric-card sales">
            <div class="metric-label">Sales (This Month)</div>
            <div class="metric-value sales">Rs {{ number_format($currentMonthSales) }}</div>
            <div class="metric-icon">💰</div>
        </div>
        <div class="metric-card trans">
            <div class="metric-label">Transactions</div>
            <div class="metric-value">{{ $currentMonthTransactions }}</div>
            <div class="metric-icon">🧾</div>
        </div>
        <div class="metric-card avg">
            <div class="metric-label">Avg Sale</div>
            <div class="metric-value">Rs {{ number_format($currentMonthAverageSale) }}</div>
            <div class="metric-icon">📊</div>
        </div>
    </div>

    <div class="table-card">
        <div class="section-title">📊 Monthly Sales</div>
        <table>
            <thead>
                <tr>
                    <th>Month</th>
                    <th>Transactions</th>
                    <th>Total Sales</th>
                    <th>Average</th>
                </tr>
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

    <div class="table-card">
        <div class="section-title">📦 Sales by Item/Service</div>
        <table>
            <thead>
                <tr>
                    <th>Item/Service</th>
                    <th>Transactions</th>
                    <th>Total Sales</th>
                </tr>
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

    <div class="table-card">
        <div class="section-title">🏆 Top Customers</div>
        <table>
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Transactions</th>
                    <th>Total</th>
                </tr>
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

    <div class="table-card">
        <div class="section-title">📋 Recent Transactions</div>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Item</th>
                    <th>Amount</th>
                    <th>Paid</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentTransactions as $transaction)
                    <tr>
                        <td>{{ $transaction->income_date->format('d M Y') }}</td>
                        <td>
                            @if($transaction->customer)
                                <a href="{{ route('customers.ledger', $transaction->customer->id) }}"
                                    class="customer-link">{{ $transaction->customer->name }}</a>
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ $transaction->item->name ?? 'N/A' }}</td>
                        <td class="sales">Rs {{ number_format($transaction->amount) }}</td>
                        <td>Rs {{ number_format($transaction->paid_amount) }}</td>
                        <td>
                            @if($transaction->payment_status == 'paid')
                                <span class="badge badge-success">✓ Paid</span>
                            @elseif($transaction->payment_status == 'partial')
                                <span class="badge badge-warning">◐ Partial</span>
                            @else
                                <span class="badge badge-danger">✗ Unpaid</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <a href="/reports" class="btn btn-secondary">← Back to Reports</a>
</x-layout>