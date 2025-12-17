<x-layout title="Customer Details - FM Travel Manager" pageTitle="{{ $customer->name }}"
    pageSubtitle="Customer profile and financial summary">
    <x-slot:styles>
        .profile-card {
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: var(--shadow);
        border: 1px solid var(--border);
        margin-bottom: 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
        }

        .profile-left {
        display: flex;
        align-items: center;
        gap: 20px;
        }

        .avatar-large {
        width: 80px;
        height: 80px;
        background: var(--primary); /* Warm Yellow */
        color: var(--accent); /* Dark Grey */
        font-size: 32px;
        font-weight: 700;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 20px rgba(212, 160, 23, 0.3);
        }

        .profile-details h2 {
        font-size: 24px;
        font-weight: 700;
        color: var(--text);
        margin-bottom: 4px;
        }

        .profile-meta {
        display: flex;
        align-items: center;
        gap: 12px;
        color: var(--text-light);
        font-size: 14px;
        }

        .stats-container {
        display: flex;
        gap: 15px;
        }

        .stat-box {
        background: var(--bg);
        padding: 15px 20px;
        border-radius: 12px;
        text-align: center;
        border: 1px solid var(--border);
        min-width: 120px;
        }

        .stat-label {
        font-size: 11px;
        text-transform: uppercase;
        color: var(--text-light);
        font-weight: 600;
        margin-bottom: 4px;
        }

        .stat-value {
        font-size: 18px;
        font-weight: 700;
        color: var(--text);
        }

        .stat-value.highlight {
        color: var(--primary-dark);
        }

        .content-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 24px;
        }

        .info-list {
        list-style: none;
        }

        .info-list li {
        padding: 15px 0;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        gap: 15px;
        }

        .info-list li:last-child {
        border-bottom: none;
        }

        .info-icon {
        width: 40px;
        height: 40px;
        background: var(--bg);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        color: var(--primary-dark);
        }

        .info-content label {
        display: block;
        font-size: 11px;
        color: var(--text-light);
        text-transform: uppercase;
        margin-bottom: 2px;
        }

        .info-content span {
        font-size: 15px;
        font-weight: 500;
        color: var(--text);
        }

        .action-card {
        background: linear-gradient(135deg, #2d2d2d 0%, #1a1a1a 100%);
        color: white;
        }

        .action-card .card-title {
        color: white;
        border-bottom: 1px solid rgba(255,255,255,0.1);
        padding-bottom: 15px;
        margin-bottom: 20px;
        }

        .quick-action-btn {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        background: rgba(255,255,255,0.05);
        color: white;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 10px;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 1px solid rgba(255,255,255,0.05);
        }

        .quick-action-btn:hover {
        background: var(--primary);
        color: var(--accent);
        transform: translateX(5px);
        }

        @media (max-width: 900px) {
        .profile-card {
        flex-direction: column;
        text-align: center;
        gap: 30px;
        padding: 20px;
        }
        .profile-left {
        flex-direction: column;
        }
        .stats-container {
        width: 100%;
        justify-content: space-between;
        }
        .stat-box {
        flex: 1;
        min-width: auto;
        padding: 10px;
        }
        .content-grid {
        grid-template-columns: 1fr;
        }
        }
    </x-slot:styles>

    <!-- Hero Section -->
    <div class="profile-card">
        <div class="profile-left">
            <div class="avatar-large">
                {{ strtoupper(substr($customer->name, 0, 1)) }}
            </div>
            <div class="profile-details">
                <h2>{{ $customer->name }}</h2>
                <div class="profile-meta">
                    <span class="badge {{ $customer->status == 'active' ? 'badge-success' : 'badge-danger' }}">
                        {{ ucfirst($customer->status) }}
                    </span>
                    <span>• Balance Due: <strong style="color: var(--danger)">Rs
                            {{ number_format($customer->balance) }}</strong></span>
                </div>
            </div>
        </div>

        <div class="stats-container">
            <div class="stat-box">
                <div class="stat-label">Total Sales</div>
                <div class="stat-value">Rs {{ number_format($customer->total_income) }}</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">Total Paid</div>
                <div class="stat-value">Rs {{ number_format($customer->total_paid) }}</div>
            </div>
        </div>
    </div>

    <div class="content-grid">
        <!-- Contact Information -->
        <div class="card">
            <h3 class="card-title" style="margin-bottom: 5px;">Contact Details</h3>
            <ul class="info-list">
                <li>
                    <div class="info-icon">📞</div>
                    <div class="info-content">
                        <label>Phone Number</label>
                        <span>{{ $customer->phone ?? 'Not provided' }}</span>
                    </div>
                </li>
                <li>
                    <div class="info-icon">📧</div>
                    <div class="info-content">
                        <label>Email Address</label>
                        <span>{{ $customer->email ?? 'Not provided' }}</span>
                    </div>
                </li>
                <li>
                    <div class="info-icon">📍</div>
                    <div class="info-content">
                        <label>Address</label>
                        <span>{{ $customer->address ?? 'Not provided' }}</span>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Quick Actions -->
        <div class="card action-card">
            <h3 class="card-title">Quick Actions</h3>

            <a href="{{ route('customers.ledger', $customer->id) }}" class="quick-action-btn">
                <span>View Full Ledger</span>
                <span>→</span>
            </a>

            <a href="{{ route('customers.edit', $customer->id) }}" class="quick-action-btn">
                <span>Edit Profile</span>
                <span>✎</span>
            </a>

            <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid rgba(255,255,255,0.1);">
                <form action="{{ route('customers.destroy', $customer->id) }}" method="POST"
                    onsubmit="return confirm('Are you sure? This cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" style="width: 100%;">Delete Customer</button>
                </form>
            </div>
        </div>
    </div>

    <div style="margin-top: 20px;">
        <a href="{{ route('customers.index') }}" class="btn btn-secondary">← Back to Customers List</a>
    </div>

</x-layout>