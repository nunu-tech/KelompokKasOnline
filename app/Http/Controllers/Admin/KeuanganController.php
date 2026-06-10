<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Tagihan;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class KeuanganController extends Controller
{

    public function index(Request $request)
    {
        // Fitur Pengaman otomatis (tetap dipertahankan)
        if (!Auth::check()) {
            $user_tersedia = User::first();
            if ($user_tersedia) {
                Auth::loginUsingId($user_tersedia->id_user);
            }
        }

        // 1. Siapkan daftar kelas untuk ditampilkan di pilihan (dropdown)
        $daftar_kelas = Kelas::all();

        // 2. Tangkap id_kelas yang dipilih admin dari URL (contoh: ?kelas=1)
        $kelas_dipilih = $request->get('kelas');

        // 3. Bangun Query Dasar
        // Jika tidak ada kelas yang dipilih, tampilkan semua. 
        // Jika ada, saring (filter) berdasarkan id_kelas.
        $query_transaksi = Transaksi::with('user');
        $query_masuk = Transaksi::where('jenis', 'Masuk');
        $query_keluar = Transaksi::where('jenis', 'Keluar');

        if ($kelas_dipilih) {
            // Logika whereHas: Cari di tabel transaksi yang 'user'-nya punya id_kelas yang dipilih
            $query_transaksi->whereHas('user', function ($q) use ($kelas_dipilih) {
                $q->where('id_kelas', $kelas_dipilih);
            });

            $query_masuk->whereHas('user', function ($q) use ($kelas_dipilih) {
                $q->where('id_kelas', $kelas_dipilih);
            });

            $query_keluar->whereHas('user', function ($q) use ($kelas_dipilih) {
                $q->where('id_kelas', $kelas_dipilih);
            });
        }

        // 4. Eksekusi Query
        $semua_transaksi = $query_transaksi->latest()->get();
        $total_masuk = $query_masuk->sum('nominal');
        $total_keluar = $query_keluar->sum('nominal');
        $saldo_akhir = $total_masuk - $total_keluar;

        $daftar_siswa = User::all();

        return view('admin.keuangan.index', compact(
            'semua_transaksi',
            'saldo_akhir',
            'daftar_siswa',
            'total_masuk',
            'total_keluar',
            'daftar_kelas', // Kirim data kelas ke View
            'kelas_dipilih' // Kirim data kelas yang sedang aktif ke View
        ));
    }

    public function siswa()
    {
        if (!Auth::check()) {
            $user_tersedia = User::first();
            if ($user_tersedia) {
                Auth::loginUsingId($user_tersedia->id_user);
            } // <--- DIUBAH: id menjadi id_user
        }

        $daftar_siswa = User::withSum(['transaksi as total_bayar' => function ($query) {
            $query->where('jenis', 'Masuk');
        }], 'nominal')->get();

        $siswa_terajin = $daftar_siswa->sortByDesc('total_bayar')->first();

        // --- Tambahan Logika Rasio Kontribusi Otomatis ---
        $total_siswa = $daftar_siswa->count();
        $siswa_aktif = $daftar_siswa->where('total_bayar', '>', 0)->count();
        $rasio_kontribusi = $total_siswa > 0 ? round(($siswa_aktif / $total_siswa) * 100) : 0;
        // -------------------------------------------------

        return view('admin.Keuangan.siswa', compact('daftar_siswa', 'siswa_terajin', 'rasio_kontribusi'));
    }

    /**
     * Menampilkan form untuk membuat tagihan kas
     */
    public function tagihan()
    {
        // Ambil data untuk pilihan dropdown
        $daftar_kelas = \App\Models\Kelas::all();
        $daftar_siswa = \App\Models\User::all();

        return view('admin.keuangan.tagihan', compact('daftar_kelas', 'daftar_siswa'));
    }

    public function kirimTagihan(Request $request)
    {
        // 1. Validasi Input (id_user sekarang tidak dicek dari tabel, karena bisa berisi kata 'semua')
        $request->validate([
            'id_kelas' => 'nullable', // Ditangkap dari dropdown kelas
            'id_user' => 'required',  // Ditangkap dari dropdown siswa
            'nominal' => 'required|numeric',
            'keterangan' => 'required',
            'jatuh_tempo' => 'required|date'
        ]);

        $id_kelas = $request->id_kelas;
        $id_user = $request->id_user;

        // 2. Siapkan wadah kosong untuk menampung target siswa
        $target_siswa = [];

        // 3. Logika 3 Skenario Tagihan
        if ($id_user === 'semua') {
            if ($id_kelas === 'semua' || empty($id_kelas)) {
                // SKENARIO A: Tagih Semua Kelas (Satu Sekolah / Semua User)
                $target_siswa = \App\Models\User::all();
            } else {
                // SKENARIO B: Tagih Semua Siswa di SATU KELAS tertentu
                $target_siswa = \App\Models\User::where('id_kelas', $id_kelas)->get();
            }
        } else {
            // SKENARIO C: Tagih SATU SISWA spesifik (Misal untuk denda)
            $target_siswa = \App\Models\User::where('id_user', $id_user)->get();
        }

        // 4. Pencegahan jika targetnya kosong
        if ($target_siswa->isEmpty()) {
            return redirect()->back()->withErrors(['Tidak ada siswa yang ditemukan untuk dikirimkan tagihan.']);
        }

        // 5. Eksekusi Kirim Massal (Looping)
        foreach ($target_siswa as $siswa) {
            Tagihan::create([
                'id_user' => $siswa->id_user, // Target spesifik per anak
                'nominal' => $request->nominal,
                'keterangan' => $request->keterangan,
                'jatuh_tempo' => $request->jatuh_tempo,
                'status' => 'Belum Bayar'
            ]);
        }

        // Kembali dengan pesan sukses plus jumlah siswa yang berhasil ditagih
        return redirect()->back()->with('sukses', 'Mantap! Tagihan berhasil dikirim ke ' . $target_siswa->count() . ' siswa sekaligus.');
    }

   /**
     * Menampilkan semua daftar tagihan kas siswa (Dengan Filter & Pagination)
     */
    public function daftarTagihan(Request $request)
    {
        // 1. Tangkap kata kunci dari form filter
        $search = $request->get('search');
        $status = $request->get('status');

        // 2. Siapkan query dasar
        $query = Tagihan::with('user.kelas');

        // 3. Jika ada input pencarian (Bisa cari Nama Siswa ATAU Nama Kelas)
        if ($search) {
            $query->where(function ($q) use ($search) {
                // Skenario 1: Cari berdasarkan Nama Siswa
                $q->whereHas('user', function ($qUser) use ($search) {
                    $qUser->where('nama_lengkap', 'like', '%' . $search . '%');
                })
                // Skenario 2: ATAU Cari berdasarkan Nama Kelas
                ->orWhereHas('user.kelas', function ($qKelas) use ($search) {
                    $qKelas->where('nama_kelas', 'like', '%' . $search . '%');
                });
            });
        }

        // 4. Jika ada pilihan status, saring datanya
        if ($status) {
            $query->where('status', $status);
        }

        // 5. Eksekusi query dengan Pagination (10 baris per halaman)
        // withQueryString() sangat penting agar filter tidak hilang saat klik "Next Page"
        $semua_tagihan = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        return view('admin.keuangan.daftar_tagihan', compact('semua_tagihan'));
    }

    /**
     * Menampilkan halaman form tambah transaksi
     */
    public function create()
    {
        // Fitur Pengaman otomatis
        if (!Auth::check()) {
            $user_tersedia = User::first();
            if ($user_tersedia) {
                Auth::loginUsingId($user_tersedia->id_user);
            }
        }

        // Ambil data Kelas dan Siswa
        $daftar_kelas = \App\Models\Kelas::all();
        $daftar_siswa = User::all();

        // Kirim keduanya ke view
        return view('admin.keuangan.create', compact('daftar_siswa', 'daftar_kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'nullable|exists:users,id_user', // <--- DIUBAH: id menjadi id_user sesuai database kelompok
            'nominal' => 'required|numeric',
            'jenis' => 'required',
            'keterangan' => 'required',
            'tanggal' => 'required|date',
        ]);

        // Ambil ID user pertama yang ada di tabel sebagai cadangan jika tidak ada session login
        $user_default = User::first()->id_user ?? null; // <--- DIUBAH: id menjadi id_user

        // Ambil ID dari bendahara yang sedang login dengan cara yang aman untuk custom primary key
        $id_bendahara_login = auth()->user() ? auth()->user()->id_user : null;

        Transaksi::create([
            'id_bendahara' => $id_bendahara_login ?? $user_default, // <--- Sudah diperbaiki secara dinamis agar tidak gagal Foreign Key
            'id_user' => $request->id_user,
            'jenis' => $request->jenis,
            'nominal' => $request->nominal,
            'keterangan' => $request->keterangan,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->back()->with('sukses', 'Data kas berhasil dicatat!');
    }


    
    /**
     * Fitur Laporan / Buku Induk Kas
     */
    public function laporan(Request $request)
    {
        // 1. Fitur Pengaman otomatis
        if (!Auth::check()) {
            $user_tersedia = User::first();
            if ($user_tersedia) {
                Auth::loginUsingId($user_tersedia->id_user);
            }
        }

        // 2. Tangkap parameter filter dari Request (Bulan, Tahun, dan Kelas)
        $bulan = $request->get('bulan', date('m')); // Default: Bulan ini
        $tahun = $request->get('tahun', date('Y')); // Default: Tahun ini
        $kelas_dipilih = $request->get('kelas');    // Filter kelas

        // 3. Bangun Query Dasar
        $query = Transaksi::with('user')
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun);

        // 4. Jika Admin memilih kelas tertentu, saring datanya!
        if ($kelas_dipilih) {
            $query->whereHas('user', function ($q) use ($kelas_dipilih) {
                $q->where('id_kelas', $kelas_dipilih);
            });
        }

        // 5. Eksekusi Query dan Urutkan dari tanggal paling tua ke muda (asc)
        $laporan = $query->orderBy('tanggal', 'asc')->get();

        // 6. Hitung ringkasan berdasarkan data yang sudah difilter
        $total_masuk = $laporan->where('jenis', 'Masuk')->sum('nominal');
        $total_keluar = $laporan->where('jenis', 'Keluar')->sum('nominal');
        $saldo_periode = $total_masuk - $total_keluar;

        // 7. Ambil daftar kelas untuk ditampilkan di dropdown form
        $daftar_kelas = Kelas::all();

        // Pastikan nama view menggunakan huruf kecil (keuangan)
        return view('admin.keuangan.laporan', compact(
            'laporan',
            'total_masuk',
            'total_keluar',
            'saldo_periode',
            'bulan',
            'tahun',
            'daftar_kelas',
            'kelas_dipilih'
        ));
    }
    

    

    

    /**
     * 4. HALAMAN ANTREAM VERIFIKASI SETORAN KAS (BARU)
     * Menampilkan data setoran masuk dari siswa yang statusnya masih 'Pending'
     */
    public function verifikasi()
    {
        if (!Auth::check()) {
            $user_tersedia = User::first();
            if ($user_tersedia) {
                Auth::loginUsingId($user_tersedia->id_user);
            } // <--- DIUBAH: id menjadi id_user
        }

        // Mengambil kiriman kas yang masih tertahan (Pending)
        $antrean = Transaksi::with('user')->where('status', 'Pending')->latest()->get();

        return view('admin.Keuangan.verifikasi', compact('antrean'));
    }

    /**
     * 5. AKSI MENYETUJUI SETORAN KAS (BARU)
     * Mengubah status menjadi 'Disetujui' agar masuk hitungan keuangan resmi
     */
    public function setujui($id_transaksi)
    {
        $transaksi = Transaksi::findOrFail($id_transaksi);
        $transaksi->update(['status' => 'Disetujui']);

        return redirect()->back()->with('sukses', 'Status pembayaran kas berhasil diverifikasi dan disetujui!');
    }

    /**
     * 6. AKSI MENOLAK SETORAN KAS (BARU)
     * Mengubah status menjadi 'Ditolak' jika bukti tidak valid
     */
    public function tolak($id_transaksi)
    {
        $transaksi = Transaksi::findOrFail($id_transaksi);
        $transaksi->update(['status' => 'Ditolak']);

        return redirect()->back()->with('sukses', 'Status pembayaran kas berhasil ditolak.');
    }

}
