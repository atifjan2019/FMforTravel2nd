<x-layout title="Item Details - Al Nafi Travels" pageTitle="{{ $item->name }}"
    pageSubtitle="View item/service details">
    <x-slot:styles>
        .item-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: var(--accent);
        padding: 24px;
        border-radius: 16px;
        margin-bottom: 20px;
        text-align: center;
        }

        .item-header .icon { font-size: 48px; margin-bottom: 12px; }
        .item-header h2 { font-size: 22px; margin-bottom: 8px; }

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

        .info-label { font-size: 10px; color: var(--text-light); text-transform: uppercase; font-weight: 600;
        margin-bottom: 6px; }
        .info-value { font-size: 14px; color: var(--text); font-weight: 600; }

        .desc-box {
        background: #f9f5eb;
        padding: 14px;
        border-radius: 10px;
        font-size: 13px;
        color: var(--text);
        }
    </x-slot:styles>

    <div class="item-header">
        <div class="icon">📦</div>
        <h2>{{ $item->name }}</h2>
        <span
            class="badge {{ $item->status == 'active' ? 'badge-success' : 'badge-danger' }}">{{ ucfirst($item->status) }}</span>
    </div>

    <div class="card">
        <h3 class="card-title" style="margin-bottom: 16px;">📋 Item Information</h3>
        <div class="info-grid">
            <div class="info-card">
                <div class="info-label">📁 Category</div>
                <div class="info-value">{{ $item->category ?? 'Not specified' }}</div>
            </div>
            <div class="info-card">
                <div class="info-label">📏 Unit</div>
                <div class="info-value">{{ $item->unit }}</div>
            </div>
            <div class="info-card">
                <div class="info-label">🏷️ Status</div>
                <div class="info-value">{{ ucfirst($item->status) }}</div>
            </div>
        </div>

        @if($item->description)
            <h3 class="card-title" style="margin: 20px 0 12px;">📝 Description</h3>
            <div class="desc-box">{{ $item->description }}</div>
        @endif
    </div>

    <div class="card">
        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
            <a href="/items/{{ $item->id }}/edit" class="btn btn-success">✏️ Edit</a>
            <a href="/items" class="btn btn-secondary">← Back</a>
        </div>
    </div>
</x-layout>