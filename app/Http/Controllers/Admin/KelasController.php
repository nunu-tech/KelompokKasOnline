<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\User;

class KelasController extends Controller
{
    // READ
    public function index(Request $request)
    {
        $query = Kelas::withCount([
            'users as total_anggota' => function ($q) {
                $q->whereIn('id_role', [2, 4]); // siswa + bendahara
            }
        ])->with('waliKelas');

        // Search nama kelas
        if ($request->filled('search')) {
            $query->where('nama_kelas', 'like', '%' . $request->search . '%');
        }

        // Filter tingkat
        if ($request->filled('tingkat')) {
            $query->where('nama_kelas', 'like', $request->tingkat . ' %');
        }

        // Filter jurusan
        if ($request->filled('jurusan')) {
            $query->where('nama_kelas', 'like', '%' . $request->jurusan . '%');
        }

        $data_kelas = $query
            ->orderBy('nama_kelas', 'asc')
            ->get();

        // Statistik mengikuti hasil filter
        $totalKelas = $data_kelas->count();

        $totalSiswa = $data_kelas->sum('total_anggota');

        $totalBendahara = User::whereIn(
            'id_kelas',
            $data_kelas->pluck('id')
        )->where('id_role', 4)->count();

        $totalWaliKelas = $data_kelas
            ->filter(fn($kelas) => $kelas->waliKelas)
            ->count();

        return view('admin.DataKelas.tampilkelas', compact(
            'data_kelas',
            'totalKelas',
            'totalSiswa',
            'totalBendahara',
            'totalWaliKelas'
        ));
    }
    // CREATE FORM
    public function create()
    {
        return view('admin.DataKelas.tambahkelas');
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|unique:kelas,nama_kelas'
        ], [
            'nama_kelas.unique' => 'Nama kelas sudah ada.'
        ]);

        Kelas::create([
            'nama_kelas' => $request->nama_kelas
        ]);

        return redirect()
            ->route('admin.kelas.index')
            ->with('success', 'Kelas berhasil ditambahkan.');
    }

    // EDIT FORM
    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('admin.DataKelas.editkelas', compact('kelas'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        $request->validate([
            'nama_kelas' => 'required|unique:kelas,nama_kelas,' . $id
        ], [
            'nama_kelas.unique' => 'Nama kelas sudah digunakan.'
        ]);

        $kelas->update([
            'nama_kelas' => $request->nama_kelas
        ]);

        return redirect()
            ->route('admin.kelas.index')
            ->with('success', 'Kelas berhasil diperbarui.');
    }

    // DELETE
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);

        // cek apakah masih ada user di kelas ini
        if ($kelas->users()->count() > 0) {
            return redirect()
                ->back()
                ->with('error', 'Kelas tidak dapat dihapus karena masih memiliki anggota.');
        }

        $kelas->delete();

        return redirect()
            ->route('admin.kelas.index')
            ->with('success', 'Data kelas berhasil dihapus.');
    }
}
