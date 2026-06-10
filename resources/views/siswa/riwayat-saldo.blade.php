@extends('layouts.siswa')

@section('title', 'Riwayat Transaksi')
@section('page-title', 'Riwayat Transaksi')

@section('content')

{{-- ── Filter ───────────────────────────────────────────── --}}
<div class="card-box p-4 mb-4">
    <form method="GET" action="{{ route('siswa.riwayat') }}">
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
                    <a href="{{ route('siswa.riwayat') }}" class="btn fw-semibold"
                       style="background:#f1f5f9;color:#64748b;border-radius:12px;font-size:.85rem;border:none;padding:10px 14px;">
                        <i class="bi bi-x-lg"></i>
                    </a>
                </div>
            </div>

        </div>
    </form>
</div>

{{-- ── Tabel Riwayat ────────────────────────────────────── --}}
<div class="card-box p-4">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h6 class="fw-bold mb-0" style="color:#1A2130;font-size:.95rem;">Daftar Transaksi</h6>
            <span style="font-size:.73rem;color:#A0AEC0;">
                {{ $transaksi->total() ?? 0 }} data ditemukan
            </span>
        </div>
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
                </tr>
            </thead>
            <tbody>
                @forelse($transaksi ?? [] as $i => $trx)
                <tr>
                    <td style="color:#A0AEC0;font-size:.8rem;">
                        {{ $transaksi->firstItem() + $i }}
                    </td>
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
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5" style="color:#A0AEC0;">
                        <i class="bi bi-inbox d-block mb-2" style="font-size:2rem;"></i>
                        Tidak ada data transaksi
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if(isset($transaksi) && $transaksi->hasPages())
    <div class="d-flex align-items-center justify-content-between mt-3 pt-3"
         style="border-top:1px solid #f1f5f9;">
        <div style="font-size:.78rem;color:#A0AEC0;">
            Menampilkan {{ $transaksi->firstItem() }}–{{ $transaksi->lastItem() }}
            dari {{ $transaksi->total() }} data
        </div>
        {{ $transaksi->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>

<style>
@keyframes blink { 0%,100%{opacity:1} 50%{opacity:.3} }
</style>

@endsection