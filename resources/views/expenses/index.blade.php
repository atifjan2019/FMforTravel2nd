<x-layout title="Expenses - Al Nafi Travels">
    <x-page-header 
        title="Expenses" 
        icon="💸" 
        actionUrl="/expenses/create" 
        actionText="+ Add Expense" 
    />

    <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Category</th>
                        <th>Amount</th>
                        <th>Reference</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($expenses as $expense)
                    <tr>
                        <td>{{ $expense->expense_date->format('d M Y') }}</td>
                        <td>{{ $expense->category }}</td>
                        <td><strong>Rs {{ number_format($expense->amount) }}</strong></td>
                        <td>{{ $expense->reference_no ?? 'N/A' }}</td>
                        <td>{{ $expense->description ?? 'N/A' }}</td>
                        <td>
                            <a href="/expenses/{{ $expense->id }}" class="btn btn-primary">View</a>
                            <a href="/expenses/{{ $expense->id }}/edit" class="btn btn-primary">Edit</a>
                            <form action="/expenses/{{ $expense->id }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this expense?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align: center; color: #999; padding: 40px;">No expenses found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
</x-layout>