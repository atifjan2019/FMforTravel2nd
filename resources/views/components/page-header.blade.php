@props(['title', 'icon' => '📄', 'backUrl' => '/', 'actionUrl' => null, 'actionText' => '+ Add'])

<header>
    <div class="header-left">
        @if($actionUrl)
            <a href="{{ $actionUrl }}" class="btn btn-success">{{ $actionText }}</a>
        @endif
    </div>
    <div class="header-center">
        <h1>{{ $icon }} {{ $title }}</h1>
    </div>
    <div class="header-right">
        <!-- Hamburger menu will be inserted here by JavaScript -->
    </div>
    <nav style="margin-top: 10px;">
        <a href="/">🏠 Dashboard</a>
        <a href="/customers">👥 Customers</a>
        <a href="/suppliers">🏢 Suppliers</a>
        <a href="/items">📦 Items</a>
        <a href="/purchases">🛒 Purchases</a>
        <a href="/incomes">💰 Incomes</a>
        <a href="/expenses">💸 Expenses</a>
        <a href="/reports">📊 Reports</a>
    </nav>
</header>
