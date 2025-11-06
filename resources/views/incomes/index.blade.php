<x-layout title="Incomes - Al Nafi Travels">
    <x-page-header 
        title="Incomes" 
        icon="💰" 
        actionUrl="/incomes/create" 
        actionText="+ Add Income" 
    />

    <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Customer</th>
                        <th>Item</th>
                        <th>Amount</th>
                        <th>Paid</th>
                        <th>Reference</th>
                        <th>Service Status</th>
                        <th>Payment Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($incomes as $income)
                    <tr>
                        <td>{{ $income->income_date->format('d M Y') }}</td>
                        <td>{{ $income->customer->name ?? 'N/A' }}</td>
                        <td>{{ $income->item->name ?? 'N/A' }}</td>
                        <td><strong>Rs {{ number_format($income->amount) }}</strong></td>
                        <td>
                            <span style="color: #10b981;">Rs {{ number_format($income->paid_amount) }}</span>
                            @if($income->remaining_amount > 0)
                                <br><small style="color: #ef4444;">Remaining: Rs {{ number_format($income->remaining_amount) }}</small>
                            @endif
                        </td>
                        <td>{{ $income->reference_no ?? 'N/A' }}</td>
                        <td>
                            <span class="badge {{ $income->status == 'completed' ? 'badge-success' : ($income->status == 'cancelled' ? 'badge-danger' : 'badge-warning') }}">
                                {{ ucfirst($income->status) }}
                            </span>
                        </td>
                        <td>
                            @if($income->payment_status == 'paid')
                                <span class="badge badge-success">✓ Paid</span>
                            @elseif($income->payment_status == 'partial')
                                <span class="badge badge-warning">◐ Partial</span>
                            @else
                                <span class="badge badge-danger">✗ Unpaid</span>
                            @endif
                        </td>
                        <td class="actions">
                            <a href="/incomes/{{ $income->id }}" class="btn btn-primary">View</a>
                            <a href="/incomes/{{ $income->id }}/edit" class="btn btn-primary">Edit</a>
                            <form action="/incomes/{{ $income->id }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this income?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" style="text-align: center; color: #999; padding: 40px;">No incomes found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
</x-layout>