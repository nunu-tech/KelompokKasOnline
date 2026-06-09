@extends('admin.app')

@section('title', 'Buku Induk Kas')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-2">Buku Induk Kas Kelas</h1>
    <p class="text-gray-500 mb-6">Rekapitulasi seluruh transaksi keuangan masuk dan keluar.</p>

    <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 mb-6">
        <form action="{{ route('admin.keuangan.laporan') }}" method="GET" class="flex flex-wrap items-end gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                <select name="kelas" class="border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-indigo-200">
                    <option value="">-- Semua Kelas --</option>
                    @foreach($daftar_kelas as $kelas)
                    <option value="{{ $kelas->id }}" {{ $kelas_dipilih == $kelas->id ? 'selected' : '' }}>
                        {{ $kelas->nama_kelas }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Bulan</label>
                <select name="bulan" class="border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-indigo-200">
                    @for($i = 1; $i <= 12; $i++)
                        <option value="{{ sprintf('%02d', $i) }}" {{ $bulan == sprintf('%02d', $i) ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                        </option>
                        @endfor </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tahun</label>
                <select name="tahun" class="border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-indigo-200">
                    @for($t = 2024; $t <= date('Y') + 1; $t++)
                        <option value="{{ $t }}" {{ $tahun == $t ? 'selected' : '' }}>{{ $t }}</option>
                        @endfor </select>
            </div>

            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-200">
                Tampilkan Data
            </button>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-indigo-50 p-4 rounded-xl border border-indigo-100">
            <p class="text-indigo-600 text-sm font-semibold">Pemasukan Bulan Ini</p>
            <h3 class="text-xl font-bold text-indigo-900 mt-1">Rp {{ number_format($total_masuk, 0, ',', '.') }}</h3>
        </div>
        <div class="bg-rose-50 p-4 rounded-xl border border-rose-100">
            <p class="text-rose-600 text-sm font-semibold">Pengeluaran Bulan Ini</p>
            <h3 class="text-xl font-bold text-rose-900 mt-1">Rp {{ number_format($total_keluar, 0, ',', '.') }}</h3>
        </div>
        <div class="bg-emerald-50 p-4 rounded-xl border border-emerald-100">
            <p class="text-emerald-600 text-sm font-semibold">Saldo Periode Ini</p>
            <h3 class="text-xl font-bold text-emerald-900 mt-1">Rp {{ number_format($saldo_periode, 0, ',', '.') }}</h3>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-3 px-4 text-gray-600 font-semibold text-sm border-b">Tanggal</th>
                        <th class="py-3 px-4 text-gray-600 font-semibold text-sm border-b">Nama Siswa</th>
                        <th class="py-3 px-4 text-gray-600 font-semibold text-sm border-b">Keterangan</th>
                        <th class="py-3 px-4 text-gray-600 font-semibold text-sm border-b">Masuk</th>
                        <th class="py-3 px-4 text-gray-600 font-semibold text-sm border-b">Keluar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($laporan as $tr)
                    <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                        <td class="py-3 px-4 text-sm">{{ \Carbon\Carbon::parse($tr->tanggal)->format('d/m/Y') }}</td>

                        <td class="py-3 px-4 text-sm font-medium text-gray-800">
                            {{ $tr->user->nama_lengkap ?? 'Kas Umum/Kelas' }}
                        </td>

                        <td class="py-3 px-4 text-sm text-gray-600">{{ $tr->keterangan }}</td>

                        <td class="py-3 px-4 text-sm font-bold text-emerald-600">
                            {{ $tr->jenis == 'Masuk' ? 'Rp ' . number_format($tr->nominal, 0, ',', '.') : '-' }}
                        </td>
                        <td class="py-3 px-4 text-sm font-bold text-rose-600">
                            {{ $tr->jenis == 'Keluar' ? 'Rp ' . number_format($tr->nominal, 0, ',', '.') : '-' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-gray-400">
                            Tidak ada transaksi pada bulan dan tahun ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection