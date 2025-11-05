<x-layout title="📊 Reports Dashboard - Al Nafi Travels">
    <x-page-header
        title="📊 Reports Dashboard"
        icon="📊"
        backUrl="/"
    />

    <style>
        .report-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .report-card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            text-decoration: none;
            color: #333;
            transition: all 0.3s;
            display: block;
        }
        .report-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        .report-card .icon {
            font-size: 48px;
            margin-bottom: 15px;
        }
        .report-card h2 {
            font-size: 20px;
            margin-bottom: 10px;
            color: #667eea;
        }
        .report-card p {
            font-size: 14px;
            color: #666;
            line-height: 1.6;
        }
        
        @media (max-width: 768px) {
            .report-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }
            .report-card {
                padding: 20px;
            }
            .report-card .icon {
                font-size: 36px;
                margin-bottom: 10px;
            }
            .report-card h2 {
                font-size: 18px;
            }
            .report-card p {
                font-size: 13px;
            }
        }
    </style>

    <div class="report-grid">
            <a href="/reports/profit-loss" class="report-card">
                <div class="icon">💹</div>
                <h2>Profit & Loss Report</h2>
                <p>View income, expenses, and net profit for any date range. Analyze your business profitability.</p>
            </a>

            <a href="/reports/customer-ledger" class="report-card">
                <div class="icon">👥</div>
                <h2>Customer Ledger</h2>
                <p>Detailed transaction history for each customer. View all incomes and payments with running balances.</p>
            </a>

            <a href="/reports/supplier-ledger" class="report-card">
                <div class="icon">🏢</div>
                <h2>Supplier Ledger</h2>
                <p>Complete supplier transaction records. Track all purchases and payments made to suppliers.</p>
            </a>

            <a href="/reports/cash-flow" class="report-card">
                <div class="icon">💰</div>
                <h2>Cash Flow Report</h2>
                <p>Monitor cash inflows and outflows. See actual money movements in your business.</p>
            </a>

            <a href="/reports/sales" class="report-card">
                <div class="icon">📈</div>
                <h2>Sales Report</h2>
                <p>Analyze sales by customer and item. Identify your top performers and revenue sources.</p>
            </a>

            <a href="/reports/purchases" class="report-card">
                <div class="icon">🛒</div>
                <h2>Purchase Report</h2>
                <p>Review purchases by supplier and item. Track spending patterns and supplier performance.</p>
            </a>
        </div>
</x-layout>
