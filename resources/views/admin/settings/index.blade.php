@extends('admin.layouts.app')

@section('page_title', 'Global Portal Settings')

@section('content')

<form action="{{ route('admin.settings.update') }}" method="POST">
    @csrf

    <div class="row g-4">
        <!-- Col 1: General Brand (6 cols) -->
        <div class="col-lg-6">
            <div class="p-4 rounded bg-white border h-100">
                <h6 class="fw-bold text-dark border-bottom pb-2 mb-3"><i class="fa-solid fa-globe text-danger me-2"></i> Brand & Editorial Identity</h6>

                <div class="mb-3">
                    <label class="form-label fw-bold small text-dark">Portal Name</label>
                    <input type="text" name="site_name" class="form-control" value="{{ old('site_name', $settings['site_name'] ?? 'World Eyes News') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold small text-dark">Editorial Tagline</label>
                    <input type="text" name="tagline" class="form-control" value="{{ old('tagline', $settings['tagline'] ?? '') }}" placeholder="e.g. Global Insight, Uncompromised Truth">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold small text-dark">About World Eyes News (Shown in Footer & Metadata)</label>
                    <textarea name="about_text" class="form-control" rows="4">{{ old('about_text', $settings['about_text'] ?? '') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold small text-dark">Footer Copyright Notice</label>
                    <input type="text" name="footer_copyright" class="form-control" value="{{ old('footer_copyright', $settings['footer_copyright'] ?? '') }}">
                </div>
            </div>
        </div>

        <!-- Col 2: Contact & Social (6 cols) -->
        <div class="col-lg-6">
            <div class="p-4 rounded bg-white border mb-4">
                <h6 class="fw-bold text-dark border-bottom pb-2 mb-3"><i class="fa-solid fa-address-book text-primary me-2"></i> Editorial Newsroom Contact</h6>

                <div class="mb-3">
                    <label class="form-label fw-bold small text-dark">Public Contact Email</label>
                    <input type="email" name="contact_email" class="form-control form-control-sm" value="{{ old('contact_email', $settings['contact_email'] ?? '') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold small text-dark">Headquarters Phone</label>
                    <input type="text" name="contact_phone" class="form-control form-control-sm" value="{{ old('contact_phone', $settings['contact_phone'] ?? '') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold small text-dark">Newsroom Address</label>
                    <input type="text" name="address" class="form-control form-control-sm" value="{{ old('address', $settings['address'] ?? '') }}">
                </div>
            </div>

            <div class="p-4 rounded bg-white border">
                <h6 class="fw-bold text-dark border-bottom pb-2 mb-3"><i class="fa-solid fa-share-nodes text-danger me-2"></i> Official Social Channels</h6>

                <div class="mb-2">
                    <label class="form-label fw-semibold small text-dark mb-1"><i class="fa-brands fa-x-twitter me-1"></i> Twitter / X URL</label>
                    <input type="url" name="social_twitter" class="form-control form-control-sm" value="{{ old('social_twitter', $settings['social_twitter'] ?? '') }}">
                </div>

                <div class="mb-2">
                    <label class="form-label fw-semibold small text-dark mb-1"><i class="fa-brands fa-facebook me-1 text-primary"></i> Facebook URL</label>
                    <input type="url" name="social_facebook" class="form-control form-control-sm" value="{{ old('social_facebook', $settings['social_facebook'] ?? '') }}">
                </div>

                <div class="mb-2">
                    <label class="form-label fw-semibold small text-dark mb-1"><i class="fa-brands fa-instagram me-1 text-danger"></i> Instagram URL</label>
                    <input type="url" name="social_instagram" class="form-control form-control-sm" value="{{ old('social_instagram', $settings['social_instagram'] ?? '') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold small text-dark mb-1"><i class="fa-brands fa-youtube me-1 text-danger"></i> YouTube URL</label>
                    <input type="url" name="social_youtube" class="form-control form-control-sm" value="{{ old('social_youtube', $settings['social_youtube'] ?? '') }}">
                </div>

                <button type="submit" class="btn btn-danger w-100 fw-bold py-2">
                    <i class="fa-solid fa-floppy-disk me-1"></i> Save Global Settings
                </button>
            </div>
        </div>
    </div>
</form>

@endsection
