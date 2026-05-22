<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Memanggil Model User
use Illuminate\Support\Facades\Hash; // Digunakan untuk enkripsi password

class UserController extends Controller
{
    /**
     * 1. READ: Menampilkan semua data user di halaman utama admin
     */
    public function index()
    {
        // Mengambil semua data user, diurutkan berdasarkan role terkecil (admin dulu) 
        // lalu berdasarkan abjad nama_lengkap
        $data_user = User::orderBy('id_role', 'asc')
                         ->orderBy('nama_lengkap', 'asc')
                         ->get();

        // Mengarahkan ke file view: resources/views/admin/DataUser/tampiluser.blade.php
        return view('admin.DataUser.tampiluser', compact('data_user'));
    }

    /**
     * 2. CREATE (Tampilan): Menampilkan form untuk tambah user baru
     */
    public function create()
    {
        // Mengarahkan ke file view: resources/views/admin/user_create.blade.php
        return view('admin.user_create');
    }

    /**
     * 3. CREATE (Proses): Menyimpan data user baru ke database
     */
    public function store(Request $request)
    {
        // Validasi input data dari form agar sesuai aturan database
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'username'     => 'required|string|max:255|unique:users,username',
            'email'        => 'required|string|email|max:255|unique:users,email',
            'password'     => 'required|string|min:6',
            'id_role'      => 'required|integer',
            'id_kelas'     => 'nullable|integer',
        ]);

        // Proses simpan ke database
        User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'username'     => $request->username,
            'email'        => $request->email,
            'password'     => Hash::make($request->password), // Password wajib di-hash/enkripsi
            'id_role'      => $request->id_role,
            'id_kelas'     => $request->id_kelas,
        ]);

        // Kembali ke halaman utama dengan pesan sukses
        return redirect()->route('admin.user')->with('sukses', 'Data user berhasil ditambahkan!');
    }

    /**
     * 4. UPDATE (Tampilan): Menampilkan form edit dengan data lama user tersebut
     */
    public function edit($id_user)
    {
        // Mencari data user berdasarkan primary key (id_user)
        // Jika data tidak ditemukan, otomatis memunculkan error 404
        $user = User::findOrFail($id_user);

        // Mengarahkan ke file view: resources/views/admin/user_edit.blade.php
        return view('admin.user_edit', compact('user'));
    }

    /**
     * 5. UPDATE (Proses): Menyimpan perubahan data user ke database
     */
    public function update(Request $request, $id_user)
    {
        $user = User::findOrFail($id_user);

        // Validasi data (untuk username & email, abaikan validasi unik untuk data milik user ini sendiri)
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'username'     => 'required|string|max:255|unique:users,username,' . $user->id_user . ',id_user',
            'email'        => 'required|string|email|max:255|unique:users,email,' . $user->id_user . ',id_user',
            'id_role'      => 'required|integer',
            'id_kelas'     => 'nullable|integer',
        ]);

        // Siapkan data yang akan diupdate
        $dataUpdate = [
            'nama_lengkap' => $request->nama_lengkap,
            'username'     => $request->username,
            'email'        => $request->email,
            'id_role'      => $request->id_role,
            'id_kelas'     => $request->id_kelas,
        ];

        // Jika kolom password di form diisi, artinya user ingin mengganti password
        if ($request->filled('password')) {
            $request->validate(['password' => 'string|min:6']);
            $dataUpdate['password'] = Hash::make($request->password);
        }

        // Jalankan perintah update
        $user->update($dataUpdate);

        return redirect()->route('admin.user')->with('sukses', 'Data user berhasil diperbarui!');
    }

    /**
     * 6. DELETE: Menghapus user dari database
     */
    public function destroy($id_user)
    {
        $user = User::findOrFail($id_user);
        $user->delete(); // Jalankan fungsi hapus

        return redirect()->route('admin.user')->with('sukses', 'Data user berhasil dihapus!');
    }
}