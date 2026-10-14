@extends('admin.layouts.app')

@section('page_title', 'Dashboard Overview')

@section('content')

<!-- Stat Cards -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card d-flex align-items-center justify-content-between">
            <div>
                <div class="text-muted small fw-semibold text-uppercase">Total Articles</div>
                <div class="fs-2 fw-bold text-dark mt-1">{{ number_format($stats['total_articles']) }}</div>
                <div class="small text-success mt-1">
                    <i class="fa-solid fa-circle-check me-1"></i> {{ $stats['published_articles'] }} Published
                </div>
            </div>
            <div class="stat-icon bg-danger bg-opacity-10 text-danger">
                <i class="fa-solid fa-newspaper"></i>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="stat-card d-flex align-items-center justify-content-between">
            <div>
                <div class="text-muted small fw-semibold text-uppercase">News Desks / Cats</div>
                <div class="fs-2 fw-bold text-dark mt-1">{{ number_format($stats['total_categories']) }}</div>
                <div class="small text-muted mt-1">
                    Active Categories
                </div>
            </div>
            <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                <i class="fa-solid fa-layer-group"></i>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="stat-card d-flex align-items-center justify-content-between">
            <div>
                <div class="text-muted small fw-semibold text-uppercase">Total Readers Views</div>
                <div class="fs-2 fw-bold text-dark mt-1">{{ number_format($stats['total_views']) }}</div>
                <div class="small text-info mt-1">
                    <i class="fa-solid fa-chart-line me-1"></i> Global Engagement
                </div>
            </div>
            <div class="stat-icon bg-info bg-opacity-10 text-info">
                <i class="fa-solid fa-eye"></i>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="stat-card d-flex align-items-center justify-content-between">
            <div>
                <div class="text-muted small fw-semibold text-uppercase">Reader Comments</div>
                <div class="fs-2 fw-bold text-dark mt-1">{{ number_format($stats['total_comments']) }}</div>
                <div class="small text-muted mt-1">
                    Discussions
                </div>
            </div>
            <div class="stat-icon bg-success bg-opacity-10 text-success">
                <i class="fa-solid fa-comments"></i>
            </div>
        </div>
    </div>
</div>

<!-- Quick Action Shortcuts -->
<div class="p-3 mb-4 rounded bg-white border d-flex flex-wrap align-items-center justify-content-between gap-3">
    <div>
        <h6 class="fw-bold mb-0 text-dark">Editorial Newsroom Quick Actions</h6>
        <span class="text-muted small">Create, edit, or publish articles immediately to front-end</span>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <a href="{{ route('admin.articles.create') }}" class="btn btn-danger btn-sm fw-bold">
            <i class="fa-solid fa-plus me-1"></i> New Article
        </a>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-dark btn-sm">
            <i class="fa-solid fa-folder-plus me-1"></i> Manage Categories
        </a>
        <a href="{{ route('admin.settings.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fa-solid fa-sliders me-1"></i> Site Settings
        </a>
    </div>
</div>

<!-- Main Dashboard Grid -->
<div class="row g-4">
    <!-- Left Column: Recent Articles (8 cols) -->
    <div class="col-lg-8">
        <div class="admin-table">
            <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0 text-dark"><i class="fa-solid fa-clock-rotate-left text-danger me-2"></i> Recent Articles</h6>
                <a href="{{ route('admin.articles.index') }}" class="small fw-semibold text-danger">View All Articles →</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Story</th>
                            <th>Desk</th>
                            <th>Status</th>
                            <th>Views</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentArticles as $art)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2" style="max-width: 320px;">
                                        <img src="{{ $art->image_url }}" alt="" class="rounded flex-shrink-0" style="width: 44px; height: 32px; object-fit: cover;">
                                        <div class="text-truncate fw-semibold text-dark" title="{{ $art->title }}">
                                            {{ $art->title }}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge" style="background-color: {{ $art->category->color ?? '#dc2626' }};">
                                        {{ $art->category->name }}
                                    </span>
                                </td>
                                <td>
                                    @if($art->status === 'published')
                                        <span class="badge bg-success">Published</span>
                                    @else
                                        <span class="badge bg-secondary">Draft</span>
                                    @endif
                                </td>
                                <td>{{ number_format($art->views_count) }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('article.show', $art->slug) }}" target="_blank" class="btn btn-outline-secondary" title="View on site"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                        <a href="{{ route('admin.articles.edit', $art->id) }}" class="btn btn-outline-primary" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Right Column: Top Stories & Moderation (4 cols) -->
    <div class="col-lg-4">
        <!-- Most Viewed Stories -->
        <div class="admin-table mb-4">
            <div class="p-3 border-bottom">
                <h6 class="fw-bold mb-0 text-dark"><i class="fa-solid fa-fire text-danger me-2"></i> Top Performed Stories</h6>
            </div>
            <div class="p-3">
                @foreach($topArticles as $tArt)
                    <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                        <div class="text-truncate me-2" style="max-width: 220px;">
                            <a href="{{ route('article.show', $tArt->slug) }}" target="_blank" class="small fw-semibold text-dark text-truncate d-block">
                                {{ $tArt->title }}
                            </a>
                            <span class="badge" style="background-color: {{ $tArt->category->color }}; font-size: 0.65rem;">
                                {{ $tArt->category->name }}
                            </span>
                        </div>
                        <span class="badge bg-light text-dark border font-monospace">
                            {{ number_format($tArt->views_count) }} <i class="fa-regular fa-eye small text-muted"></i>
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Latest Comments -->
        <div class="admin-table">
            <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0 text-dark"><i class="fa-solid fa-comments text-success me-2"></i> Recent Comments</h6>
                <a href="{{ route('admin.comments.index') }}" class="small fw-semibold text-danger">Moderate →</a>
            </div>
            <div class="p-3">
                @forelse($recentComments as $cmt)
                    <div class="mb-3 pb-2 border-bottom">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="fw-bold small text-dark">{{ $cmt->name }}</span>
                            <span class="text-muted small" style="font-size: 0.72rem;">{{ $cmt->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="small text-muted mb-1 text-truncate" title="{{ $cmt->comment }}">"{{ $cmt->comment }}"</p>
                        <small class="text-danger fw-semibold d-block text-truncate" style="font-size: 0.72rem;">
                            On: {{ $cmt->article->title ?? 'Deleted story' }}
                        </small>
                    </div>
                @empty
                    <div class="text-center text-muted small py-3">No recent comments</div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection
