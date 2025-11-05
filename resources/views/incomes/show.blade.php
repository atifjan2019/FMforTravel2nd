<x-layout title="💰 Income Details - Al Nafi Travels">
    <x-page-header
        title="💰 Income Details"
        icon="💰"
        backUrl="/incomes"
    />

    <div class="card">
            <div class="info-row"><div class="info-label">Income Date:</div><div>{{ $income->income_date->format('d M Y') }}</div></div>
            <div class="info-row"><div class="info-label">Customer:</div><div>{{ $income->customer->name }}</div></div>
            <div class="info-row"><div class="info-label">Item:</div><div>{{ $income->item->name ?? 'N/A' }}</div></div>
            <div class="info-row"><div class="info-label">Amount:</div><div><strong>Rs {{ number_format($income->amount) }}</strong></div></div>
            <div class="info-row"><div class="info-label">Reference:</div><div>{{ $income->reference_no ?? 'N/A' }}</div></div>
            <div class="info-row"><div class="info-label">Description:</div><div>{{ $income->description ?? 'N/A' }}</div></div>
            <div class="info-row"><div class="info-label">Status:</div><div>{{ ucfirst($income->status) }}</div></div>
            <div style="margin-top: 20px;"><a href="/incomes" class="btn btn-primary">Back to List</a></div>
        </div>
    </div>
<script src="/js/mobile-menu.js"></script>
</x-layout>
