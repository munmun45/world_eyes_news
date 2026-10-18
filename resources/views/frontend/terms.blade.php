@extends('layouts.app')

@section('title', 'Terms and Conditions - World Eyes News | Bringing The World Closer')
@section('meta_description', 'Terms and Conditions of World Eyes News. Understand your rights and responsibilities when accessing our digital news platform, articles, and services.')

@section('content')
<div class="container py-3">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb small">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa-solid fa-house me-1"></i> Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Terms & Conditions</li>
        </ol>
    </nav>

    <!-- Hero Header -->
    <div class="card border-0 text-white rounded-3 overflow-hidden mb-5 shadow-sm" style="background: linear-gradient(135deg, #0b1120 0%, #1e293b 100%);">
        <div class="card-body p-4 p-md-5">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <span class="badge bg-danger text-uppercase fw-bold px-3 py-2 mb-3">
                        <i class="fa-solid fa-file-contract me-1"></i> Legal & Editorial Agreement
                    </span>
                    <h1 class="display-5 fw-bold serif-font mb-3">Terms and Conditions</h1>
                    <p class="lead text-light opacity-90 fw-semibold mb-3" style="color: #fca5a5 !important;">
                        World Eyes News — Bringing The World Closer
                    </p>
                    <p class="text-light opacity-75 mb-0" style="max-width: 680px; font-size: 1.05rem; line-height: 1.7;">
                        Welcome to World Eyes News. These Terms and Conditions govern your access to and use of our digital news media platform, multimedia content, dispatches, and reader community features.
                    </p>
                </div>
                <div class="col-lg-4 text-center text-lg-end">
                    <div class="p-3 bg-black bg-opacity-25 rounded-3 border border-secondary border-opacity-25 d-inline-block text-start">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="fa-solid fa-scale-balanced text-warning fs-5"></i>
                            <span class="small fw-bold text-white">PCI & MIB Compliant</span>
                        </div>
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="fa-solid fa-certificate text-success fs-5"></i>
                            <span class="small fw-bold text-white">MSME Registered</span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-calendar-check text-info fs-5"></i>
                            <span class="small fw-bold text-white">Effective Date: October 2026</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Terms Content -->
    <div class="row g-4">
        <!-- Content Column -->
        <div class="col-lg-8">

            <!-- Section 1: Agreement to Terms -->
            <div class="card border-0 shadow-sm p-4 mb-4 bg-white">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="badge bg-danger bg-opacity-10 text-danger p-2 rounded-circle">
                        <i class="fa-solid fa-handshake fs-5"></i>
                    </span>
                    <h4 class="fw-bold serif-font mb-0 text-dark">1. Acceptance of Terms</h4>
                </div>
                <p class="text-secondary" style="line-height: 1.8;">
                    By visiting, browsing, or utilizing any portion of <strong>World Eyes News</strong> ("the Platform"), you agree to be bound by these Terms and Conditions and our Privacy Policy. If you do not agree to all terms stated herein, you should cease use of the platform immediately.
                </p>
                <p class="text-secondary mb-0" style="line-height: 1.8;">
                    World Eyes News is an <strong>MSME-registered</strong> and <strong>SSL-secured</strong> digital news media platform, maintained by qualified journalists and committed to accurate, ethical, and public-interest reporting.
                </p>
            </div>

            <!-- Section 2: Journalistic Standards & Editorial Code -->
            <div class="card border-0 shadow-sm p-4 mb-4 bg-white">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="badge bg-primary bg-opacity-10 text-primary p-2 rounded-circle">
                        <i class="fa-solid fa-newspaper fs-5"></i>
                    </span>
                    <h4 class="fw-bold serif-font mb-0 text-dark">2. Editorial Standards & Guidelines</h4>
                </div>
                <p class="text-secondary" style="line-height: 1.8;">
                    We strive to deliver credible news, breaking updates, and ground reports while adhering to applicable media laws, journalistic ethics, and relevant guidelines issued by:
                </p>
                <ul class="text-secondary" style="line-height: 1.8;">
                    <li><strong>Press Council of India (PCI):</strong> Norms of journalistic conduct regarding factual reporting, fairness, attribution, and right of reply.</li>
                    <li><strong>Ministry of Information & Broadcasting (MIB):</strong> Applicable digital media ethics codes, decency requirements, and verification protocols.</li>
                </ul>
                <p class="text-secondary mb-0" style="line-height: 1.8;">
                    Our editorial team exercises full independence in determining news priorities, investigative leads, and analytical perspectives without commercial interference.
                </p>
            </div>

            <!-- Section 3: Intellectual Property & Permissible Use -->
            <div class="card border-0 shadow-sm p-4 mb-4 bg-white">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="badge bg-warning bg-opacity-10 text-warning p-2 rounded-circle">
                        <i class="fa-solid fa-copyright fs-5"></i>
                    </span>
                    <h4 class="fw-bold serif-font mb-0 text-dark">3. Intellectual Property Rights</h4>
                </div>
                <p class="text-secondary" style="line-height: 1.8;">
                    All text, graphics, logos, icons, photographs, audio clips, video recordings, and editorial layouts published on World Eyes News are the exclusive property of World Eyes News or our licensing partners and are protected by applicable copyright, trademark, and intellectual property statutes.
                </p>
                <div class="p-3 bg-light rounded-3 text-secondary mb-3">
                    <strong class="text-dark"><i class="fa-solid fa-share-nodes text-danger me-1"></i> Permitted Sharing:</strong> Readers are warmly welcomed to share article links, excerpts (up to 150 words), and headlines across social networks and research papers, provided that clear attribution and a direct hyperlink to the original article on World Eyes News are provided.
                </div>
                <p class="text-secondary mb-0" style="line-height: 1.8;">
                    Automated web scraping, mass republishing, or commercial exploitation of our content without prior written authorization is strictly prohibited.
                </p>
            </div>

            <!-- Section 4: Reader Comments & Community Guidelines -->
            <div class="card border-0 shadow-sm p-4 mb-4 bg-white">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="badge bg-success bg-opacity-10 text-success p-2 rounded-circle">
                        <i class="fa-solid fa-comments fs-5"></i>
                    </span>
                    <h4 class="fw-bold serif-font mb-0 text-dark">4. Reader Contributions & Comments</h4>
                </div>
                <p class="text-secondary" style="line-height: 1.8;">
                    World Eyes News values public dialogue and thoughtful debate. When posting comments on our articles, Users agree to uphold our Community Conduct Code:
                </p>
                <ul class="text-secondary mb-0" style="line-height: 1.8;">
                    <li><strong>No Defamation or Harassment:</strong> Comments must not contain defamatory, abusive, libelous, obscene, or threatening language.</li>
                    <li><strong>No Hate Speech:</strong> Zero tolerance for hate speech based on religion, race, ethnicity, caste, gender, sexual orientation, disability, or nationality.</li>
                    <li><strong>No Spam or Commercial Solicitations:</strong> Promotional links, spam messages, or affiliate marketing are strictly forbidden.</li>
                    <li><strong>Editorial Moderation:</strong> World Eyes News reserves the right to review, edit, reject, or delete any comment that violates these guidelines without notice.</li>
                </ul>
            </div>

            <!-- Section 5: Accuracy & Limitation of Liability -->
            <div class="card border-0 shadow-sm p-4 mb-4 bg-white">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="badge bg-danger bg-opacity-10 text-danger p-2 rounded-circle">
                        <i class="fa-solid fa-triangle-exclamation fs-5"></i>
                    </span>
                    <h4 class="fw-bold serif-font mb-0 text-dark">5. Accuracy & Disclaimers</h4>
                </div>
                <p class="text-secondary" style="line-height: 1.8;">
                    While our editorial staff makes rigorous efforts to verify all factual statements prior to publication, news events evolve rapidly. Information is provided on an "as is" and "as available" basis.
                </p>
                <p class="text-secondary mb-0" style="line-height: 1.8;">
                    World Eyes News does not provide financial, legal, or medical advice. Opinion pieces and guest columns represent the personal views of their authors and do not necessarily reflect the official stance of World Eyes News.
                </p>
            </div>

            <!-- Section 6: Governing Law & Contact -->
            <div class="card border-0 shadow-sm p-4 mb-4 bg-white">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="badge bg-info bg-opacity-10 text-info p-2 rounded-circle">
                        <i class="fa-solid fa-gavel fs-5"></i>
                    </span>
                    <h4 class="fw-bold serif-font mb-0 text-dark">6. Governing Law & Legal Inquiries</h4>
                </div>
                <p class="text-secondary" style="line-height: 1.8;">
                    These Terms and Conditions shall be governed by and construed in accordance with the laws of the jurisdiction in which World Eyes News operates, without regard to conflict of law principles.
                </p>
                <div class="p-3 bg-light rounded-3 text-secondary mt-3">
                    <div class="fw-bold text-dark mb-1">Editorial & Legal Inquiries:</div>
                    <div><strong>Organization:</strong> World Eyes News</div>
                    <div><strong>Tagline:</strong> {{ $siteSettings['tagline'] ?? 'Bringing The World Closer' }}</div>
                    <div><strong>Legal Contact:</strong> <a href="mailto:{{ $siteSettings['contact_email'] ?? 'worldeyesnetwork@gmail.com' }}" class="text-danger fw-semibold">{{ $siteSettings['contact_email'] ?? 'worldeyesnetwork@gmail.com' }}</a></div>
                </div>
            </div>

        </div>

        <!-- Sidebar Summary Column -->
        <div class="col-lg-4">
            <!-- Summary Box -->
            <div class="card border-0 shadow-sm p-4 bg-white mb-4 position-sticky" style="top: 80px;">
                <h5 class="fw-bold serif-font text-dark mb-3">
                    <i class="fa-solid fa-circle-info text-primary me-2"></i> Quick Reference
                </h5>
                <ul class="list-unstyled small text-secondary d-flex flex-column gap-3 mb-4">
                    <li class="d-flex gap-2">
                        <i class="fa-solid fa-check text-success mt-1"></i>
                        <span><strong>Ethical Journalism:</strong> Full compliance with PCI and MIB news media standards.</span>
                    </li>
                    <li class="d-flex gap-2">
                        <i class="fa-solid fa-check text-success mt-1"></i>
                        <span><strong>Fair Dealing:</strong> Excerpts and links may be shared freely with attribution.</span>
                    </li>
                    <li class="d-flex gap-2">
                        <i class="fa-solid fa-check text-success mt-1"></i>
                        <span><strong>Civil Discourse:</strong> Constructive, respectful commenting is expected from all participants.</span>
                    </li>
                    <li class="d-flex gap-2">
                        <i class="fa-solid fa-check text-success mt-1"></i>
                        <span><strong>Independent Media:</strong> Managed by qualified, professional journalists.</span>
                    </li>
                </ul>

                <hr class="my-3">

                <div class="d-flex flex-column gap-2">
                    <a href="{{ route('privacy.policy') }}" class="btn btn-outline-dark btn-sm w-100 fw-semibold text-start d-flex justify-content-between align-items-center">
                        <span><i class="fa-solid fa-user-shield text-danger me-2"></i> Privacy Policy</span>
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
