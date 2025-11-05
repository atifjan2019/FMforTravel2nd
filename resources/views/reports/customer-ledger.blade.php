<x-layout title="📒 Customer Ledger - Al Nafi Travels">
    <x-page-header
        title="📒 Customer Ledger"
        icon="👥"
        backUrl="/reports"
    />

    <div class="card">
            <h2 style="margin-bottom: 20px;">All Customers Balance Summary</h2>
            <table>
                <thead>
                    <tr><th>Customer Name</th><th>Address</th><th>Total Income</th><th>Total Paid</th><th>Balance</th><th>Status</th></tr>
                </thead>
                <tbody>
                    @forelse($customers as $customer)
                    <tr>
                        <td><strong>{{ $customer->name }}</strong></td>
                        <td>{{ $customer->address ?? '-' }}</td>
                        <td>Rs {{ number_format($customer->total_income) }}</td>
                        <td class="positive">Rs {{ number_format($customer->total_paid) }}</td>
                        <td class="{{ $customer->balance > 0 ? 'negative' : ($customer->balance < 0 ? 'positive' : '') }}">
                            <strong>Rs {{ number_format(abs($customer->balance)) }}</strong>
                            @if($customer->balance > 0) (Receivable) @elseif($customer->balance < 0) (Advance) @endif
                        </td>
                        <td>{{ ucfirst($customer->status) }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="6" style="text-align: center; padding: 40px;">No customers found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
<script src="/js/mobile-menu.js"></script>
</x-layout>
