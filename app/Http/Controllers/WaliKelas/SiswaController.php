<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
{
    $siswa = User::with('kelas', 'role')
        ->where('id_role', 3)
        ->get();

    return view('walikelas.siswa.index', compact('siswa'));
}

    
}