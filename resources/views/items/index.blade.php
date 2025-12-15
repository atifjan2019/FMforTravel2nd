<x-layout title="Items - FM Travel Manager" pageTitle="Items" pageSubtitle="Manage your products and services">
    <x-slot:styles>
        .page-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 18px;
        }

        .item-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 15px;
        }

        .item-card {
        background: var(--card-bg);
        border-radius: 14px;
        padding: 18px;
        box-shadow: var(--shadow);
        transition: all 0.3s ease;
        border: 2px solid transparent;
        text-align: center;
        }

        .item-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-hover);
        border-color: var(--primary);
        }

        .item-icon {
        width: 55px;
        height: 55px;
        border-radius: 16px;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        margin: 0 auto 14px;
        }

        .item-name {
        font-size: 15px;
        font-weight: 600;
        color: var(--text);
        margin-bottom: 6px;
        }

        .item-meta {
        display: flex;
        justify-content: center;
        gap: 12px;
        margin-bottom: 14px;
        }

        .item-meta-item {
        font-size: 11px;
        color: var(--text-light);
        padding: 4px 10px;
        background: #f9f5eb;
        border-radius: 6px;
        }

        .item-desc {
        font-size: 11px;
        color: var(--text-light);
        margin-bottom: 14px;
        min-height: 30px;
        }

        .item-actions {
        display: flex;
        gap: 8px;
        justify-content: center;
        }

        @media (max-width: 640px) {
        .item-grid {
        grid-template-columns: repeat(2, 1fr);
        }
        }
    </x-slot:styles>

    <div class="page-actions">
        <div class="search-box">
            <input type="text" id="searchInput" placeholder="Search items..." onkeyup="filterItems()">
        </div>
        <a href="/items/create" class="btn btn-success">
            <span>➕</span> Add Item
        </a>
    </div>

    <div class="item-grid" id="itemGrid">
        @forelse($items as $item)
            <div class="item-card" data-name="{{ strtolower($item->name) }}">
                <div class="item-icon">📦</div>
                <div class="item-name">{{ $item->name }}</div>
                <div class="item-meta">
                    @if($item->category)
                        <span class="item-meta-item">{{ $item->category }}</span>
                    @endif
                    <span class="item-meta-item">{{ $item->unit }}</span>
                </div>
                <div class="item-desc">
                    {{ Str::limit($item->description, 50) ?? 'No description' }}
                </div>
                <div style="margin-bottom: 12px;">
                    <span class="badge {{ $item->status == 'active' ? 'badge-success' : 'badge-danger' }}">
                        {{ ucfirst($item->status) }}
                    </span>
                </div>
                <div class="item-actions">
                    <a href="/items/{{ $item->id }}" class="btn btn-primary btn-sm">👁️ View</a>
                    <a href="/items/{{ $item->id }}/edit" class="btn btn-secondary btn-sm">✏️ Edit</a>
                </div>
            </div>
        @empty
            <div class="empty-state" style="grid-column: 1 / -1;">
                <div class="icon">📦</div>
                <h3>No items yet</h3>
                <p>Add your first item or service</p>
                <a href="/items/create" class="btn btn-success">Add Item</a>
            </div>
        @endforelse
    </div>

    <script>
        function filterItems() {
            const search = document.getElementById('searchInput').value.toLowerCase();
            document.querySelectorAll('.item-card').forEach(card => {
                const name = card.getAttribute('data-name');
                card.style.display = name.includes(search) ? 'block' : 'none';
            });
        }
    </script>
</x-layout>