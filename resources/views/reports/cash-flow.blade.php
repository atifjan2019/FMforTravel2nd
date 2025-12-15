<x-layout title="Cash Flow - FM Travel Manager" pageTitle="Cash Flow" pageSubtitle="Monitor cash inflows and outflows">
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
        .metric-card.cashin::before { background: #2e7d32; }
        .metric-card.cashout::before { background: #c62828; }
        .metric-card.netflow::before { background: var(--primary); }

        .metric-label { font-size: 11px; color: var(--text-light); text-transform: uppercase; font-weight: 600;
        margin-bottom: 6px; }
        .metric-value { font-size: 22px; font-weight: 700; }
        .metric-value.cashin { color: #2e7d32; }
        .metric-value.cashout { color: #c62828; }
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
        .cashin { color: #2e7d32; font-weight: 600; }
        .cashout { color: #c62828; font-weight: 600; }
        .total-row { background: #f9f5eb; }
    </x-slot:styles>

    <div class="metrics-grid">
        <div class="metric-card cashin">
            <div class="metric-label">Cash In (This Month)</div>
            <div class="metric-value cashin">Rs {{ number_format($currentMonthCashIn) }}</div>
            <div class="metric-icon">💰</div>
        </div>
        <div class="metric-card cashout">
            <div class="metric-label">Cash Out (This Month)</div>
            <div class="metric-value cashout">Rs {{ number_format($currentMonthCashOut) }}</div>
            <div class="metric-icon">💸</div>
        </div>
        <div class="metric-card netflow">
            <div class="metric-label">Net Flow (This Month)</div>
            <div class="metric-value {{ $currentMonthNetCashFlow >= 0 ? 'cashin' : 'cashout' }}">Rs
                {{ number_format($currentMonthNetCashFlow) }}</div>
            <div class="metric-icon">{{ $currentMonthNetCashFlow >= 0 ? '📈' : '📉' }}</div>
        </div>
    </div>

    <div class="table-card">
        <div class="section-title">📊 Monthly Cash Flow</div>
        <table>
            <thead>
                <tr>
                    <th>Month</th>
                    <th>Cash In</th>
                    <th>Cash Out</th>
                    <th>Net Flow</th>
                </tr>
            </thead>
            <tbody>
                @foreach($monthlyData as $data)
                    <tr>
                        <td><strong>{{ $data['month'] }}</strong></td>
                        <td class="cashin">Rs {{ number_format($data['cash_in']) }}</td>
                        <td class="cashout">Rs {{ number_format($data['cash_out']) }}</td>
                        <td class="{{ $data['net_flow'] >= 0 ? 'cashin' : 'cashout' }}">Rs
                            {{ number_format($data['net_flow']) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="table-card">
        <div class="section-title">📥 Cash In Details</div>
        <table>
            <thead>
                <tr>
                    <th>Source</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Customer Payments</td>
                    <td class="cashin">Rs {{ number_format($customerPayments) }}</td>
                </tr>
                <tr>
                    <td>Income Transactions</td>
                    <td class="cashin">Rs {{ number_format($incomeTransactions) }}</td>
                </tr>
                <tr class="total-row">
                    <td><strong>Total Cash In</strong></td>
                    <td class="cashin"><strong>Rs {{ number_format($totalCashIn) }}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="table-card">
        <div class="section-title">📤 Cash Out Details</div>
        <table>
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Supplier Payments</td>
                    <td class="cashout">Rs {{ number_format($supplierPayments) }}</td>
                </tr>
                <tr>
                    <td>Purchase Transactions</td>
                    <td class="cashout">Rs {{ number_format($purchaseTransactions) }}</td>
                </tr>
                <tr>
                    <td>Expenses</td>
                    <td class="cashout">Rs {{ number_format($expenses) }}</td>
                </tr>
                <tr class="total-row">
                    <td><strong>Total Cash Out</strong></td>
                    <td class="cashout"><strong>Rs {{ number_format($totalCashOut) }}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>

    <a href="/reports" class="btn btn-secondary">← Back to Reports</a>
</x-layout>