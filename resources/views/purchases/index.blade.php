<x-layout title="Purchases - Al Nafi Travels">
    <x-page-header 
        title="Purchases" 
        icon="🛒" 
        actionUrl="/purchases/create" 
        actionText="+ Add Purchase" 
    />

    <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Supplier</th>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total Amount</th>
                        <th>Paid</th>
                        <th>Payment Status</th>
                        <th>Reference</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($purchases as $purchase)
                    <tr>
                        <td>{{ $purchase->purchase_date->format('d M Y') }}</td>
                        <td>{{ $purchase->supplier->name ?? 'N/A' }}</td>
                        <td>{{ $purchase->item->name ?? 'N/A' }}</td>
                        <td>{{ $purchase->quantity }}</td>
                        <td>Rs {{ number_format($purchase->unit_price) }}</td>
                        <td><strong>Rs {{ number_format($purchase->total_amount) }}</strong></td>
                        <td>
                            <span style="color: #3b82f6;">Rs {{ number_format($purchase->paid_amount) }}</span>
                            @if($purchase->remaining_amount > 0)
                                <br><small style="color: #ef4444;">Due: Rs {{ number_format($purchase->remaining_amount) }}</small>
                            @endif
                        </td>
                        <td>
                            @if($purchase->payment_status == 'paid')
                                <span class="badge badge-success">✓ Paid</span>
                            @elseif($purchase->payment_status == 'partial')
                                <span class="badge badge-warning">◐ Partial</span>
                            @else
                                <span class="badge badge-danger">✗ Unpaid</span>
                            @endif
                        </td>
                        <td>{{ $purchase->reference_no ?? 'N/A' }}</td>
                        <td class="actions">
                            <a href="/purchases/{{ $purchase->id }}" class="btn btn-primary">View</a>
                            <a href="/purchases/{{ $purchase->id }}/edit" class="btn btn-primary">Edit</a>
                            <form action="/purchases/{{ $purchase->id }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this purchase?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" style="text-align: center; color: #999; padding: 40px;">No purchases found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
</x-layout>