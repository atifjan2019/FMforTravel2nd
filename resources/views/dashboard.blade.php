<x-layout title="Dashboard - Al Nafi Travels" pageTitle="Dashboard"
    pageSubtitle="Welcome back! Here's your business overview">
    <x-slot:styles>
        .quick-actions {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
        margin-bottom: 20px;
        }

        .action-card {
        background: var(--card-bg);
        border-radius: 14px;
        padding: 18px 15px;
        text-align: center;
        text-decoration: none;
        box-shadow: var(--shadow);
        transition: all 0.3s ease;
        border: 2px solid transparent;
        }

        .action-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-hover);
        border-color: var(--primary);
        }

        .action-card.customers .action-icon { background: linear-gradient(135deg, #2d2d2d 0%, #3d3d3d 100%); }
        .action-card.sales .action-icon { background: linear-gradient(135deg, #d4a017 0%, #f5c518 100%); }
        .action-card.suppliers .action-icon { background: linear-gradient(135deg, #5d4e37 0%, #8b7355 100%); }
        .action-card.purchases .action-icon { background: linear-gradient(135deg, #6b5b4a 0%, #9c8c7c 100%); }
        .action-card.expenses .action-icon { background: linear-gradient(135deg, #8b4513 0%, #a0522d 100%); }
        .action-card.reports .action-icon { background: linear-gradient(135deg, #4a4a4a 0%, #6a6a6a 100%); }

        .action-icon {
        width: 50px;
        height: 50px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        margin: 0 auto 10px;
        color: white;
        }

        .action-card h3 {
        font-size: 13px;
        font-weight: 600;
        color: var(--text);
        margin-bottom: 4px;
        }

        .action-card p {
        font-size: 11px;
        color: var(--text-light);
        }

        /* Stats Section */
        .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-bottom: 20px;
        }

        .stat-card {
        background: var(--card-bg);
        border-radius: 14px;
        padding: 18px;
        box-shadow: var(--shadow);
        display: flex;
        align-items: center;
        gap: 14px;
        border: 1px solid var(--border);
        }

        .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        }

        .stat-icon.income { background: linear-gradient(135deg, #f5c518 0%, #d4a017 100%); }
        .stat-icon.expense { background: #2d2d2d; }
        .stat-icon.purchase { background: linear-gradient(135deg, #8b7355 0%, #6b5b4a 100%); }
        .stat-icon.receivable { background: linear-gradient(135deg, #d4a017 0%, #b8860b 100%); }

        .stat-info h4 {
        font-size: 11px;
        color: var(--text-light);
        font-weight: 500;
        margin-bottom: 3px;
        }

        .stat-info .value {
        font-size: 20px;
        font-weight: 700;
        color: var(--text);
        }

        .stat-info .value.positive { color: #2e7d32; }
        .stat-info .value.negative { color: #c62828; }

        .stat-info .change {
        font-size: 10px;
        margin-top: 3px;
        color: var(--text-light);
        }

        /* Recent Activity */
        .recent-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 18px;
        }

        @media (max-width: 768px) {
        .recent-grid {
        grid-template-columns: 1fr;
        }

        .quick-actions {
        grid-template-columns: repeat(3, 1fr);
        }

        .action-card {
        padding: 14px 10px;
        }

        .action-icon {
        width: 40px;
        height: 40px;
        font-size: 18px;
        }

        .action-card h3 {
        font-size: 11px;
        }

        .action-card p {
        display: none;
        }
        }

        .activity-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 0;
        border-bottom: 1px solid var(--border);
        }

        .activity-item:last-child {
        border-bottom: none;
        }

        .activity-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        }

        .activity-icon.sale { background: linear-gradient(135deg, #f5c518 0%, #d4a017 100%); }
        .activity-icon.purchase { background: linear-gradient(135deg, #8b7355 0%, #6b5b4a 100%); }
        .activity-icon.expense { background: #2d2d2d; }

        .activity-info h5 {
        font-size: 12px;
        font-weight: 600;
        color: var(--text);
        margin-bottom: 2px;
        }

        .activity-info p {
        font-size: 10px;
        color: var(--text-light);
        }

        .activity-amount {
        margin-left: auto;
        font-weight: 600;
        font-size: 13px;
        }

        .activity-amount.income { color: #2e7d32; }
        .activity-amount.expense { color: #c62828; }

        .view-all-btn {
        display: block;
        text-align: center;
        padding: 12px;
        color: var(--primary-dark);
        text-decoration: none;
        font-weight: 600;
        font-size: 12px;
        margin-top: 8px;
        border-radius: 8px;
        transition: all 0.3s ease;
        }

        .view-all-btn:hover {
        background: #fff8e1;
        }
    </x-slot:styles>

    <!-- Quick Actions -->
    <div class="quick-actions">
        <a href="/customers" class="action-card customers">
            <div class="action-icon">👥</div>
            <h3>Customers</h3>
            <p>Manage customers</p>
        </a>

        <a href="/incomes/create" class="action-card sales">
            <div class="action-icon">💰</div>
            <h3>New Sale</h3>
            <p>Record sale</p>
        </a>

        <a href="/suppliers" class="action-card suppliers">
            <div class="action-icon">🏢</div>
            <h3>Suppliers</h3>
            <p>Manage suppliers</p>
        </a>

        <a href="/purchases/create" class="action-card purchases">
            <div class="action-icon">🛒</div>
            <h3>New Purchase</h3>
            <p>Record purchase</p>
        </a>

        <a href="/expenses" class="action-card expenses">
            <div class="action-icon">💸</div>
            <h3>Expenses</h3>
            <p>Track expenses</p>
        </a>

        <a href="/reports" class="action-card reports">
            <div class="action-icon">📊</div>
            <h3>Reports</h3>
            <p>View reports</p>
        </a>
    </div>

    <!-- Stats Overview -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon income">💰</div>
            <div class="stat-info">
                <h4>Total Sales</h4>
                <div class="value positive">Rs {{ number_format($totalIncome ?? 0) }}</div>
                <div class="change">{{ $incomesCount ?? 0 }} transactions</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon purchase">🛒</div>
            <div class="stat-info">
                <h4>Total Purchases</h4>
                <div class="value">Rs {{ number_format($totalPurchases ?? 0) }}</div>
                <div class="change">{{ $purchasesCount ?? 0 }} transactions</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon expense">💸</div>
            <div class="stat-info">
                <h4>Total Expenses</h4>
                <div class="value negative">Rs {{ number_format($totalExpenses ?? 0) }}</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon receivable">📥</div>
            <div class="stat-info">
                <h4>Net Profit</h4>
                <div class="value {{ ($netProfit ?? 0) >= 0 ? 'positive' : 'negative' }}">
                    Rs {{ number_format($netProfit ?? 0) }}
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="recent-grid">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">💰 Recent Sales</h2>
            </div>

            @forelse($recentIncomes ?? [] as $income)
                <div class="activity-item">
                    <div class="activity-icon sale">💰</div>
                    <div class="activity-info">
                        <h5>{{ $income->customer->name ?? 'Unknown' }}</h5>
                        <p>{{ $income->description ?? 'Sale' }} • {{ $income->income_date->format('M d') }}</p>
                    </div>
                    <div class="activity-amount income">+Rs {{ number_format($income->amount) }}</div>
                </div>
            @empty
                <div class="empty-state">
                    <div class="icon">💰</div>
                    <h3>No recent sales</h3>
                    <p>Start by recording your first sale</p>
                    <a href="/incomes/create" class="btn btn-success">Add Sale</a>
                </div>
            @endforelse

            @if(count($recentIncomes ?? []) > 0)
                <a href="/incomes" class="view-all-btn">View All Sales →</a>
            @endif
        </div>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">🛒 Recent Purchases</h2>
            </div>

            @forelse($recentPurchases ?? [] as $purchase)
                <div class="activity-item">
                    <div class="activity-icon purchase">🛒</div>
                    <div class="activity-info">
                        <h5>{{ $purchase->supplier->name ?? 'Unknown' }}</h5>
                        <p>{{ $purchase->item->name ?? 'Item' }} • {{ $purchase->purchase_date->format('M d') }}</p>
                    </div>
                    <div class="activity-amount expense">-Rs {{ number_format($purchase->total_amount) }}</div>
                </div>
            @empty
                <div class="empty-state">
                    <div class="icon">🛒</div>
                    <h3>No recent purchases</h3>
                    <p>Start by recording your first purchase</p>
                    <a href="/purchases/create" class="btn btn-primary">Add Purchase</a>
                </div>
            @endforelse

            @if(count($recentPurchases ?? []) > 0)
                <a href="/purchases" class="view-all-btn">View All Purchases →</a>
            @endif
        </div>
    </div>
</x-layout>