@extends('layouts.app')

@section('title', 'World Eyes News - Breaking News, Analysis & Global Perspectives')

@section('content')
<div class="container">

    <!-- 1. Hero Featured Section -->
    <section class="mb-5">
        <div class="row g-4">
            <!-- Lead Primary Story (Left 7 cols) -->
            @if($leadStory)
                <div class="col-lg-7">
                    <div class="lead-story-card h-100">
                        <div class="lead-story-img-wrapper">
                            <img src="{{ $leadStory->image_url }}" alt="{{ $leadStory->title }}" loading="eager" onerror="this.onerror=null; this.src='{{ asset('images/placeholder.png') }}';">
                            <div class="lead-story-overlay">
                                <a href="{{ route('category.show', $leadStory->category->slug) }}" class="category-badge mb-2" style="background-color: {{ $leadStory->category->color ?? '#dc2626' }};">
                                    {{ $leadStory->category->name }}
                                </a>
                                @if($leadStory->is_breaking)
                                    <span class="badge bg-danger ms-1 text-uppercase"><i class="fa-solid fa-bolt"></i> Breaking</span>
                                @endif
                                <h2 class="serif-font fw-bold mt-2 mb-2 text-white" style="font-size: 1.85rem; line-height: 1.25;">
                                    <a href="{{ route('article.show', $leadStory->slug) }}" class="text-white">
                                        {{ $leadStory->title }}
                                    </a>
                                </h2>
                                <p class="text-light opacity-75 small mb-3 d-none d-md-block">
                                    {{ Str::limit($leadStory->summary, 140) }}
                                </p>
                                <div class="d-flex align-items-center gap-3 text-secondary small">
                                    <span><i class="fa-regular fa-clock me-1"></i> {{ $leadStory->published_at ? $leadStory->published_at->diffForHumans() : 'Just now' }}</span>
                                    <span>•</span>
                                    <span><i class="fa-regular fa-eye me-1"></i> {{ number_format($leadStory->views_count) }} views</span>
                                    <span>•</span>
                                    <span><i class="fa-solid fa-feather me-1"></i> {{ $leadStory->author->name ?? 'Staff Correspondent' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Secondary Featured Grid (Right 5 cols) -->
            <div class="col-lg-5">
                <div class="row g-3 h-100">
                    @foreach($secondaryStories as $secStory)
                        <div class="col-sm-6 col-lg-12">
                            <div class="news-card p-3 d-flex flex-row gap-3 align-items-center h-100">
                                <div class="flex-shrink-0" style="width: 110px; height: 80px; position: relative; border-radius: 6px; overflow: hidden;">
                                    <img src="{{ $secStory->image_url }}" alt="{{ $secStory->title }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.onerror=null; this.src='{{ asset('images/placeholder.png') }}';">
                                </div>
                                <div class="flex-grow-1">
                                    <a href="{{ route('category.show', $secStory->category->slug) }}" class="category-badge mb-1" style="background-color: {{ $secStory->category->color ?? '#dc2626' }}; font-size: 0.65rem;">
                                        {{ $secStory->category->name }}
                                    </a>
                                    <h6 class="fw-bold mb-1" style="font-size: 0.92rem; line-height: 1.3;">
                                        <a href="{{ route('article.show', $secStory->slug) }}">
                                            {{ Str::limit($secStory->title, 65) }}
                                        </a>
                                    </h6>
                                    <span class="text-muted small" style="font-size: 0.75rem;">
                                        <i class="fa-regular fa-clock me-1"></i> {{ $secStory->published_at ? $secStory->published_at->diffForHumans() : 'Recently' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- 2. Trending Now Carousel/Bar -->
    <section class="mb-5">
        <div class="section-header">
            <h3 class="section-title">Trending Perspectives</h3>
            <span class="text-muted small fw-semibold text-uppercase"><i class="fa-solid fa-chart-line text-danger me-1"></i> Most Engaged</span>
        </div>

        <div class="row g-3">
            @foreach($trendingArticles->take(4) as $index => $tArticle)
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="news-card">
                        <div class="news-card-img-wrapper">
                            <span class="category-badge badge-floating" style="background-color: {{ $tArticle->category->color ?? '#dc2626' }};">
                                {{ $tArticle->category->name }}
                            </span>
                            <img src="{{ $tArticle->image_url }}" alt="{{ $tArticle->title }}" loading="lazy" onerror="this.onerror=null; this.src='{{ asset('images/placeholder.png') }}';">
                        </div>
                        <div class="p-3 d-flex flex-column flex-grow-1">
                            <div class="text-danger fw-black serif-font mb-1" style="font-size: 1.1rem;">
                                #0{{ $index + 1 }}
                            </div>
                            <h6 class="fw-bold mb-2 flex-grow-1" style="line-height: 1.35;">
                                <a href="{{ route('article.show', $tArticle->slug) }}">
                                    {{ Str::limit($tArticle->title, 70) }}
                                </a>
                            </h6>
                            <div class="d-flex justify-content-between text-muted small mt-2 pt-2 border-top">
                                <span><i class="fa-regular fa-clock me-1"></i> {{ $tArticle->published_at ? $tArticle->published_at->diffForHumans() : 'Recent' }}</span>
                                <span><i class="fa-regular fa-eye me-1"></i> {{ number_format($tArticle->views_count) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- 3. Main Content Split: Categories & Sidebar -->
    <div class="row g-4">
        <!-- Main Feed Column (8 cols) -->
        <div class="col-lg-8">

            @foreach($categoriesWithArticles as $catSection)
                @if($catSection->publishedArticles->isNotEmpty())
                    <section class="mb-5">
                        <div class="section-header">
                            <h3 class="section-title">{{ $catSection->name }}</h3>
                            <a href="{{ route('category.show', $catSection->slug) }}" class="btn btn-sm btn-outline-danger fw-semibold">
                                View All <i class="fa-solid fa-arrow-right ms-1"></i>
                            </a>
                        </div>

                        @php
                            $catLead = $catSection->publishedArticles->first();
                            $catSubs = $catSection->publishedArticles->slice(1, 4);
                        @endphp

                        <div class="row g-3 align-items-start">
                            <!-- Category Lead Card (6 cols) -->
                            <div class="col-md-6">
                                <div class="news-card">
                                    <div class="news-card-img-wrapper">
                                        <span class="category-badge badge-floating" style="background-color: {{ $catSection->color }};">
                                            {{ $catSection->name }}
                                        </span>
                                        <img src="{{ $catLead->image_url }}" alt="{{ $catLead->title }}" loading="lazy" onerror="this.onerror=null; this.src='{{ asset('images/placeholder.png') }}';">
                                    </div>
                                    <div class="p-3 d-flex flex-column flex-grow-1">
                                        <h5 class="serif-font fw-bold mb-2" style="line-height: 1.3;">
                                            <a href="{{ route('article.show', $catLead->slug) }}">
                                                {{ $catLead->title }}
                                            </a>
                                        </h5>
                                        <p class="text-secondary small mb-3 flex-grow-1">
                                            {{ Str::limit($catLead->summary, 110) }}
                                        </p>
                                        <div class="d-flex justify-content-between text-muted small pt-2 border-top">
                                            <span><i class="fa-solid fa-feather me-1"></i> {{ $catLead->author->name ?? 'Editor' }}</span>
                                            <span><i class="fa-regular fa-clock me-1"></i> {{ $catLead->published_at ? $catLead->published_at->diffForHumans() : 'Recent' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Category 3-4 side list (6 cols) - Aligned to TOP, items stack cleanly downwards -->
                            <div class="col-md-6">
                                <div class="d-flex flex-column gap-2 justify-content-start">
                                    @foreach($catSubs as $sub)
                                        <a href="{{ route('article.show', $sub->slug) }}" class="cat-sub-card">
                                            <div class="cat-sub-card-img">
                                                <img src="{{ $sub->image_url }}" alt="{{ $sub->title }}" loading="lazy" onerror="this.onerror=null; this.src='{{ asset('images/placeholder.png') }}';">
                                            </div>
                                            <div class="cat-sub-card-content">
                                                <h6 class="cat-sub-card-title">
                                                    {{ $sub->title }}
                                                </h6>
                                                <div class="cat-sub-card-meta">
                                                    <span><i class="fa-regular fa-clock me-1"></i> {{ $sub->published_at ? $sub->published_at->diffForHumans() : 'Recently' }}</span>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </section>
                @endif
            @endforeach

        </div>

        <!-- Sidebar Column (4 cols) -->
        <div class="col-lg-4">
            <!-- Most Read Widget -->
            <div class="widget-box">
                <div class="widget-title"><i class="fa-solid fa-fire text-danger me-1"></i> Most Read Stories</div>
                <div>
                    @foreach($mostViewed as $idx => $mArticle)
                        <div class="trending-item">
                            <div class="trending-num">{{ sprintf('%02d', $idx + 1) }}</div>
                            <div>
                                <a href="{{ route('category.show', $mArticle->category->slug) }}" class="category-badge mb-1" style="background-color: {{ $mArticle->category->color }}; font-size: 0.65rem;">
                                    {{ $mArticle->category->name }}
                                </a>
                                <h6 class="fw-bold mb-1" style="font-size: 0.88rem; line-height: 1.3;">
                                    <a href="{{ route('article.show', $mArticle->slug) }}">
                                        {{ $mArticle->title }}
                                    </a>
                                </h6>
                                <span class="text-muted small" style="font-size: 0.75rem;">
                                    <i class="fa-regular fa-eye me-1"></i> {{ number_format($mArticle->views_count) }} views
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Categories Widget -->
            <div class="widget-box">
                <div class="widget-title"><i class="fa-solid fa-layer-group text-primary me-1"></i> Explore Desks</div>
                <div class="d-flex flex-wrap gap-2">
                    @foreach($navCategories as $desk)
                        <a href="{{ route('category.show', $desk->slug) }}" class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-2">
                            <span>{{ $desk->name }}</span>
                            <span class="badge bg-danger rounded-pill">{{ $desk->published_articles_count }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Editorial Trust & Mission -->
            <div class="widget-box bg-dark text-white border-0" style="background: linear-gradient(145deg, #0f172a 0%, #1e293b 100%);">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <span class="badge bg-danger">EDITORIAL TRUST</span>
                    <span class="badge bg-secondary">MSME &amp; SSL</span>
                </div>
                <h6 class="fw-bold serif-font mb-2 text-white">Bringing The World Closer</h6>
                <p class="small text-secondary mb-3">Managed by qualified journalists committed to responsible, accurate, and ethical reporting under PCI &amp; MIB guidelines.</p>
                <a href="{{ route('about') }}" class="btn btn-outline-light btn-sm w-100 fw-semibold">
                    Read Editorial Charter <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

</div>
@endsection
