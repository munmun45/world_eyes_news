@extends('admin.layouts.app')

@section('page_title', 'Edit Desk: ' . $category->name)

@section('content')

<div class="mb-3">
    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="fa-solid fa-arrow-left me-1"></i> Back to Categories
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="p-4 rounded bg-white border">
            <h5 class="fw-bold text-dark border-bottom pb-2 mb-3">Update Category Details</h5>

            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-bold small text-dark">Category Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold small text-dark">URL Slug <span class="text-danger">*</span></label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-light text-muted">/category/</span>
                        <input type="text" name="slug" class="form-control font-monospace" value="{{ old('slug', $category->slug) }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold small text-dark">Color Accent</label>
                    <div class="d-flex align-items-center gap-2">
                        <input type="color" name="color" class="form-control form-control-color" value="{{ old('color', $category->color) }}">
                        <span class="small text-muted">Visual theme badge for articles in this desk</span>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold small text-dark">Display Order</label>
                    <input type="number" name="order" class="form-control form-control-sm" value="{{ old('order', $category->order) }}" min="0">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold small text-dark">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $category->description) }}</textarea>
                </div>

                <div class="mb-3 form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="catActive" {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                    <label class="form-check-label small fw-semibold" for="catActive">Show in Main Navigation</label>
                </div>

                <button type="submit" class="btn btn-danger w-100 fw-bold py-2 mt-2">
                    <i class="fa-solid fa-check me-1"></i> Update Category
                </button>
            </form>
        </div>
    </div>
</div>

@endsection
