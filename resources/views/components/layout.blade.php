<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'FM Travel Manager' }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/alnafi.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --primary: #d4a017;
            --primary-light: #f5c518;
            --primary-dark: #b8860b;
            --accent: #2d2d2d;
            --accent-light: #3d3d3d;
            --success: #4caf50;
            --success-light: #81c784;
            --warning: #ff9800;
            --danger: #e74c3c;
            --bg: #f9f5eb;
            --bg-light: #fffdf7;
            --card-bg: #ffffff;
            --text: #2d2d2d;
            --text-light: #666666;
            --border: #e8e4d9;
            --shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
            --shadow-hover: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            font-size: 13px;
        }

        /* Main Container */
        .app-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 240px;
            background: linear-gradient(180deg, #1a1a2e 0%, #16213e 50%, #0f0f1a 100%);
            padding: 0;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
            transition: transform 0.3s ease;
            box-shadow: 4px 0 25px rgba(0, 0, 0, 0.15);
        }

        .sidebar-header {
            padding: 24px 20px;
            text-align: center;
            background: linear-gradient(135deg, rgba(212, 160, 23, 0.15) 0%, rgba(245, 197, 24, 0.05) 100%);
            border-bottom: 1px solid rgba(212, 160, 23, 0.2);
            margin-bottom: 8px;
        }

        .sidebar-logo {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
            font-size: 24px;
            box-shadow: 0 4px 15px rgba(212, 160, 23, 0.4);
        }

        .sidebar-header h1 {
            color: #ffffff;
            font-size: 18px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .sidebar-header p {
            color: rgba(255, 255, 255, 0.5);
            font-size: 11px;
            margin-top: 4px;
            font-weight: 400;
        }

        .nav-menu {
            list-style: none;
            padding: 8px 12px;
        }

        .nav-item {
            margin: 4px 0;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background: var(--primary);
            transform: scaleY(0);
            transition: transform 0.3s ease;
            border-radius: 0 2px 2px 0;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.08);
            color: #ffffff;
            transform: translateX(4px);
        }

        .nav-link.active {
            background: linear-gradient(135deg, rgba(212, 160, 23, 0.2) 0%, rgba(212, 160, 23, 0.1) 100%);
            color: var(--primary-light);
            font-weight: 600;
        }

        .nav-link.active::before {
            transform: scaleY(1);
        }

        .nav-link .icon {
            font-size: 18px;
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .nav-link:hover .icon,
        .nav-link.active .icon {
            background: rgba(212, 160, 23, 0.25);
            transform: scale(1.05);
        }

        .nav-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent 0%, rgba(255, 255, 255, 0.1) 50%, transparent 100%);
            margin: 16px 16px;
        }

        .nav-section-title {
            color: rgba(255, 255, 255, 0.35);
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            padding: 12px 16px 6px;
            font-weight: 600;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 240px;
            padding: 20px;
            min-height: 100vh;
            background: var(--bg);
        }

        /* Top Bar */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            background: linear-gradient(135deg, var(--bg-light) 0%, #f5f0e1 100%);
            padding: 15px 20px;
            border-radius: 14px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
        }

        .page-title {
            font-size: 20px;
            font-weight: 600;
            color: var(--text);
        }

        .page-subtitle {
            font-size: 12px;
            color: var(--text-light);
            margin-top: 2px;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-light);
            font-weight: 600;
            font-size: 14px;
        }

        .logout-btn {
            padding: 8px 16px;
            background: var(--accent);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background: var(--primary);
            color: var(--accent);
        }

        /* Cards */
        .card {
            background: var(--card-bg);
            border-radius: 14px;
            padding: 18px;
            box-shadow: var(--shadow);
            margin-bottom: 18px;
            border: 1px solid var(--border);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .card-title {
            font-size: 15px;
            font-weight: 600;
            color: var(--text);
        }

        /* Buttons */
        .btn {
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: var(--accent);
            color: white;
        }

        .btn-primary:hover {
            background: var(--accent-light);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(45, 45, 45, 0.2);
        }

        .btn-success {
            background: var(--primary);
            color: var(--accent);
        }

        .btn-success:hover {
            background: var(--primary-light);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(212, 160, 23, 0.3);
        }

        .btn-danger {
            background: var(--danger);
            color: white;
        }

        .btn-danger:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(231, 76, 60, 0.3);
        }

        .btn-secondary {
            background: #f5f0e1;
            color: var(--text);
            border: 1px solid var(--border);
        }

        .btn-secondary:hover {
            background: var(--border);
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 11px;
        }

        .btn-icon {
            width: 32px;
            height: 32px;
            padding: 0;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        /* Tables */
        .table-container {
            overflow-x: auto;
            border-radius: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px 14px;
            text-align: left;
            border-bottom: 1px solid var(--border);
        }

        th {
            background: #f9f5eb;
            font-weight: 600;
            font-size: 11px;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        tr:hover {
            background: #fffdf7;
        }

        td {
            font-size: 12px;
            color: var(--text);
        }

        .actions {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }

        /* Badges */
        .badge {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: 600;
        }

        .badge-success {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .badge-warning {
            background: #fff3e0;
            color: #e65100;
        }

        .badge-danger {
            background: #ffebee;
            color: #c62828;
        }

        .badge-info {
            background: #fff8e1;
            color: #f57c00;
        }

        /* Forms */
        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 500;
            color: var(--text);
            margin-bottom: 6px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px 14px;
            border: 2px solid var(--border);
            border-radius: 8px;
            font-size: 13px;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
            background: white;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(212, 160, 23, 0.1);
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid var(--border);
        }

        /* Search & Filters */
        .search-box {
            position: relative;
            max-width: 250px;
        }

        .search-box input {
            width: 100%;
            padding: 8px 14px 8px 36px;
            border: 2px solid var(--border);
            border-radius: 8px;
            font-size: 12px;
            background: white;
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--primary);
        }

        .search-box::before {
            content: '🔍';
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 12px;
        }

        /* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            position: fixed;
            bottom: 15px;
            right: 15px;
            width: 48px;
            height: 48px;
            background: var(--accent);
            border: none;
            border-radius: 50%;
            color: var(--primary-light);
            font-size: 22px;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            z-index: 1001;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .mobile-menu-toggle {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .sidebar-overlay.show {
                display: block;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 15px 12px;
            }

            .top-bar {
                flex-direction: column;
                gap: 10px;
                text-align: center;
            }

            .page-title {
                font-size: 18px;
            }

            th,
            td {
                padding: 8px 10px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 40px 15px;
        }

        .empty-state .icon {
            font-size: 40px;
            margin-bottom: 15px;
        }

        .empty-state h3 {
            font-size: 16px;
            color: var(--text);
            margin-bottom: 8px;
        }

        .empty-state p {
            color: var(--text-light);
            margin-bottom: 18px;
            font-size: 12px;
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            animation: fadeIn 0.3s ease;
        }

        /* Collapsed Sidebar */
        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar.collapsed .sidebar-header {
            padding: 24px 10px;
        }

        .sidebar.collapsed .sidebar-header h1,
        .sidebar.collapsed .sidebar-header p,
        .sidebar.collapsed .nav-section-title,
        .sidebar.collapsed .nav-link span:not(.icon) {
            display: none;
        }

        .sidebar.collapsed .sidebar-logo {
            margin-bottom: 0;
            width: 44px;
            height: 44px;
            font-size: 20px;
        }

        .sidebar.collapsed .nav-link {
            justify-content: center;
            padding: 12px;
        }

        .sidebar.collapsed .nav-link .icon {
            margin: 0;
            font-size: 20px;
        }
        
        /* Adjust Main Content */
        .app-container.sidebar-collapsed .main-content {
            margin-left: 80px;
        }

        /* Toggle Button */
        .sidebar-toggle-btn {
            background: none;
            border: none;
            color: var(--text);
            font-size: 24px;
            cursor: pointer;
            margin-right: 15px;
            padding: 4px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .sidebar-toggle-btn:hover {
            background: rgba(0,0,0,0.05);
            color: var(--primary-dark);
        }

        @media (max-width: 1024px) {
            .app-container.sidebar-collapsed .main-content {
                margin-left: 0;
            }
            .sidebar-toggle-btn {
                display: none; /* Hide desktop toggle on mobile */
            }
        }

        {{ $styles ?? '' }}
    </style>
</head>

<body>
    <div class="app-container">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-logo">✈️</div>
                <h1>FM Travel</h1>
                <p>Management System</p>
            </div>

            <nav>
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="/dashboard" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                            <span class="icon">🏠</span>
                            <span>Home</span>
                        </a>
                    </li>

                    <div class="nav-divider"></div>
                    <div class="nav-section-title">Sales & Customers</div>

                    <li class="nav-item">
                        <a href="/customers" class="nav-link {{ request()->is('customers*') ? 'active' : '' }}">
                            <span class="icon">👥</span>
                            <span>Customers</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/incomes" class="nav-link {{ request()->is('incomes*') ? 'active' : '' }}">
                            <span class="icon">💰</span>
                            <span>Sales</span>
                        </a>
                    </li>

                    <div class="nav-divider"></div>
                    <div class="nav-section-title">Purchases & Suppliers</div>

                    <li class="nav-item">
                        <a href="/suppliers" class="nav-link {{ request()->is('suppliers*') ? 'active' : '' }}">
                            <span class="icon">🏢</span>
                            <span>Suppliers</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/purchases" class="nav-link {{ request()->is('purchases*') ? 'active' : '' }}">
                            <span class="icon">🛒</span>
                            <span>Purchases</span>
                        </a>
                    </li>

                    <div class="nav-divider"></div>
                    <div class="nav-section-title">More</div>

                    <li class="nav-item">
                        <a href="/items" class="nav-link {{ request()->is('items*') ? 'active' : '' }}">
                            <span class="icon">📦</span>
                            <span>Items</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/expenses" class="nav-link {{ request()->is('expenses*') ? 'active' : '' }}">
                            <span class="icon">💸</span>
                            <span>Expenses</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/reports" class="nav-link {{ request()->is('reports*') ? 'active' : '' }}">
                            <span class="icon">📊</span>
                            <span>Reports</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Sidebar Overlay for Mobile -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Top Bar -->
            <div class="top-bar">
                <div style="display: flex; align-items: center;">
                    <button id="sidebarToggle" class="sidebar-toggle-btn">☰</button>
                    <div>
                        <h1 class="page-title">{{ $pageTitle ?? 'Dashboard' }}</h1>
                        <p class="page-subtitle">{{ $pageSubtitle ?? 'Welcome to FM Travel Manager' }}</p>
                    </div>
                </div>
                <div class="user-menu">
                    <div class="user-avatar">{{ substr(Auth::user()->name ?? 'A', 0, 1) }}</div>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="logout-btn">Logout</button>
                    </form>
                </div>
            </div>

            <!-- Page Content -->
            {{ $slot }}
        </main>

        <!-- Mobile Menu Toggle -->
        <button class="mobile-menu-toggle" id="mobileMenuToggle" onclick="toggleSidebar()">☰</button>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const container = document.querySelector('.app-container');
        const toggleBtn = document.getElementById('sidebarToggle');
        
        // Load persisted state
        if (localStorage.getItem('sidebar-collapsed') === 'true') {
            sidebar.classList.add('collapsed');
            container.classList.add('sidebar-collapsed');
        }

        if (toggleBtn) {
            toggleBtn.addEventListener('click', () => {
                sidebar.classList.toggle('collapsed');
                container.classList.toggle('sidebar-collapsed');
                localStorage.setItem('sidebar-collapsed', sidebar.classList.contains('collapsed'));
            });
        }

        function toggleSidebar() {
            const overlay = document.getElementById('sidebarOverlay');
            const toggle = document.getElementById('mobileMenuToggle');
            const sidebar = document.getElementById('sidebar'); // Ensure we select it here if not using global variable in this scope

            sidebar.classList.toggle('open');
            overlay.classList.toggle('show');
            toggle.textContent = sidebar.classList.contains('open') ? '✕' : '☰';
        }

        document.getElementById('sidebarOverlay').addEventListener('click', toggleSidebar);
    </script>
</body>

</html>