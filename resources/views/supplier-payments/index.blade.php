<x-layout title="Supplier Payments - Al Nafi Travels">
    <x-page-header 
        title="Supplier Payments" 
        icon="💵" 
        actionUrl="/supplier-payments/create" 
        actionText="+ Add Supplier Payment" 
    />

    <div class="card">
            <h3 style="margin-bottom: 20px;">💳 Supplier Payment Records: {{ $payments->count() }}</h3>
            <table>
                <thead>
                    <tr><th>Date</th><th>Supplier</th><th>Amount</th><th>Method</th><th>Reference</th><th>Notes</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    @forelse($payments as $payment)
                    <tr>
                        <td>{{ $payment->payment_date->format('d M Y') }}</td>
                        <td><a href="/suppliers/{{ $payment->supplier->id }}" style="color: #667eea; text-decoration: none; font-weight: 600;">{{ $payment->supplier->name }}</a></td>
                        <td><strong style="color: #10b981;">Rs {{ number_format($payment->amount) }}</strong></td>
                        <td><span style="background: #e0e7ff; padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 600;">{{ ucfirst($payment->payment_method) }}</span></td>
                        <td>{{ $payment->reference_no ?? 'N/A' }}</td>
                        <td>{{ $payment->notes ?? '-' }}</td>
                        <td class="actions">
                            <a href="/supplier-payments/{{ $payment->id }}/edit" class="btn btn-primary">Edit</a>
                            <form action="/supplier-payments/{{ $payment->id }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this payment?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" style="text-align: center; padding: 40px; color: #999;">No payments found</td></tr>
                    @endforelse
                </tbody>
            </table>
            @if($payments->hasPages())
            <div style="margin-top: 20px; text-align: center;">
                {{ $payments->links() }}
            </div>
            @endif
        </div>
    </div>
<script
</x-layout>