<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Rekapitulasi Kas</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brand-rose': '#E57C70',
                        'brand-nude': '#F6E6E4',
                        'brand-cream': '#FDFBF9',
                        'brand-slate': '#1A2130',
                        'brand-grey': '#5A6578',
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #FDFBF9;
            color: #5A6578;
            letter-spacing: -0.2px;
        }

        .glass-card {
            background: #FFFFFF;
            border: 1px solid #F1ECE8;
            border-radius: 24px;
            box-shadow: 0 16px 40px rgba(142, 127, 122, 0.04);
        }

        .input-premium {
            background: #FDFDFD;
            border: 1.5px solid #F1ECE8;
            transition: all 0.3s ease;
        }

        .input-premium:focus {
            background: #FFFFFF;
            border-color: #E57C70;
            box-shadow: 0 0 0 4px rgba(229, 124, 112, 0.12);
            outline: none;
        }
    </style>
</head>
<body class="flex min-h-screen justify-center items-center py-12 px-4 sm:px-6 lg:px-8">

    <!-- MAIN FORM CONTAINER -->
    <main class="w-full max-w-xl">
        
        <!-- BACK BUTTON TO LAPORAN -->
        <a href="{{ route('bendahara.laporan') }}" class="inline-flex items-center gap-2 text-xs font-bold text-[#5A6578] hover:text-[#E57C70] transition-all mb-6 group">
            <i class="bi bi-arrow-left text-sm transition-transform group-hover:-translate-x-1"></i>
            KEMBALI KE ANALYTICS & LAPORAN
        </a>

        <!-- FORM CARD -->
        <div class="glass-card p-8 sm:p-10 bg-white">
            
            <!-- HEADER PANEL -->
            <div class="flex items-center gap-4 mb-8 pb-6 border-b border-[#F1ECE8]">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center bg-[#FAF4F2] text-[#E57C70] border border-[#E57C70]/10 shadow-sm">
                    <i class="bi bi-pencil-square text-lg"></i>
                </div>
                <div>
                    <h2 class="text-xl font-extrabold text-[#1A2130] tracking-tight" style="letter-spacing: -0.5px;">Ubah Riwayat Kas</h2>
                    <p class="text-xs text-[#5A6578] mt-0.5">Modifikasi berkas pencatatan kas secara valid.</p>
                </div>
            </div>

            <!-- ACTION FORM -->
            <!-- Mengarah ke rute bendahara.update yang menggunakan metode PUT -->
            <form action="{{ route('bendahara.update', $transaksi->id_transaksi) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- 1. PILIHAN SISWA / KAS UMUM -->
                <div>
                    <label class="text-[10px] font-extrabold text-[#A0AEC0] uppercase tracking-widest mb-2.5 block px-1" style="letter-spacing: 0.5px;">Penanggung Jawab / Subjek</label>
                    <select name="id_user" class="input-premium w-full p-3.5 rounded-2xl text-xs font-bold text-[#1A2130]">
                        <option value="">Kas Umum (Internal Kelas)</option>
                        @foreach($daftar_siswa as $siswa)
                            <option value="{{ $siswa->id }}" {{ $transaksi->id_user == $siswa->id ? 'selected' : '' }}>
                                {{ $siswa->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- 2. JENIS TRANSAKSI (MASUK / KELUAR) -->
                <div>
                    <label class="text-[10px] font-extrabold text-[#A0AEC0] uppercase tracking-widest mb-2.5 block px-1" style="letter-spacing: 0.5px;">Jenis Arus Kas</label>
                    <select name="jenis" class="input-premium w-full p-3.5 rounded-2xl text-xs font-bold text-[#1A2130]" required>
                        <option value="Masuk" {{ $transaksi->jenis == 'Masuk' ? 'selected' : '' }}>Arus Masuk (+ Pemasukan)</option>
                        <option value="Keluar" {{ $transaksi->jenis == 'Keluar' ? 'selected' : '' }}>Arus Keluar (- Pengeluaran)</option>
                    </select>
                </div>

                <!-- 3. NOMINAL TRANSAKSI -->
                <div>
                    <label class="text-[10px] font-extrabold text-[#A0AEC0] uppercase tracking-widest mb-2.5 block px-1" style="letter-spacing: 0.5px;">Nominal (Rupiah)</label>
                    <div class="relative flex items-center">
                        <span class="absolute left-4 text-xs font-bold text-[#A0AEC0]">Rp</span>
                        <input type="number" name="nominal" value="{{ $transaksi->nominal }}" class="input-premium w-full p-3.5 pl-10 rounded-2xl text-xs font-bold text-[#1A2130]" placeholder="0" required>
                    </div>
                </div>

                <!-- 4. TANGGAL TRANSAKSI -->
                <div>
                    <label class="text-[10px] font-extrabold text-[#A0AEC0] uppercase tracking-widest mb-2.5 block px-1" style="letter-spacing: 0.5px;">Tanggal Pencatatan</label>
                    <input type="date" name="tanggal" value="{{ $transaksi->tanggal }}" class="input-premium w-full p-3.5 rounded-2xl text-xs font-bold text-[#1A2130]" required>
                </div>

                <!-- 5. KETERANGAN KOMODITAS -->
                <div>
                    <label class="text-[10px] font-extrabold text-[#A0AEC0] uppercase tracking-widest mb-2.5 block px-1" style="letter-spacing: 0.5px;">Keterangan Komoditas</label>
                    <textarea name="keterangan" rows="3" class="input-premium w-full p-4 rounded-2xl text-xs font-semibold text-[#1A2130]" placeholder="Tulis rincian atau alasan alokasi dana..." required>{{ $transaksi->keterangan }}</textarea>
                </div>

                <!-- ACTION BUTTON PANEL -->
                <div class="flex flex-col sm:flex-row items-center gap-3 pt-4 border-t border-[#F1ECE8]">
                    <button type="submit" class="w-full sm:flex-1 bg-gradient-to-br from-[#EA9389] to-[#E57C70] text-white py-4 rounded-2xl font-bold text-xs hover:opacity-95 transition-all shadow-md shadow-[#E57C70]/20">
                        SIMPAN PERUBAHAN
                    </button>
                    <a href="{{ route('bendahara.laporan') }}" class="w-full sm:w-auto bg-gray-50 text-center text-[#5A6578] border border-[#F1ECE8] px-6 py-4 rounded-2xl font-bold text-xs hover:bg-gray-100 transition-all">
                        BATAL
                    </a>
                </div>

            </form>
        </div>
    </main>

</body>
</html>