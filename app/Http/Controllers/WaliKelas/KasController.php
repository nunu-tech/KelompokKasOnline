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

        $kas = $query->latest()->get();

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
}
