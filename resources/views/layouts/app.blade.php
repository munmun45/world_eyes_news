<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', $siteSettings['site_name'] ?? 'World Eyes News') - {{ $siteSettings['tagline'] ?? 'Global Insight, Uncompromised Truth' }}</title>
    <meta name="description" content="@yield('meta_description', $siteSettings['about_text'] ?? 'World Eyes News - Breaking Global News, Investigative Reporting, and In-Depth Analysis')">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/TN-36.png') }}" type="image/png">

    <!-- Google Fonts: Inter & Merriweather -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Merriweather:ital,wght@0,300;0,400;0,700;1,300;1,400&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome 6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --wen-primary: #dc2626;
            --wen-dark: #0f172a;
            --wen-dark-card: #1e293b;
            --wen-border: #e2e8f0;
            --wen-muted: #64748b;
            --wen-font-sans: 'Inter', system-ui, -apple-system, sans-serif;
            --wen-font-serif: 'Merriweather', Georgia, serif;
        }

        body {
            font-family: var(--wen-font-sans);
            color: #1e293b;
            background-color: #f8fafc;
            overflow-x: hidden;
            margin: 0;
            padding: 0;
        }

        h1, h2, h3, .serif-font {
            font-family: var(--wen-font-serif);
            letter-spacing: -0.02em;
        }

        a {
            color: inherit;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        a:hover {
            color: var(--wen-primary);
        }

        /* Top Bar */
        .top-utility-bar {
            background-color: #0b1120;
            color: #94a3b8;
            font-size: 0.82rem;
            padding: 6px 0;
            border-bottom: 1px solid #1e293b;
        }

        .top-utility-bar a {
            color: #cbd5e1;
        }

        .top-utility-bar a:hover {
            color: #ffffff;
        }

        /* Breaking Bar */
        .breaking-bar {
            background-color: #1e293b;
            color: #ffffff;
            font-size: 0.85rem;
            overflow: hidden;
            border-bottom: 2px solid var(--wen-primary);
        }

        .breaking-badge {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            color: #ffffff;
            font-weight: 700;
            font-size: 0.75rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 7px 14px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            z-index: 2;
        }

        .breaking-marquee-container {
            overflow: hidden;
            white-space: nowrap;
            position: relative;
            padding: 6px 0;
        }

        .breaking-marquee {
            display: inline-block;
            animation: marqueeScroll 35s linear infinite;
        }

        .breaking-marquee:hover {
            animation-play-state: paused;
        }

        @keyframes marqueeScroll {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }

        .breaking-item {
            display: inline-block;
            margin-right: 32px;
            color: #e2e8f0;
        }

        .breaking-item:hover {
            color: #fca5a5;
        }

        /* Brand Header */
        .brand-header {
            background-color: #ffffff;
            border-bottom: 1px solid var(--wen-border);
            padding: 16px 0;
        }

        .brand-title {
            font-family: var(--wen-font-serif);
            font-size: 2.3rem;
            font-weight: 900;
            color: #0f172a;
            letter-spacing: -0.03em;
            line-height: 1;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .brand-title .brand-eye {
            color: var(--wen-primary);
        }

        .brand-subtitle {
            font-size: 0.72rem;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: var(--wen-muted);
            margin-top: 4px;
            font-weight: 600;
        }

        /* Main Navbar */
        .main-navbar {
            background-color: #0f172a;
            border-bottom: 3px solid var(--wen-primary);
            box-shadow: 0 4px 12px rgba(0,0,0,0.06);
            position: sticky;
            top: 0;
            z-index: 1020;
        }

        .main-navbar .nav-link {
            color: #f1f5f9 !important;
            font-weight: 600;
            font-size: 0.88rem;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            padding: 12px 14px !important;
            transition: all 0.2s ease;
            position: relative;
        }

        .main-navbar .nav-link:hover,
        .main-navbar .nav-link.active {
            color: #ffffff !important;
            background-color: rgba(220, 38, 38, 0.18);
        }

        .main-navbar .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 14px;
            right: 14px;
            height: 3px;
            background-color: var(--wen-primary);
        }

        /* News Cards */
        .news-card {
            background: #ffffff;
            border-radius: 8px;
            border: 1px solid var(--wen-border);
            overflow: hidden;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .news-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .news-card-img-wrapper {
            position: relative;
            overflow: hidden;
            width: 100%;
            padding-top: 60%; /* 16:9 approx */
            background-color: #e2e8f0;
        }

        .news-card-img-wrapper img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .news-card:hover .news-card-img-wrapper img {
            transform: scale(1.05);
        }

        .category-badge {
            display: inline-block;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 3px 8px;
            border-radius: 4px;
            color: #ffffff;
        }

        .badge-floating {
            position: absolute;
            top: 12px;
            left: 12px;
            z-index: 2;
            box-shadow: 0 2px 6px rgba(0,0,0,0.3);
        }

        /* Lead Story Card */
        .lead-story-card {
            background: #0f172a;
            color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 12px 30px rgba(0,0,0,0.25);
        }

        .lead-story-img-wrapper {
            position: relative;
            min-height: 400px;
            height: 100%;
            background-color: #0b1120;
        }

        .lead-story-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .lead-story-overlay {
            background: linear-gradient(to top, rgba(15, 23, 42, 0.95) 0%, rgba(15, 23, 42, 0.4) 60%, transparent 100%);
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 32px;
        }

        /* Section Headers */
        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid var(--wen-dark);
            padding-bottom: 8px;
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 1.35rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: -0.01em;
            margin: 0;
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .section-title::before {
            content: '';
            display: inline-block;
            width: 5px;
            height: 22px;
            background-color: var(--wen-primary);
            border-radius: 2px;
        }

        /* Sidebar Widgets */
        .widget-box {
            background: #ffffff;
            border: 1px solid var(--wen-border);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 24px;
        }

        .widget-title {
            font-size: 1.1rem;
            font-weight: 700;
            border-bottom: 2px solid var(--wen-primary);
            padding-bottom: 8px;
            margin-bottom: 16px;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .trending-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 10px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .trending-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .trending-num {
            font-family: var(--wen-font-serif);
            font-size: 1.8rem;
            font-weight: 900;
            color: #cbd5e1;
            line-height: 1;
            min-width: 32px;
        }

        /* Footer */
        .main-footer {
            background-color: #0b1120;
            color: #94a3b8;
            padding-top: 50px;
            border-top: 4px solid var(--wen-primary);
            margin-top: 60px;
        }

        .footer-heading {
            color: #f8fafc;
            font-size: 1rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 18px;
            position: relative;
            padding-bottom: 8px;
        }

        .footer-heading::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 30px;
            height: 2px;
            background-color: var(--wen-primary);
        }

        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links li {
            margin-bottom: 10px;
        }

        .footer-links a {
            color: #94a3b8;
            font-size: 0.9rem;
            transition: color 0.2s, padding-left 0.2s;
        }

        .footer-links a:hover {
            color: #ffffff;
            padding-left: 4px;
        }

        .footer-bottom {
            background-color: #070a12;
            padding: 20px 0;
            border-top: 1px solid #1e293b;
            font-size: 0.82rem;
            color: #64748b;
        }

        /* Offcanvas Mobile Nav */
        .offcanvas-mobile {
            background-color: #0f172a;
            color: #ffffff;
        }

        .offcanvas-mobile .nav-link {
            color: #cbd5e1;
            padding: 10px 15px;
            font-size: 1.05rem;
            border-bottom: 1px solid #1e293b;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .offcanvas-mobile .nav-link:hover {
            color: #ffffff;
            background-color: rgba(220, 38, 38, 0.15);
        }

        /* Mobile Adjustments */
        @media (max-width: 768px) {
            .brand-title {
                font-size: 1.6rem;
            }
            .lead-story-overlay {
                padding: 18px;
            }
            .lead-story-overlay h2 {
                font-size: 1.35rem !important;
            }
            .lead-story-img-wrapper {
                min-height: 280px;
            }
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- 1. Top Utility Bar -->
    <div class="top-utility-bar">
        <div class="container d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div class="d-flex align-items-center gap-3">
                <span><i class="fa-regular fa-calendar-days text-danger me-1"></i> {{ now()->format('l, F j, Y') }}</span>
                <span class="d-none d-md-inline text-secondary">|</span>
                <span class="d-none d-md-inline"><i class="fa-solid fa-earth-americas text-primary me-1"></i> Global Edition</span>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="social-links d-none d-sm-flex align-items-center gap-2">
                    @if(!empty($siteSettings['social_facebook']))
                        <a href="{{ $siteSettings['social_facebook'] }}" target="_blank" title="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    @endif
                    @if(!empty($siteSettings['social_twitter']))
                        <a href="{{ $siteSettings['social_twitter'] }}" target="_blank" title="Twitter / X"><i class="fa-brands fa-x-twitter"></i></a>
                    @endif
                    @if(!empty($siteSettings['social_instagram']))
                        <a href="{{ $siteSettings['social_instagram'] }}" target="_blank" title="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    @endif
                    @if(!empty($siteSettings['social_youtube']))
                        <a href="{{ $siteSettings['social_youtube'] }}" target="_blank" title="YouTube"><i class="fa-brands fa-youtube"></i></a>
                    @endif
                </div>
                <span class="text-secondary">|</span>
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-danger py-0 px-2 fw-semibold">
                        <i class="fa-solid fa-gauge me-1"></i> Admin Panel
                    </a>
                @else
                    <a href="{{ route('admin.login') }}" class="fw-semibold">
                        <i class="fa-solid fa-lock me-1"></i> Admin Login
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- 2. Breaking News Ticker (Dynamic) -->
    @if(isset($globalBreaking) && $globalBreaking->isNotEmpty())
        <div class="breaking-bar">
            <div class="container-fluid p-0 d-flex align-items-center">
                <div class="breaking-badge flex-shrink-0">
                    <i class="fa-solid fa-bolt fa-fade"></i> Breaking News
                </div>
                <div class="breaking-marquee-container flex-grow-1">
                    <div class="breaking-marquee">
                        @foreach($globalBreaking as $bItem)
                            <a href="{{ route('article.show', $bItem->slug) }}" class="breaking-item">
                                <span class="badge bg-danger me-1">{{ $bItem->category->name ?? 'News' }}</span>
                                {{ $bItem->title }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- 3. Brand Header -->
    <header class="brand-header">
        <div class="container d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <a href="{{ route('home') }}" class="brand-title">
                    <span>WORLD</span>
                    <span class="brand-eye">EYES</span>
                    <span>NEWS</span>
                </a>
                <div class="brand-subtitle">{{ $siteSettings['tagline'] ?? 'GLOBAL INSIGHT • UNCOMPROMISED TRUTH' }}</div>
            </div>

            <!-- Header Search Bar -->
            <div class="header-search-box flex-grow-1 flex-md-grow-0" style="min-width: 260px; max-width: 360px;">
                <form action="{{ route('search') }}" method="GET" class="input-group">
                    <input type="text" name="q" class="form-control form-control-sm border-end-0" placeholder="Search news, topics, tags..." value="{{ request('q') }}" required>
                    <button class="btn btn-sm btn-danger border-start-0 px-3" type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- 4. Main Navigation Bar -->
    <nav class="navbar navbar-expand-lg main-navbar">
        <div class="container">
            <!-- Mobile Menu Toggle Button -->
            <button class="navbar-toggler text-white border-secondary p-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenuOffcanvas" aria-controls="mobileMenuOffcanvas">
                <i class="fa-solid fa-bars fs-4"></i>
            </button>

            <a class="navbar-brand d-lg-none text-white fw-bold serif-font m-0" href="{{ route('home') }}">
                <span class="text-danger">WEN</span> FEED
            </a>

            <!-- Desktop Nav Links -->
            <div class="collapse navbar-collapse" id="desktopNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 flex-wrap">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="fa-solid fa-house me-1"></i> Home
                        </a>
                    </li>
                    @foreach($navCategories as $cat)
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('category/' . $cat->slug) ? 'active' : '' }}" href="{{ route('category.show', $cat->slug) }}">
                                {{ $cat->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>

    <!-- Mobile Offcanvas Menu Drawer -->
    <div class="offcanvas offcanvas-start offcanvas-mobile" tabindex="-1" id="mobileMenuOffcanvas" aria-labelledby="mobileMenuLabel">
        <div class="offcanvas-header border-bottom border-secondary">
            <h5 class="offcanvas-title fw-bold serif-font text-white" id="mobileMenuLabel">
                WORLD <span class="text-danger">EYES</span> NEWS
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-0">
            <div class="p-3 bg-dark">
                <form action="{{ route('search') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control form-control-sm bg-secondary text-white border-0" placeholder="Search..." required>
                        <button class="btn btn-danger btn-sm" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
            </div>
            <nav class="nav flex-column">
                <a class="nav-link {{ request()->routeIs('home') ? 'text-danger fw-bold' : '' }}" href="{{ route('home') }}">
                    <span><i class="fa-solid fa-house me-2"></i> Home</span>
                </a>
                @foreach($navCategories as $cat)
                    <a class="nav-link {{ request()->is('category/' . $cat->slug) ? 'text-danger fw-bold' : '' }}" href="{{ route('category.show', $cat->slug) }}">
                        <span>{{ $cat->name }}</span>
                        <span class="badge bg-secondary rounded-pill font-monospace">{{ $cat->published_articles_count }}</span>
                    </a>
                @endforeach
            </nav>
            <div class="p-4 mt-auto border-top border-secondary">
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-danger w-100 mb-2">
                        <i class="fa-solid fa-gauge me-2"></i> Admin Panel
                    </a>
                @else
                    <a href="{{ route('admin.login') }}" class="btn btn-outline-light w-100">
                        <i class="fa-solid fa-lock me-2"></i> Staff Login
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Main Content Area -->
    <main class="py-4">
        @yield('content')
    </main>

    <!-- 5. Footer -->
    <footer class="main-footer">
        <div class="container pb-4">
            <div class="row g-4">
                <!-- Col 1: About -->
                <div class="col-lg-4 col-md-6">
                    <h5 class="brand-title text-white mb-2" style="font-size: 1.6rem;">
                        <span>WORLD</span> <span class="text-danger">EYES</span> <span>NEWS</span>
                    </h5>
                    <p class="small text-secondary mb-3">
                        {{ $siteSettings['about_text'] ?? 'World Eyes News provides unbiased global coverage, in-depth reports, and breaking news updates from around the world.' }}
                    </p>
                    <div class="d-flex gap-2">
                        @if(!empty($siteSettings['social_facebook']))
                            <a href="{{ $siteSettings['social_facebook'] }}" class="btn btn-sm btn-outline-secondary rounded-circle" style="width:34px;height:34px;" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                        @endif
                        @if(!empty($siteSettings['social_twitter']))
                            <a href="{{ $siteSettings['social_twitter'] }}" class="btn btn-sm btn-outline-secondary rounded-circle" style="width:34px;height:34px;" target="_blank"><i class="fa-brands fa-x-twitter"></i></a>
                        @endif
                        @if(!empty($siteSettings['social_instagram']))
                            <a href="{{ $siteSettings['social_instagram'] }}" class="btn btn-sm btn-outline-secondary rounded-circle" style="width:34px;height:34px;" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                        @endif
                        @if(!empty($siteSettings['social_youtube']))
                            <a href="{{ $siteSettings['social_youtube'] }}" class="btn btn-sm btn-outline-secondary rounded-circle" style="width:34px;height:34px;" target="_blank"><i class="fa-brands fa-youtube"></i></a>
                        @endif
                    </div>
                </div>

                <!-- Col 2: Categories -->
                <div class="col-lg-3 col-md-6">
                    <div class="footer-heading">News Desks</div>
                    <ul class="footer-links">
                        @foreach($navCategories->take(6) as $cat)
                            <li>
                                <a href="{{ route('category.show', $cat->slug) }}">
                                    <i class="fa-solid fa-chevron-right text-danger me-1 small"></i> {{ $cat->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Col 3: Quick Links -->
                <div class="col-lg-2 col-md-6">
                    <div class="footer-heading">Company</div>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="#about">About Editorial</a></li>
                        <li><a href="#press">Press Releases</a></li>
                        <li><a href="#careers">Careers</a></li>
                        <li><a href="{{ route('admin.login') }}">Staff Portal</a></li>
                    </ul>
                </div>

                <!-- Col 4: Newsletter -->
                <div class="col-lg-3 col-md-6">
                    <div class="footer-heading">Morning Dispatch</div>
                    <p class="small text-secondary">Subscribe to receive daily curated briefings delivered directly to your inbox.</p>
                    <form onsubmit="event.preventDefault(); alert('Thank you for subscribing to World Eyes News Daily Dispatch!'); this.reset();">
                        <div class="input-group mb-2">
                            <input type="email" class="form-control form-control-sm bg-dark text-white border-secondary" placeholder="Enter your email" required>
                            <button class="btn btn-danger btn-sm px-3" type="submit">Join</button>
                        </div>
                    </form>
                    <span class="small text-muted" style="font-size:0.75rem;">No spam. Unsubscribe anytime.</span>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div>
                    {{ $siteSettings['footer_copyright'] ?? '© ' . date('Y') . ' World Eyes News. All rights reserved.' }}
                </div>
                <div class="d-flex gap-3">
                    <a href="#" class="text-secondary">Privacy Policy</a>
                    <a href="#" class="text-secondary">Terms of Service</a>
                    <a href="#" class="text-secondary">Code of Ethics</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5.3.3 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
