<x-layout title="📦 Item Details - Al Nafi Travels">
    <x-page-header
        title="📦 Item Details"
        icon="📦"
        backUrl="/items"
    />

    <div class="card">
            <div class="info-row"><div class="info-label">Category:</div><div>{{ $item->category ?? 'N/A' }}</div></div>
            <div class="info-row"><div class="info-label">Unit:</div><div>{{ $item->unit }}</div></div>
            <div class="info-row"><div class="info-label">Description:</div><div>{{ $item->description ?? 'N/A' }}</div></div>
            <div class="info-row"><div class="info-label">Status:</div><div>{{ ucfirst($item->status) }}</div></div>
            <div style="margin-top: 20px;"><a href="/items" class="btn btn-primary">Back to List</a></div>
        </div>
    </div>
<script src="/js/mobile-menu.js"></script>
</x-layout>
