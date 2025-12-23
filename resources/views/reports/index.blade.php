<x-layout title="Reports - Al Nafi Travels" pageTitle="Reports" pageSubtitle="View business reports and analytics">
    <x-slot:styles>
        .report-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 18px;
        }

        .report-card {
        background: var(--card-bg);
        padding: 22px;
        border-radius: 16px;
        box-shadow: var(--shadow);
        text-decoration: none;
        color: var(--text);
        transition: all 0.3s ease;
        display: block;
        border: 2px solid transparent;
        }

        .report-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-hover);
        border-color: var(--primary);
        }

        .report-header {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 14px;
        }

        .report-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        }

        .report-icon.profit { background: linear-gradient(135deg, #2e7d32 0%, #4caf50 100%); }
        .report-icon.customer { background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); }
        .report-icon.supplier { background: linear-gradient(135deg, #5d4e37 0%, #8b7355 100%); }
        .report-icon.cash { background: linear-gradient(135deg, #1565c0 0%, #42a5f5 100%); }
        .report-icon.sales { background: linear-gradient(135deg, #7b1fa2 0%, #ab47bc 100%); }
        .report-icon.purchase { background: linear-gradient(135deg, #c62828 0%, #ef5350 100%); }

        .report-title {
        font-size: 15px;
        font-weight: 600;
        color: var(--text);
        margin-bottom: 3px;
        }

        .report-subtitle {
        font-size: 11px;
        color: var(--text-light);
        }

        .report-desc {
        font-size: 12px;
        color: var(--text-light);
        line-height: 1.6;
        padding: 14px;
        background: #f9f5eb;
        border-radius: 10px;
        }

        .report-arrow {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        margin-top: 14px;
        font-size: 12px;
        color: var(--primary);
        font-weight: 600;
        }

        @media (max-width: 640px) {
        .report-grid {
        grid-template-columns: 1fr;
        }
        }
    </x-slot:styles>

    <div class="report-grid">
        <a href="/reports/profit-loss" class="report-card">
            <div class="report-header">
                <div class="report-icon profit">💹</div>
                <div>
                    <div class="report-title">Profit & Loss</div>
                    <div class="report-subtitle">Financial Summary</div>
                </div>
            </div>
            <p class="report-desc">View income, expenses, and net profit for any date range. Analyze your business
                profitability.</p>
            <div class="report-arrow">View Report →</div>
        </a>

        <a href="/reports/customer-ledger" class="report-card">
            <div class="report-header">
                <div class="report-icon customer">👥</div>
                <div>
                    <div class="report-title">Customer Ledger</div>
                    <div class="report-subtitle">Receivables Tracking</div>
                </div>
            </div>
            <p class="report-desc">Detailed transaction history for each customer. View all sales and payments with
                running balances.</p>
            <div class="report-arrow">View Report →</div>
        </a>

        <a href="/reports/supplier-ledger" class="report-card">
            <div class="report-header">
                <div class="report-icon supplier">🏢</div>
                <div>
                    <div class="report-title">Supplier Ledger</div>
                    <div class="report-subtitle">Payables Tracking</div>
                </div>
            </div>
            <p class="report-desc">Complete supplier transaction records. Track all purchases and payments made to
                suppliers.</p>
            <div class="report-arrow">View Report →</div>
        </a>

        <a href="/reports/cash-flow" class="report-card">
            <div class="report-header">
                <div class="report-icon cash">💰</div>
                <div>
                    <div class="report-title">Cash Flow</div>
                    <div class="report-subtitle">Money Movement</div>
                </div>
            </div>
            <p class="report-desc">Monitor cash inflows and outflows. See actual money movements in your business.</p>
            <div class="report-arrow">View Report →</div>
        </a>

        <a href="/reports/sales" class="report-card">
            <div class="report-header">
                <div class="report-icon sales">📈</div>
                <div>
                    <div class="report-title">Sales Report</div>
                    <div class="report-subtitle">Revenue Analysis</div>
                </div>
            </div>
            <p class="report-desc">Analyze sales by customer and item. Identify your top performers and revenue sources.
            </p>
            <div class="report-arrow">View Report →</div>
        </a>

        <a href="/reports/purchases" class="report-card">
            <div class="report-header">
                <div class="report-icon purchase">🛒</div>
                <div>
                    <div class="report-title">Purchase Report</div>
                    <div class="report-subtitle">Expense Analysis</div>
                </div>
            </div>
            <p class="report-desc">Review purchases by supplier and item. Track spending patterns and supplier
                performance.</p>
            <div class="report-arrow">View Report →</div>
        </a>
    </div>
</x-layout>