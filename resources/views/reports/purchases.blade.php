<x-layout title="🛒 Purchases Report - Al Nafi Travels">
    <x-page-header
        title="🛒 Purchases Report"
        icon="🛒"
        backUrl="/reports"
    />

    <div class="summary">
            <div class="stat-card">
                <h3>Total Purchases</h3>
                <div class="amount">Rs {{ number_format($totalPurchases) }}</div>
            </div>
            <div class="stat-card">
                <h3>Total Transactions</h3>
                <div class="amount">{{ $totalTransactions }}</div>
            </div>
            <div class="stat-card">
                <h3>Average Purchase</h3>
                <div class="amount">Rs {{ number_format($averagePurchase) }}</div>
            </div>
        </div>

        <div class="card">
            <h2 style="margin-bottom: 20px;">Monthly Purchases</h2>
            <table>
                <thead>
                    <tr><th>Month</th><th>Transactions</th><th>Total Purchases</th><th>Average</th></tr>
                </thead>
                <tbody>
                    @foreach($monthlyPurchases as $purchase)
                    <tr>
                        <td><strong>{{ $purchase['month'] }}</strong></td>
                        <td>{{ $purchase['count'] }}</td>
                        <td style="color: #ef4444; font-weight: bold;">Rs {{ number_format($purchase['total']) }}</td>
                        <td>Rs {{ number_format($purchase['average']) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card">
            <h2 style="margin-bottom: 20px;">Purchases by Item</h2>
            <table>
                <thead>
                    <tr><th>Item</th><th>Quantity</th><th>Total Amount</th></tr>
                </thead>
                <tbody>
                    @foreach($purchasesByItem as $item)
                    <tr>
                        <td><strong>{{ $item->item_name }}</strong></td>
                        <td>{{ $item->quantity }}</td>
                        <td style="color: #ef4444; font-weight: bold;">Rs {{ number_format($item->total) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card">
            <h2 style="margin-bottom: 20px;">Top Suppliers</h2>
            <table>
                <thead>
                    <tr><th>Supplier</th><th>Transactions</th><th>Total Amount</th></tr>
                </thead>
                <tbody>
                    @foreach($topSuppliers as $supplier)
                    <tr>
                        <td><strong>{{ $supplier->supplier_name }}</strong></td>
                        <td>{{ $supplier->count }}</td>
                        <td style="color: #ef4444; font-weight: bold;">Rs {{ number_format($supplier->total) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
<script src="/js/mobile-menu.js"></script>
</x-layout>
