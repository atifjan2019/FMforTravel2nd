<x-layout title="Dashboard - Al Nafi Travels">
    <style>
        .dashboard-header { 
            background: #ffffff; 
            color: #333; 
            padding: 25px 30px; 
            border-radius: 10px; 
            margin-bottom: 30px; 
            box-shadow: 0 2px 8px rgba(0,0,0,0.1); 
            position: relative; 
            display: flex; 
            flex-direction: row; 
            align-items: center; 
            gap: 20px;
            border-left: 5px solid #667eea;
        }
        .dashboard-header .logo { 
            height: 70px; 
            width: auto; 
        }
        .dashboard-header .header-text {
            flex: 1;
            text-align: right;
        }
        .dashboard-header p { 
            font-size: 16px; 
            color: #333;
            font-weight: 600;
            margin: 0;
        }
        .hamburger-menu { position: absolute; top: 20px; right: 20px; }
        .stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px; }
        .stat-card { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .stat-card h3 { color: #666; font-size: 14px; font-weight: 600; text-transform: uppercase; margin-bottom: 10px; }
        .stat-card .value { font-size: 28px; font-weight: bold; color: #333; }
        .stat-card .value.positive { color: #10b981; }
        .stat-card .value.negative { color: #ef4444; }
        .stat-card .value.info { color: #3b82f6; }
        .menu { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-bottom: 30px; }
        .menu-item { 
            background: white; 
            padding: 20px; 
            border-radius: 10px; 
            text-align: center; 
            text-decoration: none; 
            color: #333; 
            box-shadow: 0 2px 4px rgba(0,0,0,0.1); 
            transition: all 0.3s;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .menu-item:hover { transform: translateY(-5px); box-shadow: 0 4px 8px rgba(0,0,0,0.15); }
        .menu-item .icon { 
            font-size: 32px; 
            margin-bottom: 10px;
            display: block;
        }
        .menu-item .label { 
            font-weight: 600; 
            font-size: 14px;
            display: block;
        }
        
        /* Override for mobile - force 2 columns */
        @media (max-width: 768px) {
            .dashboard-header { 
                padding: 20px; 
                text-align: center; 
                flex-direction: column;
                gap: 10px;
            }
            .dashboard-header .logo { 
                display: none !important; /* Hide logo on mobile */
            }
            .dashboard-header .header-text {
                text-align: center;
            }
            .dashboard-header p { 
                font-size: 16px !important; 
                font-weight: 600 !important; 
                color: #333 !important;
            }
            
            .stats { grid-template-columns: 1fr !important; gap: 15px; }
            .stat-card { padding: 20px; }
            .stat-card h3 { font-size: 12px !important; }
            .stat-card .value { font-size: 24px !important; }
            
            .menu { 
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 12px !important;
            }
            .menu-item {
                padding: 15px 10px !important;
                display: flex !important;
                flex-direction: column !important;
                align-items: center !important;
                justify-content: center !important;
            }
            .menu-item .icon {
                font-size: 32px !important;
                margin-bottom: 8px !important;
                display: block !important;
            }
            .menu-item .label {
                font-size: 13px !important;
                display: block !important;
                text-align: center !important;
            }
        }
        
        @media (max-width: 480px) {
            .dashboard-header { 
                padding: 15px; 
                text-align: center; 
            }
            .dashboard-header .logo { 
                display: none !important; /* Hide logo on small mobile */
            }
            .dashboard-header .header-text {
                text-align: center;
            }
            .dashboard-header p { 
                font-size: 14px !important; 
                font-weight: 600 !important; 
            }
            
            .stat-card { padding: 15px; }
            .stat-card h3 { font-size: 11px !important; }
            .stat-card .value { font-size: 20px !important; }
            
            .menu-item {
                padding: 12px 8px !important;
            }
            .menu-item .icon {
                font-size: 28px !important;
                margin-bottom: 6px !important;
            }
            .menu-item .label {
                font-size: 12px !important;
                line-height: 1.3 !important;
            }
            
            .recent-section { padding: 15px; }
            .recent-section h2 { font-size: 16px !important; }
        }
        .recent-section { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 20px; }
        .recent-section h2 { margin-bottom: 20px; color: #333; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #f8fafc; font-weight: 600; color: #666; }
        .badge { padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 600; }
        .badge-success { background: #d1fae5; color: #047857; }
        .badge-warning { background: #fef3c7; color: #92400e; }
        footer { text-align: center; padding: 20px; color: #666; font-size: 14px; }
        
        /* Tabs styling */
        .tabs { display: flex; gap: 10px; margin-bottom: 20px; border-bottom: 2px solid #e5e7eb; }
        .tab-btn { 
            background: none; 
            border: none; 
            padding: 12px 24px; 
            font-size: 16px; 
            font-weight: 600; 
            color: #666; 
            cursor: pointer; 
            border-bottom: 3px solid transparent; 
            transition: all 0.3s;
        }
        .tab-btn:hover { color: #333; }
        .tab-btn.active { 
            color: #667eea; 
            border-bottom-color: #667eea; 
        }
        .tab-content { display: none; }
        .tab-content.active { display: block; }
    </style>

    <header class="dashboard-header">
        <img src="{{ asset('images/alnafi.png') }}" alt="Al Nafi Travels" class="logo">
        <div class="header-text">
            <p>Financial Management System - Dashboard ({{ now()->format('F Y') }})</p>
        </div>
    </header>

        <!-- Stats Tabs -->
        <div class="recent-section" style="margin-bottom: 20px;">
            <div class="tabs">
                <button class="tab-btn active" onclick="switchStatsTab('income-stats')">💰 Income Stats</button>
                <button class="tab-btn" onclick="switchStatsTab('purchase-stats')">🛒 Purchase Stats</button>
            </div>

            <!-- Income Stats -->
            <div id="income-stats-tab" class="tab-content active">
                <div class="stats">
                    <div class="stat-card">
                        <h3>Current Month Income</h3>
                        <div class="value positive">Rs {{ number_format($totalIncome ?? 0) }}</div>
                    </div>
                    <div class="stat-card">
                        <h3>Current Month Received</h3>
                        <div class="value info">Rs {{ number_format($totalPaidAmount ?? 0) }}</div>
                    </div>
                    <div class="stat-card">
                        <h3>Customer Receivables</h3>
                        <div class="value info">Rs {{ number_format($customerReceivables ?? 0) }}</div>
                        <small style="color: #666; font-size: 12px; margin-top: 5px;">
                            Unpaid: {{ $unpaidIncomesCount ?? 0 }} | Partial: {{ $partialIncomesCount ?? 0 }}
                        </small>
                    </div>
                    <div class="stat-card">
                        <h3>Current Month Net Profit</h3>
                        <div class="value {{ ($netProfit ?? 0) >= 0 ? 'positive' : 'negative' }}">Rs {{ number_format($netProfit ?? 0) }}</div>
                    </div>
                </div>
            </div>

            <!-- Purchase Stats -->
            <div id="purchase-stats-tab" class="tab-content">
                <div class="stats">
                    <div class="stat-card">
                        <h3>Current Month Purchases</h3>
                        <div class="value negative">Rs {{ number_format($totalPurchases ?? 0) }}</div>
                    </div>
                    <div class="stat-card">
                        <h3>Current Month Paid to Suppliers</h3>
                        <div class="value info">Rs {{ number_format($totalPurchasesPaid ?? 0) }}</div>
                    </div>
                    <div class="stat-card">
                        <h3>Supplier Payables</h3>
                        <div class="value negative">Rs {{ number_format($supplierPayables ?? 0) }}</div>
                        <small style="color: #666; font-size: 12px; margin-top: 5px;">
                            Unpaid: {{ $unpaidPurchasesCount ?? 0 }} | Partial: {{ $partialPurchasesCount ?? 0 }}
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <div class="menu">
            <a href="/customers" class="menu-item">
                <div class="icon">👥</div>
                <div class="label">Customers</div>
            </a>
            <a href="/suppliers" class="menu-item">
                <div class="icon">🏢</div>
                <div class="label">Suppliers</div>
            </a>
            <a href="/items" class="menu-item">
                <div class="icon">📦</div>
                <div class="label">Items/Services</div>
            </a>
            <a href="/purchases" class="menu-item">
                <div class="icon">🛒</div>
                <div class="label">Purchases</div>
            </a>
            <a href="/incomes" class="menu-item">
                <div class="icon">💰</div>
                <div class="label">Incomes</div>
            </a>
            <a href="/expenses" class="menu-item">
                <div class="icon">💸</div>
                <div class="label">Expenses</div>
            </a>
            <a href="/reports" class="menu-item">
                <div class="icon">📊</div>
                <div class="label">Reports</div>
            </a>
        </div>

        <div class="recent-section">
            <div class="tabs">
                <button class="tab-btn active" onclick="switchTab('incomes')">💰 Incomes (Sales)</button>
                <button class="tab-btn" onclick="switchTab('purchases')">🛒 Purchases</button>
            </div>

            <!-- Incomes Tab -->
            <div id="incomes-tab" class="tab-content active">
                <h2 style="margin-bottom: 20px;">💰 Current Month Incomes - Sales to Customers ({{ now()->format('F Y') }})</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Item</th>
                            <th>Amount</th>
                            <th>Paid</th>
                            <th>Payment Status</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentIncomes ?? [] as $income)
                        <tr>
                            <td>{{ $income->income_date->format('d M Y') }}</td>
                            <td>{{ $income->customer->name ?? 'N/A' }}</td>
                            <td>{{ $income->item->name ?? 'N/A' }}</td>
                            <td><strong>Rs {{ number_format($income->amount) }}</strong></td>
                            <td style="color: #3b82f6; font-weight: 600;">Rs {{ number_format($income->paid_amount) }}</td>
                            <td>
                                @if($income->payment_status == 'paid')
                                    <span class="badge" style="background: #d1fae5; color: #047857;">✓ Paid</span>
                                @elseif($income->payment_status == 'partial')
                                    <span class="badge" style="background: #fef3c7; color: #92400e;">◐ Partial</span>
                                @else
                                    <span class="badge" style="background: #fee2e2; color: #991b1b;">✗ Unpaid</span>
                                @endif
                            </td>
                            <td><span class="badge badge-success">{{ ucfirst($income->status) }}</span></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" style="text-align: center; color: #999;">No incomes this month</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Purchases Tab -->
            <div id="purchases-tab" class="tab-content">
                <h2 style="margin-bottom: 20px;">🛒 Current Month Purchases - Bought from Suppliers ({{ now()->format('F Y') }})</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Supplier</th>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Total Amount</th>
                            <th>Paid</th>
                            <th>Payment Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentPurchases ?? [] as $purchase)
                        <tr>
                            <td>{{ $purchase->purchase_date->format('d M Y') }}</td>
                            <td>{{ $purchase->supplier->name ?? 'N/A' }}</td>
                            <td>{{ $purchase->item->name ?? 'N/A' }}</td>
                            <td>{{ $purchase->quantity }}</td>
                            <td><strong>Rs {{ number_format($purchase->total_amount) }}</strong></td>
                            <td style="color: #3b82f6; font-weight: 600;">Rs {{ number_format($purchase->paid_amount) }}</td>
                            <td>
                                @if($purchase->payment_status == 'paid')
                                    <span class="badge" style="background: #d1fae5; color: #047857;">✓ Paid</span>
                                @elseif($purchase->payment_status == 'partial')
                                    <span class="badge" style="background: #fef3c7; color: #92400e;">◐ Partial</span>
                                @else
                                    <span class="badge" style="background: #fee2e2; color: #991b1b;">✗ Unpaid</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" style="text-align: center; color: #999;">No purchases this month</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <script>
        function switchTab(tab) {
            // Hide all tabs
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.remove('active');
            });
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            
            // Show selected tab
            document.getElementById(tab + '-tab').classList.add('active');
            event.target.classList.add('active');
        }
        
        function switchStatsTab(tab) {
            // Hide all stats tabs
            document.getElementById('income-stats-tab').classList.remove('active');
            document.getElementById('purchase-stats-tab').classList.remove('active');
            
            // Remove active from stats tab buttons
            const statsBtns = document.querySelectorAll('.tabs')[0].querySelectorAll('.tab-btn');
            statsBtns.forEach(btn => btn.classList.remove('active'));
            
            // Show selected tab
            document.getElementById(tab + '-tab').classList.add('active');
            event.target.classList.add('active');
        }
        </script>

        <footer>
            <p>&copy; 2025 Al Nafi Travels. Financial Management System.</p>
        </footer>
</x-layout>
