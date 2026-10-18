@extends('layouts.app')

@section('title', ($article->meta_title ?? $article->title) . ' - World Eyes News')
@section('meta_description', $article->meta_description ?? ($article->summary ?? Str::limit(strip_tags($article->content), 160)))
@section('canonical_url', route('article.show', $article->slug))

@section('og_type', 'article')
@section('og_url', route('article.show', $article->slug))
@section('og_title', $article->meta_title ?? $article->title)
@section('og_description', $article->meta_description ?? ($article->summary ?? Str::limit(strip_tags($article->content), 160)))
@section('og_image', $article->image_url)

@section('extra_og_tags')
    <meta property="article:published_time" content="{{ $article->published_at ? $article->published_at->toIso8601String() : $article->created_at->toIso8601String() }}">
    <meta property="article:modified_time" content="{{ $article->updated_at->toIso8601String() }}">
    <meta property="article:section" content="{{ $article->category->name ?? 'News' }}">
    @if($article->tags)
        @foreach(explode(',', $article->tags) as $tag)
            <meta property="article:tag" content="{{ trim($tag) }}">
        @endforeach
    @endif
    <!-- NewsArticle JSON-LD Structured Data for Search Engines & Social Platforms -->
    @php
        $schemaData = [
            '@context' => 'https://schema.org',
            '@type' => 'NewsArticle',
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => route('article.show', $article->slug),
            ],
            'headline' => $article->title,
            'image' => [$article->image_url],
            'datePublished' => $article->published_at ? $article->published_at->toIso8601String() : $article->created_at->toIso8601String(),
            'dateModified' => $article->updated_at->toIso8601String(),
            'author' => [
                [
                    '@type' => 'Person',
                    'name' => $article->author->name ?? 'Staff Correspondent',
                ]
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => 'World Eyes News',
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => asset('images/world_eyes_news_main_logo.png'),
                ]
            ],
            'description' => $article->meta_description ?? ($article->summary ?? Str::limit(strip_tags($article->content), 160)),
        ];
    @endphp
    <script type="application/ld+json">
    {!! json_encode($schemaData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
@endsection

@push('styles')
<style>
    .article-body {
        font-size: 1.125rem;
        line-height: 1.85;
        color: #1e293b;
        word-break: break-word;
    }
    .article-body p {
        margin-bottom: 1.35rem;
    }
    .article-body h2 {
        font-size: 1.75rem;
        font-weight: 700;
        margin-top: 2rem;
        margin-bottom: 1rem;
        color: #0f172a;
        line-height: 1.3;
    }
    .article-body h3 {
        font-size: 1.4rem;
        font-weight: 700;
        margin-top: 1.75rem;
        margin-bottom: 0.85rem;
        color: #0f172a;
        line-height: 1.35;
    }
    .article-body h4 {
        font-size: 1.2rem;
        font-weight: 600;
        margin-top: 1.5rem;
        margin-bottom: 0.75rem;
        color: #1e293b;
    }
    .article-body a {
        color: #dc2626;
        text-decoration: underline;
        text-underline-offset: 3px;
        font-weight: 500;
        transition: color 0.15s ease;
    }
    .article-body a:hover {
        color: #991b1b;
    }
    .article-body img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 1.75rem auto;
        display: block;
        box-shadow: 0 4px 14px rgba(0,0,0,0.08);
    }
    .article-body blockquote {
        border-left: 4px solid #dc2626;
        padding: 0.85rem 1.25rem;
        margin: 1.75rem 0;
        background-color: #f8fafc;
        border-radius: 0 8px 8px 0;
        font-style: italic;
        color: #475569;
        font-size: 1.15rem;
    }
    .article-body ul, .article-body ol {
        margin-bottom: 1.35rem;
        padding-left: 1.75rem;
    }
    .article-body li {
        margin-bottom: 0.5rem;
    }
    .article-body code {
        background-color: #f1f5f9;
        color: #e11d48;
        padding: 0.2rem 0.4rem;
        border-radius: 4px;
        font-size: 0.9em;
    }
</style>
@endpush

@section('content')
<div class="container">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb small">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa-solid fa-house me-1"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('category.show', $article->category->slug) }}">{{ $article->category->name }}</a></li>
            <li class="breadcrumb-item active text-muted text-truncate" style="max-width: 320px;" aria-current="page">{{ $article->title }}</li>
        </ol>
    </nav>

    <div class="row g-4">
        <!-- Main Article Column (8 cols) -->
        <article class="col-lg-8">

            <!-- Category & Breaking Badges -->
            <div class="d-flex align-items-center gap-2 mb-2">
                <a href="{{ route('category.show', $article->category->slug) }}" class="category-badge" style="background-color: {{ $article->category->color }}; font-size: 0.75rem;">
                    {{ $article->category->name }}
                </a>
                @if($article->is_breaking)
                    <span class="badge bg-danger text-uppercase"><i class="fa-solid fa-bolt"></i> Breaking News</span>
                @endif
                @if($article->is_featured)
                    <span class="badge bg-warning text-dark"><i class="fa-solid fa-star"></i> Featured</span>
                @endif
            </div>

            <!-- Headline -->
            <h1 class="serif-font fw-bold mb-3" style="font-size: 2.25rem; line-height: 1.25; color: #0f172a;">
                {{ $article->title }}
            </h1>

            <!-- Summary / Subtitle -->
            @if($article->summary)
                <p class="lead text-secondary mb-4" style="font-size: 1.15rem; line-height: 1.6;">
                    {{ $article->summary }}
                </p>
            @endif

            <!-- Author & Metadata Row -->
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 py-3 my-3 border-top border-bottom">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 44px; height: 44px; font-size: 1.1rem;">
                        {{ substr($article->author->name ?? 'W', 0, 1) }}
                    </div>
                    <div>
                        <div class="fw-bold text-dark" style="font-size: 0.95rem;">By {{ $article->author->name ?? 'Staff Correspondent' }}</div>
                        <div class="text-muted small" style="font-size: 0.78rem;">
                            <span>Published {{ $article->published_at ? $article->published_at->format('M j, Y • g:i A') : 'Recently' }}</span>
                            <span class="mx-1">•</span>
                            <span><i class="fa-regular fa-clock me-1"></i> {{ $article->reading_time }} min read</span>
                        </div>
                    </div>
                </div>

                <!-- Share Buttons -->
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <span class="small text-muted fw-semibold me-1"><i class="fa-solid fa-share-nodes text-danger me-1"></i> Share:</span>
                    <a href="https://api.whatsapp.com/send?text={{ rawurlencode($article->title . "\n\n" . route('article.show', $article->slug)) }}" target="_blank" class="btn btn-sm btn-success rounded-pill px-3 d-inline-flex align-items-center gap-1 shadow-sm" title="Share on WhatsApp"><i class="fa-brands fa-whatsapp fs-6"></i><span class="small fw-bold">WhatsApp</span></a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ rawurlencode(route('article.show', $article->slug)) }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-circle d-inline-flex align-items-center justify-content-center" style="width:34px;height:34px;" title="Share on Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="https://twitter.com/intent/tweet?text={{ rawurlencode($article->title) }}&url={{ rawurlencode(route('article.show', $article->slug)) }}" target="_blank" class="btn btn-sm btn-outline-dark rounded-circle d-inline-flex align-items-center justify-content-center" style="width:34px;height:34px;" title="Share on X / Twitter"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="https://t.me/share/url?url={{ rawurlencode(route('article.show', $article->slug)) }}&text={{ rawurlencode($article->title) }}" target="_blank" class="btn btn-sm btn-outline-info rounded-circle d-inline-flex align-items-center justify-content-center" style="width:34px;height:34px;" title="Share on Telegram"><i class="fa-brands fa-telegram"></i></a>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-circle d-inline-flex align-items-center justify-content-center" style="width:34px;height:34px;" title="Copy Story Link" onclick="navigator.clipboard.writeText('{{ route('article.show', $article->slug) }}'); this.innerHTML='<i class=\'fa-solid fa-check text-success\'></i>'; setTimeout(() => this.innerHTML='<i class=\'fa-regular fa-copy\'></i>', 2000);"><i class="fa-regular fa-copy"></i></button>
                    <button type="button" class="btn btn-sm btn-danger rounded-circle d-inline-flex align-items-center justify-content-center d-md-none" style="width:34px;height:34px;" title="Share via Mobile" onclick="if(navigator.share){navigator.share({title:{{ json_encode($article->title) }},text:{{ json_encode($article->meta_description ?? ($article->summary ?? '')) }},url:{{ json_encode(route('article.show', $article->slug)) }}});}"><i class="fa-solid fa-arrow-up-from-bracket"></i></button>
                </div>
            </div>

            <!-- Featured Image -->
            <div class="mb-4">
                <div class="rounded-3 overflow-hidden shadow-sm" style="max-height: 520px; background-color: #000;">
                    <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="img-fluid w-100" style="object-fit: cover; max-height: 520px;" onerror="this.onerror=null; this.src='{{ asset('images/placeholder.png') }}';">
                </div>
                @if($article->image_caption)
                    <figcaption class="text-muted small mt-2 fst-italic">
                        <i class="fa-solid fa-camera me-1"></i> {{ $article->image_caption }}
                    </figcaption>
                @endif
            </div>

            <!-- Rich Body Content -->
            <div class="article-body mb-5" style="font-size: 1.1rem; line-height: 1.8; color: #334155;">
                {!! $article->content !!}
            </div>

            <!-- Tags -->
            @if($article->tags)
                <div class="d-flex align-items-center flex-wrap gap-2 pt-3 pb-4 border-top">
                    <span class="text-muted small fw-bold"><i class="fa-solid fa-tags me-1"></i> Topics:</span>
                    @foreach(explode(',', $article->tags) as $tag)
                        <a href="{{ route('search', ['q' => trim($tag)]) }}" class="badge bg-light text-dark border px-3 py-2 fw-normal">
                            #{{ trim($tag) }}
                        </a>
                    @endforeach
                </div>
            @endif

            <!-- Share Bar Bottom Callout -->
            <div class="p-3 my-4 bg-light rounded-3 border d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center gap-2">
                    <i class="fa-solid fa-share-nodes text-danger fs-5"></i>
                    <span class="fw-bold text-dark small">Liked this story? Share with your friends:</span>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a href="https://api.whatsapp.com/send?text={{ rawurlencode($article->title . "\n\n" . route('article.show', $article->slug)) }}" target="_blank" class="btn btn-sm btn-success rounded-pill px-3 fw-bold d-inline-flex align-items-center gap-1 shadow-sm">
                        <i class="fa-brands fa-whatsapp fs-6"></i> WhatsApp
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ rawurlencode(route('article.show', $article->slug)) }}" target="_blank" class="btn btn-sm btn-primary rounded-circle d-inline-flex align-items-center justify-content-center" style="width:34px;height:34px;" title="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="https://twitter.com/intent/tweet?text={{ rawurlencode($article->title) }}&url={{ rawurlencode(route('article.show', $article->slug)) }}" target="_blank" class="btn btn-sm btn-dark rounded-circle d-inline-flex align-items-center justify-content-center" style="width:34px;height:34px;" title="Twitter"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="https://t.me/share/url?url={{ rawurlencode(route('article.show', $article->slug)) }}&text={{ rawurlencode($article->title) }}" target="_blank" class="btn btn-sm btn-info text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width:34px;height:34px;" title="Telegram"><i class="fa-brands fa-telegram"></i></a>
                </div>
            </div>

            <!-- Prev / Next Navigation -->
            <div class="row g-3 my-4 py-3 border-top border-bottom">
                <div class="col-6">
                    @if($prevArticle)
                        <a href="{{ route('article.show', $prevArticle->slug) }}" class="text-decoration-none d-block">
                            <span class="small text-muted text-uppercase fw-bold"><i class="fa-solid fa-arrow-left me-1"></i> Previous Story</span>
                            <div class="fw-semibold text-truncate small mt-1 text-dark">{{ $prevArticle->title }}</div>
                        </a>
                    @endif
                </div>
                <div class="col-6 text-end">
                    @if($nextArticle)
                        <a href="{{ route('article.show', $nextArticle->slug) }}" class="text-decoration-none d-block">
                            <span class="small text-muted text-uppercase fw-bold">Next Story <i class="fa-solid fa-arrow-right ms-1"></i></span>
                            <div class="fw-semibold text-truncate small mt-1 text-dark">{{ $nextArticle->title }}</div>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Author Box -->
            <div class="p-4 mb-5 rounded bg-light border d-flex gap-3 align-items-center">
                <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center fw-bold flex-shrink-0" style="width: 60px; height: 60px; font-size: 1.5rem;">
                    {{ substr($article->author->name ?? 'W', 0, 1) }}
                </div>
                <div>
                    <h5 class="fw-bold mb-1">{{ $article->author->name ?? 'Staff Correspondent' }}</h5>
                    <p class="text-secondary small mb-0">Senior reporter at World Eyes News specializing in in-depth investigative reporting, geopolitics, and global developments.</p>
                </div>
            </div>

            <!-- Comments Section -->
            <section class="comments-section mb-5" id="comments">
                <div class="section-header">
                    <h3 class="section-title">Reader Discussion ({{ $article->comments->count() }})</h3>
                </div>

                @if(session('comment_success'))
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        <i class="fa-solid fa-circle-check me-2"></i> {{ session('comment_success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Comments List -->
                <div class="comments-list mb-5">
                    @forelse($article->comments as $cmt)
                        <div class="p-3 mb-3 bg-white rounded border">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 32px; height: 32px; font-size: 0.85rem;">
                                        {{ substr($cmt->name, 0, 1) }}
                                    </div>
                                    <span class="fw-bold text-dark">{{ $cmt->name }}</span>
                                </div>
                                <span class="text-muted small">{{ $cmt->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-secondary mb-0 small" style="line-height: 1.6;">{{ $cmt->comment }}</p>
                        </div>
                    @empty
                        <div class="p-4 text-center bg-light rounded text-muted">
                            <i class="fa-regular fa-comments fs-3 mb-2 d-block text-secondary"></i>
                            No comments yet. Start the conversation below!
                        </div>
                    @endforelse
                </div>

                <!-- Leave Comment Form -->
                <div class="widget-box">
                    <h4 class="fw-bold serif-font mb-3">Leave a Reply</h4>
                    <p class="text-muted small mb-4">Your email address will not be published. Required fields are marked *</p>

                    <form action="{{ route('comment.store', $article->id) }}" method="POST">
                        @csrf
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Your Name *</label>
                                <input type="text" name="name" class="form-control" placeholder="Your full name" required value="{{ old('name') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Email Address *</label>
                                <input type="email" name="email" class="form-control" placeholder="Your email address" required value="{{ old('email') }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Your Comment *</label>
                            <textarea name="comment" class="form-control" rows="4" placeholder="Join the discussion with thoughtful analysis..." required>{{ old('comment') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-danger fw-bold px-4">
                            <i class="fa-regular fa-paper-plane me-1"></i> Post Comment
                        </button>
                    </form>
                </div>
            </section>

        </article>

        <!-- Sidebar Column (4 cols) -->
        <aside class="col-lg-4">

            <!-- Related Articles -->
            @if($relatedArticles->isNotEmpty())
                <div class="widget-box">
                    <div class="widget-title"><i class="fa-solid fa-newspaper text-danger me-1"></i> Related Stories</div>
                    <div>
                        @foreach($relatedArticles as $rel)
                            <div class="trending-item">
                                <div class="flex-shrink-0" style="width: 80px; height: 60px; border-radius: 4px; overflow: hidden;">
                                    <img src="{{ $rel->image_url }}" alt="{{ $rel->title }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.onerror=null; this.src='{{ asset('images/placeholder.png') }}';">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold mb-1" style="font-size: 0.85rem; line-height: 1.3;">
                                        <a href="{{ route('article.show', $rel->slug) }}">
                                            {{ Str::limit($rel->title, 60) }}
                                        </a>
                                    </h6>
                                    <span class="text-muted small" style="font-size: 0.72rem;">
                                        <i class="fa-regular fa-clock me-1"></i> {{ $rel->published_at ? $rel->published_at->diffForHumans() : 'Recent' }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Trending Sidebar -->
            <div class="widget-box">
                <div class="widget-title"><i class="fa-solid fa-chart-line text-primary me-1"></i> Trending Global</div>
                <div>
                    @foreach($trendingSidebar as $sIdx => $trend)
                        <div class="trending-item">
                            <div class="trending-num">{{ sprintf('%02d', $sIdx + 1) }}</div>
                            <div>
                                <h6 class="fw-bold mb-1" style="font-size: 0.85rem; line-height: 1.3;">
                                    <a href="{{ route('article.show', $trend->slug) }}">
                                        {{ $trend->title }}
                                    </a>
                                </h6>
                                <span class="text-muted small" style="font-size: 0.72rem;">
                                    <i class="fa-regular fa-eye me-1"></i> {{ number_format($trend->views_count) }} views
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Categories Box -->
            <div class="widget-box">
                <div class="widget-title"><i class="fa-solid fa-layer-group text-danger me-1"></i> Desks & Topics</div>
                <div class="d-flex flex-wrap gap-2">
                    @foreach($navCategories as $catItem)
                        <a href="{{ route('category.show', $catItem->slug) }}" class="btn btn-sm btn-outline-secondary">
                            {{ $catItem->name }}
                        </a>
                    @endforeach
                </div>
            </div>

        </aside>
    </div>

</div>
@endsection
