<x-layout title="📈 Profit & Loss Report - Al Nafi Travels">
    <x-page-header
        title="📈 Profit & Loss Report"
        icon="💹"
        backUrl="/reports"
    />


    <style>
        .report-section {
            display: flex;
            flex-wrap: wrap;
            gap: 24px;
            margin-bottom: 32px;
        }
        .report-card-metric {
            flex: 1 1 220px;
            min-width: 220px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            padding: 28px 24px 20px 24px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            position: relative;
        }
        .report-card-metric .metric-label {
            font-size: 15px;
            color: #888;
            margin-bottom: 8px;
            font-weight: 500;
        }
        .report-card-metric .metric-value {
            font-size: 2.1rem;
            font-weight: 700;
            margin-bottom: 0;
        }
        .report-card-metric.income {
            border-left: 6px solid #10b981;
        }
        .report-card-metric.expenses {
            border-left: 6px solid #ef4444;
        }
        .report-card-metric.purchases {
            border-left: 6px solid #f59e0b;
        }
        .report-card-metric.netprofit {
            border-left: 6px solid {{ $netProfit >= 0 ? '#8b5cf6' : '#ef4444' }};
        }
        .report-card-metric .metric-icon {
            font-size: 2.2rem;
            position: absolute;
            top: 18px;
            right: 18px;
            opacity: 0.13;
        }
        .report-section-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 18px;
            margin-top: 10px;
        }
        .report-table-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            padding: 28px 24px 20px 24px;
            margin-bottom: 32px;
        }
        .report-table-card table {
            width: 100%;
            border-collapse: collapse;
        }
        .report-table-card th, .report-table-card td {
            padding: 12px 10px;
            border-bottom: 1px solid #f1f1f1;
            text-align: left;
        }
        .report-table-card th {
            background: #f8fafc;
            color: #667eea;
            font-weight: 700;
            font-size: 15px;
        }
        .report-table-card td.positive { color: #10b981; font-weight: 600; }
        .report-table-card td.negative { color: #ef4444; font-weight: 600; }
        .report-table-card td { font-size: 15px; }
        @media (max-width: 900px) {
            .report-section { flex-direction: column; gap: 18px; }
            .report-card-metric { min-width: 0; width: 100%; }
        }
        @media (max-width: 600px) {
            .report-table-card { padding: 12px 4px; }
            .report-card-metric { padding: 18px 10px; }
        }
    </style>

    <div class="report-section">
        <div class="report-card-metric income">
            <span class="metric-label">Total Income</span>
            <span class="metric-value">Rs {{ number_format($totalIncome) }}</span>
            <span class="metric-icon">💰</span>
        </div>
        <div class="report-card-metric expenses">
            <span class="metric-label">Total Expenses</span>
            <span class="metric-value">Rs {{ number_format($totalExpenses) }}</span>
            <span class="metric-icon">💸</span>
        </div>
        <div class="report-card-metric purchases">
            <span class="metric-label">Total Purchases</span>
            <span class="metric-value">Rs {{ number_format($totalPurchases) }}</span>
            <span class="metric-icon">🛒</span>
        </div>
        <div class="report-card-metric netprofit">
            <span class="metric-label">Net Profit/Loss</span>
            <span class="metric-value">Rs {{ number_format($netProfit) }}</span>
            <span class="metric-icon">{{ $netProfit >= 0 ? '📈' : '📉' }}</span>
        </div>
    </div>

    <div class="report-table-card">
        <div class="report-section-title">Monthly Breakdown</div>
        <table>
            <thead>
                <tr><th>Month</th><th>Income</th><th>Expenses</th><th>Purchases</th><th>Net Profit</th></tr>
            </thead>
            <tbody>
                @foreach($monthlyData as $data)
                <tr>
                    <td>{{ $data['month'] }}</td>
                    <td class="positive">Rs {{ number_format($data['income']) }}</td>
                    <td class="negative">Rs {{ number_format($data['expenses']) }}</td>
                    <td class="negative">Rs {{ number_format($data['purchases']) }}</td>
                    <td class="{{ $data['profit'] >= 0 ? 'positive' : 'negative' }}">Rs {{ number_format($data['profit']) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
<script src="/js/mobile-menu.js"></script>
</x-layout>
