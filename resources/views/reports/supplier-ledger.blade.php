<x-layout title="📕 Supplier Ledger - Al Nafi Travels">
    <x-page-header
        title="📕 Supplier Ledger"
        icon="🏢"
        backUrl="/reports"
    />

    <div class="card">
            <h2 style="margin-bottom: 20px;">All Suppliers Balance Summary</h2>
            <table>
                <thead>
                    <tr><th>Supplier Name</th><th>Total Purchases</th><th>Total Paid</th><th>Balance</th><th>Status</th><th>Action</th></tr>
                </thead>
                <tbody>
                    @forelse($suppliers as $supplier)
                    <tr>
                        <td><strong>{{ $supplier->name }}</strong></td>
                        <td class="negative">Rs {{ number_format($supplier->total_purchases) }}</td>
                        <td class="positive">Rs {{ number_format($supplier->total_paid) }}</td>
                        <td class="{{ $supplier->balance > 0 ? 'negative' : ($supplier->balance < 0 ? 'positive' : '') }}">
                            <strong>Rs {{ number_format(abs($supplier->balance)) }}</strong>
                            @if($supplier->balance > 0) (Payable) @elseif($supplier->balance < 0) (Advance) @endif
                        </td>
                        <td>{{ ucfirst($supplier->status) }}</td>
                        <td><a href="/suppliers/{{ $supplier->id }}/ledger" class="supplier-link">View Ledger →</a></td>
                    </tr>
                    @empty
                    <tr><td colspan="6" style="text-align: center; padding: 40px;">No suppliers found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
<script src="/js/mobile-menu.js"></script>
</x-layout>
