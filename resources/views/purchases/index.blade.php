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
                                   <!-- Add Payment Button for Partial -->
                                   <button class="btn btn-info btn-sm" onclick="openPaymentModal({{ $purchase->id }}, {{ $purchase->remaining_amount }})" type="button" style="margin-top: 5px;">Add Payment</button>
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

                    @empty
                    <tr>
                        <td colspan="10" style="text-align: center; color: #999; padding: 40px;">No purchases found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

            <!-- Payment Modal -->
            <div id="paymentModal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.3); z-index:9999; align-items:center; justify-content:center;">
                <div style="background:white; padding:30px 25px; border-radius:10px; min-width:320px; max-width:90vw; box-shadow:0 2px 8px rgba(0,0,0,0.2); position:relative;">
                    <h3 style="margin-bottom:18px; color:#4f46e5;">Add Payment</h3>
                    <form id="paymentForm" method="POST">
                        @csrf
                        <label for="payment_amount">Amount to Pay</label>
                        <input type="number" id="payment_amount" name="amount" min="1" step="0.01" required style="width:100%; margin-bottom:15px; padding:8px; border-radius:5px; border:1px solid #ddd;">
                        <input type="hidden" id="modal_purchase_id">
                        <div style="margin-bottom:10px; color:#666; font-size:13px;">
                            Remaining: Rs <span id="modal_remaining"></span>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Payment</button>
                        <button type="button" class="btn btn-secondary" onclick="closePaymentModal()" style="margin-left:10px;">Cancel</button>
                    </form>
                    <button onclick="closePaymentModal()" style="position:absolute; top:10px; right:15px; background:none; border:none; font-size:20px; color:#888; cursor:pointer;">&times;</button>
                </div>
            </div>

            <script>
            function openPaymentModal(purchaseId, remaining) {
                document.getElementById('paymentModal').style.display = 'flex';
                document.getElementById('modal_purchase_id').value = purchaseId;
                document.getElementById('modal_remaining').innerText = Number(remaining).toLocaleString();
                document.getElementById('payment_amount').max = remaining;
                document.getElementById('payment_amount').value = '';
                // Set form action
                document.getElementById('paymentForm').action = '/purchases/' + purchaseId + '/add-payment';
            }
            function closePaymentModal() {
                document.getElementById('paymentModal').style.display = 'none';
            }
            // Close modal on ESC
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') closePaymentModal();
            });
            </script>
        </div>
</x-layout>