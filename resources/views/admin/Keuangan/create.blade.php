@extends('admin.app')

@section('title', 'Tambah Transaksi Kas')

@section('content')
<div class="p-6 sm:p-10 max-w-6xl mx-auto">
    
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight mb-2">Catat Transaksi Baru</h1>
        <p class="text-gray-500">Pilih jenis transaksi dan lengkapi detail pendataannya di bawah ini.</p>
    </div>

    @if(session('sukses'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-6 py-4 rounded-2xl mb-8 flex items-center shadow-sm">
        <svg class="w-6 h-6 mr-3 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <div>
            <p class="font-bold text-sm">Berhasil!</p>
            <p class="text-sm">{{ session('sukses') }}</p>
        </div>
    </div>
    @endif

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.keuangan.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-12">
                
                <div class="md:col-span-5 bg-gray-50/50 p-6 md:p-8 border-b md:border-b-0 md:border-r border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center">
                        <span class="bg-indigo-100 text-indigo-600 p-1.5 rounded-lg mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </span>
                        Info Keuangan
                    </h3>

                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Jenis Transaksi</label>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="relative flex items-center justify-center p-4 border border-gray-200 rounded-xl cursor-pointer hover:bg-gray-50 focus-within:ring-2 focus-within:ring-indigo-500 transition">
                                <input type="radio" name="jenis" value="Masuk" class="absolute w-0 h-0 opacity-0 peer" required>
                                <div class="peer-checked:hidden text-gray-500 font-medium">Uang Masuk</div>
                                <div class="hidden peer-checked:flex items-center text-emerald-600 font-bold">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path></svg>
                                    Pemasukan
                                </div>
                            </label>

                            <label class="relative flex items-center justify-center p-4 border border-gray-200 rounded-xl cursor-pointer hover:bg-gray-50 focus-within:ring-2 focus-within:ring-indigo-500 transition">
                                <input type="radio" name="jenis" value="Keluar" class="absolute w-0 h-0 opacity-0 peer" required>
                                <div class="peer-checked:hidden text-gray-500 font-medium">Uang Keluar</div>
                                <div class="hidden peer-checked:flex items-center text-rose-600 font-bold">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"></path></svg>
                                    Pengeluaran
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Jumlah Nominal</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <span class="text-gray-500 font-bold">Rp</span>
                            </div>
                            <input type="number" name="nominal" placeholder="0" class="w-full pl-12 bg-white border border-gray-200 rounded-xl px-4 py-3 text-lg font-bold text-gray-800 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition shadow-sm" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Transaksi</label>
                        <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 text-gray-700 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition shadow-sm" required>
                    </div>
                </div>

                <div class="md:col-span-7 p-6 md:p-8">
                    <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center">
                        <span class="bg-indigo-100 text-indigo-600 p-1.5 rounded-lg mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </span>
                        Pihak Terkait & Keterangan
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Filter Kelas <span class="text-gray-400 font-normal">(Opsional)</span></label>
                            <select id="pilih_kelas" class="w-full bg-gray-50 border border-gray-200 text-gray-700 rounded-xl px-4 py-3 focus:bg-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                                <option value="">Semua Kelas</option>
                                @foreach($daftar_kelas as $kelas)
                                <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Siswa</label>
                            <select name="id_user" id="pilih_siswa" class="w-full bg-gray-50 border border-gray-200 text-gray-700 rounded-xl px-4 py-3 focus:bg-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                                <option value="">-- Kas Umum (Bukan Siswa) --</option>
                                @foreach($daftar_siswa as $siswa)
                                <option value="{{ $siswa->id_user }}" data-kelas="{{ $siswa->id_kelas }}">
                                    {{ $siswa->nama_lengkap }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-8">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Catatan Keterangan</label>
                        <textarea name="keterangan" rows="4" placeholder="Tulis rincian transaksi di sini (misal: Bayar kas minggu ke-3 / Beli sapu lidi untuk kebersihan kelas)..." class="w-full bg-gray-50 border border-gray-200 text-gray-700 rounded-xl px-4 py-3 focus:bg-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition resize-none" required></textarea>
                    </div>

                    <div class="flex items-center justify-end space-x-4 pt-4">
                        <a href="{{ route('admin.keuangan.index') }}" class="px-6 py-3 text-gray-500 hover:text-gray-800 font-semibold rounded-xl hover:bg-gray-100 transition">
                            Batalkan
                        </a>
                        <button type="submit" class="px-8 py-3 bg-gray-900 hover:bg-indigo-600 text-white font-bold rounded-xl shadow-md transition-all duration-200 transform hover:-translate-y-1">
                            Simpan Data Transaksi
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const kelasSelect = document.getElementById('pilih_kelas');
        const siswaSelect = document.getElementById('pilih_siswa');
        const siswaOptions = siswaSelect.querySelectorAll('option');

        kelasSelect.addEventListener('change', function() {
            const selectedKelas = this.value;
            siswaSelect.value = "";

            siswaOptions.forEach(option => {
                if (option.value === "") {
                    option.hidden = false;
                    return;
                }

                const kelasSiswa = option.getAttribute('data-kelas');
                if (selectedKelas === "" || kelasSiswa === selectedKelas) {
                    option.hidden = false;
                } else {
                    option.hidden = true;
                }
            });
        });
    });
</script>
@endsection