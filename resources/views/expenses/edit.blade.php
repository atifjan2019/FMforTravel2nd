<x-layout title="Edit Expense - Al Nafi Travels" pageTitle="Edit Expense" pageSubtitle="Update expense details">
    <x-slot:styles>
        .form-card { max-width: 500px; }
        .form-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px; }
        .form-grid .full-width { grid-column: 1 / -1; }
        .form-group { margin-bottom: 12px; }
        .form-group label { display: block; font-size: 11px; font-weight: 600; color: var(--text); margin-bottom: 4px; }
        .form-group input, .form-group select, .form-group textarea { width: 100%; padding: 8px 12px; border: 1.5px
        solid var(--border); border-radius: 6px; font-size: 12px; font-family: 'Poppins', sans-serif; background: white;
        }
        .form-group textarea { min-height: 50px; resize: vertical; }
        .form-group input:focus, .form-group select:focus, .form-group textarea:focus { outline: none; border-color:
        var(--primary); box-shadow: 0 0 0 2px rgba(212, 160, 23, 0.1); }
        .form-actions { display: flex; gap: 10px; margin-top: 18px; padding-top: 15px; border-top: 1px solid
        var(--border); }
        .danger-zone { margin-top: 20px; padding-top: 15px; border-top: 1px solid var(--border); }
        @media (max-width: 640px) { .form-grid { grid-template-columns: 1fr; } }
    </x-slot:styles>

    <div class="card form-card">
        <form action="/expenses/{{ $expense->id }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-grid">
                <div class="form-group">
                    <label for="category">Category *</label>
                    <select id="category" name="category" required>
                        <option value="">Select</option>
                        <option value="Rent" {{ $expense->category == 'Rent' ? 'selected' : '' }}>Rent</option>
                        <option value="Salaries" {{ $expense->category == 'Salaries' ? 'selected' : '' }}>Salaries
                        </option>
                        <option value="Utilities" {{ $expense->category == 'Utilities' ? 'selected' : '' }}>Utilities
                        </option>
                        <option value="Marketing" {{ $expense->category == 'Marketing' ? 'selected' : '' }}>Marketing
                        </option>
                        <option value="Office Supplies" {{ $expense->category == 'Office Supplies' ? 'selected' : '' }}>
                            Office Supplies</option>
                        <option value="Transportation" {{ $expense->category == 'Transportation' ? 'selected' : '' }}>
                            Transportation</option>
                        <option value="Communication" {{ $expense->category == 'Communication' ? 'selected' : '' }}>
                            Communication</option>
                        <option value="Insurance" {{ $expense->category == 'Insurance' ? 'selected' : '' }}>Insurance
                        </option>
                        <option value="Maintenance" {{ $expense->category == 'Maintenance' ? 'selected' : '' }}>
                            Maintenance</option>
                        <option value="Other" {{ $expense->category == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="amount">Amount (Rs) *</label>
                    <input type="number" id="amount" name="amount" step="0.01" value="{{ $expense->amount }}" required>
                </div>
                <div class="form-group">
                    <label for="expense_date">Date *</label>
                    <input type="date" id="expense_date" name="expense_date"
                        value="{{ $expense->expense_date->format('Y-m-d') }}" required>
                </div>
                <div class="form-group">
                    <label for="status">Status *</label>
                    <select id="status" name="status" required>
                        <option value="paid" {{ $expense->status == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="pending" {{ $expense->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="cancelled" {{ $expense->status == 'cancelled' ? 'selected' : '' }}>Cancelled
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="reference_no">Reference No</label>
                    <input type="text" id="reference_no" name="reference_no" value="{{ $expense->reference_no }}">
                </div>
                <div class="form-group full-width">
                    <label for="description">Description</label>
                    <textarea id="description" name="description">{{ $expense->description }}</textarea>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-success">💾 Update</button>
                <a href="/expenses" class="btn btn-secondary">Cancel</a>
            </div>
        </form>

        <form action="/expenses/{{ $expense->id }}" method="POST" class="danger-zone"
            onsubmit="return confirm('Delete this expense?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">🗑️ Delete</button>
        </form>
    </div>
</x-layout>