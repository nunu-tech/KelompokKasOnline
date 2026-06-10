@extends('layouts.siswa')

@section('title', 'Saldo Kas')
@section('page-title', 'Saldo Kas Kelas')

@section('content')

{{-- ── Hero Saldo ─────────────────────────────────────── --}}
<div class="rounded-4 p-4 mb-4 text-white position-relative overflow-hidden"
     style="background: linear-gradient(135deg, #E57C70 0%, #EA9389 50%, #c4554a 100%);">

    {{-- Dekorasi lingkaran latar --}}
    <div class="position-absolute rounded-circle"
         style="width:220px;height:220px;background:rgba(255,255,255,.07);top:-70px;right:-50px;"></div>
    <div class="position-absolute rounded-circle"
         style="width:140px;height:140px;background:rgba(255,255,255,.05);bottom:-40px;right:130px;"></div>

    <div style="position:relative;z-index:1;">
        <div class="d-flex align-items-center gap-2 mb-2">
            <i class="bi bi-wallet2" style="opacity:.75;font-size:.9rem;"></i>
            <span style="font-size:.8rem;opacity:.75;">Saldo Kas Kelas — Real Time</span>
        </div>

        <div class="fw-bold mb-1" style="font-size:2.4rem;letter-spacing:-1px;">
            Rp {{ number_format($saldo_akhir ?? 0, 0, ',', '.') }}
        </div>

        <div style="font-size:.75rem;opacity:.6;">
            Diperbarui: {{ now()->format('d M Y, H:i') }} WIB
        </div>

        {{-- Ringkasan Total --}}
        <div class="d-flex gap-4 mt-3 pt-3" style="border-top:1px solid rgba(255,255,255,.15);">
            <div>
                <div style="font-size:.7rem;opacity:.6;margin-bottom:2px;">Total Pemasukan</div>
                <div class="fw-semibold" style="font-size:.97rem;">
                    Rp {{ number_format($total_masuk ?? 0, 0, ',', '.') }}
                </div>
            </div>
            <div style="width:1px;background:rgba(255,255,255,.2);"></div>
            <div>
                <div style="font-size:.7rem;opacity:.6;margin-bottom:2px;">Total Pengeluaran</div>
                <div class="fw-semibold" style="font-size:.97rem;">
                    Rp {{ number_format($total_keluar ?? 0, 0, ',', '.') }}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ── Stat Cards Bulan Ini ────────────────────────────── --}}
<div class="row g-3 mb-4">

    {{-- Pemasukan bulan ini --}}
    <div class="col-md-6">
        <div class="stat-card">
            <div class="d-flex align-items-center gap-3 mb-3">
                <div style="width:44px;height:44px;background:#f0fdf4;border-radius:13px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="bi bi-arrow-up-circle-fill" style="color:#16a34a;font-size:1.2rem;"></i>
                </div>
                <div>
                    <div style="font-size:.73rem;color:#A0AEC0;font-weight:700;">Pemasukan Bulan Ini</div>
                    <div class="fw-bold" style="font-size:1.15rem;color:#16a34a;">
                        Rp {{ number_format($masuk_bulan_ini ?? 0, 0, ',', '.') }}
                    </div>
                </div>
            </div>
            @php
                $pctMasuk = ($total_masuk ?? 0) > 0
                    ? min(100, (($masuk_bulan_ini ?? 0) / $total_masuk) * 100)
                    : 0;
            @endphp
            <div class="progress" style="height:7px;border-radius:99px;background:#dcfce7;">
                <div class="progress-bar" style="width:{{ $pctMasuk }}%;background:#16a34a;border-radius:99px;"></div>
            </div>
            <div style="font-size:.71rem;color:#A0AEC0;margin-top:6px;">
                {{ number_format($pctMasuk, 1) }}% dari total pemasukan
            </div>
        </div>
    </div>

    {{-- Pengeluaran bulan ini --}}
    <div class="col-md-6">
        <div class="stat-card">
            <div class="d-flex align-items-center gap-3 mb-3">
                <div style="width:44px;height:44px;background:#fff1f2;border-radius:13px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="bi bi-arrow-down-circle-fill" style="color:#dc2626;font-size:1.2rem;"></i>
                </div>
                <div>
                    <div style="font-size:.73rem;color:#A0AEC0;font-weight:700;">Pengeluaran Bulan Ini</div>
                    <div class="fw-bold" style="font-size:1.15rem;color:#dc2626;">
                        Rp {{ number_format($keluar_bulan_ini ?? 0, 0, ',', '.') }}
                    </div>
                </div>
            </div>
            @php
                $pctKeluar = ($total_keluar ?? 0) > 0
                    ? min(100, (($keluar_bulan_ini ?? 0) / $total_keluar) * 100)
                    : 0;
            @endphp
            <div class="progress" style="height:7px;border-radius:99px;background:#fee2e2;">
                <div class="progress-bar" style="width:{{ $pctKeluar }}%;background:#dc2626;border-radius:99px;"></div>
            </div>
            <div style="font-size:.71rem;color:#A0AEC0;margin-top:6px;">
                {{ number_format($pctKeluar, 1) }}% dari total pengeluaran
            </div>
        </div>
    </div>
</div>

{{-- ── Riwayat Saldo per Bulan ─────────────────────────── --}}
<div class="card-box p-4">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h6 class="fw-bold mb-0" style="color:#1A2130;font-size:.95rem;">Riwayat Saldo per Bulan</h6>
            <div style="font-size:.73rem;color:#A0AEC0;">Data kumulatif kas kelas</div>
        </div>
        <a href="{{ route('siswa.riwayat') }}"
           style="font-size:.8rem;color:#E57C70;font-weight:600;text-decoration:none;">
            Lihat semua <i class="bi bi-arrow-right ms-1"></i>
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-custom table-borderless">
            <thead>
                <tr>
                    <th>Bulan</th>
                    <th class="text-end">Pemasukan</th>
                    <th class="text-end">Pengeluaran</th>
                    <th class="text-end">Saldo Akhir</th>
                </tr>
            </thead>
            <tbody>
                @forelse($riwayat_bulanan ?? [] as $rb)
                <tr>
                    <td class="fw-semibold" style="color:#1A2130;">{{ $rb->bulan }}</td>
                    <td class="text-end fw-semibold" style="color:#16a34a;">
                        + Rp {{ number_format($rb->total_masuk, 0, ',', '.') }}
                    </td>
                    <td class="text-end fw-semibold" style="color:#dc2626;">
                        - Rp {{ number_format($rb->total_keluar, 0, ',', '.') }}
                    </td>
                    <td class="text-end fw-bold" style="color:#E57C70;">
                        Rp {{ number_format($rb->saldo_akhir, 0, ',', '.') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-5" style="color:#A0AEC0;">
                        <i class="bi bi-inbox d-block mb-2" style="font-size:2rem;"></i>
                        Belum ada data saldo bulanan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection