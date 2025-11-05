<x-layout title="👤 Customer Details - Al Nafi Travels">
    <x-page-header
        title="👤 Customer Details"
        icon="👥"
        backUrl="/customers"
    />

    <div class="card">
            <h2 style="margin-bottom: 20px;">{{ $customer->name }}</h2>
            
            <div class="info-row">
                <div class="info-label">Phone:</div>
                <div class="info-value">{{ $customer->phone ?? 'N/A' }}</div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Email:</div>
                <div class="info-value">{{ $customer->email ?? 'N/A' }}</div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Address:</div>
                <div class="info-value">{{ $customer->address ?? 'N/A' }}</div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Status:</div>
                <div class="info-value">
                    <span class="badge badge-success">{{ ucfirst($customer->status) }}</span>
                </div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Total Income:</div>
                <div class="info-value"><strong>Rs {{ number_format($customer->total_income) }}</strong></div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Total Paid:</div>
                <div class="info-value"><strong>Rs {{ number_format($customer->total_paid) }}</strong></div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Balance:</div>
                <div class="info-value"><strong>Rs {{ number_format($customer->balance) }}</strong></div>
            </div>
            
            <div style="margin-top: 30px;">
                <a href="/customers/{{ $customer->id }}/ledger" class="btn btn-primary">View Ledger</a>
                <a href="/customers" class="btn btn-primary">Back to List</a>
            </div>
        </div>
    </div>
</x-layout>
