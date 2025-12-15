<x-layout title="Add Sale - FM Travel Manager" pageTitle="Add New Sale" pageSubtitle="Record a new sale/income">
    <x-slot:styles>
        .form-card {
        max-width: 600px;
        }

        .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
        }

        .form-grid .full-width {
        grid-column: 1 / -1;
        }

        .form-group {
        margin-bottom: 12px;
        }

        .form-group label {
        display: block;
        font-size: 11px;
        font-weight: 600;
        color: var(--text);
        margin-bottom: 4px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
        width: 100%;
        padding: 8px 12px;
        border: 1.5px solid var(--border);
        border-radius: 6px;
        font-size: 12px;
        font-family: 'Poppins', sans-serif;
        transition: all 0.3s ease;
        background: white;
        }

        .form-group textarea {
        min-height: 60px;
        resize: vertical;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 2px rgba(212, 160, 23, 0.1);
        }

        .form-group small {
        color: var(--text-light);
        font-size: 10px;
        display: block;
        margin-top: 3px;
        }

        .form-actions {
        display: flex;
        gap: 10px;
        margin-top: 18px;
        padding-top: 15px;
        border-top: 1px solid var(--border);
        }

        @media (max-width: 640px) {
        .form-grid {
        grid-template-columns: 1fr;
        }
        }
    </x-slot:styles>

    <div class="card form-card">
        <form action="/incomes" method="POST">
            @csrf

            <div class="form-grid">
                <div class="form-group">
                    <label for="customer_id">Customer *</label>
                    <select id="customer_id" name="customer_id" required>
                        <option value="">Select Customer</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="item_id">Item/Service</label>
                    <select id="item_id" name="item_id">
                        <option value="">Select Item (Optional)</option>
                        @foreach($items as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="amount">Amount (Rs) *</label>
                    <input type="number" id="amount" name="amount" step="0.01" required placeholder="0.00">
                </div>

                <div class="form-group">
                    <label for="paid_amount">Paid Amount (Rs)</label>
                    <input type="number" id="paid_amount" name="paid_amount" step="0.01" value="0" min="0"
                        placeholder="0.00">
                    <small>0 = unpaid, full = paid</small>
                </div>

                <div class="form-group">
                    <label for="income_date">Date *</label>
                    <input type="date" id="income_date" name="income_date" value="{{ date('Y-m-d') }}" required>
                </div>

                <div class="form-group">
                    <label for="reference_no">Reference No</label>
                    <input type="text" id="reference_no" name="reference_no" placeholder="Invoice #">
                </div>

                <div class="form-group">
                    <label for="status">Status *</label>
                    <select id="status" name="status" required>
                        <option value="completed">Completed</option>
                        <option value="pending">Pending</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>

                <div class="form-group full-width">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" placeholder="Additional details..."></textarea>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success">💾 Save Sale</button>
                <a href="/incomes" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</x-layout>