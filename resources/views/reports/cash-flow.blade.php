<x-layout title="💵 Cash Flow Report - Al Nafi Travels">
    <x-page-header
        title="💵 Cash Flow Report"
        icon="💰"
        backUrl="/reports"
    />


    <style>
        .report-section { display: flex; flex-wrap: wrap; gap: 24px; margin-bottom: 32px; }
        .report-card-metric { flex: 1 1 220px; min-width: 220px; background: #fff; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); padding: 28px 24px 20px 24px; display: flex; flex-direction: column; align-items: flex-start; position: relative; }
        .report-card-metric .metric-label { font-size: 15px; color: #888; margin-bottom: 8px; font-weight: 500; }
        .report-card-metric .metric-value { font-size: 2.1rem; font-weight: 700; margin-bottom: 0; }
        .report-card-metric.income { border-left: 6px solid #10b981; }
        .report-card-metric.expenses { border-left: 6px solid #ef4444; }
        .report-card-metric.netcash { border-left: 6px solid {{ $netCashFlow >= 0 ? '#8b5cf6' : '#ef4444' }}; }
        .report-card-metric .metric-icon { font-size: 2.2rem; position: absolute; top: 18px; right: 18px; opacity: 0.13; }
        .report-section-title { font-size: 1.2rem; font-weight: 600; color: #333; margin-bottom: 18px; margin-top: 10px; }
        .report-table-card { background: #fff; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); padding: 28px 24px 20px 24px; margin-bottom: 32px; }
        .report-table-card table { width: 100%; border-collapse: collapse; }
        .report-table-card th, .report-table-card td { padding: 12px 10px; border-bottom: 1px solid #f1f1f1; text-align: left; }
        .report-table-card th { background: #f8fafc; color: #667eea; font-weight: 700; font-size: 15px; }
        .report-table-card td.cashin, .report-table-card td.cash-in { color: #10b981; font-weight: 600; }
        .report-table-card td.cashout, .report-table-card td.cash-out { color: #ef4444; font-weight: 600; }
        .report-table-card td { font-size: 15px; }
        @media (max-width: 900px) { .report-section { flex-direction: column; gap: 18px; } .report-card-metric { min-width: 0; width: 100%; } }
        @media (max-width: 600px) { .report-table-card { padding: 12px 4px; } .report-card-metric { padding: 18px 10px; } }
    </style>

    <div class="report-section">
        <div class="report-card-metric income">
            <span class="metric-label">Total Cash In (This Month)</span>
            <span class="metric-value">Rs {{ number_format($currentMonthCashIn) }}</span>
            <span class="metric-icon">💰</span>
        </div>
        <div class="report-card-metric expenses">
            <span class="metric-label">Total Cash Out (This Month)</span>
            <span class="metric-value">Rs {{ number_format($currentMonthCashOut) }}</span>
            <span class="metric-icon">💸</span>
        </div>
        <div class="report-card-metric netcash">
            <span class="metric-label">Net Cash Flow (This Month)</span>
            <span class="metric-value">Rs {{ number_format($currentMonthNetCashFlow) }}</span>
            <span class="metric-icon">{{ $currentMonthNetCashFlow >= 0 ? '📈' : '📉' }}</span>
        </div>
    </div>

    <div class="report-table-card">
        <div class="report-section-title">Monthly Cash Flow</div>
        <table>
            <thead>
                <tr><th>Month</th><th>Cash In</th><th>Cash Out</th><th>Net Flow</th></tr>
            </thead>
            <tbody>
                @foreach($monthlyData as $data)
                <tr>
                    <td><strong>{{ $data['month'] }}</strong></td>
                    <td class="cash-in">Rs {{ number_format($data['cash_in']) }}</td>
                    <td class="cash-out">Rs {{ number_format($data['cash_out']) }}</td>
                    <td class="{{ $data['net_flow'] >= 0 ? 'cash-in' : 'cash-out' }}">Rs {{ number_format($data['net_flow']) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="report-table-card">
        <div class="report-section-title">Cash In Details</div>
        <table>
            <thead>
                <tr><th>Source</th><th>Amount</th></tr>
            </thead>
            <tbody>
                <tr><td>Customer Payments</td><td class="cash-in">Rs {{ number_format($customerPayments) }}</td></tr>
                <tr><td>Income Transactions</td><td class="cash-in">Rs {{ number_format($incomeTransactions) }}</td></tr>
                <tr style="background: #f8f9fa;"><td><strong>Total Cash In</strong></td><td class="cash-in"><strong>Rs {{ number_format($totalCashIn) }}</strong></td></tr>
            </tbody>
        </table>
    </div>

    <div class="report-table-card">
        <div class="report-section-title">Cash Out Details</div>
        <table>
            <thead>
                <tr><th>Category</th><th>Amount</th></tr>
            </thead>
            <tbody>
                <tr><td>Supplier Payments</td><td class="cash-out">Rs {{ number_format($supplierPayments) }}</td></tr>
                <tr><td>Purchase Transactions</td><td class="cash-out">Rs {{ number_format($purchaseTransactions) }}</td></tr>
                <tr><td>Expenses</td><td class="cash-out">Rs {{ number_format($expenses) }}</td></tr>
                <tr style="background: #f8f9fa;"><td><strong>Total Cash Out</strong></td><td class="cash-out"><strong>Rs {{ number_format($totalCashOut) }}</strong></td></tr>
            </tbody>
        </table>
    </div>
<script src="/js/mobile-menu.js"></script>
</x-layout>
