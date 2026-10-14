<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Admin Portal') - World Eyes News Management</title>

    <link rel="icon" href="{{ asset('images/TN-36.png') }}" type="image/png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome 6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --admin-sidebar-bg: #0f172a;
            --admin-sidebar-hover: #1e293b;
            --admin-accent: #dc2626;
            --admin-body-bg: #f1f5f9;
        }

        body {
            font-family: 'Inter', system-ui, sans-serif;
            background-color: var(--admin-body-bg);
            color: #1e293b;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Sidebar */
        #adminSidebar {
            width: 260px;
            min-height: 100vh;
            background-color: var(--admin-sidebar-bg);
            color: #94a3b8;
            transition: all 0.3s ease;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 1050;
            overflow-y: auto;
        }

        #adminSidebar .brand-logo {
            padding: 20px;
            font-weight: 800;
            font-size: 1.25rem;
            letter-spacing: -0.02em;
            color: #ffffff;
            border-bottom: 1px solid #1e293b;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        #adminSidebar .nav-link {
            color: #94a3b8;
            padding: 12px 20px;
            font-size: 0.9rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }

        #adminSidebar .nav-link:hover {
            color: #ffffff;
            background-color: var(--admin-sidebar-hover);
        }

        #adminSidebar .nav-link.active {
            color: #ffffff;
            background-color: #1e293b;
            border-left-color: var(--admin-accent);
        }

        #adminSidebar .nav-header {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            font-weight: 700;
            color: #475569;
            padding: 16px 20px 6px;
        }

        /* Main Content Wrapper */
        #adminContent {
            margin-left: 260px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
        }

        /* Top Header */
        .admin-topbar {
            background-color: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 14px 24px;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        /* Stat Cards */
        .stat-card {
            background: #ffffff;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.06);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
        }

        .admin-table {
            background: #ffffff;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        }

        .admin-table th {
            background-color: #f8fafc;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #64748b;
            padding: 12px 16px;
            border-bottom: 1px solid #e2e8f0;
        }

        .admin-table td {
            padding: 14px 16px;
            vertical-align: middle;
            font-size: 0.88rem;
            border-bottom: 1px solid #f1f5f9;
        }

        @media (max-width: 991.98px) {
            #adminSidebar {
                margin-left: -260px;
            }
            #adminSidebar.show {
                margin-left: 0;
            }
            #adminContent {
                margin-left: 0;
            }
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- Sidebar -->
    <aside id="adminSidebar">
        <a href="{{ route('admin.dashboard') }}" class="brand-logo text-decoration-none">
            <span class="text-white">WORLD</span>
            <span class="text-danger">EYES</span>
            <span class="badge bg-danger ms-auto fs-6">ADMIN</span>
        </a>

        <div class="py-2">
            <div class="nav-header">Main Overview</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-gauge-high"></i> Dashboard
            </a>

            <div class="nav-header">Content Desk</div>
            <a href="{{ route('admin.articles.index') }}" class="nav-link {{ request()->routeIs('admin.articles.index') ? 'active' : '' }}">
                <i class="fa-solid fa-newspaper"></i> All Articles
            </a>
            <a href="{{ route('admin.articles.create') }}" class="nav-link {{ request()->routeIs('admin.articles.create') ? 'active' : '' }}">
                <i class="fa-solid fa-square-plus text-danger"></i> Add New Article
            </a>
            <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <i class="fa-solid fa-layer-group"></i> News Desks / Categories
            </a>
            <a href="{{ route('admin.comments.index') }}" class="nav-link {{ request()->routeIs('admin.comments.*') ? 'active' : '' }}">
                <i class="fa-solid fa-comments"></i> Reader Comments
            </a>

            <div class="nav-header">Administration</div>
            <a href="{{ route('admin.settings.index') }}" class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <i class="fa-solid fa-sliders"></i> Portal Settings
            </a>
            <a href="{{ route('admin.profile.edit') }}" class="nav-link {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
                <i class="fa-solid fa-user-shield"></i> Profile & Security
            </a>

            <div class="nav-header">Live Portal</div>
            <a href="{{ route('home') }}" target="_blank" class="nav-link text-info">
                <i class="fa-solid fa-arrow-up-right-from-square"></i> View Live Website
            </a>
        </div>

        <div class="p-3 mt-auto border-top border-secondary">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-danger w-100 btn-sm fw-semibold">
                    <i class="fa-solid fa-right-from-bracket me-2"></i> Sign Out
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div id="adminContent">
        <!-- Topbar -->
        <header class="admin-topbar d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-outline-secondary btn-sm d-lg-none" type="button" id="sidebarToggle">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div class="d-none d-sm-block">
                    <h5 class="fw-bold mb-0 text-dark">@yield('page_title', 'Management Dashboard')</h5>
                    <small class="text-muted">Editorial CMS & Newsroom Control Panel</small>
                </div>
            </div>

            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('home') }}" target="_blank" class="btn btn-sm btn-outline-dark d-none d-md-inline-flex align-items-center gap-1">
                    <i class="fa-solid fa-globe"></i> Visit Website
                </a>

                <div class="dropdown">
                    <button class="btn btn-light btn-sm dropdown-toggle d-flex align-items-center gap-2 border" type="button" data-bs-toggle="dropdown">
                        <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 28px; height: 28px; font-size: 0.8rem;">
                            {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                        </div>
                        <span class="fw-semibold d-none d-sm-inline">{{ auth()->user()->name ?? 'Admin' }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                        <li><h6 class="dropdown-header">{{ auth()->user()->email ?? '' }}</h6></li>
                        <li><a class="dropdown-item" href="{{ route('admin.profile.edit') }}"><i class="fa-solid fa-user me-2"></i> Edit Profile</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.settings.index') }}"><i class="fa-solid fa-gear me-2"></i> Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('admin.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="fa-solid fa-power-off me-2"></i> Log Out
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- Body Container -->
        <main class="p-3 p-md-4 flex-grow-1">
            <!-- Alert Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-triangle-exclamation me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </main>

        <footer class="p-3 text-center text-muted small bg-white border-top">
            World Eyes News CMS v2.0 • Powered by Laravel & MySQL
        </footer>
    </div>

    <!-- Bootstrap 5.3.3 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.getElementById('adminSidebar').classList.toggle('show');
        });
    </script>
    @stack('scripts')
</body>
</html>
