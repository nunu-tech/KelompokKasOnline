<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use App\Models\Kas;
use App\Models\Siswa;
use Illuminate\Http\Request;


class KasController extends Controller
{
    public function index(Request $request)
    {
        $query = Kas::with('siswa');

        // FILTER STATUS
        if ($request->status == 'lunas') {
            $query->where('status', 'lunas');
        } elseif ($request->status == 'belum') {
            $query->where('status', 'belum');
        }

        // SEARCH
        if ($request->search) {
            $query->whereHas('siswa', function ($q) use ($request) {
                $q->where('nama', 'like', '%'.$request->search.'%');
            });
        }

        $kas = $query->latest()->paginate(10);

        $totalKas = Kas::where('status', 'lunas')->sum('jumlah');
        $sudahBayar = Kas::where('status', 'lunas')->count();
        $belumBayar = Siswa::count() - $sudahBayar;

        return view('walikelas.kas.index', compact(
            'kas',
            'totalKas',
            'sudahBayar',
            'belumBayar'
        ));
    }

    public function create()
{
    return view('walikelas.kas.create');
}

public function store(Request $request)
{
    $request->validate([
        'jumlah' => 'required|numeric',
        'tanggal' => 'required|date',
    ]);

    Kas::create([
        'jumlah' => $request->jumlah,
        'tanggal' => $request->tanggal,
        'status' => 'lunas',
    ]);

    return redirect()->route('walikelas.kas.index')
        ->with('success', 'Data kas berhasil ditambahkan');
}
}
