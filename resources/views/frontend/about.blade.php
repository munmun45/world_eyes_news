@extends('layouts.app')

@section('title', 'About Us - World Eyes News | Bringing The World Closer')
@section('meta_description', 'Learn about World Eyes News, an MSME-registered and SSL-secured digital news media platform managed by qualified journalists and committed to ethical journalism.')

@section('content')
<div class="container py-3">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb small">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa-solid fa-house me-1"></i> Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">About Us</li>
        </ol>
    </nav>

    <!-- Hero Header -->
    <div class="card border-0 text-white rounded-3 overflow-hidden mb-5 shadow-sm" style="background: linear-gradient(135deg, #0b1120 0%, #1e293b 100%);">
        <div class="card-body p-4 p-md-5">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <span class="badge bg-danger text-uppercase fw-bold px-3 py-2 mb-3">
                        <i class="fa-solid fa-shield-halved me-1"></i> Verified & Independent Media
                    </span>
                    <h1 class="display-5 fw-bold serif-font mb-3">About World Eyes News</h1>
                    <p class="lead text-light opacity-90 fw-semibold mb-3" style="color: #fca5a5 !important;">
                        "{{ $siteSettings['tagline'] ?? 'Bringing The World Closer' }}"
                    </p>
                    <p class="text-light opacity-75 mb-0" style="max-width: 680px; font-size: 1.05rem; line-height: 1.7;">
                        World Eyes News is an <strong>MSME-registered</strong> and <strong>SSL-secured</strong> digital news media platform, managed by qualified journalists and committed to responsible, accurate, and ethical journalism.
                    </p>
                </div>
                <div class="col-lg-4 text-center text-lg-end">
                    <div class="p-3 bg-black bg-opacity-25 rounded-3 border border-secondary border-opacity-25 d-inline-block text-start">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="fa-solid fa-circle-check text-success fs-5"></i>
                            <span class="small fw-bold text-white">MSME Registered</span>
                        </div>
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="fa-solid fa-lock text-info fs-5"></i>
                            <span class="small fw-bold text-white">SSL Encrypted & Secured</span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-scale-balanced text-warning fs-5"></i>
                            <span class="small fw-bold text-white">PCI & MIB Compliant</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Regulatory Adherence Statement -->
    <div class="card border-start border-4 border-danger shadow-sm mb-5 bg-white">
        <div class="card-body p-4">
            <h5 class="fw-bold serif-font text-dark mb-2">
                <i class="fa-solid fa-landmark text-danger me-2"></i> Journalistic Ethics & Standards
            </h5>
            <p class="text-secondary mb-0" style="line-height: 1.7;">
                We strive to deliver credible news, breaking updates, and ground reports while adhering to applicable media laws, journalistic ethics, and relevant guidelines issued by the <strong>Press Council of India (PCI)</strong> and the <strong>Ministry of Information and Broadcasting (MIB)</strong>, wherever applicable.
            </p>
        </div>
    </div>

    <!-- Why World Eyes? -->
    <section class="mb-5">
        <div class="section-header">
            <h3 class="section-title">Why World Eyes?</h3>
        </div>
        <div class="row g-4 align-items-stretch">
            <div class="col-lg-7">
                <div class="card h-100 border-0 shadow-sm p-4 bg-white">
                    <p class="text-secondary" style="font-size: 1.05rem; line-height: 1.8;">
                        The world is constantly changing, and every moment brings new developments, discoveries, challenges, and stories that deserve attention. At World Eyes, we believe that journalism should do more than simply report events—it should help people understand what is happening around them and why it matters.
                    </p>
                    <p class="text-secondary mb-0" style="font-size: 1.05rem; line-height: 1.8;">
                        The name <strong>World Eyes</strong> reflects our commitment to viewing the world through a wider, more informed, and responsible perspective. Just as our eyes help us see and understand our surroundings, World Eyes News aims to bring important developments from across the globe closer to our readers and viewers.
                    </p>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card h-100 border-0 text-white p-4 shadow-sm d-flex justify-content-center" style="background: linear-gradient(145deg, #1e293b 0%, #0f172a 100%);">
                    <i class="fa-solid fa-quote-left text-danger display-4 mb-3 opacity-50"></i>
                    <blockquote class="blockquote mb-3">
                        <p class="serif-font fs-5 text-white" style="line-height: 1.6;">
                            "World Eyes is more than a name—it represents a broader vision of seeing the world, understanding its stories, and bringing people closer through reliable information."
                        </p>
                    </blockquote>
                    <footer class="blockquote-footer text-secondary mb-0">Editorial Board, World Eyes News</footer>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Coverage -->
    <section class="mb-5">
        <div class="section-header">
            <h3 class="section-title">Our Coverage</h3>
        </div>
        <p class="text-secondary mb-4">World Eyes News delivers continuous, verified reporting spanning essential beats and perspectives:</p>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-3">
            @php
                $beats = [
                    ['icon' => 'fa-bolt text-danger', 'title' => 'Breaking News and Latest Updates', 'desc' => 'Instant, real-time dispatches from national and global correspondents.'],
                    ['icon' => 'fa-landmark text-primary', 'title' => 'Politics and Governance', 'desc' => 'Policy reviews, legislative decisions, elections, and civic impact analysis.'],
                    ['icon' => 'fa-gavel text-warning', 'title' => 'Crime, Law and Public Safety', 'desc' => 'Courts, jurisprudence, investigative reporting, and public safety.'],
                    ['icon' => 'fa-location-dot text-info', 'title' => 'Regional and Local News', 'desc' => 'Grassroots reporting from towns, states, and regional communities.'],
                    ['icon' => 'fa-earth-americas text-primary', 'title' => 'National and International Affairs', 'desc' => 'Diplomacy, strategic alliances, global treaties, and foreign policy.'],
                    ['icon' => 'fa-chart-line text-success', 'title' => 'Business, Economy and Technology', 'desc' => 'Markets, fiscal indicators, disruptive technology, and AI innovation.'],
                    ['icon' => 'fa-trophy text-warning', 'title' => 'Sports and Sporting Events', 'desc' => 'Tournaments, athlete spotlights, fixtures, and post-game coverage.'],
                    ['icon' => 'fa-film text-danger', 'title' => 'Entertainment, Lifestyle and Culture', 'desc' => 'Cinema, arts, music, societal trends, wellness, and heritage.'],
                    ['icon' => 'fa-users text-primary', 'title' => 'Human-Interest Stories and Ground Reports', 'desc' => 'In-depth reporting giving voice to real people and grassroots issues.'],
                ];
            @endphp

            @foreach($beats as $beat)
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm p-3 bg-white">
                        <div class="d-flex align-items-center gap-3 mb-2">
                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                                <i class="fa-solid {{ $beat['icon'] }} fs-5"></i>
                            </div>
                            <h6 class="fw-bold mb-0 text-dark">{{ $beat['title'] }}</h6>
                        </div>
                        <p class="small text-secondary mb-0 ps-1" style="line-height: 1.5;">{{ $beat['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Vision & Mission -->
    <section class="mb-5">
        <div class="row g-4">
            <!-- Vision -->
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm p-4 bg-white border-top border-4 border-danger">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="rounded-circle bg-danger bg-opacity-10 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="fa-solid fa-eye text-danger fs-4"></i>
                        </div>
                        <h4 class="fw-bold serif-font mb-0 text-dark">Our Vision</h4>
                    </div>
                    <p class="text-secondary" style="line-height: 1.7;">
                        Our vision is to build World Eyes News into a credible, accessible, and widely trusted digital news media platform that connects people with important developments from across the world.
                    </p>
                    <div class="p-3 bg-light rounded-3 text-dark fw-semibold mt-auto">
                        <i class="fa-solid fa-bullseye text-danger me-2"></i>
                        "Our vision is simple: to see the world more clearly, understand it more deeply, and connect people through responsible journalism."
                    </div>
                </div>
            </div>

            <!-- Mission -->
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm p-4 bg-white border-top border-4 border-primary">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="fa-solid fa-compass text-primary fs-4"></i>
                        </div>
                        <h4 class="fw-bold serif-font mb-0 text-dark">Our Mission</h4>
                    </div>
                    <p class="text-secondary" style="line-height: 1.7;">
                        The mission of World Eyes News is to deliver timely, relevant, and responsibly reported news that keeps people informed, encourages awareness, and serves the public interest.
                    </p>
                    <p class="text-secondary mb-0" style="line-height: 1.7;">
                        We are committed to covering important developments with a focus on factual accuracy, clarity, fairness, and accountability. Through digital reporting, news updates, ground reports, interviews, and multimedia storytelling, we aim to make meaningful information accessible to audiences across different regions and communities.
                    </p>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection
