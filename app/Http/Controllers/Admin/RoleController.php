<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    // 1. TAMPILAN INDEX
    public function index()
    {
        // Mengambil semua role beserta jumlah usernya
        $roles = Role::withCount('users')->get();
        return view('admin.DataRole.tampilrole', compact('roles'));
    }

    // TAMPILAN FORM TAMBAH
    public function create()
    {
        // Sesuaikan 'admin.DataRole.tambahrole' dengan lokasi folder file blade kamu
        return view('admin.DataRole.tambahrole');
    }
    // 2. PROSES TAMBAH (Hanya Nama)
    public function store(Request $request)
    {
        // Validasi: Nama wajib diisi dan tidak boleh sama (unique) di tabel roles
        $request->validate([
            'nama_role' => 'required|unique:roles,nama_role'
        ], [
            'nama_role.unique' => 'Gagal! Nama role ini sudah ada, silakan gunakan nama lain.',
            'nama_role.required' => 'Nama role wajib diisi!'
        ]);

        Role::create([
            'nama_role' => $request->nama_role
        ]);

        return redirect()->route('admin.peran.index')->with('success', 'Role baru berhasil ditambahkan!');
    }

    // 3. PROSES EDIT (Hanya Nama)
    // TAMPILAN FORM EDIT
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        // Sesuaikan 'admin.DataRole.editrole' dengan lokasi folder file blade kamu
        return view('admin.DataRole.editrole', compact('role'));
    }

    public function update(Request $request, $id)
    {
        // Validasi: Nama tidak boleh sama dengan role lain, TAPI boleh sama dengan namanya sendiri (biar bisa di-save kalau gak diganti)
        $request->validate([
            'nama_role' => 'required|unique:roles,nama_role,' . $id
        ], [
            'nama_role.unique' => 'Gagal! Nama role ini sudah dipakai oleh role lain.',
            'nama_role.required' => 'Nama role wajib diisi!'
        ]);

        $role = Role::findOrFail($id);
        $role->update([
            'nama_role' => $request->nama_role
        ]);

        return redirect()->route('admin.peran.index')->with('success', 'Nama Role berhasil diperbarui!');
    }

    // 4. PROSES HAPUS
    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        // VALIDASI: Cek apakah masih ada user di role ini?
        if ($role->users()->count() > 0) {
            return redirect()->route('admin.peran.index')
                ->with('error', 'Data ditolak! Role tidak bisa dihapus karena masih ada ' . $role->users()->count() . ' user yang menggunakannya.');
        }

        $role->delete();

        return redirect()->route('admin.peran.index')->with('success', 'Role berhasil dihapus!');
    }
}
