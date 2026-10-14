@extends('layouts.app')

@section('title', $category->name . ' - World Eyes News')
@section('meta_description', $category->description ?? 'Latest updates, reports and analysis on ' . $category->name)

@section('content')
<div class="container">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb small">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa-solid fa-house me-1"></i> Home</a></li>
            <li class="breadcrumb-item text-muted">Desk</li>
            <li class="breadcrumb-item active text-danger fw-bold" aria-current="page">{{ $category->name }}</li>
        </ol>
    </nav>

    <!-- Category Header Banner -->
    <div class="p-4 p-md-5 mb-4 rounded-3 text-white" style="background: linear-gradient(135deg, #0f172a 0%, {{ $category->color }} 160%);">
        <div class="row align-items-center">
            <div class="col-md-8">
                <span class="category-badge mb-2 px-3 py-1" style="background-color: {{ $category->color }}; font-size: 0.8rem;">
                    {{ $category->name }}
                </span>
                <h1 class="serif-font fw-bold text-white mb-2" style="font-size: 2.2rem;">{{ $category->name }}</h1>
                <p class="text-light opacity-75 mb-0" style="max-width: 650px;">
                    {{ $category->description ?? 'Comprehensive reporting, analysis, and breaking developments from the ' . $category->name . ' desk.' }}
                </p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <div class="d-inline-block p-3 bg-dark bg-opacity-50 rounded border border-secondary text-center">
                    <div class="fs-3 fw-bold text-white serif-font">{{ $articles->total() }}</div>
                    <div class="small text-secondary text-uppercase fw-semibold" style="font-size:0.75rem;">Published Stories</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Controls Bar -->
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 pb-2 border-bottom">
        <div class="text-muted small">
            Showing <span class="fw-bold text-dark">{{ $articles->firstItem() ?? 0 }}</span> to <span class="fw-bold text-dark">{{ $articles->lastItem() ?? 0 }}</span> of <span class="fw-bold text-dark">{{ $articles->total() }}</span> articles
        </div>
        <div class="d-flex align-items-center gap-2">
            <label class="small text-muted mb-0">Sort By:</label>
            <div class="btn-group btn-group-sm">
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'latest']) }}" class="btn {{ request('sort') !== 'popular' ? 'btn-danger' : 'btn-outline-secondary' }}">
                    Latest
                </a>
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'popular']) }}" class="btn {{ request('sort') === 'popular' ? 'btn-danger' : 'btn-outline-secondary' }}">
                    Most Read
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content & Sidebar -->
    <div class="row g-4">
        <!-- Articles Grid (8 cols) -->
        <div class="col-lg-8">
            @if($articles->count() > 0)
                <div class="row g-4">
                    @foreach($articles as $art)
                        <div class="col-md-6 col-lg-6">
                            <div class="news-card">
                                <div class="news-card-img-wrapper">
                                    <span class="category-badge badge-floating" style="background-color: {{ $category->color }};">
                                        {{ $category->name }}
                                    </span>
                                    @if($art->is_breaking)
                                        <span class="badge bg-danger position-absolute top-0 end-0 m-2"><i class="fa-solid fa-bolt"></i> Breaking</span>
                                    @endif
                                    <img src="{{ $art->image_url }}" alt="{{ $art->title }}" loading="lazy">
                                </div>
                                <div class="p-3 d-flex flex-column flex-grow-1">
                                    <h5 class="serif-font fw-bold mb-2" style="font-size: 1.05rem; line-height: 1.35;">
                                        <a href="{{ route('article.show', $art->slug) }}">
                                            {{ $art->title }}
                                        </a>
                                    </h5>
                                    <p class="text-secondary small mb-3 flex-grow-1">
                                        {{ Str::limit($art->summary, 100) }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center text-muted small pt-2 border-top" style="font-size: 0.78rem;">
                                        <span><i class="fa-regular fa-clock me-1"></i> {{ $art->published_at ? $art->published_at->format('M j, Y') : 'Recent' }}</span>
                                        <span><i class="fa-regular fa-eye me-1"></i> {{ number_format($art->views_count) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-5 d-flex justify-content-center">
                    {{ $articles->links() }}
                </div>
            @else
                <div class="alert alert-info py-5 text-center">
                    <i class="fa-solid fa-newspaper fs-1 text-secondary mb-3"></i>
                    <h4>No articles found in {{ $category->name }}</h4>
                    <p class="text-muted">Stay tuned as our editorial desk updates this category shortly.</p>
                    <a href="{{ route('home') }}" class="btn btn-sm btn-danger mt-2">Return to Homepage</a>
                </div>
            @endif
        </div>

        <!-- Sidebar (4 cols) -->
        <div class="col-lg-4">
            <!-- Trending in this category -->
            @if($trendingCategory->isNotEmpty())
                <div class="widget-box">
                    <div class="widget-title"><i class="fa-solid fa-fire text-danger me-1"></i> Top in {{ $category->name }}</div>
                    <div>
                        @foreach($trendingCategory as $tIdx => $tArt)
                            <div class="trending-item">
                                <div class="trending-num">{{ sprintf('%02d', $tIdx + 1) }}</div>
                                <div>
                                    <h6 class="fw-bold mb-1" style="font-size: 0.88rem; line-height: 1.3;">
                                        <a href="{{ route('article.show', $tArt->slug) }}">
                                            {{ $tArt->title }}
                                        </a>
                                    </h6>
                                    <span class="text-muted small" style="font-size: 0.75rem;">
                                        <i class="fa-regular fa-eye me-1"></i> {{ number_format($tArt->views_count) }} views
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Categories -->
            <div class="widget-box">
                <div class="widget-title"><i class="fa-solid fa-layer-group text-primary me-1"></i> Other Desks</div>
                <div class="d-flex flex-column gap-2">
                    @foreach($navCategories as $catItem)
                        <a href="{{ route('category.show', $catItem->slug) }}" class="p-2 rounded border d-flex justify-content-between align-items-center {{ $catItem->id === $category->id ? 'bg-light border-danger fw-bold' : '' }}">
                            <span><i class="fa-solid fa-circle me-2" style="color: {{ $catItem->color }}; font-size: 0.65rem;"></i> {{ $catItem->name }}</span>
                            <span class="badge bg-secondary rounded-pill">{{ $catItem->published_articles_count }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
