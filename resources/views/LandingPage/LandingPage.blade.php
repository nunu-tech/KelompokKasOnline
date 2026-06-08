<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>KasKu - Manajemen Kas Kelas Online</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="[fonts.googleapis.com](https://fonts.googleapis.com)" />
    <link rel="preconnect" href="[fonts.gstatic.com](https://fonts.gstatic.com)" crossorigin />
    <link
        href="[fonts.googleapis.com](https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap)"
        rel="stylesheet" />
    <style>
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        :root {
            --primary: #4F46E5;
            --primary-dark: #3730A3;
            --secondary: #06B6D4;
            --accent: #8B5CF6;
            --bg: #F8F7FF;
            --surface: #FFFFFF;
            --text: #1E1B4B;
            --text-muted: #6B7280;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background-color: var(--bg);
            color: var(--text);
            margin: 0;
        }

        /* ── NAVBAR ── */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(79, 70, 229, 0.08);
            padding: 0 2rem;
            height: 68px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .nav-brand-icon {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .nav-brand-text {
            font-size: 1.3rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .nav-links a {
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.92rem;
            transition: color .2s;
        }

        .nav-links a:hover {
            color: var(--primary);
        }

        /* Avatar button */
        .nav-avatar-btn {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 14px rgba(79, 70, 229, 0.35);
            transition: transform .2s, box-shadow .2s;
            flex-shrink: 0;
        }

        .nav-avatar-btn:hover {
            transform: scale(1.08);
            box-shadow: 0 6px 20px rgba(79, 70, 229, 0.45);
        }

        .nav-avatar-btn svg {
            width: 22px;
            height: 22px;
            fill: white;
        }

        /* ── MODAL OVERLAY ── */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 200;
            background: rgba(30, 27, 75, 0.45);
            backdrop-filter: blur(4px);
            align-items: center;
            justify-content: center;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal-card {
            background: var(--surface);
            border-radius: 24px;
            padding: 2.5rem 2rem;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 25px 60px rgba(79, 70, 229, 0.2);
            position: relative;
            animation: modalIn .3s ease;
        }

        @keyframes modalIn {
            from {
                opacity: 0;
                transform: translateY(-20px) scale(0.96);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .modal-close {
            position: absolute;
            top: 1rem;
            right: 1.2rem;
            background: none;
            border: none;
            font-size: 1.4rem;
            color: var(--text-muted);
            cursor: pointer;
            line-height: 1;
        }

        .modal-logo {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .modal-logo-icon {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: .75rem;
            box-shadow: 0 8px 24px rgba(79, 70, 229, 0.3);
        }

        .modal-logo-icon svg {
            width: 32px;
            height: 32px;
            fill: white;
        }

        .modal-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--text);
            margin: 0 0 .25rem;
        }

        .modal-subtitle {
            color: var(--text-muted);
            font-size: .85rem;
            margin: 0;
        }

        .modal-actions {
            display: flex;
            flex-direction: column;
            gap: .85rem;
            margin-top: 1.5rem;
        }

        .btn-primary-modal {
            display: block;
            width: 100%;
            padding: .85rem;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: white;
            border: none;
            border-radius: 12px;
            font-size: .95rem;
            font-weight: 600;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: opacity .2s, transform .2s;
        }

        .btn-primary-modal:hover {
            opacity: .9;
            transform: translateY(-1px);
        }

        .btn-outline-modal {
            display: block;
            width: 100%;
            padding: .85rem;
            background: transparent;
            color: var(--primary);
            border: 2px solid var(--primary);
            border-radius: 12px;
            font-size: .95rem;
            font-weight: 600;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: background .2s, color .2s;
        }

        .btn-outline-modal:hover {
            background: var(--primary);
            color: white;
        }

        .modal-divider {
            display: flex;
            align-items: center;
            gap: .75rem;
            color: var(--text-muted);
            font-size: .8rem;
        }

        .modal-divider::before,
        .modal-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #E5E7EB;
        }

        /* ── HERO ── */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 6rem 1.5rem 4rem;
            background:
                radial-gradient(ellipse 80% 60% at 50% -10%, rgba(79, 70, 229, 0.12) 0%, transparent 70%),
                radial-gradient(ellipse 50% 40% at 90% 60%, rgba(139, 92, 246, 0.1) 0%, transparent 60%),
                var(--bg);
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            background: rgba(79, 70, 229, 0.08);
            color: var(--primary);
            border: 1px solid rgba(79, 70, 229, 0.2);
            padding: .4rem 1rem;
            border-radius: 999px;
            font-size: .8rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .hero h1 {
            font-size: clamp(2.2rem, 5vw, 3.5rem);
            font-weight: 800;
            line-height: 1.15;
            margin: 0 0 1.25rem;
            color: var(--text);
        }

        .hero h1 span {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero p {
            font-size: 1.1rem;
            color: var(--text-muted);
            max-width: 560px;
            margin: 0 auto 2.5rem;
            line-height: 1.75;
        }

        .hero-cta {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-hero-primary {
            padding: .9rem 2rem;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: white;
            border-radius: 12px;
            font-weight: 700;
            font-size: .95rem;
            text-decoration: none;
            border: none;
            cursor: pointer;
            box-shadow: 0 8px 24px rgba(79, 70, 229, 0.3);
            transition: transform .2s, box-shadow .2s;
        }

        .btn-hero-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(79, 70, 229, 0.4);
        }

        .btn-hero-outline {
            padding: .9rem 2rem;
            background: transparent;
            color: var(--primary);
            border: 2px solid var(--primary);
            border-radius: 12px;
            font-weight: 700;
            font-size: .95rem;
            text-decoration: none;
            cursor: pointer;
            transition: background .2s, color .2s;
        }

        .btn-hero-outline:hover {
            background: var(--primary);
            color: white;
        }

        .hero-stats {
            display: flex;
            justify-content: center;
            gap: 3rem;
            margin-top: 4rem;
            flex-wrap: wrap;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 1.8rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .stat-label {
            font-size: .82rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        /* ── FEATURES ── */
        .section {
            padding: 5rem 1.5rem;
        }

        .section-center {
            text-align: center;
        }

        .section-label {
            display: inline-block;
            background: rgba(79, 70, 229, 0.08);
            color: var(--primary);
            border: 1px solid rgba(79, 70, 229, 0.15);
            padding: .35rem .9rem;
            border-radius: 999px;
            font-size: .78rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .section-title {
            font-size: clamp(1.6rem, 3vw, 2.2rem);
            font-weight: 800;
            margin: 0 0 .75rem;
            color: var(--text);
        }

        .section-desc {
            color: var(--text-muted);
            max-width: 520px;
            margin: 0 auto;
            line-height: 1.75;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 1.5rem;
            max-width: 1100px;
            margin: 3rem auto 0;
        }

        .feature-card {
            background: var(--surface);
            border-radius: 20px;
            padding: 2rem;
            border: 1px solid rgba(79, 70, 229, 0.07);
            box-shadow: 0 2px 16px rgba(79, 70, 229, 0.05);
            transition: transform .25s, box-shadow .25s;
        }

        .feature-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(79, 70, 229, 0.12);
        }

        .feature-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            margin-bottom: 1.1rem;
        }

        .feature-card h3 {
            font-size: 1rem;
            font-weight: 700;
            margin: 0 0 .5rem;
            color: var(--text);
        }

        .feature-card p {
            font-size: .875rem;
            color: var(--text-muted);
            margin: 0;
            line-height: 1.7;
        }

        /* ── HOW IT WORKS ── */
        .how-section {
            background: var(--surface);
        }

        .steps-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 2rem;
            max-width: 960px;
            margin: 3rem auto 0;
        }

        .step-item {
            text-align: center;
        }

        .step-number {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: white;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            font-weight: 800;
            margin-bottom: 1rem;
            box-shadow: 0 6px 18px rgba(79, 70, 229, 0.3);
        }

        .step-item h3 {
            font-size: 1rem;
            font-weight: 700;
            margin: 0 0 .5rem;
            color: var(--text);
        }

        .step-item p {
            font-size: .875rem;
            color: var(--text-muted);
            margin: 0;
            line-height: 1.65;
        }

        /* ── ROLES ── */
        .roles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.25rem;
            max-width: 960px;
            margin: 3rem auto 0;
        }

        .role-card {
            border-radius: 20px;
            padding: 1.75rem;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: transform .2s;
        }

        .role-card:hover {
            transform: translateY(-3px);
        }

        .role-card.siswa {
            background: linear-gradient(135deg, #EEF2FF, #E0E7FF);
        }

        .role-card.admin {
            background: linear-gradient(135deg, #FDF4FF, #F3E8FF);
        }

        .role-card.walikelas {
            background: linear-gradient(135deg, #ECFEFF, #CFFAFE);
        }

        .role-card.bendahara {
            background: linear-gradient(135deg, #F0FDF4, #DCFCE7);
        }

        .role-emoji {
            font-size: 2rem;
            margin-bottom: .75rem;
        }

        .role-card h3 {
            font-size: 1rem;
            font-weight: 700;
            margin: 0 0 .4rem;
            color: var(--text);
        }

        .role-card p {
            font-size: .825rem;
            color: var(--text-muted);
            margin: 0;
            line-height: 1.65;
        }

        /* ── CTA BANNER ── */
        .cta-section {
            padding: 5rem 1.5rem;
            text-align: center;
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
        }

        .cta-section h2 {
            font-size: clamp(1.6rem, 3vw, 2.2rem);
            font-weight: 800;
            color: white;
            margin: 0 0 1rem;
        }

        .cta-section p {
            color: rgba(255, 255, 255, 0.8);
            max-width: 480px;
            margin: 0 auto 2rem;
            line-height: 1.75;
        }

        .btn-cta-white {
            display: inline-block;
            padding: .9rem 2.2rem;
            color: var(--primary);
            border-radius: 12px;
            font-weight: 700;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: transform .2s, box-shadow .2s;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .btn-cta-white:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(0, 0, 0, 0.2);
        }

        /* ── FOOTER ── */
        footer {
            background: var(--text);
            color: rgba(255, 255, 255, 0.6);
            text-align: center;
            padding: 2rem;
            font-size: .85rem;
        }

        footer span {
            color: var(--accent);
            font-weight: 600;
        }

        /* Responsive */
        @media (max-width: 640px) {
            .nav-links {
                display: none;
            }

            .hero-stats {
                gap: 2rem;
            }
        }
    </style>
</head>

<body>

    {{-- ═══════════════ NAVBAR ═══════════════ --}}
    <nav class="navbar">
        <a href="/" class="nav-brand">
            <div class="nav-brand-icon">💰</div>
            <span class="nav-brand-text">KasKu</span>
        </a>

        <ul class="nav-links">
            <li><a href="#fitur">Fitur</a></li>
            <li><a href="#cara-kerja">Cara Kerja</a></li>
            <li><a href="#peran">Peran</a></li>
        </ul>

        {{-- Avatar button buka modal --}}
        <button class="nav-avatar-btn" id="openModalBtn" title="Masuk / Daftar">
            <svg viewBox="0 0 24 24" xmlns="[w3.org](http://www.w3.org/2000/svg)">
                <path
                    d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z" />
            </svg>
        </button>
    </nav>

    {{-- ═══════════════ MODAL ═══════════════ --}}
    <div class="modal-overlay" id="authModal">
        <div class="modal-card">
            <button class="modal-close" id="closeModalBtn">✕</button>

            <div class="modal-logo">
                <div class="modal-logo-icon">
                    <svg viewBox="0 0 24 24" xmlns="[w3.org](http://www.w3.org/2000/svg)">
                        <path
                            d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z" />
                    </svg>
                </div>
                <h2 class="modal-title">Selamat Datang 👋</h2>
                <p class="modal-subtitle">Kelola kas kelas lebih mudah & transparan</p>
            </div>

            <div class="modal-actions">
                <a href="{{ route('login') }}" class="btn-primary-modal">
                    🔐 &nbsp;Sudah Punya Akun? Masuk
                </a>
                <div class="modal-divider">atau</div>
                <a href="{{ route('register') }}" class="btn-outline-modal">
                    ✨ &nbsp;Daftar Akun Baru
                </a>
            </div>
        </div>
    </div>

    {{-- ═══════════════ HERO ═══════════════ --}}
    <section class="hero">
        <div>
            <div class="hero-badge">
                ✨ Platform Kas Kelas #1 Terpercaya
            </div>
            <h1>
                Kas Kelas Lebih Mudah,<br />
                <span>Transparan & Modern</span>
            </h1>
            <p>
                KasKu hadir untuk mempermudah pengelolaan uang kas kelas secara online.
                Bayar, pantau, dan lacak keuangan kelas kapan saja & di mana saja.
            </p>
            <div class="hero-cta">
                <button class="btn-hero-primary" onclick="document.getElementById('authModal').classList.add('active')">
                    Mulai Sekarang — Gratis
                </button>
                <a href="#cara-kerja" class="btn-hero-outline">Lihat Cara Kerja</a>
            </div>
            <div class="hero-stats">
                <div class="stat-item">
                    <div class="stat-number">100%</div>
                    <div class="stat-label">Transparan</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">4 Peran</div>
                    <div class="stat-label">Manajemen Lengkap</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">Real-time</div>
                    <div class="stat-label">Laporan Otomatis</div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════ FEATURES ═══════════════ --}}
    <section class="section section-center" id="fitur">
        <span class="section-label">✦ Fitur Unggulan</span>
        <h2 class="section-title">Semua yang Kamu Butuhkan</h2>
        <p class="section-desc">Dari pembayaran hingga laporan keuangan, semua ada di satu platform.</p>

        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon" style="background:rgba(79,70,229,0.1);">💸</div>
                <h3>Pembayaran Online</h3>
                <p>Siswa bisa bayar kas kapan saja tanpa harus repot membawa uang tunai ke sekolah.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon" style="background:rgba(6,182,212,0.1);">📊</div>
                <h3>Laporan Real-time</h3>
                <p>Bendahara dan wali kelas bisa melihat laporan keuangan secara langsung dan akurat.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon" style="background:rgba(139,92,246,0.1);">🔍</div>
                <h3>Transparansi Penuh</h3>
                <p>Setiap transaksi tercatat rapi. Semua pihak bisa melihat riwayat keuangan dengan jelas.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon" style="background:rgba(16,185,129,0.1);">🔔</div>
                <h3>Notifikasi Otomatis</h3>
                <p>Pengingat otomatis dikirim ke siswa yang belum membayar kas di bulan berjalan.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon" style="background:rgba(245,158,11,0.1);">📁</div>
                <h3>Riwayat Lengkap</h3>
                <p>Semua data pembayaran tersimpan dan bisa diunduh sebagai laporan PDF kapan saja.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon" style="background:rgba(239,68,68,0.1);">🛡️</div>
                <h3>Aman & Terpercaya</h3>
                <p>Sistem autentikasi berlapis memastikan hanya pengguna berwenang yang dapat mengakses data.</p>
            </div>
        </div>
    </section>

    {{-- ═══════════════ HOW IT WORKS ═══════════════ --}}
    <section class="section section-center how-section" id="cara-kerja">
        <span class="section-label">⚡ Cara Kerja</span>
        <h2 class="section-title">Mudah dalam 4 Langkah</h2>
        <p class="section-desc">Proses yang simpel, cepat, dan bisa langsung digunakan oleh siapa saja.</p>

        <div class="steps-grid">
            <div class="step-item">
                <div class="step-number">1</div>
                <h3>Daftar Akun</h3>
                <p>Siswa, wali kelas, dan bendahara mendaftar sesuai peran masing-masing.</p>
            </div>
            <div class="step-item">
                <div class="step-number">2</div>
                <h3>Setup Kelas</h3>
                <p>Admin atau wali kelas mengatur data kelas dan besaran iuran kas bulanan.</p>
            </div>
            <div class="step-item">
                <div class="step-number">3</div>
                <h3>Bayar Kas</h3>
                <p>Siswa melakukan pembayaran kas secara online melalui platform dengan mudah.</p>
            </div>
            <div class="step-item">
                <div class="step-number">4</div>
                <h3>Pantau Laporan</h3>
                <p>Semua pihak bisa melihat rekapitulasi dan laporan keuangan secara transparan.</p>
            </div>
        </div>
    </section>

    {{-- ═══════════════ ROLES ═══════════════ --}}
    <section class="section section-center" id="peran">
        <span class="section-label">👥 Peran Pengguna</span>
        <h2 class="section-title">Satu Platform, Empat Peran</h2>
        <p class="section-desc">Setiap peran memiliki akses dan fungsi yang berbeda sesuai kebutuhan.</p>

        <div class="roles-grid">
            <div class="role-card siswa">
                <div class="role-emoji">🎒</div>
                <h3>Siswa</h3>
                <p>Bayar kas, lihat riwayat pembayaran pribadi, dan pantau status tagihan.</p>
            </div>
            <div class="role-card walikelas">
                <div class="role-emoji">👩‍🏫</div>
                <h3>Wali Kelas</h3>
                <p>Pantau rekap kas kelas, lihat siapa yang sudah/belum bayar, dan setujui transaksi.</p>
            </div>
            <div class="role-card bendahara">
                <div class="role-emoji">📒</div>
                <h3>Bendahara</h3>
                <p>Kelola keuangan, buat laporan, catat pengeluaran, dan rekap pemasukan kas.</p>
            </div>
            <div class="role-card admin">
                <div class="role-emoji">⚙️</div>
                <h3>Admin</h3>
                <p>Kelola seluruh pengguna, kelas, dan pengaturan sistem secara menyeluruh.</p>
            </div>
        </div>
    </section>

    {{-- ═══════════════ CTA ═══════════════ --}}
    <section class="cta-section">
        <h2>Siap Modernisasi Kas Kelasmu?</h2>
        <p>Bergabung sekarang dan rasakan kemudahan mengelola keuangan kelas secara digital.</p>
        <button class="btn-cta-white" onclick="document.getElementById('authModal').classList.add('active')">
            Daftar Sekarang — Gratis 🚀
        </button>
    </section>

    {{-- ═══════════════ FOOTER ═══════════════ --}}
    <footer>
        <p>© {{ date('Y') }} <span>KasKu</span>. Dibuat dengan ❤️ untuk kemudahan pendidikan Indonesia.</p>
    </footer>

    <script>
        const modal = document.getElementById('authModal');
        const openBtn = document.getElementById('openModalBtn');
        const closeBtn = document.getElementById('closeModalBtn');

        openBtn.addEventListener('click', () => modal.classList.add('active'));
        closeBtn.addEventListener('click', () => modal.classList.remove('active'));


        modal.addEventListener('click', (e) => {
            if (e.target === modal) modal.classList.remove('active');
        });


        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') modal.classList.remove('active');
        });
    </script>
</body>

</html>
