<x-layout title="Supplier Details - FM Travel Manager" pageTitle="Supplier Details"
    pageSubtitle="View supplier profile and financial summary">

    <x-slot:styles>
        /* Polished Profile Card */
        .profile-box {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        border: 1px solid #e5e7eb;
        max-width: 900px;
        margin: 0 auto 24px auto;
        overflow: hidden;
        }

        /* Header Section */
        .profile-header {
        padding: 40px;
        background: linear-gradient(to right, #ffffff, #f9fafb);
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
        }

        .profile-identity {
        display: flex;
        align-items: center;
        gap: 20px;
        }

        .avatar-circle {
        width: 80px;
        height: 80px;
        background: var(--primary);
        color: var(--accent);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        font-weight: 700;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .identity-text h1 {
        font-size: 24px;
        font-weight: 800;
        color: #111827;
        margin-bottom: 4px;
        }

        .identity-text .status-badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        }
        .status-badge.active { background: #d1fae5; color: #065f46; }
        .status-badge.inactive { background: #fee2e2; color: #991b1b; }

        .header-actions {
        display: flex;
        gap: 10px;
        }

        /* Body Content */
        .profile-body {
        padding: 40px;
        }

        .section-title {
        font-size: 14px;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
        }

        .section-title::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #e5e7eb;
        }

        .info-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr); /* 3 Columns for Contact Info */
        gap: 30px;
        margin-bottom: 40px;
        }

        .info-item h4 {
        font-size: 12px;
        font-weight: 700;
        color: #9ca3af;
        text-transform: uppercase;
        margin-bottom: 5px;
        }

        .info-item p {
        font-size: 16px;
        color: #1f2937;
        font-weight: 500;
        }

        /* Financial Bar */
        .financial-bar {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 30px;
        display: flex;
        justify-content: space-around;
        align-items: center;
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }

        .fin-stat {
        text-align: center;
        }

        .fin-stat .label {
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        color: #6b7280;
        margin-bottom: 8px;
        letter-spacing: 0.5px;
        }

        .fin-stat .value {
        font-size: 26px;
        font-weight: 800;
        color: #111827;
        }

        .fin-stat.purchases .value { color: #4b5563; }
        .fin-stat.paid .value { color: #059669; }
        .fin-stat.balance .value { color: #dc2626; }

        .back-nav {
        max-width: 900px;
        margin: 0 auto;
        }
    </x-slot:styles>

    <div class="profile-box">
        <!-- Header -->
        <div class="profile-header">
            <div class="profile-identity">
                <div class="avatar-circle">
                    {{ strtoupper(substr($supplier->name, 0, 1)) }}
                </div>
                <div class="identity-text">
                    <h1>{{ $supplier->name }}</h1>
                    <span class="status-badge {{ $supplier->status == 'active' ? 'active' : 'inactive' }}">
                        {{ $supplier->status }}
                    </span>
                </div>
            </div>
            <div class="header-actions">
                <a href="{{ route('suppliers.ledger', $supplier->id) }}" class="btn btn-success">📒 Ledger</a>
                <a href="/suppliers/{{ $supplier->id }}/edit" class="btn btn-secondary">✏️ Edit</a>
            </div>
        </div>

        <!-- Body -->
        <div class="profile-body">

            <div class="section-title">Contact Information</div>
            <div class="info-grid">
                <div class="info-item">
                    <h4>Phone</h4>
                    <p>{{ $supplier->phone ?? 'Not provided' }}</p>
                </div>
                <div class="info-item">
                    <h4>Email</h4>
                    <p>{{ $supplier->email ?? 'Not provided' }}</p>
                </div>
                <div class="info-item">
                    <h4>Address</h4>
                    <p>{{ $supplier->address ?? 'Not provided' }}</p>
                </div>
            </div>

            <div class="section-title">Financial Overview</div>
            <div class="financial-bar">
                <div class="fin-stat purchases">
                    <div class="label">Total Purchases</div>
                    <div class="value">Rs {{ number_format($supplier->total_purchases) }}</div>
                </div>
                <div class="fin-stat paid">
                    <div class="label">Total Paid</div>
                    <div class="value">Rs {{ number_format($supplier->total_paid) }}</div>
                </div>
                <div class="fin-stat balance">
                    <div class="label">Balance Due</div>
                    <div class="value">Rs {{ number_format($supplier->balance) }}</div>
                </div>
            </div>

        </div>
    </div>

    <div class="back-nav">
        <a href="/suppliers" class="btn btn-secondary">← Back to Suppliers</a>
    </div>

</x-layout>