<?php $__env->startSection('title', 'Dreamella Project — Tiket Event Online'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    /* ========== DESIGN TOKENS ========== */
    :root {
        --clr-bg:       #080c14;
        --clr-surface:  #0f172a;
        --clr-card:     rgba(255,255,255,.055);
        --clr-border:   rgba(255,255,255,.10);
        --clr-primary:  #e11d48;
        --clr-primary2: #fb7185;
        --clr-gold:     #f59e0b;
        --clr-text:     #f1f5f9;
        --clr-muted:    #94a3b8;
        --clr-white:    #ffffff;
        --radius-xl:    1.5rem;
        --radius-lg:    1rem;
        --radius-md:    .65rem;
        --shadow-glow:  0 0 40px rgba(225,29,72,.25);
        --transition:   .3s cubic-bezier(.4,0,.2,1);
        --font:         'Inter', system-ui, sans-serif;
    }

    /* ========== RESET / BASE ========== */
    .home-root *,
    .home-root *::before,
    .home-root *::after { box-sizing: border-box; }

    .home-root {
        font-family: var(--font);
        background: var(--clr-bg);
        color: var(--clr-text);
        overflow-x: hidden;
    }

    /* ========== UTILITY ========== */
    .home-root .gradient-text {
        background: linear-gradient(135deg, var(--clr-white) 0%, var(--clr-primary2) 55%, var(--clr-gold) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .home-root .badge-pill {
        display: inline-flex;
        align-items: center;
        gap: .35rem;
        padding: .28rem .85rem;
        border-radius: 999px;
        font-size: .72rem;
        font-weight: 600;
        letter-spacing: .06em;
        text-transform: uppercase;
    }

    /* ========== GLASS CARD ========== */
    .home-root .glass {
        background: var(--clr-card);
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
        border: 1px solid var(--clr-border);
        border-radius: var(--radius-xl);
    }

    /* ========== SECTION SPACING ========== */
    .home-root section { padding: 5rem 0; }

    /* =====================
       HERO
    ===================== */
    .hero-wrap {
        position: relative;
        min-height: 100vh;
        display: flex;
        align-items: center;
        overflow: hidden;
        background: var(--clr-bg);
        padding: 7rem 0 5rem;
    }

    /* Animated orbs */
    .hero-wrap .orb {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: .45;
        animation: floatOrb 8s ease-in-out infinite;
    }
    .hero-wrap .orb-1 {
        width: 520px; height: 520px;
        background: radial-gradient(circle, #e11d48, transparent 70%);
        top: -120px; left: -100px;
        animation-delay: 0s;
    }
    .hero-wrap .orb-2 {
        width: 380px; height: 380px;
        background: radial-gradient(circle, #f59e0b, transparent 70%);
        bottom: -80px; right: -60px;
        animation-delay: -3s;
    }
    .hero-wrap .orb-3 {
        width: 260px; height: 260px;
        background: radial-gradient(circle, #6366f1, transparent 70%);
        top: 40%; right: 20%;
        animation-delay: -6s;
    }

    @keyframes floatOrb {
        0%, 100% { transform: translateY(0) scale(1); }
        50%       { transform: translateY(-30px) scale(1.05); }
    }

    /* Grid dots overlay */
    .hero-wrap::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image:
            radial-gradient(rgba(255,255,255,.06) 1px, transparent 1px);
        background-size: 40px 40px;
        pointer-events: none;
    }

    .hero-content { position: relative; z-index: 2; }

    .hero-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        padding: .35rem 1rem;
        background: rgba(225,29,72,.15);
        border: 1px solid rgba(225,29,72,.35);
        border-radius: 999px;
        color: var(--clr-primary2);
        font-size: .8rem;
        font-weight: 600;
        letter-spacing: .08em;
        text-transform: uppercase;
        margin-bottom: 1.5rem;
    }
    .hero-eyebrow .dot {
        width: 6px; height: 6px;
        background: var(--clr-primary);
        border-radius: 50%;
        animation: pulse-dot 1.5s ease-in-out infinite;
    }
    @keyframes pulse-dot {
        0%, 100% { opacity: 1; transform: scale(1); }
        50%       { opacity: .4; transform: scale(.6); }
    }

    .hero-title {
        font-size: clamp(2.4rem, 6vw, 4.5rem);
        font-weight: 800;
        line-height: 1.12;
        letter-spacing: -.03em;
        margin-bottom: 1.5rem;
    }

    .hero-desc {
        font-size: 1.15rem;
        color: var(--clr-muted);
        line-height: 1.75;
        max-width: 520px;
        margin-bottom: 2.5rem;
    }

    .hero-actions { display: flex; gap: 1rem; flex-wrap: wrap; }

    .btn-primary-glow {
        display: inline-flex;
        align-items: center;
        gap: .55rem;
        padding: .85rem 2rem;
        border-radius: var(--radius-lg);
        background: linear-gradient(135deg, var(--clr-primary), #be123c);
        color: #fff;
        font-weight: 700;
        font-size: .97rem;
        text-decoration: none;
        border: none;
        cursor: pointer;
        box-shadow: 0 8px 30px rgba(225,29,72,.4);
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }
    .btn-primary-glow::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(255,255,255,.15), transparent);
        opacity: 0;
        transition: var(--transition);
    }
    .btn-primary-glow:hover {
        transform: translateY(-2px);
        box-shadow: 0 14px 40px rgba(225,29,72,.55);
        color: #fff;
    }
    .btn-primary-glow:hover::before { opacity: 1; }

    .btn-ghost {
        display: inline-flex;
        align-items: center;
        gap: .55rem;
        padding: .85rem 2rem;
        border-radius: var(--radius-lg);
        background: rgba(255,255,255,.07);
        color: var(--clr-text);
        font-weight: 600;
        font-size: .97rem;
        text-decoration: none;
        border: 1px solid var(--clr-border);
        transition: var(--transition);
    }
    .btn-ghost:hover {
        background: rgba(255,255,255,.13);
        border-color: rgba(255,255,255,.25);
        transform: translateY(-2px);
        color: var(--clr-text);
    }

    /* Hero stats */
    .hero-stats {
        display: flex;
        gap: 2.5rem;
        margin-top: 3rem;
        flex-wrap: wrap;
    }
    .stat-item {}
    .stat-value {
        font-size: 2rem;
        font-weight: 800;
        line-height: 1;
        background: linear-gradient(135deg, #fff, var(--clr-primary2));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .stat-label {
        font-size: .8rem;
        color: var(--clr-muted);
        margin-top: .25rem;
        font-weight: 500;
    }

    /* Hero visual card */
    .hero-card-wrap {
        position: relative;
        z-index: 2;
    }
    .hero-feature-card {
        padding: 2rem;
        border-radius: var(--radius-xl);
        background: rgba(15,23,42,.7);
        backdrop-filter: blur(24px);
        border: 1px solid rgba(255,255,255,.12);
        box-shadow: 0 20px 60px rgba(0,0,0,.5);
        transform: perspective(1000px) rotateY(-5deg) rotateX(3deg);
        transition: transform .4s ease;
    }
    .hero-feature-card:hover {
        transform: perspective(1000px) rotateY(0deg) rotateX(0deg);
    }
    .hero-feature-card .fc-icon {
        width: 48px; height: 48px;
        border-radius: var(--radius-md);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.3rem;
        margin-bottom: 1rem;
    }
    .hero-feature-card .fc-title {
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: .3rem;
    }
    .hero-feature-card .fc-desc {
        font-size: .85rem;
        color: var(--clr-muted);
        line-height: 1.6;
    }
    .fc-divider {
        height: 1px;
        background: var(--clr-border);
        margin: 1.25rem 0;
    }
    .payment-badge {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        padding: .4rem .9rem;
        border-radius: 999px;
        font-size: .75rem;
        font-weight: 600;
        background: rgba(245,158,11,.15);
        border: 1px solid rgba(245,158,11,.3);
        color: #fbbf24;
        margin-top: .5rem;
    }
    /* Floating mini cards */
    .float-badge {
        position: absolute;
        padding: .6rem 1rem;
        border-radius: var(--radius-lg);
        background: rgba(15,23,42,.85);
        backdrop-filter: blur(12px);
        border: 1px solid var(--clr-border);
        font-size: .8rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: .5rem;
        animation: floatBadge 4s ease-in-out infinite;
        box-shadow: 0 8px 24px rgba(0,0,0,.3);
        z-index: 3;
    }
    .float-badge-1 {
        top: 10%; right: -12%;
        animation-delay: 0s;
    }
    .float-badge-2 {
        bottom: 12%; left: -10%;
        animation-delay: -2s;
    }
    @keyframes floatBadge {
        0%, 100% { transform: translateY(0); }
        50%       { transform: translateY(-10px); }
    }

    /* =====================
       FEATURES (HOW IT WORKS)
    ===================== */
    .section-eyebrow {
        display: inline-block;
        padding: .3rem .9rem;
        border-radius: 999px;
        font-size: .72rem;
        font-weight: 700;
        letter-spacing: .1em;
        text-transform: uppercase;
        background: rgba(225,29,72,.12);
        border: 1px solid rgba(225,29,72,.25);
        color: var(--clr-primary2);
        margin-bottom: 1rem;
    }
    .section-title {
        font-size: clamp(1.8rem, 4vw, 2.8rem);
        font-weight: 800;
        line-height: 1.2;
        letter-spacing: -.02em;
        margin-bottom: 1rem;
    }
    .section-desc {
        color: var(--clr-muted);
        font-size: 1.05rem;
        line-height: 1.75;
        max-width: 560px;
        margin: 0 auto;
    }

    .step-card {
        padding: 2rem;
        border-radius: var(--radius-xl);
        background: var(--clr-card);
        border: 1px solid var(--clr-border);
        height: 100%;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }
    .step-card::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(225,29,72,.08) 0%, transparent 60%);
        opacity: 0;
        transition: var(--transition);
    }
    .step-card:hover {
        transform: translateY(-6px);
        border-color: rgba(225,29,72,.3);
        box-shadow: 0 20px 50px rgba(0,0,0,.4);
    }
    .step-card:hover::before { opacity: 1; }

    .step-number {
        font-size: 4rem;
        font-weight: 900;
        line-height: 1;
        background: linear-gradient(135deg, rgba(225,29,72,.25), rgba(225,29,72,.05));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: .75rem;
    }
    .step-icon {
        width: 52px; height: 52px;
        border-radius: var(--radius-md);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.4rem;
        margin-bottom: 1.25rem;
    }
    .step-card .step-title {
        font-size: 1.05rem;
        font-weight: 700;
        margin-bottom: .5rem;
    }
    .step-card .step-desc {
        font-size: .88rem;
        color: var(--clr-muted);
        line-height: 1.7;
    }

    /* =====================
       EVENTS SECTION
    ===================== */
    .events-section {
        background: linear-gradient(180deg, var(--clr-bg) 0%, var(--clr-surface) 50%, var(--clr-bg) 100%);
    }

    .section-header { margin-bottom: 3rem; }

    .view-all-link {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        color: var(--clr-primary2);
        font-size: .9rem;
        font-weight: 600;
        text-decoration: none;
        transition: var(--transition);
    }
    .view-all-link:hover {
        color: var(--clr-white);
        gap: .7rem;
    }

    /* Event Card */
    .event-card {
        border-radius: var(--radius-xl);
        background: rgba(15,23,42,.6);
        border: 1px solid var(--clr-border);
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
        transition: var(--transition);
        position: relative;
    }
    .event-card:hover {
        transform: translateY(-8px);
        border-color: rgba(225,29,72,.35);
        box-shadow: 0 24px 60px rgba(0,0,0,.5), 0 0 0 1px rgba(225,29,72,.1);
    }

    .event-poster-new {
        position: relative;
        height: 200px;
        overflow: hidden;
    }
    .event-poster-bg {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        font-weight: 700;
        text-align: center;
        padding: 1.5rem;
        color: rgba(255,255,255,.9);
        letter-spacing: .01em;
        line-height: 1.4;
    }
    .event-poster-bg::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(0deg, rgba(15,23,42,1) 0%, transparent 60%);
    }
    .event-category-tag {
        position: absolute;
        top: 1rem;
        left: 1rem;
        z-index: 2;
        padding: .28rem .75rem;
        border-radius: 999px;
        background: rgba(0,0,0,.55);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255,255,255,.15);
        font-size: .7rem;
        font-weight: 600;
        letter-spacing: .06em;
        text-transform: uppercase;
        color: var(--clr-text);
    }

    .event-body {
        padding: 1.5rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .event-status-row {
        display: flex;
        align-items: center;
        gap: .5rem;
        margin-bottom: .75rem;
    }
    .event-title-new {
        font-size: 1.05rem;
        font-weight: 700;
        margin-bottom: .75rem;
        line-height: 1.4;
        color: var(--clr-text);
    }
    .event-meta {
        display: flex;
        flex-direction: column;
        gap: .35rem;
        margin-bottom: 1.25rem;
        flex: 1;
    }
    .event-meta-item {
        display: flex;
        align-items: center;
        gap: .5rem;
        font-size: .82rem;
        color: var(--clr-muted);
    }
    .event-meta-item i { color: var(--clr-primary2); font-size: .85rem; }

    .event-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 1rem;
        border-top: 1px solid var(--clr-border);
    }
    .event-price {
        font-size: 1.15rem;
        font-weight: 800;
        color: var(--clr-white);
    }
    .event-price small {
        display: block;
        font-size: .7rem;
        font-weight: 500;
        color: var(--clr-muted);
    }
    .btn-event {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        padding: .55rem 1.2rem;
        border-radius: var(--radius-md);
        background: linear-gradient(135deg, var(--clr-primary), #be123c);
        color: #fff;
        font-size: .83rem;
        font-weight: 700;
        text-decoration: none;
        transition: var(--transition);
        box-shadow: 0 4px 14px rgba(225,29,72,.3);
    }
    .btn-event:hover {
        transform: scale(1.04);
        box-shadow: 0 6px 20px rgba(225,29,72,.5);
        color: #fff;
    }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        border-radius: var(--radius-xl);
        border: 1px dashed rgba(255,255,255,.1);
        background: rgba(255,255,255,.02);
    }
    .empty-state-icon {
        font-size: 3.5rem;
        margin-bottom: 1rem;
        opacity: .4;
    }
    .empty-state p {
        color: var(--clr-muted);
        font-size: 1rem;
    }

    /* =====================
       PAYMENT INFO
    ===================== */
    .payment-section {
        position: relative;
        overflow: hidden;
    }
    .payment-section .bg-accent {
        position: absolute;
        width: 500px; height: 500px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(225,29,72,.12), transparent 70%);
        top: 50%; left: 50%;
        transform: translate(-50%, -50%);
        pointer-events: none;
    }

    .payment-card {
        padding: 2.5rem;
        border-radius: var(--radius-xl);
        background: linear-gradient(135deg, rgba(225,29,72,.12) 0%, rgba(15,23,42,.8) 100%);
        border: 1px solid rgba(225,29,72,.25);
        text-align: center;
        transition: var(--transition);
        height: 100%;
    }
    .payment-card:hover {
        border-color: rgba(225,29,72,.5);
        transform: translateY(-4px);
        box-shadow: 0 16px 40px rgba(225,29,72,.15);
    }
    .payment-card .pay-icon {
        font-size: 2.5rem;
        margin-bottom: 1.25rem;
        display: block;
    }
    .payment-card .pay-title {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: .5rem;
    }
    .payment-card .pay-desc {
        font-size: .88rem;
        color: var(--clr-muted);
        line-height: 1.65;
    }

    /* =====================
       CTA BANNER
    ===================== */
    .cta-section {
        padding: 5rem 0;
    }
    .cta-banner {
        border-radius: var(--radius-xl);
        padding: 4rem 3rem;
        text-align: center;
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, #1e0a14 0%, #3d0619 40%, #1e0a14 100%);
        border: 1px solid rgba(225,29,72,.25);
    }
    .cta-banner::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Ccircle cx='30' cy='30' r='1'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        pointer-events: none;
    }
    .cta-banner .cta-orb-1 {
        position: absolute;
        width: 300px; height: 300px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(225,29,72,.35), transparent 70%);
        top: -100px; left: -80px;
        pointer-events: none;
    }
    .cta-banner .cta-orb-2 {
        position: absolute;
        width: 250px; height: 250px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(245,158,11,.2), transparent 70%);
        bottom: -80px; right: -50px;
        pointer-events: none;
    }
    .cta-content { position: relative; z-index: 1; }
    .cta-title {
        font-size: clamp(1.6rem, 4vw, 2.5rem);
        font-weight: 800;
        margin-bottom: 1rem;
        letter-spacing: -.02em;
    }
    .cta-desc {
        color: rgba(255,255,255,.7);
        font-size: 1rem;
        margin-bottom: 2rem;
        max-width: 480px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.7;
    }

    /* =====================
       ENTRANCE ANIMATIONS
    ===================== */
    .fade-up {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity .65s ease, transform .65s ease;
    }
    .fade-up.visible {
        opacity: 1;
        transform: translateY(0);
    }
    .fade-up:nth-child(1) { transition-delay: .05s; }
    .fade-up:nth-child(2) { transition-delay: .15s; }
    .fade-up:nth-child(3) { transition-delay: .25s; }
    .fade-up:nth-child(4) { transition-delay: .35s; }
    .fade-up:nth-child(5) { transition-delay: .45s; }

    /* =====================
       RESPONSIVE
    ===================== */
    @media (max-width: 991px) {
        .hero-card-wrap { margin-top: 3rem; }
        .hero-feature-card { transform: none; }
        .float-badge-1, .float-badge-2 { display: none; }
    }
    @media (max-width: 576px) {
        .hero-wrap { padding: 5rem 0 3rem; }
        .hero-stats { gap: 1.5rem; }
        .cta-banner { padding: 2.5rem 1.5rem; }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="home-root">

    <!-- ══════════ HERO ══════════ -->
    <section class="hero-wrap">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>

        <div class="container hero-content">
            <div class="row align-items-center g-5">

                <!-- Left: copy -->
                <div class="col-lg-6">
                    <div class="hero-eyebrow">
                        <span class="dot"></span>
                        Platform Tiket Resmi
                    </div>

                    <h1 class="hero-title">
                        Temukan &amp; Pesan<br>
                        <span class="gradient-text">Event Terbaik</span><br>
                        di Dreamella
                    </h1>

                    <p class="hero-desc">
                        Sistem informasi pembelian tiket online dengan pembayaran manual terpercaya.
                        Pesan tiket, upload bukti bayar, dan terima e-ticket setelah verifikasi admin.
                    </p>

                    <div class="hero-actions">
                        <a href="<?php echo e(route('events.index')); ?>" id="hero-cta-events" class="btn-primary-glow">
                            <i class="bi bi-calendar-event-fill"></i>
                            Jelajahi Event
                        </a>
                        <?php if(auth()->guard()->guest()): ?>
                        <a href="<?php echo e(route('register')); ?>" id="hero-cta-register" class="btn-ghost">
                            <i class="bi bi-person-plus"></i>
                            Daftar Gratis
                        </a>
                        <?php endif; ?>
                    </div>

                    <div class="hero-stats">
                        <div class="stat-item">
                            <div class="stat-value">100%</div>
                            <div class="stat-label">Pembayaran Manual</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">24/7</div>
                            <div class="stat-label">Akses Online</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">E-Ticket</div>
                            <div class="stat-label">Digital Instan</div>
                        </div>
                    </div>
                </div>

                <!-- Right: feature card -->
                <div class="col-lg-6">
                    <div class="hero-card-wrap position-relative">

                        <!-- Floating badges -->
                        <div class="float-badge float-badge-1">
                            <span style="color:#22c55e">●</span> Verifikasi Cepat
                        </div>
                        <div class="float-badge float-badge-2">
                            <i class="bi bi-shield-check" style="color:#6366f1"></i> Aman &amp; Terpercaya
                        </div>

                        <div class="hero-feature-card">
                            <div class="fc-icon" style="background:rgba(225,29,72,.15); color:#fb7185;">
                                <i class="bi bi-ticket-perforated-fill"></i>
                            </div>
                            <div class="fc-title">Cara Pembelian Tiket</div>
                            <div class="fc-desc">Ikuti langkah sederhana untuk mendapatkan tiket event impianmu.</div>

                            <div class="fc-divider"></div>

                            <?php
                            $steps = [
                                ['icon' => 'bi-search', 'clr' => '#6366f1', 'bg' => 'rgba(99,102,241,.15)', 'text' => 'Temukan event yang kamu inginkan'],
                                ['icon' => 'bi-cart-check', 'clr' => '#f59e0b', 'bg' => 'rgba(245,158,11,.15)', 'text' => 'Pilih tiket & lakukan pemesanan'],
                                ['icon' => 'bi-credit-card', 'clr' => '#22c55e', 'bg' => 'rgba(34,197,94,.15)', 'text' => 'Transfer & upload bukti bayar'],
                                ['icon' => 'bi-qr-code', 'clr' => '#fb7185', 'bg' => 'rgba(251,113,133,.15)', 'text' => 'Terima e-ticket setelah verifikasi'],
                            ];
                            ?>

                            <?php $__currentLoopData = $steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="d-flex align-items-center gap-3 <?php echo e(!$loop->last ? 'mb-3' : ''); ?>">
                                <div style="width:36px;height:36px;border-radius:.5rem;background:<?php echo e($step['bg']); ?>;color:<?php echo e($step['clr']); ?>;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:1rem;">
                                    <i class="bi <?php echo e($step['icon']); ?>"></i>
                                </div>
                                <div style="font-size:.85rem;color:var(--clr-muted);"><?php echo e($step['text']); ?></div>
                                <div class="ms-auto" style="font-size:.7rem;font-weight:700;color:var(--clr-muted);">0<?php echo e($i+1); ?></div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <div class="fc-divider"></div>
                            <div class="payment-badge">
                                <i class="bi bi-bank2"></i>
                                Transfer Bank / E-Wallet / QRIS
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ══════════ HOW IT WORKS ══════════ -->
    <section style="padding: 5rem 0; background: var(--clr-surface);">
        <div class="container">
            <div class="text-center mb-5">
                <span class="section-eyebrow">Cara Kerja</span>
                <h2 class="section-title">Mudah, Cepat &amp; <span class="gradient-text">Terpercaya</span></h2>
                <p class="section-desc">Proses pembelian tiket yang simpel dari awal hingga kamu memegang e-ticket.</p>
            </div>

            <div class="row g-4">
                <?php
                $howSteps = [
                    ['num'=>'01','icon'=>'bi-calendar2-event','color'=>'#6366f1','bg'=>'rgba(99,102,241,.15)','title'=>'Temukan Event','desc'=>'Browse semua event aktif yang tersedia. Filter berdasarkan kategori, tanggal, atau lokasi sesuai kebutuhanmu.'],
                    ['num'=>'02','icon'=>'bi-ticket-detailed','color'=>'#e11d48','bg'=>'rgba(225,29,72,.15)','title'=>'Pesan Tiket','desc'=>'Pilih jenis tiket yang kamu inginkan dan masukkan data pemesan dengan lengkap dan benar.'],
                    ['num'=>'03','icon'=>'bi-upload','color'=>'#f59e0b','bg'=>'rgba(245,158,11,.15)','title'=>'Upload Bukti Bayar','desc'=>'Lakukan transfer sesuai nominal, lalu upload bukti pembayaran ke sistem untuk diverifikasi admin.'],
                    ['num'=>'04','icon'=>'bi-qr-code-scan','color'=>'#22c55e','bg'=>'rgba(34,197,94,.15)','title'=>'Terima E-Ticket','desc'=>'Setelah admin memverifikasi pembayaranmu, e-ticket akan langsung tersedia di akun Tiket Saya.'],
                ];
                ?>

                <?php $__currentLoopData = $howSteps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-sm-6 col-lg-3 fade-up">
                    <div class="step-card">
                        <div class="step-number"><?php echo e($step['num']); ?></div>
                        <div class="step-icon" style="background:<?php echo e($step['bg']); ?>; color:<?php echo e($step['color']); ?>;">
                            <i class="bi <?php echo e($step['icon']); ?>"></i>
                        </div>
                        <div class="step-title"><?php echo e($step['title']); ?></div>
                        <div class="step-desc"><?php echo e($step['desc']); ?></div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    <!-- ══════════ ACTIVE EVENTS ══════════ -->
    <section class="events-section">
        <div class="container">
            <div class="section-header d-flex align-items-end justify-content-between flex-wrap gap-3">
                <div>
                    <span class="section-eyebrow">Event Pilihan</span>
                    <h2 class="section-title mb-0">Event <span class="gradient-text">Aktif Sekarang</span></h2>
                </div>
                <a href="<?php echo e(route('events.index')); ?>" id="link-all-events" class="view-all-link">
                    Lihat semua event <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <div class="row g-4">
                <?php $__empty_1 = true; $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-md-6 col-lg-4 fade-up">
                    <div class="event-card">
                        <!-- Poster -->
                        <div class="event-poster-new">
                            <?php
                            $gradients = [
                                'linear-gradient(135deg,#1e0533,#7c3aed)',
                                'linear-gradient(135deg,#0c1a3a,#e11d48)',
                                'linear-gradient(135deg,#0f2027,#203a43,#2c5364)',
                                'linear-gradient(135deg,#1a0a00,#f59e0b)',
                                'linear-gradient(135deg,#0d1b2a,#1b4332)',
                            ];
                            $grad = $gradients[$loop->index % count($gradients)];
                            ?>
                            <div class="event-poster-bg" style="background: <?php echo e($grad); ?>;">
                                <span style="position:relative;z-index:1;"><?php echo e($event->title); ?></span>
                            </div>
                            <div class="event-category-tag">
                                <?php echo e($event->category); ?>

                            </div>
                        </div>

                        <!-- Body -->
                        <div class="event-body">
                            <div class="event-status-row">
                                <?php echo $__env->make('partials.status', ['status' => $event->status], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            </div>

                            <h3 class="event-title-new"><?php echo e($event->title); ?></h3>

                            <div class="event-meta">
                                <div class="event-meta-item">
                                    <i class="bi bi-calendar3"></i>
                                    <span><?php echo e($event->event_date->format('d M Y')); ?> &bull; <?php echo e($event->event_time); ?></span>
                                </div>
                                <div class="event-meta-item">
                                    <i class="bi bi-geo-alt-fill"></i>
                                    <span><?php echo e($event->location); ?></span>
                                </div>
                            </div>

                            <div class="event-footer">
                                <div class="event-price">
                                    Rp <?php echo e(number_format($event->minimumPrice(), 0, ',', '.')); ?>

                                    <small>Harga mulai dari</small>
                                </div>
                                <a href="<?php echo e(route('events.show', $event)); ?>" id="event-detail-<?php echo e($event->id); ?>" class="btn-event">
                                    Detail <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12">
                    <div class="empty-state">
                        <div class="empty-state-icon">🎭</div>
                        <h3 style="font-weight:700;margin-bottom:.5rem;">Belum ada event aktif</h3>
                        <p>Event sedang dipersiapkan. Pantau terus untuk update terbaru!</p>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- ══════════ PAYMENT METHODS ══════════ -->
    <section class="payment-section" style="background: var(--clr-surface);">
        <div class="bg-accent"></div>
        <div class="container" style="position:relative;z-index:1;">
            <div class="text-center mb-5">
                <span class="section-eyebrow">Pembayaran</span>
                <h2 class="section-title">Metode Pembayaran <span class="gradient-text">Resmi</span></h2>
                <p class="section-desc">Kami menggunakan pembayaran manual langsung — tanpa payment gateway, lebih transparan dan aman.</p>
            </div>

            <div class="row g-4 justify-content-center">
                <?php
                $payments = [
                    ['icon'=>'bi-bank2','title'=>'Transfer Bank','desc'=>'BCA, Mandiri, BNI, BRI dan bank lainnya. Rekening tersedia di halaman pembayaran transaksi.'],
                    ['icon'=>'bi-phone','title'=>'E-Wallet','desc'=>'GoPay, OVO, Dana, ShopeePay. Scan atau transfer langsung ke nomor tujuan yang tertera.'],
                    ['icon'=>'bi-qr-code','title'=>'QRIS','desc'=>'Scan kode QRIS yang tersedia menggunakan aplikasi perbankan atau dompet digital apapun.'],
                ];
                ?>
                <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pay): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4 fade-up">
                    <div class="payment-card">
                        <span class="pay-icon"><i class="bi <?php echo e($pay['icon']); ?>" style="color:var(--clr-primary2)"></i></span>
                        <div class="pay-title"><?php echo e($pay['title']); ?></div>
                        <div class="pay-desc"><?php echo e($pay['desc']); ?></div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    <!-- ══════════ CTA ══════════ -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-banner">
                <div class="cta-orb-1"></div>
                <div class="cta-orb-2"></div>
                <div class="cta-content">
                    <h2 class="cta-title">Siap Ikut Event <span class="gradient-text">Dreamella?</span></h2>
                    <p class="cta-desc">Daftarkan dirimu sekarang dan jangan lewatkan event-event seru yang sudah menanti.</p>
                    <div class="d-flex gap-3 justify-content-center flex-wrap">
                        <a href="<?php echo e(route('events.index')); ?>" id="cta-browse-events" class="btn-primary-glow">
                            <i class="bi bi-compass-fill"></i>
                            Jelajahi Event
                        </a>
                        <?php if(auth()->guard()->guest()): ?>
                        <a href="<?php echo e(route('register')); ?>" id="cta-register" class="btn-ghost">
                            <i class="bi bi-person-plus-fill"></i>
                            Buat Akun Gratis
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // Intersection Observer untuk fade-up animation
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.12 });

    document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));

    // Counter animation untuk hero stats
    function animateCount(el, target, suffix = '') {
        let start = 0;
        const duration = 1500;
        const step = (timestamp) => {
            if (!start) start = timestamp;
            const progress = Math.min((timestamp - start) / duration, 1);
            const eased = 1 - Math.pow(1 - progress, 3);
            el.textContent = Math.floor(eased * target) + suffix;
            if (progress < 1) requestAnimationFrame(step);
        };
        requestAnimationFrame(step);
    }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Herd\ticket\resources\views/home.blade.php ENDPATH**/ ?>