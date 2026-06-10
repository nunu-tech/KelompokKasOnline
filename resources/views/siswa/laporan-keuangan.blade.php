@extends('layouts.siswa')

@section('title', 'Laporan Keuangan')
@section('page-title', 'Laporan Keuangan Kelas')

@section('content')

{{-- ── Ringkasan Saldo ──────────────────────────────────── --}}
<div class="row g-3 mb-4">
    <div class="col-12 col-md-4">
        <div class="stat-card text-center">
            <div style="width:44px;height:44px;background:#eff6ff;border-radius:13px;display:flex;align-items:center;justify-content:center;margin:0 auto 12px;">
                <i class="bi bi-wallet2" style="color:#1d4ed8;font-size:1.1rem;"></i>
            </div>
            <div class="fw-bold" style="font-size:1.4rem;color:#1A2130;line-height:1.2;">
                Rp {{ number_format($saldo_periode ?? 0, 0, ',', '.') }}
            </div>
            <div style="font-size:.73rem;color:#A0AEC0;margin-top:4px;">Saldo Kas Kelas</div>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="stat-card text-center">
            <div style="width:44px;height:44px;background:#f0fdf4;border-radius:13px;display:flex;align-items:center;justify-content:center;margin:0 auto 12px;">
                <i class="bi bi-arrow-up-circle-fill" style="color:#16a34a;font-size:1.1rem;"></i>
            </div>
            <div class="fw-bold" style="font-size:1.4rem;color:#16a34a;line-height:1.2;">
                Rp {{ number_format($total_masuk ?? 0, 0, ',', '.') }}
            </div>
            <div style="font-size:.73rem;color:#A0AEC0;margin-top:4px;">Total Pemasukan</div>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="stat-card text-center">
            <div style="width:44px;height:44px;background:#fff1f2;border-radius:13px;display:flex;align-items:center;justify-content:center;margin:0 auto 12px;">
                <i class="bi bi-arrow-down-circle-fill" style="color:#dc2626;font-size:1.1rem;"></i>
            </div>
            <div class="fw-bold" style="font-size:1.4rem;color:#dc2626;line-height:1.2;">
                Rp {{ number_format($total_keluar ?? 0, 0, ',', '.') }}
            </div>
            <div style="font-size:.73rem;color:#A0AEC0;margin-top:4px;">Total Pengeluaran</div>
        </div>
    </div>
</div>

{{-- ── Filter ───────────────────────────────────────────── --}}
<div class="card-box p-4 mb-4">
    <form method="GET" action="{{ route('siswa.laporan') }}">
        <div class="row g-3 align-items-end">

            <div class="col-12 col-md-3">
                <label style="font-size:.75rem;font-weight:700;color:#A0AEC0;display:block;margin-bottom:6px;">
                    <i class="bi bi-search me-1"></i> Cari Keterangan
                </label>
                <input type="text" name="search" class="form-control form-control-custom"
                       placeholder="Ketik keterangan..." value="{{ request('search') }}">
            </div>

            <div class="col-12 col-md-2">
                <label style="font-size:.75rem;font-weight:700;color:#A0AEC0;display:block;margin-bottom:6px;">
                    <i class="bi bi-funnel me-1"></i> Jenis
                </label>
                <select name="jenis" class="form-control form-control-custom">
                    <option value="">Semua</option>
                    <option value="Masuk"  {{ request('jenis') == 'Masuk'  ? 'selected' : '' }}>Masuk</option>
                    <option value="Keluar" {{ request('jenis') == 'Keluar' ? 'selected' : '' }}>Keluar</option>
                </select>
            </div>

            <div class="col-12 col-md-2">
                <label style="font-size:.75rem;font-weight:700;color:#A0AEC0;display:block;margin-bottom:6px;">
                    <i class="bi bi-calendar3 me-1"></i> Dari Tanggal
                </label>
                <input type="date" name="dari" class="form-control form-control-custom"
                       value="{{ request('dari') }}">
            </div>

            <div class="col-12 col-md-2">
                <label style="font-size:.75rem;font-weight:700;color:#A0AEC0;display:block;margin-bottom:6px;">
                    <i class="bi bi-calendar3 me-1"></i> Sampai Tanggal
                </label>
                <input type="date" name="sampai" class="form-control form-control-custom"
                       value="{{ request('sampai') }}">
            </div>

            <div class="col-12 col-md-3">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn fw-semibold flex-fill"
                            style="background:#E57C70;color:#fff;border-radius:12px;font-size:.85rem;border:none;padding:10px;">
                        <i class="bi bi-search me-1"></i> Filter
                    </button>
                    <a href="{{ route('siswa.laporan') }}" class="btn fw-semibold"
                       style="background:#f1f5f9;color:#64748b;border-radius:12px;font-size:.85rem;border:none;padding:10px 14px;">
                        <i class="bi bi-x-lg"></i>
                    </a>
                </div>
            </div>

        </div>
    </form>
</div>

{{-- ── Tabel Laporan ────────────────────────────────────── --}}
<div class="card-box p-4">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h6 class="fw-bold mb-0" style="color:#1A2130;font-size:.95rem;">Daftar Transaksi Kelas</h6>
            <span style="font-size:.73rem;color:#A0AEC0;">
                {{ $laporan->count() }} data ditemukan
            </span>
        </div>
        {{-- Info sumber data --}}
        <div style="display:inline-flex;align-items:center;gap:6px;background:#f0fdf4;border:1px solid #bbf7d0;border-radius:10px;padding:5px 12px;font-size:.72rem;color:#16a34a;font-weight:700;">
            <span style="width:7px;height:7px;background:#16a34a;border-radius:50%;animation:blink 1.6s infinite;"></span>
            Real-time dari Bendahara
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-custom table-borderless">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Jenis</th>
                    <th class="text-end">Jumlah</th>
                    <th class="text-end">Saldo Setelah</th>
                </tr>
            </thead>
            <tbody>
                @php $saldo_running = 0; @endphp
                @forelse($laporan as $i => $trx)
                @php
                    if (strtolower($trx->jenis) == 'masuk') {
                        $saldo_running += $trx->nominal;
                    } else {
                        $saldo_running -= $trx->nominal;
                    }
                @endphp
                <tr>
                    <td style="color:#A0AEC0;font-size:.8rem;">{{ $i + 1 }}</td>
                    <td style="color:#5A6578;">
                        {{ \Carbon\Carbon::parse($trx->tanggal)->format('d M Y') }}
                    </td>
                    <td class="fw-semibold" style="color:#1A2130;">{{ $trx->keterangan }}</td>
                    <td>
                        @if(strtolower($trx->jenis) == 'masuk')
                            <span class="badge-masuk">
                                <i class="bi bi-arrow-up"></i> Masuk
                            </span>
                        @else
                            <span class="badge-keluar">
                                <i class="bi bi-arrow-down"></i> Keluar
                            </span>
                        @endif
                    </td>
                    <td class="text-end fw-bold"
                        style="color:{{ strtolower($trx->jenis) == 'masuk' ? '#16a34a' : '#dc2626' }}">
                        {{ strtolower($trx->jenis) == 'masuk' ? '+' : '-' }}
                        Rp {{ number_format($trx->nominal, 0, ',', '.') }}
                    </td>
                    <td class="text-end fw-semibold" style="color:#1A2130;font-size:.83rem;">
                        Rp {{ number_format($saldo_running, 0, ',', '.') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5" style="color:#A0AEC0;">
                        <i class="bi bi-inbox d-block mb-2" style="font-size:2rem;"></i>
                        Tidak ada data transaksi
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Footer Ringkasan --}}
    @if($laporan->count() > 0)
    <div class="d-flex align-items-center justify-content-end gap-4 pt-3"
         style="border-top:1px solid #f1f5f9;">
        <div style="font-size:.8rem;color:#16a34a;font-weight:700;">
            <i class="bi bi-arrow-up me-1"></i>
            Total Masuk: Rp {{ number_format($total_masuk, 0, ',', '.') }}
        </div>
        <div style="font-size:.8rem;color:#dc2626;font-weight:700;">
            <i class="bi bi-arrow-down me-1"></i>
            Total Keluar: Rp {{ number_format($total_keluar, 0, ',', '.') }}
        </div>
        <div style="font-size:.85rem;color:#E57C70;font-weight:800;">
            Saldo: Rp {{ number_format($saldo_periode, 0, ',', '.') }}
        </div>
    </div>
    @endif
</div>

<style>
@keyframes blink { 0%,100%{opacity:1} 50%{opacity:.3} }
</style>

@endsection