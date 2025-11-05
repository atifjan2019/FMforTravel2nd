<x-layout title="Items - Al Nafi Travels">
    <x-page-header 
        title="Items" 
        icon="📦" 
        actionUrl="/items/create" 
        actionText="+ Add Item" 
    />

    <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Unit</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                    <tr>
                        <td><strong>{{ $item->name }}</strong></td>
                        <td>{{ $item->category ?? 'N/A' }}</td>
                        <td>{{ $item->unit }}</td>
                        <td>{{ $item->description ?? 'N/A' }}</td>
                        <td>
                            <span class="badge badge-success">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="/items/{{ $item->id }}" class="btn btn-primary">View</a>
                            <a href="/items/{{ $item->id }}/edit" class="btn btn-primary">Edit</a>
                            <form action="/items/{{ $item->id }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align: center; color: #999; padding: 40px;">No items found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
</x-layout>