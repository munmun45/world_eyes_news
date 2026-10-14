@extends('admin.layouts.app')

@section('page_title', 'Create New Article')

@section('content')

<div class="mb-3">
    <a href="{{ route('admin.articles.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="fa-solid fa-arrow-left me-1"></i> Back to Articles
    </a>
</div>

<form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row g-4">
        <!-- Main Form Column (8 cols) -->
        <div class="col-lg-8">
            <div class="p-4 rounded bg-white border mb-4">
                <h6 class="fw-bold text-dark border-bottom pb-2 mb-3">Story Editorial Content</h6>

                <!-- Title -->
                <div class="mb-3">
                    <label class="form-label fw-bold small text-dark">Headline / Article Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="titleInput" class="form-control form-control-lg fw-bold" placeholder="Enter an engaging, authoritative headline..." value="{{ old('title') }}" required>
                </div>

                <!-- Summary / Excerpt -->
                <div class="mb-3">
                    <label class="form-label fw-bold small text-dark">Summary / Deck Lead</label>
                    <textarea name="summary" class="form-control" rows="3" placeholder="Brief 1-2 sentence overview shown in feeds, previews, and social share cards...">{{ old('summary') }}</textarea>
                    <div class="form-text small">Recommended: 120-160 characters for maximum search visibility.</div>
                </div>

                <!-- Content Body -->
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label class="form-label fw-bold small text-dark mb-0">Full Story Content (HTML Supported) <span class="text-danger">*</span></label>
                        <div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="insertTag('p')">&lt;p&gt;</button>
                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="insertTag('h3')">&lt;h3&gt;</button>
                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="insertTag('blockquote')">&lt;quote&gt;</button>
                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="insertTag('strong')">&lt;b&gt;</button>
                        </div>
                    </div>
                    <textarea name="content" id="contentInput" class="form-control font-monospace" rows="14" placeholder="Write or paste your article content here..." required>{{ old('content') }}</textarea>
                </div>
            </div>

            <!-- SEO & Metadata -->
            <div class="p-4 rounded bg-white border">
                <h6 class="fw-bold text-dark border-bottom pb-2 mb-3"><i class="fa-solid fa-magnifying-glass me-1"></i> Search Engine Optimization (SEO)</h6>
                <div class="mb-3">
                    <label class="form-label fw-bold small text-dark">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control form-control-sm" placeholder="Custom SEO Page Title (optional)" value="{{ old('meta_title') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold small text-dark">Meta Description</label>
                    <textarea name="meta_description" class="form-control form-control-sm" rows="2" placeholder="Custom meta description for Google search snippet...">{{ old('meta_description') }}</textarea>
                </div>
                <div>
                    <label class="form-label fw-bold small text-dark">Topics & Tags (Comma Separated)</label>
                    <input type="text" name="tags" class="form-control form-control-sm" placeholder="e.g. Geopolitics, Economy, Breaking, Tech" value="{{ old('tags') }}">
                </div>
            </div>
        </div>

        <!-- Sidebar Options (4 cols) -->
        <div class="col-lg-4">
            <!-- Publishing Actions -->
            <div class="p-4 rounded bg-white border mb-4">
                <h6 class="fw-bold text-dark border-bottom pb-2 mb-3"><i class="fa-solid fa-paper-plane me-1"></i> Publication Status</h6>

                <div class="mb-3">
                    <label class="form-label fw-bold small text-dark">Status</label>
                    <select name="status" class="form-select">
                        <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published (Live immediately)</option>
                        <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft (Save as work-in-progress)</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold small text-dark">Desk / Category <span class="text-danger">*</span></label>
                    <select name="category_id" class="form-select" required>
                        <option value="">Select Desk...</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <hr class="my-3">

                <!-- Editorial Flags -->
                <div class="mb-2 form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_breaking" value="1" id="isBreaking" {{ old('is_breaking') ? 'checked' : '' }}>
                    <label class="form-check-label fw-semibold small text-danger" for="isBreaking">
                        <i class="fa-solid fa-bolt me-1"></i> Breaking News Ticker
                    </label>
                </div>

                <div class="mb-2 form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="isFeatured" {{ old('is_featured') ? 'checked' : '' }}>
                    <label class="form-check-label fw-semibold small text-warning" for="isFeatured">
                        <i class="fa-solid fa-star me-1"></i> Hero Lead Story
                    </label>
                </div>

                <div class="mb-3 form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_trending" value="1" id="isTrending" {{ old('is_trending') ? 'checked' : '' }}>
                    <label class="form-check-label fw-semibold small text-primary" for="isTrending">
                        <i class="fa-solid fa-chart-line me-1"></i> Trending Highlight
                    </label>
                </div>

                <button type="submit" class="btn btn-danger w-100 fw-bold py-2 mt-2">
                    <i class="fa-solid fa-floppy-disk me-1"></i> Save & Publish Story
                </button>
            </div>

            <!-- Media / Featured Image Upload (Local Storage) -->
            <div class="p-4 rounded bg-white border">
                <h6 class="fw-bold text-dark border-bottom pb-2 mb-3"><i class="fa-solid fa-image me-1"></i> Featured Visual</h6>

                <!-- Local File Upload -->
                <div class="mb-3">
                    <label class="form-label fw-bold small text-dark">Upload Image (Local Storage)</label>
                    <input type="file" name="image" id="imageFileInput" class="form-control form-control-sm" accept="image/*" onchange="previewImage(event)">
                    <div class="form-text small">Stored securely in MySQL & local storage. JPG, PNG, WebP up to 10MB.</div>
                </div>

                <!-- Image Preview Box -->
                <div class="mb-3 text-center border rounded p-2 bg-light d-none" id="previewContainer">
                    <img id="imagePreview" src="" alt="Preview" class="img-fluid rounded" style="max-height: 180px;">
                </div>

                <!-- Or External Image URL -->
                <div class="mb-3">
                    <label class="form-label fw-bold small text-dark">Or External Image URL</label>
                    <input type="url" name="image_url" class="form-control form-control-sm" placeholder="https://images.unsplash.com/..." value="{{ old('image_url') }}">
                </div>

                <!-- Caption -->
                <div>
                    <label class="form-label fw-bold small text-dark">Image Caption / Photo Credit</label>
                    <input type="text" name="image_caption" class="form-control form-control-sm" placeholder="Photo: Reuters / World Eyes News" value="{{ old('image_caption') }}">
                </div>
            </div>
        </div>
    </div>
</form>

@endsection

@push('scripts')
<script>
    function previewImage(event) {
        const input = event.target;
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').src = e.target.result;
                document.getElementById('previewContainer').classList.remove('d-none');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function insertTag(tag) {
        const textarea = document.getElementById('contentInput');
        const start = textarea.selectionStart;
        const end = textarea.selectionEnd;
        const selected = textarea.value.substring(start, end);
        const replacement = `<${tag}>${selected || 'Text here'}</${tag}>`;
        textarea.setRangeText(replacement, start, end, 'end');
    }
</script>
@endpush
