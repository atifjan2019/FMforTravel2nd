<x-layout title="🛍️ Sales Report - Al Nafi Travels">
    <x-page-header
        title="🛍️ Sales Report"
        icon="💰"
        backUrl="/reports"
    />

    <div class="summary">
            <div class="stat-card">
                <h3>Total Sales</h3>
                <div class="amount">Rs {{ number_format($totalSales) }}</div>
            </div>
            <div class="stat-card">
                <h3>Total Transactions</h3>
                <div class="amount">{{ $totalTransactions }}</div>
            </div>
            <div class="stat-card">
                <h3>Average Sale</h3>
                <div class="amount">Rs {{ number_format($averageSale) }}</div>
            </div>
        </div>

        <div class="card">
            <h2 style="margin-bottom: 20px;">Monthly Sales</h2>
            <table>
                <thead>
                    <tr><th>Month</th><th>Transactions</th><th>Total Sales</th><th>Average</th></tr>
                </thead>
                <tbody>
                    @foreach($monthlySales as $sale)
                    <tr>
                        <td><strong>{{ $sale['month'] }}</strong></td>
                        <td>{{ $sale['count'] }}</td>
                        <td style="color: #10b981; font-weight: bold;">Rs {{ number_format($sale['total']) }}</td>
                        <td>Rs {{ number_format($sale['average']) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card">
            <h2 style="margin-bottom: 20px;">Sales by Item/Service</h2>
            <table>
                <thead>
                    <tr><th>Item/Service</th><th>Transactions</th><th>Total Sales</th></tr>
                </thead>
                <tbody>
                    @foreach($salesByItem as $item)
                    <tr>
                        <td><strong>{{ $item->item_name ?? 'N/A' }}</strong></td>
                        <td>{{ $item->count }}</td>
                        <td style="color: #10b981; font-weight: bold;">Rs {{ number_format($item->total) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card">
            <h2 style="margin-bottom: 20px;">Top Customers</h2>
            <table>
                <thead>
                    <tr><th>Customer</th><th>Transactions</th><th>Total Amount</th></tr>
                </thead>
                <tbody>
                    @foreach($topCustomers as $customer)
                    <tr>
                        <td><strong>{{ $customer->customer_name }}</strong></td>
                        <td>{{ $customer->count }}</td>
                        <td style="color: #10b981; font-weight: bold;">Rs {{ number_format($customer->total) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
<script src="/js/mobile-menu.js"></script>
</x-layout>
