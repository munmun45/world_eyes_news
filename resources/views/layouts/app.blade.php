<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', ($siteSettings['site_name'] ?? 'World Eyes News') . ' - ' . ($siteSettings['tagline'] ?? 'Bringing The World Closer'))</title>
    <meta name="description" content="@yield('meta_description', $siteSettings['about_text'] ?? 'World Eyes News - Bringing The World Closer. Verified news, in-depth reports, and breaking updates.')">
    <link rel="canonical" href="@yield('canonical_url', url()->current())">

    <!-- Open Graph (Facebook, WhatsApp, Instagram, LinkedIn, Telegram) -->
    <meta property="og:site_name" content="{{ $siteSettings['site_name'] ?? 'World Eyes News' }}">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="@yield('og_url', url()->current())">
    <meta property="og:title" content="@yield('og_title', ($siteSettings['site_name'] ?? 'World Eyes News') . ' - ' . ($siteSettings['tagline'] ?? 'Bringing The World Closer'))">
    <meta property="og:description" content="@yield('og_description', $siteSettings['about_text'] ?? 'World Eyes News - Bringing The World Closer. Verified news, in-depth reports, and breaking updates.')">
    <meta property="og:image" content="@yield('og_image', asset('images/world_eyes_news_main_logo.png'))">
    <meta property="og:image:secure_url" content="@yield('og_image', asset('images/world_eyes_news_main_logo.png'))">
    <meta property="og:image:width" content="@yield('og_image_width', '1200')">
    <meta property="og:image:height" content="@yield('og_image_height', '630')">
    <meta property="og:image:alt" content="@yield('og_title', $siteSettings['site_name'] ?? 'World Eyes News')">
    <meta property="og:locale" content="en_US">
    @yield('extra_og_tags')

    <!-- Twitter / X Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@worldeyesnet">
    <meta name="twitter:creator" content="@worldeyesnet">
    <meta name="twitter:url" content="@yield('og_url', url()->current())">
    <meta name="twitter:title" content="@yield('og_title', ($siteSettings['site_name'] ?? 'World Eyes News'))">
    <meta name="twitter:description" content="@yield('og_description', $siteSettings['about_text'] ?? 'World Eyes News - Bringing The World Closer.')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/world_eyes_news_main_logo.png'))">

    <!-- Favicon & App Icons -->
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="36x36" href="{{ asset('images/TN-36.png') }}">
    <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('images/TN-48.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('images/TN-96.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('images/TN-192.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('images/TN-144.png') }}">
    <link rel="apple-touch-icon" sizes="192x192" href="{{ asset('images/TN-192.png') }}">
    <link rel="apple-touch-icon" sizes="512x512" href="{{ asset('images/TN-512.png') }}">

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
            padding: 5px 0;
        }

        .breaking-badge {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            color: #ffffff;
            font-weight: 700;
            font-size: 0.75rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 5px 12px;
            border-radius: 4px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            z-index: 2;
            box-shadow: 0 1px 3px rgba(0,0,0,0.3);
        }

        .breaking-marquee-container {
            overflow: hidden;
            position: relative;
            padding: 2px 0;
            width: 100%;
        }

        .breaking-marquee-track {
            display: flex;
            width: max-content;
            animation: marqueeInfinite 95s linear infinite;
            will-change: transform;
        }

        .breaking-marquee-track:hover {
            animation-play-state: paused;
        }

        .breaking-marquee-group {
            display: flex;
            align-items: center;
            flex-shrink: 0;
        }

        @keyframes marqueeInfinite {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-50%);
            }
        }

        .breaking-item {
            display: inline-flex;
            align-items: center;
            color: #f1f5f9;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            white-space: nowrap;
            transition: color 0.15s ease;
        }

        .breaking-item:hover {
            color: #fbc400;
        }

        .breaking-separator {
            display: inline-block;
            margin: 0 24px;
            color: #64748b;
            font-size: 1rem;
            user-select: none;
        }

        @media (max-width: 575.98px) {
            .breaking-badge {
                padding: 4px 8px;
                font-size: 0.8rem;
            }
            .breaking-marquee-track {
                animation-duration: 110s;
            }
            .breaking-separator {
                margin: 0 16px;
            }
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
            font-size: 0.90rem;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: var(--wen-muted);
            margin-top: 4px;
            font-weight: 600;
            margin-left: 60px;
        }

        /* Main Navbar - Single Row Horizontally Scrollable */
        .main-navbar {
            background-color: #0f172a;
            border-bottom: 3px solid var(--wen-primary);
            box-shadow: 0 4px 12px rgba(0,0,0,0.06);
            position: sticky;
            top: 0;
            z-index: 1020;
            padding: 0;
        }

        .main-navbar .nav-scroll-container {
            overflow-x: auto;
            overflow-y: hidden;
            white-space: nowrap;
            scrollbar-width: thin;
            scrollbar-color: rgba(220, 38, 38, 0.3) transparent;
            -webkit-overflow-scrolling: touch;
        }

        .main-navbar .nav-scroll-container::-webkit-scrollbar {
            height: 3px;
        }
        .main-navbar .nav-scroll-container::-webkit-scrollbar-track {
            background: transparent;
        }
        .main-navbar .nav-scroll-container::-webkit-scrollbar-thumb {
            background: rgba(220, 38, 38, 0.3);
            border-radius: 2px;
        }
        .main-navbar .nav-scroll-container:hover::-webkit-scrollbar-thumb {
            background: var(--wen-primary);
        }

        .main-navbar .navbar-nav {
            flex-direction: row;
            flex-wrap: nowrap !important;
            align-items: center;
        }

        .main-navbar .nav-item {
            flex-shrink: 0;
            white-space: nowrap;
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
            white-space: nowrap;
            display: inline-flex;
            align-items: center;
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

        /* Category Sub Cards (Side List) */
        .cat-sub-card {
            background: #ffffff;
            border-radius: 8px;
            border: 1px solid var(--wen-border);
            padding: 10px 12px;
            display: flex;
            flex-direction: row;
            gap: 12px;
            align-items: center;
            transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
            height: auto !important;
            min-height: auto;
            text-decoration: none;
            color: inherit;
            width: 100%;
        }

        .cat-sub-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.07);
            border-color: #cbd5e1;
            color: inherit;
        }

        .cat-sub-card-img {
            width: 96px;
            height: 72px;
            border-radius: 6px;
            overflow: hidden;
            flex-shrink: 0;
            background-color: #e2e8f0;
        }

        .cat-sub-card-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .cat-sub-card:hover .cat-sub-card-img img {
            transform: scale(1.06);
        }

        .cat-sub-card-content {
            flex-grow: 1;
            min-width: 0;
        }

        .cat-sub-card-title {
            font-size: 0.9rem;
            font-weight: 700;
            line-height: 1.35;
            margin-bottom: 4px;
            color: #0f172a;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            transition: color 0.15s ease;
        }

        .cat-sub-card:hover .cat-sub-card-title {
            color: var(--wen-primary);
        }

        .cat-sub-card-meta {
            font-size: 0.74rem;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 8px;
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

        /* Mobile Adjustments & Bottom Fixed Nav */
        @media (max-width: 991.98px) {
            body {
                padding-bottom: 68px;
            }
        }

        .mobile-bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 60px;
            background-color: rgba(15, 23, 42, 0.96);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.35);
            z-index: 1040;
            display: flex;
            align-items: center;
            justify-content: space-around;
            padding: 0 8px;
        }

        .mobile-bottom-nav .mobile-nav-item {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #94a3b8;
            font-size: 0.72rem;
            font-weight: 600;
            text-decoration: none;
            padding: 6px 0;
            transition: color 0.2s ease, transform 0.15s ease;
            gap: 3px;
            cursor: pointer;
        }

        .mobile-bottom-nav .mobile-nav-item i {
            font-size: 1.15rem;
            line-height: 1;
        }

        .mobile-bottom-nav .mobile-nav-item:hover,
        .mobile-bottom-nav .mobile-nav-item:active,
        .mobile-bottom-nav .mobile-nav-item.active {
            color: #ef4444;
            transform: translateY(-1px);
        }

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

        /* Verified Trust Bar */
        .verified-trust-bar {
            background-color: #f1f5f9;
            border-bottom: 1px solid #e2e8f0;
            padding: 7px 0;
            font-size: 0.82rem;
        }

        .verified-trust-text {
            color: #334155;
            line-height: 1.4;
        }

        .verified-trust-link {
            transition: color 0.2s ease;
        }

        .verified-trust-link:hover {
            color: #b91c1c;
            text-decoration: underline !important;
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
            </div>
        </div>
    </div>

    <!-- 2. Breaking News Ticker (Dynamic Seamless Infinite Loop) -->
    @if(isset($globalBreaking) && $globalBreaking->isNotEmpty())
        @php
            // Ensure enough items so that each group comfortably spans wide screens
            $tickerItems = $globalBreaking;
            if ($tickerItems->count() < 4) {
                $tickerItems = $tickerItems->concat($globalBreaking)->concat($globalBreaking);
            }
        @endphp
        <div class="breaking-bar">
            <div class="container d-flex align-items-center">
                <div class="breaking-badge flex-shrink-0 me-2 me-md-3" title="Breaking News">
                    <i class="fa-solid fa-bolt fa-fade"></i><span class="d-none d-sm-inline ms-1">Breaking News</span>
                </div>
                <div class="breaking-marquee-container flex-grow-1">
                    <div class="breaking-marquee-track">
                        <div class="breaking-marquee-group">
                            @foreach($tickerItems as $bItem)
                                <a href="{{ route('article.show', $bItem->slug) }}" class="breaking-item">
                                    <span class="badge bg-danger me-2" style="font-size: 0.7rem; font-weight: 600;">{{ $bItem->category->name ?? 'Breaking' }}</span>
                                    <span>{{ $bItem->title }}</span>
                                </a>
                                <span class="breaking-separator">•</span>
                            @endforeach
                        </div>
                        <div class="breaking-marquee-group" aria-hidden="true">
                            @foreach($tickerItems as $bItem)
                                <a href="{{ route('article.show', $bItem->slug) }}" class="breaking-item">
                                    <span class="badge bg-danger me-2" style="font-size: 0.7rem; font-weight: 600;">{{ $bItem->category->name ?? 'Breaking' }}</span>
                                    <span>{{ $bItem->title }}</span>
                                </a>
                                <span class="breaking-separator">•</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- 3. Brand Header -->
    <header class="brand-header">
        <div class="container d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <a href="{{ route('home') }}" class="d-inline-block text-decoration-none">
                    <img src="{{ asset('images/world_eyes_news_main_logo.png') }}" alt="{{ $siteSettings['site_name'] ?? 'World Eyes News' }}" class="main-brand-logo" style="height: 50px; width: auto; max-width: 100%; object-fit: contain;">
                </a>
                <div class="brand-subtitle">{{ $siteSettings['tagline'] ?? 'BRINGING THE WORLD CLOSER' }}</div>
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

    <!-- 4. Main Navigation Bar (Desktop - Single Row Horizontally Scrollable) -->
    <nav class="navbar main-navbar d-none d-lg-block">
        <div class="container">
            <div class="nav-scroll-container w-100" id="desktopNavbar">
                <ul class="navbar-nav flex-row flex-nowrap align-items-center mb-0">
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
                <a class="nav-link {{ request()->routeIs('about') ? 'text-danger fw-bold' : '' }}" href="{{ route('about') }}">
                    <span><i class="fa-solid fa-circle-info me-2 text-danger"></i> About Us</span>
                </a>
                <a class="nav-link {{ request()->routeIs('privacy.policy') ? 'text-danger fw-bold' : '' }}" href="{{ route('privacy.policy') }}">
                    <span><i class="fa-solid fa-user-shield me-2 text-danger"></i> Privacy Policy</span>
                </a>
                <a class="nav-link {{ request()->routeIs('terms.conditions') ? 'text-danger fw-bold' : '' }}" href="{{ route('terms.conditions') }}">
                    <span><i class="fa-solid fa-file-contract me-2 text-danger"></i> Terms & Conditions</span>
                </a>
            </nav>
            <div class="p-4 mt-auto border-top border-secondary">
                <div class="d-flex justify-content-center gap-3">
                    @if(!empty($siteSettings['social_facebook']))
                        <a href="{{ $siteSettings['social_facebook'] }}" target="_blank" class="text-secondary hover-white fs-5" title="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    @endif
                    @if(!empty($siteSettings['social_twitter']))
                        <a href="{{ $siteSettings['social_twitter'] }}" target="_blank" class="text-secondary hover-white fs-5" title="Twitter / X"><i class="fa-brands fa-x-twitter"></i></a>
                    @endif
                    @if(!empty($siteSettings['social_instagram']))
                        <a href="{{ $siteSettings['social_instagram'] }}" target="_blank" class="text-secondary hover-white fs-5" title="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    @endif
                    @if(!empty($siteSettings['social_youtube']))
                        <a href="{{ $siteSettings['social_youtube'] }}" target="_blank" class="text-secondary hover-white fs-5" title="YouTube"><i class="fa-brands fa-youtube"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Verified Compliance & Trust Bar (Above News Feed) -->
    <div class="verified-trust-bar">
        <div class="container d-flex align-items-center justify-content-between flex-wrap gap-2">
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <span class="badge bg-danger text-uppercase fw-bold px-2 py-1" style="font-size: 0.68rem; letter-spacing: 0.04em;">
                    <i class="fa-solid fa-shield-halved me-1"></i> Verified Media
                </span>
                <span class="verified-trust-text small">
                    <strong class="text-dark">World Eyes</strong> is a <strong>MSME registered & SSL Certified</strong> Digital News Media. Maintained by qualified journalist's with the <strong>PCI & MIB Guidelines</strong>.
                </span>
            </div>
            <a href="{{ route('about') }}" class="verified-trust-link small fw-semibold text-danger text-decoration-none d-none d-md-inline-flex align-items-center gap-1">
                Ethics & Standards <i class="fa-solid fa-arrow-right-long"></i>
            </a>
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
                    <a href="{{ route('home') }}" class="d-inline-block text-decoration-none mb-3">
                        <img src="{{ asset('images/world_eyes_news_channel.png') }}" alt="{{ $siteSettings['site_name'] ?? 'World Eyes News' }}" class="footer-brand-logo" style="height: 62px; width: auto; max-width: 100%; object-fit: contain; border-radius: 6px; box-shadow: 0 4px 12px rgba(0,0,0,0.25);">
                    </a>
                    <p class="small text-secondary mb-3">
                        World Eyes News delivers real-time breaking news, investigative reporting, deep analysis, and multimedia stories spanning geopolitics, technology, business, culture, and sports across the globe.
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
                        <li><a href="{{ route('about') }}">About Editorial</a></li>
                        <li><a href="{{ route('privacy.policy') }}">Privacy Policy</a></li>
                        <li><a href="{{ route('terms.conditions') }}">Terms & Conditions</a></li>
                        <li><a href="{{ route('admin.login') }}">Staff Portal</a></li>
                    </ul>
                </div>

                <!-- Col 4: Editorial Standards & Contact -->
                <div class="col-lg-3 col-md-6">
                    <div class="footer-heading">Editorial Standards</div>
                    <p class="small text-secondary mb-2">World Eyes News is an MSME-registered &amp; SSL-secured digital news media platform, managed by qualified journalists adhering to PCI &amp; MIB guidelines.</p>
                    <div class="small text-secondary mb-2">
                        <i class="fa-solid fa-envelope text-danger me-2"></i>
                        <a href="mailto:{{ $siteSettings['contact_email'] ?? 'worldeyesnetwork@gmail.com' }}" class="text-secondary text-decoration-none">{{ $siteSettings['contact_email'] ?? 'worldeyesnetwork@gmail.com' }}</a>
                    </div>
                    <div class="small text-secondary">
                        <i class="fa-solid fa-shield-halved text-success me-2"></i> Verified Digital Journalism
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div class="d-flex flex-wrap align-items-center gap-2">
                    <span>{{ $siteSettings['footer_copyright'] ?? '© ' . date('Y') . ' World Eyes News. All rights reserved.' }}</span>
                    <span class="d-none d-sm-inline text-secondary opacity-50">•</span>
                    <span>Developed by <a href="https://munmunmaharana.in" target="_blank" rel="noopener noreferrer" class="text-danger fw-semibold text-decoration-none">Munmun</a></span>
                </div>
                <div class="d-flex gap-3">
                    <a href="{{ route('privacy.policy') }}" class="text-secondary">Privacy Policy</a>
                    <a href="{{ route('terms.conditions') }}" class="text-secondary">Terms of Service</a>
                    <a href="{{ route('about') }}" class="text-secondary">Code of Ethics</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Mobile Bottom Fixed Navigation Bar -->
    <nav class="mobile-bottom-nav d-lg-none" aria-label="Mobile Navigation">
        <a href="{{ route('home') }}" class="mobile-nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
            <i class="fa-solid fa-house"></i>
            <span>Home</span>
        </a>

        <a href="{{ route('about') }}" class="mobile-nav-item {{ request()->routeIs('about') ? 'active' : '' }}">
            <i class="fa-solid fa-circle-info"></i>
            <span>About</span>
        </a>

        <button type="button" class="mobile-nav-item border-0 bg-transparent" data-bs-toggle="modal" data-bs-target="#mobileSearchModal" aria-label="Search Site">
            <i class="fa-solid fa-magnifying-glass"></i>
            <span>Search</span>
        </button>

        <button type="button" class="mobile-nav-item border-0 bg-transparent" data-bs-toggle="offcanvas" data-bs-target="#mobileMenuOffcanvas" aria-label="Open Menu">
            <i class="fa-solid fa-bars"></i>
            <span>Menu</span>
        </button>
    </nav>

    <!-- Mobile Quick Search Modal -->
    <div class="modal fade" id="mobileSearchModal" tabindex="-1" aria-labelledby="mobileSearchModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered px-3">
            <div class="modal-content bg-dark text-white border-secondary shadow-lg">
                <div class="modal-header border-secondary py-2">
                    <h6 class="modal-title fw-bold" id="mobileSearchModalLabel">
                        <i class="fa-solid fa-magnifying-glass text-danger me-2"></i> Search World Eyes News
                    </h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-3">
                    <form action="{{ route('search') }}" method="GET">
                        <div class="input-group mb-3">
                            <input type="text" name="q" class="form-control bg-black text-white border-secondary" placeholder="Search news, topics, tags..." required autofocus>
                            <button class="btn btn-danger px-3 fw-bold" type="submit">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </form>
                    <div class="small text-secondary mb-1">Browse News Desks:</div>
                    <div class="d-flex flex-wrap gap-1">
                        @foreach($navCategories as $cat)
                            <a href="{{ route('category.show', $cat->slug) }}" class="btn btn-sm btn-outline-secondary py-0 px-2 small">{{ $cat->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5.3.3 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Global Image Error Fallback -->
    <script>
        document.addEventListener('error', function (e) {
            if (e.target && e.target.tagName && e.target.tagName.toLowerCase() === 'img') {
                const fallbackUrl = "{{ asset('images/placeholder.png') }}";
                if (e.target.src !== fallbackUrl && !e.target.classList.contains('main-brand-logo') && !e.target.classList.contains('footer-brand-logo')) {
                    e.target.onerror = null;
                    e.target.src = fallbackUrl;
                }
            }
        }, true);
    </script>
    @stack('scripts')
</body>
</html>
