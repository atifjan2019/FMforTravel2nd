<x-layout title="💸 Expense Details - Al Nafi Travels">
    <x-page-header
        title="💸 Expense Details"
        icon="💸"
        backUrl="/expenses"
    />

    <div class="card">
            <div class="info-row"><div class="info-label">Expense Date:</div><div>{{ $expense->expense_date->format('d M Y') }}</div></div>
            <div class="info-row"><div class="info-label">Category:</div><div>{{ $expense->category }}</div></div>
            <div class="info-row"><div class="info-label">Amount:</div><div><strong>Rs {{ number_format($expense->amount) }}</strong></div></div>
            <div class="info-row"><div class="info-label">Reference:</div><div>{{ $expense->reference_no ?? 'N/A' }}</div></div>
            <div class="info-row"><div class="info-label">Description:</div><div>{{ $expense->description ?? 'N/A' }}</div></div>
            <div class="info-row"><div class="info-label">Status:</div><div>{{ ucfirst($expense->status) }}</div></div>
            <div style="margin-top: 20px;"><a href="/expenses" class="btn btn-primary">Back to List</a></div>
        </div>
    </div>
<script src="/js/mobile-menu.js"></script>
</x-layout>
