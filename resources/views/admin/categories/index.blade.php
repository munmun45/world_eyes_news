@extends('admin.layouts.app')

@section('page_title', 'News Desks & Categories')

@section('content')

<div class="row g-4">
    <!-- Categories List (8 cols) -->
    <div class="col-lg-8">
        <div class="admin-table">
            <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0 text-dark"><i class="fa-solid fa-layer-group text-danger me-2"></i> All Desks ({{ $categories->count() }})</h6>
                <span class="text-muted small">Arranged by display priority</span>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th style="width: 50px;">Color</th>
                            <th>Desk Name</th>
                            <th>Slug</th>
                            <th>Articles</th>
                            <th>Order</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $cat)
                            <tr>
                                <td>
                                    <div class="rounded-circle shadow-sm border" style="width: 24px; height: 24px; background-color: {{ $cat->color }};" title="{{ $cat->color }}"></div>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $cat->name }}</div>
                                    @if($cat->description)
                                        <small class="text-muted d-block text-truncate" style="max-width: 260px;">{{ $cat->description }}</small>
                                    @endif
                                </td>
                                <td><code class="text-secondary">/category/{{ $cat->slug }}</code></td>
                                <td>
                                    <span class="badge bg-light text-dark border font-monospace">
                                        {{ $cat->articles_count }}
                                    </span>
                                </td>
                                <td>{{ $cat->order }}</td>
                                <td>
                                    @if($cat->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('category.show', $cat->slug) }}" target="_blank" class="btn btn-outline-secondary" title="View Public Desk">
                                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                        </a>
                                        <a href="{{ route('admin.categories.edit', $cat->id) }}" class="btn btn-outline-primary" title="Edit Desk">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger" title="Delete Desk" {{ $cat->articles_count > 0 ? 'disabled' : '' }}>
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">No categories created yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Quick Add Category Form (4 cols) -->
    <div class="col-lg-4">
        <div class="p-4 rounded bg-white border">
            <h6 class="fw-bold text-dark border-bottom pb-2 mb-3"><i class="fa-solid fa-plus text-danger me-1"></i> Add New Desk / Category</h6>

            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold small text-dark">Category Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control form-control-sm" placeholder="e.g. Asia Pacific, AI Ethics" required value="{{ old('name') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold small text-dark">URL Slug (Optional)</label>
                    <input type="text" name="slug" class="form-control form-control-sm font-monospace" placeholder="Auto-generated if blank" value="{{ old('slug') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold small text-dark">Color Accent</label>
                    <div class="d-flex align-items-center gap-2">
                        <input type="color" name="color" class="form-control form-control-color" value="{{ old('color', '#0d6efd') }}" title="Choose category badge color">
                        <span class="small text-muted">Badge color across portal</span>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold small text-dark">Display Order</label>
                    <input type="number" name="order" class="form-control form-control-sm" value="{{ old('order', 0) }}" min="0">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold small text-dark">Description</label>
                    <textarea name="description" class="form-control form-control-sm" rows="3" placeholder="Desk mandate and coverage scope...">{{ old('description') }}</textarea>
                </div>

                <div class="mb-3 form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="catActive" checked>
                    <label class="form-check-label small fw-semibold" for="catActive">Show in Main Navigation</label>
                </div>

                <button type="submit" class="btn btn-danger btn-sm w-100 fw-bold py-2">
                    <i class="fa-solid fa-folder-plus me-1"></i> Save Category
                </button>
            </form>
        </div>
    </div>
</div>

@endsection
