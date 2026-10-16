@extends('admin.layouts.app')

@section('page_title', 'All Articles & Stories')

@section('content')

<!-- Header & Filter Bar -->
<div class="p-3 mb-4 rounded bg-white border">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
        <div>
            <h5 class="fw-bold mb-0 text-dark">Articles Newsroom</h5>
            <small class="text-muted">Manage, publish, and curate stories for the public portal</small>
        </div>
        <a href="{{ route('admin.articles.create') }}" class="btn btn-danger btn-sm fw-bold px-3">
            <i class="fa-solid fa-plus me-1"></i> Create New Article
        </a>
    </div>

    <!-- Filters -->
    <form action="{{ route('admin.articles.index') }}" method="GET" class="row g-2">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control form-control-sm" placeholder="Search by title or tags..." value="{{ request('search') }}">
        </div>
        <div class="col-md-3">
            <select name="category" class="form-select form-select-sm">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select form-select-sm">
                <option value="">All Statuses</option>
                <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
                <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
            </select>
        </div>
        <div class="col-md-2 d-flex gap-2">
            <button type="submit" class="btn btn-dark btn-sm flex-grow-1"><i class="fa-solid fa-filter me-1"></i> Filter</button>
            @if(request()->hasAny(['search', 'category', 'status']))
                <a href="{{ route('admin.articles.index') }}" class="btn btn-outline-secondary btn-sm" title="Clear Filters"><i class="fa-solid fa-xmark"></i></a>
            @endif
        </div>
    </form>
</div>

<!-- Articles Table -->
<div class="admin-table">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th style="width: 50px;">Media</th>
                    <th>Story Details</th>
                    <th>Desk</th>
                    <th>Breaking</th>
                    <th>Featured</th>
                    <th>Status</th>
                    <th>Views</th>
                    <th>Published</th>
                    <th style="width: 140px;" class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($articles as $art)
                    <tr>
                        <td>
                            <img src="{{ $art->image_url }}" alt="" class="rounded" style="width: 54px; height: 38px; object-fit: cover;" onerror="this.onerror=null; this.src='{{ asset('images/placeholder.png') }}';">
                        </td>
                        <td>
                            <div class="fw-bold text-dark mb-1" style="max-width: 380px;">
                                <a href="{{ route('admin.articles.edit', $art->id) }}" class="text-dark">
                                    {{ $art->title }}
                                </a>
                            </div>
                            <small class="text-muted d-block" style="font-size: 0.75rem;">
                                By {{ $art->author->name ?? 'Staff' }} • <code class="text-secondary">/article/{{ $art->slug }}</code>
                            </small>
                        </td>
                        <td>
                            <span class="badge" style="background-color: {{ $art->category->color ?? '#dc2626' }};">
                                {{ $art->category->name }}
                            </span>
                        </td>
                        <td>
                            <form action="{{ route('admin.articles.toggleBreaking', $art->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="badge border-0 {{ $art->is_breaking ? 'bg-danger' : 'bg-light text-muted border' }}" style="cursor: pointer;" title="Toggle Breaking status">
                                    <i class="fa-solid fa-bolt me-1"></i> {{ $art->is_breaking ? 'Breaking' : 'Normal' }}
                                </button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('admin.articles.toggleFeatured', $art->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="badge border-0 {{ $art->is_featured ? 'bg-warning text-dark' : 'bg-light text-muted border' }}" style="cursor: pointer;" title="Toggle Featured status">
                                    <i class="fa-solid fa-star me-1"></i> {{ $art->is_featured ? 'Hero Lead' : 'Standard' }}
                                </button>
                            </form>
                        </td>
                        <td>
                            @if($art->status === 'published')
                                <span class="badge bg-success"><i class="fa-solid fa-circle-check me-1"></i> Published</span>
                            @else
                                <span class="badge bg-secondary"><i class="fa-solid fa-file-lines me-1"></i> Draft</span>
                            @endif
                        </td>
                        <td class="font-monospace small">{{ number_format($art->views_count) }}</td>
                        <td class="text-muted small" style="white-space: nowrap;">
                            {{ $art->published_at ? $art->published_at->format('M j, Y') : 'Unpublished' }}
                        </td>
                        <td class="text-end">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('article.show', $art->slug) }}" target="_blank" class="btn btn-outline-secondary" title="View Story on Site">
                                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                </a>
                                <a href="{{ route('admin.articles.edit', $art->id) }}" class="btn btn-outline-primary" title="Edit Story">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('admin.articles.destroy', $art->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete this article?');" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" title="Delete Story">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center py-4 text-muted">
                            <i class="fa-regular fa-newspaper fs-2 d-block mb-2 text-secondary"></i>
                            No articles match your criteria.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($articles->hasPages())
        <div class="p-3 border-top d-flex justify-content-center">
            {{ $articles->links() }}
        </div>
    @endif
</div>

@endsection
