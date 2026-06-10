@extends('admin.app')

@section('title', 'Kirim Tagihan Kas')

@section('content')
<div class="p-6 sm:p-10 max-w-6xl mx-auto">

    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight mb-2">Buat Tagihan Kas</h1>
        <p class="text-gray-500">Kirim notifikasi tagihan ke siswa untuk melunasi uang kas kelas.</p>
    </div>

    @if(session('sukses'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-6 py-4 rounded-2xl mb-8 flex items-center shadow-sm">
        <svg class="w-6 h-6 mr-3 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <div>
            <p class="font-bold text-sm">Berhasil!</p>
            <p class="text-sm">{{ session('sukses') }}</p>
        </div>
    </div>
    @endif

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.keuangan.kirimTagihan') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-12">

                <div class="md:col-span-5 bg-orange-50/30 p-6 md:p-8 border-b md:border-b-0 md:border-r border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center">
                        <span class="bg-orange-100 text-orange-600 p-1.5 rounded-lg mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </span>
                        Detail Tagihan
                    </h3>

                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nominal Tagihan</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <span class="text-gray-500 font-bold">Rp</span>
                            </div>
                            <input type="number" name="nominal" placeholder="Contoh: 10000" class="w-full pl-12 bg-white border border-gray-200 rounded-xl px-4 py-3 text-lg font-bold text-gray-800 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition shadow-sm" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Batas Waktu Pembayaran</label>
                        <input type="date" name="jatuh_tempo" class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 text-gray-700 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition shadow-sm" required>
                        <p class="text-xs text-gray-500 mt-2">* Tanggal terakhir siswa diharapkan melunasi tagihan ini.</p>
                    </div>
                </div>

                <div class="md:col-span-7 p-6 md:p-8">
                    <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center">
                        <span class="bg-orange-100 text-orange-600 p-1.5 rounded-lg mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </span>
                        Siswa yang Ditagih
                    </h3>


                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                            <!-- 1. Filter Kelas -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Target Kelas</label>
                                <!-- Tambahkan name="id_kelas" di sini agar ditangkap Controller -->
                                <select name="id_kelas" id="pilih_kelas" class="w-full bg-gray-50 border border-gray-200 text-gray-700 rounded-xl px-4 py-3 focus:bg-white focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition">
                                    <option value="semua">-- Semua Kelas (Satu Sekolah) --</option>
                                    @foreach($daftar_kelas as $kelas)
                                    <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- 2. Pilih Siswa -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Target Siswa</label>
                                <select name="id_user" id="pilih_siswa" class="w-full bg-gray-50 border border-gray-200 text-gray-700 rounded-xl px-4 py-3 focus:bg-white focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition" required>
                                    <option value="semua" class="font-bold text-orange-600">-- Tagih Semua Siswa --</option>
                                    @foreach($daftar_siswa as $siswa)
                                    <option value="{{ $siswa->id_user }}" data-kelas="{{ $siswa->id_kelas }}">
                                        {{ $siswa->nama_lengkap }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                    <div class="mb-8">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Pesan Tagihan</label>
                        <textarea name="keterangan" rows="4" placeholder="Contoh: Halo! Mohon segera lunasi kas kelas untuk bulan Agustus ya, terima kasih!" class="w-full bg-gray-50 border border-gray-200 text-gray-700 rounded-xl px-4 py-3 focus:bg-white focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition resize-none" required></textarea>
                    </div>

                    <div class="flex items-center justify-end space-x-4 pt-4">
                        <button type="reset" class="px-6 py-3 text-gray-500 hover:text-gray-800 font-semibold rounded-xl hover:bg-gray-100 transition">
                            Reset
                        </button>
                        <button type="submit" class="px-8 py-3 bg-orange-600 hover:bg-orange-700 text-white font-bold rounded-xl shadow-md shadow-orange-200 transition-all duration-200 transform hover:-translate-y-1">
                            Kirim Tagihan
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

<!-- Script Otomasi Filter -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const kelasSelect = document.getElementById('pilih_kelas');
        const siswaSelect = document.getElementById('pilih_siswa');
        const siswaOptions = siswaSelect.querySelectorAll('option');

        kelasSelect.addEventListener('change', function() {
            const selectedKelas = this.value;
            
            // Otomatis kembalikan pilihan siswa ke "Tagih Semua" tiap kali kelas diganti
            siswaSelect.value = "semua";

            siswaOptions.forEach(option => {
                // Opsi "Tagih Semua Siswa" tidak boleh disembunyikan
                if (option.value === "semua") {
                    option.hidden = false;
                    return;
                }

                // Tampilkan siswa sesuai kelas, atau tampilkan semua jika "Semua Kelas" dipilih
                const kelasSiswa = option.getAttribute('data-kelas');
                if (selectedKelas === "semua" || selectedKelas === "" || kelasSiswa === selectedKelas) {
                    option.hidden = false;
                } else {
                    option.hidden = true;
                }
            });
        });
    });
</script>
@endsection