@extends('layouts.siswa')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard Siswa')

@section('content')

{{-- Stat Cards --}}
<div class="row g-3 mb-4">

    {{-- Saldo --}}
    <div calass="col-12 col-md-4">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="d-flex align-items-center justify-content-center rounded-3"
                     style="width:48px;height:48px;background:#eff6ff;">
                    <i class="fas fa-wallet" style="color:#1d4ed8;font-size:1.1rem;"></i>
                </div>
                <span class="badge rounded-pill"
                      style="background:#eff6ff;color:#1d4ed8;font-size:0.72rem;font-weight:600;">
                    Saldo Aktif
                </span>
            </div>

            <div class="fw-bold" style="font-size:1.5rem;line-height:1.2;color:#1e293b;">
                Rp {{ number_format($saldo ?? 0, 0, ',', '.') }}
            </div>

            <div class="text-muted mt-1" style="font-size:0.78rem;">
                Total saldo kas kelas
            </div>
        </div>
    </div>

    {{-- Total Masuk --}}
    <div class="col-12 col-md-4">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="d-flex align-items-center justify-content-center rounded-3"
                     style="width:48px;height:48px;background:#f0fdf4;">
                    <i class="fas fa-arrow-trend-up" style="color:#16a34a;font-size:1.1rem;"></i>
                </div>
                <span class="badge rounded-pill"
                      style="background:#f0fdf4;color:#16a34a;font-size:0.72rem;font-weight:600;">
                    Bulan Ini
                </span>
            </div>

            <div class="fw-bold" style="font-size:1.5rem;color:#16a34a;line-height:1.2;">
                Rp {{ number_format($totalMasuk ?? 0, 0, ',', '.') }}
            </div>

            <div class="text-muted mt-1" style="font-size:0.78rem;">
                Total pemasukan
            </div>
        </div>
    </div>

    {{-- Total Keluar --}}
    <div class="col-12 col-md-4">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="d-flex align-items-center justify-content-center rounded-3"
                     style="width:48px;height:48px;background:#fff1f2;">
                    <i class="fas fa-arrow-trend-down" style="color:#dc2626;font-size:1.1rem;"></i>
                </div>
                <span class="badge rounded-pill"
                      style="background:#fff1f2;color:#dc2626;font-size:0.72rem;font-weight:600;">
                    Bulan Ini
                </span>
            </div>

            <div class="fw-bold" style="font-size:1.5rem;color:#dc2626;line-height:1.2;">
                Rp {{ number_format($totalKeluar ?? 0, 0, ',', '.') }}
            </div>

            <div class="text-muted mt-1" style="font-size:0.78rem;">
                Total pengeluaran
            </div>
        </div>
    </div>

</div>

{{-- Transaksi Terbaru --}}
<div class="card-box p-4">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h6 class="fw-bold mb-0">Transaksi Terbaru</h6>
            <p class="text-muted mb-0" style="font-size:0.75rem;">5 transaksi terakhir</p>
        </div>

        <a href="{{ route('siswa.riwayat') }}"
           class="btn btn-sm fw-semibold"
           style="background:#eff6ff;color:#1d4ed8;border:none;border-radius:8px;font-size:0.8rem;">
            Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-borderless align-middle">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Kategori</th>
                    <th>Jenis</th>
                    <th class="text-end">Jumlah</th>
                </tr>
            </thead>

            <tbody>
                @forelse($transaksiTerbaru ?? [] as $trx)
                    <tr>
                        <td class="text-muted">
                            {{ \Carbon\Carbon::parse($trx->tanggal)->format('d M Y') }}
                        </td>

                        <td class="fw-semibold">
                            {{ $trx->keterangan ?? '-' }}
                        </td>

                        <td class="text-muted">
                            {{ $trx->kategori->nama ?? '-' }}
                        </td>

                        <td>
                            @if($trx->jenis == 'masuk')
                                <span class="badge bg-success">
                                    <i class="fas fa-arrow-up me-1"></i> Masuk
                                </span>
                            @else
                                <span class="badge bg-danger">
                                    <i class="fas fa-arrow-down me-1"></i> Keluar
                                </span>
                            @endif
                        </td>

                        <td class="text-end fw-bold"
                            style="color: {{ $trx->jenis == 'masuk' ? '#16a34a' : '#dc2626' }}">
                            {{ $trx->jenis == 'masuk' ? '+' : '-' }}
                            Rp {{ number_format($trx->jumlah ?? 0, 0, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="fas fa-inbox fa-2x d-block mb-2"></i>
                            Belum ada transaksi
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection