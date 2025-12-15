<x-layout title="Expenses - FM Travel Manager" pageTitle="Expenses" pageSubtitle="Track all your business expenses">
    <x-slot:styles>
        .page-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 18px;
        }

        .expense-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 15px;
        }

        .expense-card {
            background: var(--card-bg);
            border-radius: 14px;
            padding: 18px;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            border-left: 4px solid var(--accent);
        }

        .expense-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-hover);
        }

        .expense-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 14px;
        }

        .expense-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .expense-category {
            font-size: 14px;
            font-weight: 600;
            color: var(--text);
        }

        .expense-date {
            font-size: 11px;
            color: var(--text-light);
        }

        .expense-amount {
            margin-left: auto;
            font-size: 18px;
            font-weight: 700;
            color: #c62828;
        }

        .expense-desc {
            font-size: 12px;
            color: var(--text-light);
            margin-bottom: 14px;
            padding: 10px;
            background: #f9f5eb;
            border-radius: 8px;
            min-height: 36px;
        }

        .expense-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 12px;
            border-top: 1px solid var(--border);
        }

        .expense-ref {
            font-size: 11px;
            color: var(--text-light);
        }

        .expense-actions {
            display: flex;
            gap: 6px;
        }

        @media (max-width: 640px) {
            .expense-grid {
                grid-template-columns: 1fr;
            }
        }
    </x-slot:styles>

    <div class="page-actions">
        <div class="search-box">
            <input type="text" id="searchInput" placeholder="Search expenses..." onkeyup="filterExpenses()">
        </div>
        <a href="/expenses/create" class="btn btn-success">
            <span>➕</span> Add Expense
        </a>
    </div>

    <div class="expense-grid" id="expenseGrid">
        @forelse($expenses as $expense)
            <div class="expense-card" data-category="{{ strtolower($expense->category) }}">
                <div class="expense-header">
                    <div class="expense-icon">
                        @switch($expense->category)
                            @case('Rent') 🏠 @break
                            @case('Salaries') 👥 @break
                            @case('Utilities') ⚡ @break
                            @case('Marketing') 📢 @break
                            @case('Office Supplies') 📎 @break
                            @case('Transportation') 🚗 @break
                            @case('Communication') 📞 @break
                            @case('Insurance') 🛡️ @break
                            @case('Maintenance') 🔧 @break
                            @default 💸
                        @endswitch
                    </div>
                    <div>
                        <div class="expense-category">{{ $expense->category }}</div>
                        <div class="expense-date">📅 {{ $expense->expense_date->format('d M Y') }}</div>
                    </div>
                    <div class="expense-amount">-Rs {{ number_format($expense->amount) }}</div>
                </div>
                
                <div class="expense-desc">
                    {{ $expense->description ?? 'No description' }}
                </div>
                
                <div class="expense-footer">
                    <div class="expense-ref">
                        @if($expense->reference_no)
                            🏷️ {{ $expense->reference_no }}
                        @endif
                        <span class="badge {{ $expense->status == 'paid' ? 'badge-success' : ($expense->status == 'pending' ? 'badge-warning' : 'badge-danger') }}">
                            {{ ucfirst($expense->status) }}
                        </span>
                    </div>
                    <div class="expense-actions">
                        <a href="/expenses/{{ $expense->id }}" class="btn btn-primary btn-sm">👁️</a>
                        <a href="/expenses/{{ $expense->id }}/edit" class="btn btn-secondary btn-sm">✏️</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-state" style="grid-column: 1 / -1;">
                <div class="icon">💸</div>
                <h3>No expenses yet</h3>
                <p>Start tracking your expenses</p>
                <a href="/expenses/create" class="btn btn-success">Add Expense</a>
            </div>
        @endforelse
    </div>

    <script>
        function filterExpenses() {
            const search = document.getElementById('searchInput').value.toLowerCase();
            document.querySelectorAll('.expense-card').forEach(card => {
                const category = card.getAttribute('data-category');
                card.style.display = category.includes(search) ? 'block' : 'none';
            });
        }
    </script>
</x-layout>