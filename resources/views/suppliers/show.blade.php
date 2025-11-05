<x-layout title="🏢 Supplier Details - Al Nafi Travels">
    <x-page-header
        title="🏢 Supplier Details"
        icon="🏢"
        backUrl="/suppliers"
    />

    <div class="card">
            <h2 style="margin-bottom: 20px;">{{ $supplier->name }}</h2>
            
            <div class="info-row">
                <div class="info-label">Phone:</div>
                <div class="info-value">{{ $supplier->phone ?? 'N/A' }}</div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Email:</div>
                <div class="info-value">{{ $supplier->email ?? 'N/A' }}</div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Address:</div>
                <div class="info-value">{{ $supplier->address ?? 'N/A' }}</div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Status:</div>
                <div class="info-value">
                    <span class="badge badge-success">{{ ucfirst($supplier->status) }}</span>
                </div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Total Purchases:</div>
                <div class="info-value"><strong>Rs {{ number_format($supplier->total_purchases) }}</strong></div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Total Paid:</div>
                <div class="info-value"><strong>Rs {{ number_format($supplier->total_paid) }}</strong></div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Balance Due:</div>
                <div class="info-value"><strong>Rs {{ number_format($supplier->balance) }}</strong></div>
            </div>
            
            <div style="margin-top: 30px;">
                <a href="/suppliers/{{ $supplier->id }}/ledger" class="btn btn-primary">View Ledger</a>
                <a href="/suppliers" class="btn btn-primary">Back to List</a>
            </div>
        </div>
    </div>
<script src="/js/mobile-menu.js"></script>
</x-layout>
