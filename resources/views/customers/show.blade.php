<x-layout title="Customer Details - FM Travel Manager" pageTitle="{{ $customer->name }}"
    pageSubtitle="Customer profile and financial summary">
    <x-slot:styles>
        .profile-header {
        background: linear-gradient(135deg, var(--accent) 0%, #3d3d3d 100%);
        color: white;
        padding: 24px;
        border-radius: 16px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
        }

        .profile-avatar {
        width: 70px;
        height: 70px;
        border-radius: 18px;
        background: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--accent);
        font-size: 28px;
        font-weight: 600;
        }

        .profile-info h2 {
        font-size: 22px;
        margin-bottom: 6px;
        }

        .profile-info p {
        opacity: 0.8;
        font-size: 13px;
        }

        .profile-actions {
        margin-left: auto;
        display: flex;
        gap: 10px;
        }

        .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-bottom: 20px;
        }

        .info-card {
        background: #f9f5eb;
        padding: 16px;
        border-radius: 12px;
        border-left: 4px solid var(--primary);
        }

        .info-label {
        font-size: 10px;
        color: var(--text-light);
        text-transform: uppercase;
        font-weight: 600;
        margin-bottom: 6px;
        }

        .info-value {
        font-size: 14px;
        color: var(--text);
        font-weight: 600;
        }

        .financial-summary {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: var(--accent);
        padding: 24px;
        border-radius: 16px;
        margin-bottom: 20px;
        }

        .financial-summary h3 {
        margin-bottom: 18px;
        font-size: 16px;
        }

        .financial-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        }

        .financial-item {
        text-align: center;
        padding: 14px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 10px;
        }

        .financial-item .label {
        font-size: 10px;
        opacity: 0.9;
        margin-bottom: 6px;
        text-transform: uppercase;
        }

        .financial-item .amount {
        font-size: 20px;
        font-weight: bold;
        }

        @media (max-width: 768px) {
        .profile-header { flex-direction: column; text-align: center; }
        .profile-actions { margin-left: 0; }
        .financial-grid { grid-template-columns: 1fr; }
        }
    </x-slot:styles>

    <div class="profile-header">
        <div class="profile-avatar">{{ strtoupper(substr($customer->name, 0, 1)) }}</div>
        <div class="profile-info">
            <h2>{{ $customer->name }}</h2>
            <p>📱 {{ $customer->phone ?? 'No phone' }} •
                <span
                    class="badge {{ $customer->status == 'active' ? 'badge-success' : 'badge-danger' }}">{{ ucfirst($customer->status) }}</span>
            </p>
        </div>
        <div class="profile-actions">
            <a href="{{ route('customers.ledger', $customer->id) }}" class="btn btn-success">📒 Ledger</a>
            <a href="/customers/{{ $customer->id }}/edit" class="btn btn-secondary">✏️ Edit</a>
        </div>
    </div>

    <div class="card">
        <h3 class="card-title" style="margin-bottom: 16px;">📋 Contact Information</h3>
        <div class="info-grid">
            <div class="info-card">
                <div class="info-label">📞 Phone</div>
                <div class="info-value">{{ $customer->phone ?? 'Not provided' }}</div>
            </div>
            <div class="info-card">
                <div class="info-label">📧 Email</div>
                <div class="info-value">{{ $customer->email ?? 'Not provided' }}</div>
            </div>
            <div class="info-card">
                <div class="info-label">📍 Address</div>
                <div class="info-value">{{ $customer->address ?? 'Not provided' }}</div>
            </div>
        </div>
    </div>

    <div class="financial-summary">
        <h3>💰 Financial Summary</h3>
        <div class="financial-grid">
            <div class="financial-item">
                <div class="label">Total Sales</div>
                <div class="amount">Rs {{ number_format($customer->total_income) }}</div>
            </div>
            <div class="financial-item">
                <div class="label">Total Paid</div>
                <div class="amount">Rs {{ number_format($customer->total_paid) }}</div>
            </div>
            <div class="financial-item">
                <div class="label">Balance Due</div>
                <div class="amount">Rs {{ number_format($customer->balance) }}</div>
            </div>
        </div>
    </div>

    <div class="card">
        <a href="/customers" class="btn btn-secondary">← Back to Customers</a>
    </div>
</x-layout>