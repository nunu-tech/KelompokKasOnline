<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Role;
use Illuminate\Support\Facades\Hash; // Digunakan untuk enkripsi password
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * 1. READ: Menampilkan semua data user di halaman utama admin
     */
    public function index(Request $request)
    {
        $query = User::with(['kelas', 'role']);

        // Search nama, username, email
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter Role
        if ($request->filled('role')) {
            $query->where('id_role', $request->role);
        }

        // Filter Tingkat
        if ($request->filled('tingkat')) {
            $query->whereHas('kelas', function ($q) use ($request) {
                $q->where('nama_kelas', 'like', $request->tingkat . ' %');
            });
        }

        // Filter Jurusan
        if ($request->filled('jurusan')) {
            $query->whereHas('kelas', function ($q) use ($request) {
                $q->where('nama_kelas', 'like', '%' . $request->jurusan . '%');
            });
        }

        // Statistik mengikuti filter aktif
        $totalUser = (clone $query)->count();

        $totalAdmin = (clone $query)
            ->where('id_role', 1)
            ->count();

        $totalSiswa = (clone $query)
            ->where('id_role', 3)
            ->count();

        $totalWaliKelas = (clone $query)
            ->where('id_role', 4)
            ->count();

        $totalBendahara = (clone $query)
            ->where('id_role', 2)
            ->count();

        // Data tabel
        $data_user = $query
            ->orderBy('id_role')
            ->orderBy('nama_lengkap')
            ->paginate(10)
            ->withQueryString();

        return view('admin.DataUser.tampiluser', compact(
            'data_user',
            'totalUser',
            'totalAdmin',
            'totalSiswa',
            'totalWaliKelas',
            'totalBendahara'
        ));
    }

    /**
     * 2. CREATE (Tampilan): Menampilkan form untuk tambah user baru
     */
    public function create()
    {
        $roles = Role::all();
        $kelas = Kelas::all();

        return view('admin.DataUser.tambahuser', compact('roles', 'kelas'));
    }

    /**
     * 3. CREATE (Proses): Menyimpan data user baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'username'     => 'required|string|max:255|unique:users,username',
            'kelamin'      => 'required|string|in:Laki-laki,Perempuan',
            'email'        => 'required|string|email|max:255|unique:users,email',
            'password'     => 'required|string|min:6',
            'id_role'      => 'required|integer',
            'id_kelas'     => 'required|integer',
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'username.required'     => 'Username wajib diisi.',
            'username.unique'       => 'Username sudah digunakan.',
            'email.required'        => 'Email wajib diisi.',
            'email.email'           => 'Format email tidak valid.',
            'email.unique'          => 'Email sudah digunakan.',
            'password.required'     => 'Password wajib diisi.',
            'password.min'          => 'Password minimal 6 karakter.',
            'kelamin.required'      => 'Jenis kelamin wajib dipilih.',
            'id_role.required'      => 'Role wajib dipilih.',
            'id_kelas.required'      => 'Kelas wajib dipilih.',
        ]);

        User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'username'     => $request->username,
            'kelamin'      => $request->kelamin,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'id_role'      => $request->id_role,
            'id_kelas'     => $request->id_kelas,
        ]);

        return redirect()
            ->route('admin.user.tampiluser')
            ->with('sukses', 'Data user berhasil ditambahkan!');
    }

    /**
     * 4. UPDATE (Tampilan): Menampilkan form edit dengan data lama user tersebut
     */
    public function edit($id_user)
    {
        // Mencari data user berdasarkan primary key (id_user)
        // Jika data tidak ditemukan, otomatis memunculkan error 404
        $user = User::findOrFail($id_user);

        return view('admin.DataUser.edituser', [
            'user' => $user,
            'roles' => Role::all(),
            'kelas' => Kelas::all()
        ]);
    }

    /**
     * 5. UPDATE (Proses): Menyimpan perubahan data user ke database
     */
    public function update(Request $request, $id_user)
    {
        $user = User::findOrFail($id_user);

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'username'     => 'required|string|max:255|unique:users,username,' . $user->id_user . ',id_user',
            'email'        => 'required|string|email|max:255|unique:users,email,' . $user->id_user . ',id_user',
            'id_role'      => 'required|integer',
            'id_kelas'     => 'nullable|integer',
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'username.required'     => 'Username wajib diisi.',
            'username.unique'       => 'Username sudah digunakan.',
            'email.required'        => 'Email wajib diisi.',
            'email.email'           => 'Format email tidak valid.',
            'email.unique'          => 'Email sudah digunakan.',
            'id_role.required'      => 'Role wajib dipilih.',
            'id_kelas.integer'      => 'Kelas tidak valid.',
        ]);

        $dataUpdate = [
            'nama_lengkap' => $request->nama_lengkap,
            'username'     => $request->username,
            'email'        => $request->email,
            'id_role'      => $request->id_role,
            'id_kelas'     => $request->id_kelas,
        ];

        if ($request->filled('password')) {

            $request->validate([
                'password' => 'min:8|confirmed'
            ], [
                'password.min' => 'Password minimal 8 karakter.',
                'password.confirmed' => 'Konfirmasi password tidak sesuai.',
            ]);

            $dataUpdate['password'] = Hash::make($request->password);
        }

        $user->update($dataUpdate);

        return redirect()
            ->route('admin.user.tampiluser')
            ->with('sukses', 'Data user berhasil diperbarui!');
    }

    /**
     * 6. DELETE: Menghapus user dari database
     */
    public function destroy($id_user)
    {
        // // Cek apakah admin mencoba menghapus dirinya sendiri
        // if (Auth::user()->id_user == $id_user) {
        //     return redirect()
        //         ->route('admin.user.tampiluser')
        //         ->with('gagal', 'Anda tidak dapat menghapus akun yang sedang digunakan.');
        // }

        $user = User::findOrFail($id_user);
        $user->delete();

        return redirect()
            ->route('admin.user.tampiluser')
            ->with('sukses', 'Data user berhasil dihapus!');
    }
}
