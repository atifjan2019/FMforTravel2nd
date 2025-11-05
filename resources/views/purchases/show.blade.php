<x-layout title="🛒 Purchase Details - Al Nafi Travels">
    <x-page-header
        title="🛒 Purchase Details"
        icon="🛒"
        backUrl="/purchases"
    />

    <div class="card">
            <div class="info-row"><div class="info-label">Purchase Date:</div><div>{{ $purchase->purchase_date->format('d M Y') }}</div></div>
            <div class="info-row"><div class="info-label">Supplier:</div><div>{{ $purchase->supplier->name }}</div></div>
            <div class="info-row"><div class="info-label">Item:</div><div>{{ $purchase->item->name }}</div></div>
            <div class="info-row"><div class="info-label">Quantity:</div><div>{{ $purchase->quantity }}</div></div>
            <div class="info-row"><div class="info-label">Unit Price:</div><div>Rs {{ number_format($purchase->unit_price) }}</div></div>
            <div class="info-row"><div class="info-label">Total Amount:</div><div><strong>Rs {{ number_format($purchase->total_amount) }}</strong></div></div>
            <div class="info-row"><div class="info-label">Reference:</div><div>{{ $purchase->reference_no ?? 'N/A' }}</div></div>
            <div class="info-row"><div class="info-label">Notes:</div><div>{{ $purchase->notes ?? 'N/A' }}</div></div>
            <div style="margin-top: 20px;"><a href="/purchases" class="btn btn-primary">Back to List</a></div>
        </div>
    </div>
<script src="/js/mobile-menu.js"></script>
</x-layout>
