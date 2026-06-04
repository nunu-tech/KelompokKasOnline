<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    public function index()
    {
        $pengeluaran = Pengeluaran::latest()->get();

        return view(
            'walikelas.pengeluaran.index',
            compact('pengeluaran')
        );
    }

    public function create()
    {
        return view('walikelas.pengeluaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
            'jumlah' => 'required|numeric',
            'keterangan' => 'required'
        ]);

        Pengeluaran::create([
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()
            ->route('walikelas.pengeluaran.index')
            ->with('success', 'Data pengeluaran berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);

        return view('walikelas.pengeluaran.edit', compact('pengeluaran'));
    }

    public function update(Request $request, $id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);

        $pengeluaran->update([
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('walikelas.pengeluaran.index')
            ->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);

        $pengeluaran->delete();

        return redirect()
            ->route('walikelas.pengeluaran.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
