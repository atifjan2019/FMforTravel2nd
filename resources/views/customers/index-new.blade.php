<x-layout title="Customers - Al Nafi Travels">
    <x-page-header 
        title="Customers" 
        icon="👥" 
        actionUrl="/customers/create" 
        actionText="+ Add Customer" 
    />

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Total Incomes (Sell)</th>
                    <th>Total Payments</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($customers as $customer)
                <tr>
                    <td>
                        <strong>
                            <a href="{{ route('customers.ledger', $customer->id) }}" style="color:#2563eb; text-decoration:none;">
                                {{ $customer->name }}
                            </a>
                        </strong>
                    </td>
                    <td>{{ $customer->phone ?? 'N/A' }}</td>
                    <td>{{ $customer->email ?? 'N/A' }}</td>
                    <td>{{ $customer->incomes_count }}</td>
                    <td>{{ $customer->payments_count }}</td>
                    <td>
                        <span class="badge {{ $customer->status == 'active' ? 'badge-success' : 'badge-danger' }}">
                            {{ ucfirst($customer->status) }}
                        </span>
                    </td>
                    <td class="actions">
                        <a href="/customers/{{ $customer->id }}" class="btn btn-primary">View</a>
                        <a href="/customers/{{ $customer->id }}/edit" class="btn btn-primary">Edit</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align: center; color: #999; padding: 40px;">No customers found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        @if($customers->hasPages())
        <div style="margin-top: 20px; text-align: center;">
            {{ $customers->links() }}
        </div>
        @endif
    </div>
</x-layout>
