<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aesthetic Kas Ledger — Premium Interface</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --bg-base: #FDFBF9;         /* Soft warm ivory / cream */
            --bg-sidebar: #FFFFFF;
            --surface: #FFFFFF;
            --accent-primary: #E57C70;  /* Soft Warm Rose */
            --accent-secondary: #F6E6E4;/* Very soft nude blush */
            --text-heading: #1A2130;    /* Deep elegant slate */
            --text-body: #5A6578;       /* Clean muted grey */
            --border-color: #F1ECE8;    /* Ultra soft warm border */
            
            /* Modern Layered Shadows */
            --shadow-sm: 0 2px 12px rgba(229, 124, 112, 0.04);
            --shadow-md: 0 16px 40px rgba(142, 127, 122, 0.06);
            --shadow-lg: 0 32px 64px rgba(142, 127, 122, 0.08);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-base);
            color: var(--text-body);
            min-height: 100vh;
            letter-spacing: -0.2px;
        }

        /* Bento-Style Container Card */
        .bento-card {
            background: var(--surface);
            border: 1px solid var(--border-color);
            border-radius: 24px;
            box-shadow: var(--shadow-md);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .bento-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: rgba(229, 124, 112, 0.25);
        }

        /* Sidebar Architecture */
        .sidebar-container {
            background: var(--bg-sidebar);
            border-right: 1px solid var(--border-color);
            width: 290px;
            height: 100vh;
            position: fixed;
            top: 0; left: 0;
            z-index: 100;
        }

        .nav-aesthetic .nav-link {
            color: var(--text-body);
            font-weight: 600;
            font-size: 0.92rem;
            padding: 14px 20px;
            border-radius: 16px;
            margin-bottom: 8px;
            transition: all 0.25s ease;
            display: flex;
            align-items: center;
        }

        .nav-aesthetic .nav-link i {
            font-size: 1.1rem;
            transition: transform 0.25s ease;
        }

        .nav-aesthetic .nav-link:hover {
            color: var(--accent-primary);
            background: var(--accent-secondary);
        }

        .nav-aesthetic .nav-link:hover i {
            transform: translateX(4px);
        }

        .nav-aesthetic .nav-link.active {
            background: linear-gradient(135deg, #FAF4F2 0%, var(--accent-secondary) 100%);
            color: var(--accent-primary);
            font-weight: 700;
            border: 1px solid rgba(229, 124, 112, 0.15);
        }

        /* Workspace Wrapper */
        .workspace {
            margin-left: 290px;
            padding: 56px;
            width: calc(100% - 290px);
        }

        /* Input Controls */
        .input-premium {
            background: #FDFDFD !important;
            border: 1.5px solid var(--border-color) !important;
            color: var(--text-heading) !important;
            border-radius: 16px;
            padding: 14px 18px;
            font-size: 0.9rem;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .input-premium:focus {
            background: #FFFFFF !important;
            border-color: var(--accent-primary) !important;
            box-shadow: 0 0 0 4px rgba(229, 124, 112, 0.12) !important;
        }

        /* Button Luxury Minimalist */
        .btn-luxury {
            background: linear-gradient(135deg, #EA9389 0%, var(--accent-primary) 100%);
            color: #FFFFFF !important;
            font-weight: 700;
            font-size: 0.9rem;
            border: none;
            border-radius: 16px;
            padding: 16px;
            box-shadow: 0 10px 24px rgba(229, 124, 112, 0.2);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .btn-luxury:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 32px rgba(229, 124, 112, 0.35);
            opacity: 0.95;
        }

        /* Status Pill Circle */
        .indicator-icon {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
        }

        /* Ambient Glow Effect for Balance Card */
        .glow-orb {
            position: absolute;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(246,230,228,0.6) 0%, rgba(255,255,255,0) 70%);
            top: -60px;
            right: -40px;
            z-index: 0;
        }

        /* Responsive Mechanics */
        @media (max-width: 991.98px) {
            .sidebar-container { display: none !important; }
            .workspace { margin-left: 0; width: 100%; padding: 28px; }
        }
    </style>
</head>
<body>

    <div class="sidebar-container d-flex flex-column justify-content-between p-4">
        <div>
            <div class="d-flex align-items-center gap-3 mb-5 mt-2 px-2">
                <div class="rounded-4 d-flex align-items-center justify-content-center shadow-sm" style="width: 42px; height: 42px; background: var(--accent-secondary); color: var(--accent-primary);">
                    <i class="bi bi-intersect fs-5"></i>
                </div>
                <div>
                    <h1 class="h5 m-0 fw-bold tracking-tight" style="color: var(--text-heading); font-weight: 800;">Class<span style="color: var(--accent-primary)">Ledger.</span></h1>
                    <p class="m-0 text-uppercase tracking-widest" style="font-size: 8px; font-weight: 800; color: #A0AEC0; letter-spacing: 1.8px;">FINANCIAL ECOSYSTEM</p>
                </div>
            </div>

            <nav class="nav nav-pills flex-column nav-aesthetic">
                <a class="nav-link active" href="{{ route('bendahara.index') }}">
                    <i class="bi bi-columns-gap me-3"></i> Dashboard
                </a>
                <a class="nav-link" href="{{ route('bendahara.siswa') }}">
                    <i class="bi bi-person-lines-fill me-3"></i> Data Siswa
                </a>
                <a class="nav-link" href="{{ route('bendahara.laporan') }}">
                    <i class="bi bi-bar-chart-line me-3"></i> Analytics & Laporan
                </a>
                <a class="nav-link" href="{{ route('bendahara.verifikasi') }}">
                    <i class="bi bi-shield-check me-3"></i> Verifikasi Kas
                </a>
            </nav>
        </div>

        <div class="p-3 rounded-4" style="background: var(--bg-base); border: 1px solid var(--border-color)">
            <div class="d-flex align-items-center gap-3 mb-3">
                <img src="https://ui-avatars.com/api/?name=Bendahara+Kelas&background=F6E6E4&color=E57C70&bold=true" class="rounded-4" style="width: 40px; height: 40px;">
                <div class="overflow-hidden">
                    <p class="m-0 fw-bold small text-truncate" style="color: var(--text-heading);">Bendahara Kelas</p>
                    <p class="m-0 text-muted" style="font-size: 11px;">Administrator Mode</p>
                </div>
            </div>
            <button class="btn btn-sm w-100 btn-light rounded-3 py-2 fw-bold shadow-none" style="font-size: 11px; color: #E53E3E; background: #FFF; border: 1px solid var(--border-color); transition: all 0.2s;">
                Logout Session
            </button>
        </div>
    </div>

    <div class="workspace">
        
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center mb-5 gap-3">
            <div>
                <h2 class="fw-bold m-0" style="color: var(--text-heading); font-weight: 800; font-size: 1.85rem; letter-spacing: -0.5px;">Financial Hub</h2>
                <p class="text-muted small m-0 mt-1">Kelola sirkulasi kas kelas dengan akurat, transparan, dan teratur.</p>
            </div>
            
            <div class="d-flex align-items-center gap-2 px-3 py-2 rounded-4" style="background: #FFFFFF; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm);">
                <i class="bi bi-calendar-check" style="color: var(--accent-primary);"></i>
                <span class="fw-bold uppercase tracking-wider" style="font-size: 11px; color: var(--text-heading);">{{ date('d F Y') }}</span>
            </div>
        </div>

        @if(session('sukses'))
            <div class="alert border-0 rounded-4 p-3 mb-4 d-flex align-items-center gap-3" style="background: #F0FDF4; color: #166534; border: 1px solid #DCFCE7 !important; box-shadow: var(--shadow-sm);">
                <i class="bi bi-check-circle-fill fs-5 text-success"></i>
                <span class="small fw-semibold">{{ session('sukses') }}</span>
            </div>
        @endif

        <div class="row g-4">
            
            <div class="col-12 col-lg-8 d-flex flex-column gap-4">
                
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bento-card p-4 p-sm-5 position-relative overflow-hidden" style="background: linear-gradient(135deg, #FFFFFF 0%, #FFFDFD 100%);">
                            <div class="glow-orb"></div>
                            <div class="position-relative" style="z-index: 1;">
                                <p class="fw-bold text-uppercase tracking-widest m-0" style="font-size: 10px; color: #A0AEC0; letter-spacing: 2px;">Akumulasi Saldo Aktif</p>
                                <h2 class="m-0 mt-3" style="color: var(--text-heading); font-weight: 800; font-size: 3.25rem; letter-spacing: -1.5px;">
                                    <span style="color: var(--accent-primary); font-size: 1.6rem; vertical-align: middle;" class="fw-bold me-1">Rp</span>{{ number_format($saldo_akhir, 0, ',', '.') }}
                                </h2>
                                <div class="d-flex align-items-center gap-2 mt-4 pt-3 border-top" style="border-color: var(--border-color) !important;">
                                    <div class="rounded-circle bg-success" style="width: 6px; height: 6px; animation: pulse 2s infinite;"></div>
                                    <span class="text-muted" style="font-size: 11px;">Data kas tervalidasi secara *real-time* oleh sistem</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bento-card p-4 p-sm-5">
                    <div class="d-flex align-items-center gap-2 mb-4">
                        <div class="rounded-pill" style="width: 5px; height: 18px; background: var(--accent-primary);"></div>
                        <h3 class="h6 m-0 fw-bold" style="color: var(--text-heading); font-weight: 700; letter-spacing: -0.2px;">Pencatatan Log Transaksi</h3>
                    </div>

                    <form action="{{ route('bendahara.store') }}" method="POST" class="row g-4">
                        @csrf
                        <div class="col-md-6 d-flex flex-column gap-1">
                            <label class="fw-bold text-uppercase" style="font-size: 10px; color: #A0AEC0; letter-spacing: 0.5px; padding-left: 2px;">Penanggung Jawab / Siswa</label>
                            <select name="id_user" class="form-select input-premium shadow-none">
                                <option value="">Kategori Kas Umum (non-siswa)</option>
                                @foreach($daftar_siswa as $siswa)
                                    <option value="{{ $siswa->id }}">{{ $siswa->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 d-flex flex-column gap-1">
                            <label class="fw-bold text-uppercase" style="font-size: 10px; color: #A0AEC0; letter-spacing: 0.5px; padding-left: 2px;">Nominal Dana (IDR)</label>
                            <input type="number" name="nominal" placeholder="Masukan nominal angka" class="form-control input-premium shadow-none" required>
                        </div>

                        <div class="col-md-6 d-flex flex-column gap-1">
                            <label class="fw-bold text-uppercase" style="font-size: 10px; color: #A0AEC0; letter-spacing: 0.5px; padding-left: 2px;">Jenis Aliran Arus</label>
                            <select name="jenis" class="form-select input-premium shadow-none">
                                <option value="Masuk">Pemasukan Dana</option>
                                <option value="Keluar">Pengeluaran Dana</option>
                            </select>
                        </div>

                        <div class="col-md-6 d-flex flex-column gap-1">
                            <label class="fw-bold text-uppercase" style="font-size: 10px; color: #A0AEC0; letter-spacing: 0.5px; padding-left: 2px;">Tanggal Buku Matriks</label>
                            <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" class="form-control input-premium shadow-none" required>
                        </div>

                        <div class="col-12 d-flex flex-column gap-1">
                            <label class="fw-bold text-uppercase" style="font-size: 10px; color: #A0AEC0; letter-spacing: 0.5px; padding-left: 2px;">Deskripsi Keperluan</label>
                            <input type="text" name="keterangan" placeholder="Tulis rincian atau alasan alokasi dana..." class="form-control input-premium shadow-none" required>
                        </div>

                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-luxury w-100 shadow-none">Simpan Transaksi</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="bento-card p-4 d-flex flex-column justify-content-between h-100">
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-4 px-1">
                            <h3 class="h6 m-0 fw-bold" style="color: var(--text-heading); font-weight: 700;">Riwayat Aktivitas</h3>
                            <a href="{{ route('bendahara.laporan') }}" class="text-decoration-none fw-bold text-uppercase" style="color: var(--accent-primary); font-size: 10px; letter-spacing: 0.5px;">Semua Data</a>
                        </div>

                        <div class="d-flex flex-column gap-2">
                            @foreach($semua_transaksi->take(5) as $item)
                            <div class="d-flex align-items-center justify-content-between p-2 rounded-4" style="background: transparent;">
                                <div class="d-flex align-items-center gap-3 min-w-0">
                                    
                                    <div class="indicator-icon flex-shrink-0" style="background-color: {{ $item->jenis == 'Masuk' ? '#F4FBF7' : '#FFF5F5' }}; color: {{ $item->jenis == 'Masuk' ? '#16A34A' : '#DC2626' }}; border: 1px solid {{ $item->jenis == 'Masuk' ? '#E6F4EA' : '#FEE2E2' }};">
                                        <i class="bi {{ $item->jenis == 'Masuk' ? 'bi-arrow-up-right-circle' : 'bi-arrow-down-left-circle' }}"></i>
                                    </div>
                                    <div class="text-truncate">
                                        <p class="m-0 fw-bold small text-truncate" style="color: var(--text-heading); font-size: 0.88rem;">{{ $item->user ? $item->user->name : 'Kas Umum' }}</p>
                                        <p class="m-0 text-muted text-truncate" style="font-size: 11px; margin-top: 1px;">{{ $item->keterangan }}</p>
                                    </div>
                                </div>
                                <div class="text-end flex-shrink-0 ps-2">
                                    <p class="m-0 fw-bold small" style="color: {{ $item->jenis == 'Masuk' ? '#16A34A' : '#DC2626' }}; font-size: 0.88rem;">
                                        {{ $item->jenis == 'Masuk' ? '+' : '-' }}{{ number_format($item->nominal, 0, ',', '.') }}
                                    </p>
                                    <p class="m-0 text-muted" style="font-size: 9px; margin-top: 2px; font-weight: 600;">{{ date('d M', strtotime($item->tanggal)) }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        @if($semua_transaksi->isEmpty())
                            <div class="text-center py-5 my-5">
                                <div class="text-muted fs-3 mb-2"><i class="bi bi-envelope-open" style="color: var(--accent-primary); opacity: 0.6;"></i></div>
                                <p class="text-muted small m-0" style="font-style: italic;">Belum ada arus kas terdaftar.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>