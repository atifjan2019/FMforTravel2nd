<x-layout title="Profit & Loss - Al Nafi Travels" pageTitle="Profit & Loss"
    pageSubtitle="Financial summary and profitability analysis">
    <x-slot:styles>
        .metrics-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
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

        .metric-card::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        }

        .metric-card.income::before { background: #2e7d32; }
        .metric-card.expense::before { background: #c62828; }
        .metric-card.purchase::before { background: #f57c00; }
        .metric-card.profit::before { background: var(--primary); }
        .metric-card.loss::before { background: #c62828; }

        .metric-label { font-size: 11px; color: var(--text-light); text-transform: uppercase; font-weight: 600;
        margin-bottom: 6px; }
        .metric-value { font-size: 22px; font-weight: 700; color: var(--text); }
        .metric-value.income { color: #2e7d32; }
        .metric-value.expense { color: #c62828; }
        .metric-value.profit { color: #2e7d32; }
        .metric-value.loss { color: #c62828; }
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
        .positive { color: #2e7d32; font-weight: 600; }
        .negative { color: #c62828; font-weight: 600; }

        @media (max-width: 640px) {
        .metrics-grid { grid-template-columns: repeat(2, 1fr); }
        .metric-value { font-size: 18px; }
        }
    </x-slot:styles>

    <div class="metrics-grid">
        <div class="metric-card income">
            <div class="metric-label">Total Sales</div>
            <div class="metric-value income">Rs {{ number_format($totalIncome) }}</div>
            <div class="metric-icon">💰</div>
        </div>
        <div class="metric-card expense">
            <div class="metric-label">Total Expenses</div>
            <div class="metric-value expense">Rs {{ number_format($totalExpenses) }}</div>
            <div class="metric-icon">💸</div>
        </div>
        <div class="metric-card purchase">
            <div class="metric-label">Total Purchases</div>
            <div class="metric-value">Rs {{ number_format($totalPurchases) }}</div>
            <div class="metric-icon">🛒</div>
        </div>
        <div class="metric-card {{ $netProfit >= 0 ? 'profit' : 'loss' }}">
            <div class="metric-label">Net Profit/Loss</div>
            <div class="metric-value {{ $netProfit >= 0 ? 'profit' : 'loss' }}">Rs {{ number_format($netProfit) }}</div>
            <div class="metric-icon">{{ $netProfit >= 0 ? '📈' : '📉' }}</div>
        </div>
    </div>

    <div class="table-card">
        <div class="section-title">📊 Monthly Breakdown</div>
        <table>
            <thead>
                <tr>
                    <th>Month</th>
                    <th>Sales</th>
                    <th>Expenses</th>
                    <th>Purchases</th>
                    <th>Net Profit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($monthlyData as $data)
                    <tr>
                        <td><strong>{{ $data['month'] }}</strong></td>
                        <td class="positive">Rs {{ number_format($data['income']) }}</td>
                        <td class="negative">Rs {{ number_format($data['expenses']) }}</td>
                        <td class="negative">Rs {{ number_format($data['purchases']) }}</td>
                        <td class="{{ $data['profit'] >= 0 ? 'positive' : 'negative' }}">Rs
                            {{ number_format($data['profit']) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <a href="/reports" class="btn btn-secondary">← Back to Reports</a>
</x-layout>