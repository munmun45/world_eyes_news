@extends('layouts.app')

@section('title', 'Search Results for: "' . ($query ?? '') . '" - World Eyes News')

@section('content')
<div class="container">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb small">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa-solid fa-house me-1"></i> Home</a></li>
            <li class="breadcrumb-item active text-danger fw-bold" aria-current="page">Search</li>
        </ol>
    </nav>

    <!-- Search Header -->
    <div class="p-4 mb-4 rounded bg-white border">
        <h2 class="serif-font fw-bold mb-2">Search Results for: <span class="text-danger">"{{ $query }}"</span></h2>
        <p class="text-muted small mb-3">Found {{ $articles->total() }} matching {{ Str::plural('article', $articles->total()) }} across all desks.</p>

        <form action="{{ route('search') }}" method="GET" class="d-flex gap-2" style="max-width: 600px;">
            <input type="text" name="q" class="form-control" value="{{ $query }}" placeholder="Search news, topics, keywords..." required>
            <button class="btn btn-danger px-4" type="submit"><i class="fa-solid fa-magnifying-glass me-1"></i> Search</button>
        </form>
    </div>

    <!-- Results Grid -->
    @if($articles->count() > 0)
        <div class="row g-4">
            @foreach($articles as $art)
                <div class="col-md-6 col-lg-4">
                    <div class="news-card">
                        <div class="news-card-img-wrapper">
                            <span class="category-badge badge-floating" style="background-color: {{ $art->category->color ?? '#dc2626' }};">
                                {{ $art->category->name }}
                            </span>
                            <img src="{{ $art->image_url }}" alt="{{ $art->title }}" loading="lazy" onerror="this.onerror=null; this.src='{{ asset('images/placeholder.png') }}';">
                        </div>
                        <div class="p-3 d-flex flex-column flex-grow-1">
                            <h5 class="serif-font fw-bold mb-2" style="font-size: 1.05rem; line-height: 1.35;">
                                <a href="{{ route('article.show', $art->slug) }}">
                                    {{ $art->title }}
                                </a>
                            </h5>
                            <p class="text-secondary small mb-3 flex-grow-1">
                                {{ Str::limit($art->summary, 90) }}
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

        <div class="mt-5 d-flex justify-content-center">
            {{ $articles->links() }}
        </div>
    @else
        <div class="alert alert-light border py-5 text-center">
            <i class="fa-solid fa-magnifying-glass fs-1 text-secondary mb-3"></i>
            <h4>No matching stories found</h4>
            <p class="text-muted">Please try different keywords or browse our categories from the navigation bar.</p>
            <a href="{{ route('home') }}" class="btn btn-sm btn-danger mt-2">Return to Front Page</a>
        </div>
    @endif

</div>
@endsection
