<x-layout title="Incomes - Al Nafi Travels">
    <x-page-header 
        title="Incomes" 
        icon="💰" 
        actionUrl="/incomes/create" 
        actionText="+ Add Income" 
    />

    @if(session('success'))
        <div style="background: #10b981; color: white; padding: 15px; border-radius: 8px; margin-bottom: 20px; font-weight: 600;">
            ✓ {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background: #ef4444; color: white; padding: 15px; border-radius: 8px; margin-bottom: 20px; font-weight: 600;">
            ✗ {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div style="background: #ef4444; color: white; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            <strong>Please fix the following errors:</strong>
            <ul style="margin-top: 10px; margin-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

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
                                <!-- Add Payment Button for Partial -->
                                <button class="btn btn-info btn-sm" onclick="openIncomePaymentModal({{ $income->id }}, {{ $income->remaining_amount }})" type="button" style="margin-top: 5px;">Add Payment</button>
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

        <!-- Income Payment Modal -->
        <div id="incomePaymentModal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.5); z-index:9999; align-items:center; justify-content:center;">
            <div style="background:white; padding:30px; border-radius:10px; min-width:400px; max-width:90vw; box-shadow:0 4px 12px rgba(0,0,0,0.3); position:relative;">
                <h3 style="margin-bottom:20px; color:#10b981;">💰 Receive Payment from Customer</h3>
                <form id="incomePaymentForm" method="POST">
                    @csrf
                    <input type="hidden" id="modal_income_id">
                    
                    <div style="margin-bottom:15px;">
                        <label for="income_payment_amount" style="display:block; margin-bottom:5px; font-weight:600;">Amount (Rs) *</label>
                        <input type="number" id="income_payment_amount" name="amount" min="1" step="0.01" required style="width:100%; padding:10px; border-radius:5px; border:1px solid #ddd;">
                        <small style="color:#666; font-size:12px;">Remaining: Rs <span id="modal_income_remaining"></span></small>
                    </div>
                    
                    <div style="margin-bottom:15px;">
                        <label for="income_payment_method" style="display:block; margin-bottom:5px; font-weight:600;">Payment Method *</label>
                        <select id="income_payment_method" name="payment_method" required style="width:100%; padding:10px; border-radius:5px; border:1px solid #ddd;">
                            <option value="Cash" selected>Cash</option>
                            <option value="Online">Online</option>
                            <option value="Check">Check</option>
                        </select>
                    </div>
                    
                    <div style="margin-bottom:15px;">
                        <label for="income_person_reference" style="display:block; margin-bottom:5px; font-weight:600;">Person + Reference</label>
                        <input type="text" id="income_person_reference" name="person_reference" style="width:100%; padding:10px; border-radius:5px; border:1px solid #ddd;" placeholder="e.g., Jane Smith - INV-456">
                    </div>
                    
                    <div style="margin-bottom:20px;">
                        <label for="income_payment_date" style="display:block; margin-bottom:5px; font-weight:600;">Date & Time *</label>
                        <input type="datetime-local" id="income_payment_date" name="payment_date" required style="width:100%; padding:10px; border-radius:5px; border:1px solid #ddd;">
                    </div>
                    
                    <div style="display:flex; gap:10px;">
                        <button type="submit" class="btn btn-primary" style="flex:1;">Receive Payment</button>
                        <button type="button" class="btn btn-secondary" onclick="closeIncomePaymentModal()" style="flex:1;">Cancel</button>
                    </div>
                </form>
                <button onclick="closeIncomePaymentModal()" style="position:absolute; top:10px; right:15px; background:none; border:none; font-size:24px; color:#888; cursor:pointer;">&times;</button>
            </div>
        </div>

        <script>
        function openIncomePaymentModal(incomeId, remaining) {
            document.getElementById('incomePaymentModal').style.display = 'flex';
            document.getElementById('modal_income_id').value = incomeId;
            document.getElementById('modal_income_remaining').innerText = Number(remaining).toLocaleString();
            document.getElementById('income_payment_amount').max = remaining;
            document.getElementById('income_payment_amount').value = '';
            
            // Set current date and time
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const day = String(now.getDate()).padStart(2, '0');
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            document.getElementById('income_payment_date').value = `${year}-${month}-${day}T${hours}:${minutes}`;
            
            // Set form action
            document.getElementById('incomePaymentForm').action = '/incomes/' + incomeId + '/add-payment';
        }
        function closeIncomePaymentModal() {
            document.getElementById('incomePaymentModal').style.display = 'none';
        }
        // Close modal on ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeIncomePaymentModal();
        });
        </script>
</x-layout>