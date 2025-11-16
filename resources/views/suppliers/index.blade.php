<x-layout title="Suppliers - Al Nafi Travels">
    <x-page-header 
        title="Suppliers" 
        icon="🏢" 
        actionUrl="/suppliers/create" 
        actionText="+ Add Supplier" 
    />

    <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Total Purchases</th>
                        <th>Total Payments</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($suppliers as $supplier)
                    <tr>
                        <td>
                            <strong>
                                <a href="{{ route('suppliers.ledger', $supplier->id) }}" style="color:#2563eb; text-decoration:none;">
                                    {{ $supplier->name }}
                                </a>
                            </strong>
                        </td>
                        <td>{{ $supplier->phone ?? 'N/A' }}</td>
                        <td>{{ $supplier->email ?? 'N/A' }}</td>
                        <td>{{ $supplier->address ?? 'N/A' }}</td>
                        <td>{{ $supplier->purchases_count }}</td>
                        <td>{{ $supplier->payments_count }}</td>
                        <td>
                            <span class="badge badge-success">
                                {{ ucfirst($supplier->status) }}
                            </span>
                        </td>
                        <td class="actions">
                            <a href="/suppliers/{{ $supplier->id }}" class="btn btn-primary">View</a>
                            <a href="/suppliers/{{ $supplier->id }}/ledger" class="btn btn-primary">Ledger</a>
                            <a href="/suppliers/{{ $supplier->id }}/edit" class="btn btn-primary">Edit</a>
                            <form action="/suppliers/{{ $supplier->id }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this supplier?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="text-align: center; color: #999; padding: 40px;">No suppliers found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
</x-layout>
