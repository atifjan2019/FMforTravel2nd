<x-layout title="📈 Profit & Loss Report - Al Nafi Travels">
    <x-page-header
        title="📈 Profit & Loss Report"
        icon="💹"
        backUrl="/reports"
    />

    <div class="summary">
            <div class="stat-card" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                <h3>Total Income</h3>
                <div class="amount">Rs {{ number_format($totalIncome) }}</div>
            </div>
            <div class="stat-card" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);">
                <h3>Total Expenses</h3>
                <div class="amount">Rs {{ number_format($totalExpenses) }}</div>
            </div>
            <div class="stat-card" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                <h3>Total Purchases</h3>
                <div class="amount">Rs {{ number_format($totalPurchases) }}</div>
            </div>
            <div class="stat-card" style="background: linear-gradient(135deg, {{ $netProfit >= 0 ? '#8b5cf6, #7c3aed' : '#ef4444, #dc2626' }} 100%);">
                <h3>Net Profit/Loss</h3>
                <div class="amount">Rs {{ number_format($netProfit) }}</div>
            </div>
        </div>

        <div class="card">
            <h2 style="margin-bottom: 20px;">Monthly Breakdown</h2>
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
    </div>
<script src="/js/mobile-menu.js"></script>
</x-layout>
