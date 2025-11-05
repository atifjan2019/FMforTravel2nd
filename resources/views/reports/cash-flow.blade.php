<x-layout title="💵 Cash Flow Report - Al Nafi Travels">
    <x-page-header
        title="💵 Cash Flow Report"
        icon="💰"
        backUrl="/reports"
    />

    <div class="summary">
            <div class="stat-card" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                <h3>Total Cash In</h3>
                <div class="amount">Rs {{ number_format($totalCashIn) }}</div>
            </div>
            <div class="stat-card" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);">
                <h3>Total Cash Out</h3>
                <div class="amount">Rs {{ number_format($totalCashOut) }}</div>
            </div>
            <div class="stat-card" style="background: linear-gradient(135deg, {{ $netCashFlow >= 0 ? '#8b5cf6, #7c3aed' : '#ef4444, #dc2626' }} 100%);">
                <h3>Net Cash Flow</h3>
                <div class="amount">Rs {{ number_format($netCashFlow) }}</div>
            </div>
        </div>

        <div class="card">
            <h2 style="margin-bottom: 20px;">Monthly Cash Flow</h2>
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

        <div class="card">
            <h2 style="margin-bottom: 20px;">Cash In Details</h2>
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

        <div class="card">
            <h2 style="margin-bottom: 20px;">Cash Out Details</h2>
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
    </div>
<script src="/js/mobile-menu.js"></script>
</x-layout>
