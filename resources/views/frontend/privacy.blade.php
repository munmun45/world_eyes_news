@extends('layouts.app')

@section('title', 'Privacy Policy - World Eyes News | Bringing The World Closer')
@section('meta_description', 'Privacy Policy for World Eyes News. Learn how we handle, protect, and respect your data across our MSME-registered and SSL-secured digital news platform.')

@section('content')
<div class="container py-3">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb small">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa-solid fa-house me-1"></i> Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Privacy Policy</li>
        </ol>
    </nav>

    <!-- Hero Header -->
    <div class="card border-0 text-white rounded-3 overflow-hidden mb-5 shadow-sm" style="background: linear-gradient(135deg, #0b1120 0%, #1e293b 100%);">
        <div class="card-body p-4 p-md-5">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <span class="badge bg-danger text-uppercase fw-bold px-3 py-2 mb-3">
                        <i class="fa-solid fa-user-shield me-1"></i> Data Privacy & Security
                    </span>
                    <h1 class="display-5 fw-bold serif-font mb-3">Privacy Policy</h1>
                    <p class="lead text-light opacity-90 fw-semibold mb-3" style="color: #fca5a5 !important;">
                        World Eyes News — Bringing The World Closer
                    </p>
                    <p class="text-light opacity-75 mb-0" style="max-width: 680px; font-size: 1.05rem; line-height: 1.7;">
                        Your trust is essential to credible journalism. As an <strong>MSME-registered</strong> and <strong>SSL-certified</strong> digital news media platform, World Eyes News is deeply committed to protecting the privacy, confidentiality, and security of our readers, subscribers, and contributors.
                    </p>
                </div>
                <div class="col-lg-4 text-center text-lg-end">
                    <div class="p-3 bg-black bg-opacity-25 rounded-3 border border-secondary border-opacity-25 d-inline-block text-start">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="fa-solid fa-lock text-success fs-5"></i>
                            <span class="small fw-bold text-white">SSL 256-Bit Encrypted</span>
                        </div>
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="fa-solid fa-shield-halved text-info fs-5"></i>
                            <span class="small fw-bold text-white">MSME Registered Entity</span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-calendar-check text-warning fs-5"></i>
                            <span class="small fw-bold text-white">Last Updated: October 2026</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Policy Content -->
    <div class="row g-4">
        <!-- Content Column -->
        <div class="col-lg-8">

            <!-- Section 1: Introduction -->
            <div class="card border-0 shadow-sm p-4 mb-4 bg-white">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="badge bg-danger bg-opacity-10 text-danger p-2 rounded-circle">
                        <i class="fa-solid fa-file-shield fs-5"></i>
                    </span>
                    <h4 class="fw-bold serif-font mb-0 text-dark">1. Introduction & Scope</h4>
                </div>
                <p class="text-secondary" style="line-height: 1.8;">
                    This Privacy Policy governs the manner in which <strong>World Eyes News</strong> ("we", "our", or "us") collects, uses, maintains, and discloses information gathered from users ("Users" or "Readers") of our website and digital services.
                </p>
                <p class="text-secondary mb-0" style="line-height: 1.8;">
                    By accessing or using our platform, you signify your acceptance of this policy. World Eyes News operates in strict adherence to applicable media and information technology laws, journalistic standards, and guidelines issued by the Press Council of India (PCI) and the Ministry of Information and Broadcasting (MIB), wherever applicable.
                </p>
            </div>

            <!-- Section 2: Information We Collect -->
            <div class="card border-0 shadow-sm p-4 mb-4 bg-white">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="badge bg-primary bg-opacity-10 text-primary p-2 rounded-circle">
                        <i class="fa-solid fa-database fs-5"></i>
                    </span>
                    <h4 class="fw-bold serif-font mb-0 text-dark">2. Information We Collect</h4>
                </div>
                <p class="text-secondary" style="line-height: 1.8;">
                    We may collect personal identification information from Users in various ways, including when Users visit our site, subscribe to the daily morning newsletter, submit comments on news articles, or fill out feedback forms:
                </p>
                <ul class="text-secondary" style="line-height: 1.8;">
                    <li><strong>Voluntarily Provided Information:</strong> Name, email address, and comment messages submitted during public discussions or editorial tip-offs.</li>
                    <li><strong>Technical Log Data:</strong> Internet Protocol (IP) address, browser type, operating system, Internet Service Provider (ISP), date/time stamps, and referring/exit pages to ensure site reliability and prevent automated abuse.</li>
                    <li><strong>Usage & Reading Analytics:</strong> Aggregated statistics regarding most-read articles, categories visited, and reading durations to help refine our journalistic coverage.</li>
                </ul>
            </div>

            <!-- Section 3: Cookies & Web Beacons -->
            <div class="card border-0 shadow-sm p-4 mb-4 bg-white">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="badge bg-warning bg-opacity-10 text-warning p-2 rounded-circle">
                        <i class="fa-solid fa-cookie-bite fs-5"></i>
                    </span>
                    <h4 class="fw-bold serif-font mb-0 text-dark">3. Cookies and Tracking Technologies</h4>
                </div>
                <p class="text-secondary" style="line-height: 1.8;">
                    World Eyes News uses "cookies" to enhance reader experience and analyze site traffic. Cookies are small files placed on your device's hard drive for record-keeping purposes and to retain user preferences (such as dark mode preferences or search queries).
                </p>
                <p class="text-secondary mb-0" style="line-height: 1.8;">
                    Users may choose to set their web browser to refuse cookies or to alert you when cookies are being sent. Note that some portions of the site may function with reduced personalization if cookies are disabled.
                </p>
            </div>

            <!-- Section 4: How We Use Collected Information -->
            <div class="card border-0 shadow-sm p-4 mb-4 bg-white">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="badge bg-success bg-opacity-10 text-success p-2 rounded-circle">
                        <i class="fa-solid fa-list-check fs-5"></i>
                    </span>
                    <h4 class="fw-bold serif-font mb-0 text-dark">4. How We Use Collected Information</h4>
                </div>
                <p class="text-secondary" style="line-height: 1.8;">
                    World Eyes News collects and uses User information solely for legitimate journalistic and operational purposes:
                </p>
                <ul class="text-secondary mb-0" style="line-height: 1.8;">
                    <li><strong>To Deliver News & Editorial Briefings:</strong> Sending requested email dispatches and breaking alerts.</li>
                    <li><strong>To Moderate Community Discussions:</strong> Ensuring reader comments remain respectful, constructive, and compliant with hate-speech laws.</li>
                    <li><strong>To Improve Platform Performance:</strong> Diagnosing server bottlenecks and optimizing mobile page-load speeds.</li>
                    <li><strong>To Protect Platform Integrity:</strong> Mitigating spam, brute-force attacks, and distributed denial-of-service attempts.</li>
                </ul>
            </div>

            <!-- Section 5: Data Security & SSL Certification -->
            <div class="card border-0 shadow-sm p-4 mb-4 bg-white">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="badge bg-danger bg-opacity-10 text-danger p-2 rounded-circle">
                        <i class="fa-solid fa-shield-virus fs-5"></i>
                    </span>
                    <h4 class="fw-bold serif-font mb-0 text-dark">5. Data Protection & SSL Security</h4>
                </div>
                <p class="text-secondary" style="line-height: 1.8;">
                    We adopt strict data collection, storage, and processing practices, as well as robust security measures to protect against unauthorized access, alteration, disclosure, or destruction of your personal data.
                </p>
                <div class="p-3 bg-light rounded-3 border-start border-4 border-success text-secondary">
                    <strong class="text-dark"><i class="fa-solid fa-lock text-success me-1"></i> SSL Encryption:</strong> All sensitive communication between your web browser and World Eyes News servers occurs across an SSL-secured, 256-bit encrypted channel.
                </div>
            </div>

            <!-- Section 6: Third-Party Links & Embeds -->
            <div class="card border-0 shadow-sm p-4 mb-4 bg-white">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="badge bg-info bg-opacity-10 text-info p-2 rounded-circle">
                        <i class="fa-solid fa-up-right-from-square fs-5"></i>
                    </span>
                    <h4 class="fw-bold serif-font mb-0 text-dark">6. Third-Party Websites & Social Media Embeds</h4>
                </div>
                <p class="text-secondary" style="line-height: 1.8;">
                    Our articles may feature embedded content (e.g., YouTube videos, X / Twitter posts, Facebook shares) and hyperlinks to official government portals, scientific repositories, or reference material.
                </p>
                <p class="text-secondary mb-0" style="line-height: 1.8;">
                    We do not control the privacy practices of external third-party sites. Once you leave our domain or interact directly with an external embed, their respective privacy policies will apply.
                </p>
            </div>

            <!-- Section 7: User Rights & Grievance Officer -->
            <div class="card border-0 shadow-sm p-4 mb-4 bg-white">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="badge bg-dark bg-opacity-10 text-dark p-2 rounded-circle">
                        <i class="fa-solid fa-scale-balanced fs-5"></i>
                    </span>
                    <h4 class="fw-bold serif-font mb-0 text-dark">7. User Rights & Grievance Redressal</h4>
                </div>
                <p class="text-secondary" style="line-height: 1.8;">
                    In accordance with applicable media regulations and the Information Technology (Intermediary Guidelines and Digital Media Ethics Code) Rules, World Eyes News has appointed a dedicated Grievance Officer for handling privacy inquiries, data deletion requests, or editorial corrections.
                </p>
                <div class="p-3 bg-light rounded-3 text-secondary mt-3">
                    <div class="fw-bold text-dark mb-1">Grievance & Privacy Desk:</div>
                    <div><strong>Platform:</strong> World Eyes News (MSME Registered)</div>
                    <div><strong>Email:</strong> <a href="mailto:{{ $siteSettings['contact_email'] ?? 'worldeyesnetwork@gmail.com' }}" class="text-danger fw-semibold">{{ $siteSettings['contact_email'] ?? 'worldeyesnetwork@gmail.com' }}</a></div>
                    <div><strong>Editorial Office:</strong> {{ $siteSettings['address'] ?? 'World News Media Tower, New York, NY' }}</div>
                </div>
            </div>

        </div>

        <!-- Sidebar Summary Column -->
        <div class="col-lg-4">
            <!-- Quick Summary Card -->
            <div class="card border-0 shadow-sm p-4 bg-white mb-4 position-sticky" style="top: 80px;">
                <h5 class="fw-bold serif-font text-dark mb-3">
                    <i class="fa-solid fa-circle-check text-success me-2"></i> Our Privacy Commitments
                </h5>
                <ul class="list-unstyled small text-secondary d-flex flex-column gap-3 mb-4">
                    <li class="d-flex gap-2">
                        <i class="fa-solid fa-check text-danger mt-1"></i>
                        <span><strong>No Data Selling:</strong> We never sell, rent, or trade reader personal data to third parties.</span>
                    </li>
                    <li class="d-flex gap-2">
                        <i class="fa-solid fa-check text-danger mt-1"></i>
                        <span><strong>SSL Secured:</strong> All browser requests and forms are protected with industry-standard encryption.</span>
                    </li>
                    <li class="d-flex gap-2">
                        <i class="fa-solid fa-check text-danger mt-1"></i>
                        <span><strong>MSME Registered:</strong> Fully recognized digital media entity adhering to statutory guidelines.</span>
                    </li>
                    <li class="d-flex gap-2">
                        <i class="fa-solid fa-check text-danger mt-1"></i>
                        <span><strong>Right to Correction:</strong> Readers may request updates or removal of their comments anytime.</span>
                    </li>
                </ul>

                <hr class="my-3">

                <div class="d-flex flex-column gap-2">
                    <a href="{{ route('terms.conditions') }}" class="btn btn-outline-dark btn-sm w-100 fw-semibold text-start d-flex justify-content-between align-items-center">
                        <span><i class="fa-solid fa-file-contract text-primary me-2"></i> Terms & Conditions</span>
                        <i class="fa-solid fa-chevron-right small text-muted"></i>
                    </a>
                    <a href="{{ route('about') }}" class="btn btn-outline-danger btn-sm w-100 fw-semibold text-start d-flex justify-content-between align-items-center">
                        <span><i class="fa-solid fa-circle-info text-danger me-2"></i> About World Eyes News</span>
                        <i class="fa-solid fa-chevron-right small text-muted"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
