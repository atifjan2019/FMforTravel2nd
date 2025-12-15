<x-layout title="Purchase Report - FM Travel Manager" pageTitle="Purchase Report"
    pageSubtitle="Expense analysis and supplier tracking">
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
        .metric-card.purchase::before { background: #c62828; }
        .metric-card.trans::before { background: #1565c0; }
        .metric-card.avg::before { background: var(--primary); }

        .metric-label { font-size: 11px; color: var(--text-light); text-transform: uppercase; font-weight: 600;
        margin-bottom: 6px; }
        .metric-value { font-size: 22px; font-weight: 700; color: var(--text); }
        .metric-value.purchase { color: #c62828; }
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
        .purchase { color: #c62828; font-weight: 600; }
        .supplier-link { color: var(--primary-dark); text-decoration: none; font-weight: 600; }
        .supplier-link:hover { text-decoration: underline; }
    </x-slot:styles>

    <div class="metrics-grid">
        <div class="metric-card purchase">
            <div class="metric-label">Purchases (This Month)</div>
            <div class="metric-value purchase">Rs {{ number_format($currentMonthPurchases) }}</div>
            <div class="metric-icon">🛒</div>
        </div>
        <div class="metric-card trans">
            <div class="metric-label">Transactions</div>
            <div class="metric-value">{{ $currentMonthTransactions }}</div>
            <div class="metric-icon">🧾</div>
        </div>
        <div class="metric-card avg">
            <div class="metric-label">Avg Purchase</div>
            <div class="metric-value">Rs {{ number_format($currentMonthAveragePurchase) }}</div>
            <div class="metric-icon">📊</div>
        </div>
    </div>

    <div class="table-card">
        <div class="section-title">📊 Monthly Purchases</div>
        <table>
            <thead>
                <tr>
                    <th>Month</th>
                    <th>Transactions</th>
                    <th>Total</th>
                    <th>Average</th>
                </tr>
            </thead>
            <tbody>
                @foreach($monthlyPurchases as $purchase)
                    <tr>
                        <td><strong>{{ $purchase['month'] }}</strong></td>
                        <td>{{ $purchase['count'] }}</td>
                        <td class="purchase">Rs {{ number_format($purchase['total']) }}</td>
                        <td>Rs {{ number_format($purchase['average']) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="table-card">
        <div class="section-title">📦 Purchases by Item</div>
        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($purchasesByItem as $item)
                    <tr>
                        <td><strong>{{ $item->item_name }}</strong></td>
                        <td>{{ $item->quantity }}</td>
                        <td class="purchase">Rs {{ number_format($item->total) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="table-card">
        <div class="section-title">🏢 Top Suppliers</div>
        <table>
            <thead>
                <tr>
                    <th>Supplier</th>
                    <th>Transactions</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($topSuppliers as $supplier)
                    <tr>
                        <td><strong>{{ $supplier->supplier_name }}</strong></td>
                        <td>{{ $supplier->count }}</td>
                        <td class="purchase">Rs {{ number_format($supplier->total) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="table-card">
        <div class="section-title">📋 Recent Purchases</div>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Supplier</th>
                    <th>Item</th>
                    <th>Amount</th>
                    <th>Paid</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentPurchases as $purchase)
                    <tr>
                        <td>{{ $purchase->purchase_date->format('d M Y') }}</td>
                        <td>
                            @if($purchase->supplier)
                                <a href="{{ route('suppliers.ledger', $purchase->supplier->id) }}"
                                    class="supplier-link">{{ $purchase->supplier->name }}</a>
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ $purchase->item->name ?? 'N/A' }}</td>
                        <td class="purchase">Rs {{ number_format($purchase->total_amount) }}</td>
                        <td>Rs {{ number_format($purchase->paid_amount) }}</td>
                        <td>
                            @if($purchase->payment_status == 'paid')
                                <span class="badge badge-success">✓ Paid</span>
                            @elseif($purchase->payment_status == 'partial')
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