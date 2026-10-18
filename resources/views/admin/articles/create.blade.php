@extends('admin.layouts.app')

@section('page_title', 'Create New Article')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
<style>
    .ql-toolbar.ql-snow {
        border-top-left-radius: 6px;
        border-top-right-radius: 6px;
        background-color: #f8fafc;
        border-color: #cbd5e1;
        position: sticky;
        top: 0;
        z-index: 10;
    }
    .ql-container.ql-snow {
        border-bottom-left-radius: 6px;
        border-bottom-right-radius: 6px;
        border-color: #cbd5e1;
        min-height: 400px;
        font-size: 1.05rem;
        background: #ffffff;
    }
    .ql-editor {
        min-height: 380px;
        line-height: 1.75;
        font-family: inherit;
    }
    .ql-editor p {
        margin-bottom: 1.15rem;
    }
    .ql-editor h2, .ql-editor h3, .ql-editor h4 {
        margin-top: 1.5rem;
        margin-bottom: 0.75rem;
        font-weight: 700;
    }
    .ql-editor img {
        max-width: 100%;
        height: auto;
        border-radius: 6px;
        margin: 1.25rem auto;
        display: block;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    .ql-editor blockquote {
        border-left: 4px solid #dc2626;
        padding-left: 1rem;
        color: #475569;
        font-style: italic;
    }
</style>
@endpush

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

                <!-- Content Body with Rich WYSIWYG Editor -->
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="form-label fw-bold small text-dark mb-0">
                            <i class="fa-solid fa-pen-nib text-danger me-1"></i> Full Story Content <span class="text-danger">*</span>
                        </label>
                        <div class="d-flex align-items-center gap-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary py-1 px-2" id="toggleHtmlBtn" onclick="toggleHtmlMode()">
                                <i class="fa-solid fa-code me-1"></i> <span id="htmlModeLabel">Edit HTML Source</span>
                            </button>
                        </div>
                    </div>

                    <!-- Quill Visual Editor Container -->
                    <div id="quillEditorWrapper">
                        <div id="quillEditor">{!! old('content') !!}</div>
                    </div>

                    <!-- Direct HTML Textarea (Form Submission & HTML Mode) -->
                    <textarea name="content" id="contentInput" class="form-control font-monospace d-none" rows="16" placeholder="Write or edit HTML source here..." required>{{ old('content') }}</textarea>

                    <div class="d-flex justify-content-between align-items-center mt-2 small text-muted">
                        <div>
                            <i class="fa-regular fa-keyboard me-1 text-danger"></i> <strong>Enter</strong> press karne par automatically naya paragraph banega. Toolbar se <strong>Heading</strong>, <strong>Bold</strong>, <strong>Anchor Link</strong> aur <strong>Image URL</strong> insert karein.
                        </div>
                        <div id="editorWordCount" class="fw-semibold text-dark">0 words</div>
                    </div>
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
                    <input type="text" name="image_url" id="imageUrlInput" class="form-control form-control-sm" placeholder="https://images.unsplash.com/..." value="{{ old('image_url') }}" oninput="previewUrl(this.value)">
                    <div class="form-text small">Enter image link from web if not uploading local file.</div>
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
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
<script>
    let isHtmlMode = false;
    let quill;

    document.addEventListener('DOMContentLoaded', function() {
        const toolbarOptions = [
            [{ 'header': [2, 3, 4, false] }],
            ['bold', 'italic', 'underline', 'strike'],
            [{ 'color': [] }, { 'background': [] }],
            ['blockquote', 'code-block'],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            [{ 'align': [] }],
            ['link', 'image'],
            ['clean']
        ];

        quill = new Quill('#quillEditor', {
            theme: 'snow',
            modules: {
                toolbar: {
                    container: toolbarOptions,
                    handlers: {
                        image: handleQuillImage
                    }
                }
            },
            placeholder: 'Write your story content here... Press Enter for a new paragraph.'
        });

        const textarea = document.getElementById('contentInput');

        // Real-time synchronization
        quill.on('text-change', function() {
            if (!isHtmlMode) {
                textarea.value = quill.root.innerHTML === '<p><br></p>' ? '' : quill.root.innerHTML;
                updateWordCount();
            }
        });

        // Ensure sync before form submit
        const form = textarea.closest('form');
        if (form) {
            form.addEventListener('submit', function() {
                if (!isHtmlMode) {
                    textarea.value = quill.root.innerHTML === '<p><br></p>' ? '' : quill.root.innerHTML;
                }
            });
        }

        updateWordCount();
    });

    // Custom Image Handler: Allows pasting Image URL OR selecting local file
    function handleQuillImage() {
        const choice = prompt('Enter Image URL (e.g. https://example.com/photo.jpg):\n\nTip: Leave empty and click OK to select an image from your computer.');
        if (choice !== null && choice.trim() !== '') {
            let cleanUrl = choice.trim();
            if (!cleanUrl.startsWith('http://') && !cleanUrl.startsWith('https://') && !cleanUrl.startsWith('//')) {
                cleanUrl = 'https://' + cleanUrl;
            }
            const range = quill.getSelection(true);
            quill.insertEmbed(range.index, 'image', cleanUrl);
            quill.setSelection(range.index + 1);
        } else if (choice === '') {
            const fileInput = document.createElement('input');
            fileInput.type = 'file';
            fileInput.accept = 'image/*';
            fileInput.click();
            fileInput.onchange = function() {
                if (fileInput.files && fileInput.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const range = quill.getSelection(true);
                        quill.insertEmbed(range.index, 'image', e.target.result);
                        quill.setSelection(range.index + 1);
                    };
                    reader.readAsDataURL(fileInput.files[0]);
                }
            };
        }
    }

    // Toggle between Visual WYSIWYG and HTML Source Code
    function toggleHtmlMode() {
        const textarea = document.getElementById('contentInput');
        const wrapper = document.getElementById('quillEditorWrapper');
        const label = document.getElementById('htmlModeLabel');
        const btn = document.getElementById('toggleHtmlBtn');
        const toolbar = document.querySelector('.ql-toolbar');

        if (!isHtmlMode) {
            textarea.value = quill.root.innerHTML === '<p><br></p>' ? '' : quill.root.innerHTML;
            wrapper.classList.add('d-none');
            if (toolbar) toolbar.classList.add('d-none');
            textarea.classList.remove('d-none');
            label.textContent = 'Switch to Visual Editor';
            btn.classList.replace('btn-outline-secondary', 'btn-danger');
            isHtmlMode = true;
        } else {
            quill.root.innerHTML = textarea.value;
            textarea.classList.add('d-none');
            wrapper.classList.remove('d-none');
            if (toolbar) toolbar.classList.remove('d-none');
            label.textContent = 'Edit HTML Source';
            btn.classList.replace('btn-danger', 'btn-outline-secondary');
            isHtmlMode = false;
            updateWordCount();
        }
    }

    function updateWordCount() {
        const text = quill ? quill.getText().trim() : '';
        const words = text ? text.split(/\s+/).filter(Boolean).length : 0;
        const countEl = document.getElementById('editorWordCount');
        if (countEl) {
            countEl.textContent = words + ' words';
        }
    }

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

    function previewUrl(url) {
        url = url.trim();
        const preview = document.getElementById('imagePreview');
        const container = document.getElementById('previewContainer');
        if (url) {
            if (!url.startsWith('http://') && !url.startsWith('https://') && !url.startsWith('//')) {
                url = 'https://' + url;
            }
            preview.src = url;
            container.classList.remove('d-none');
        }
    }
</script>
@endpush
