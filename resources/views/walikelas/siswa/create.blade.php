@extends('waliKelas.layouts.app')

@section('content')

<div class="bg-white p-8 rounded-3xl shadow-sm">

    <h2 class="text-2xl font-bold mb-6">
        Tambah Siswa
    </h2>

    <form action="{{ route('siswa.store') }}" method="POST">

        @csrf

        <div class="grid grid-cols-2 gap-6">

            <div>
                <label>Nama</label>

                <input type="text"
                       name="nama"
                       class="w-full mt-2 border rounded-xl p-3">
            </div>

            <div>
                <label>NIS</label>

                <input type="text"
                       name="nis"
                       class="w-full mt-2 border rounded-xl p-3">
            </div>

            <div>
                <label>Kelas</label>

                <input type="text"
                       name="kelas"
                       class="w-full mt-2 border rounded-xl p-3">
            </div>

            <div>
                <label>Jenis Kelamin</label>

                <select name="jenis_kelamin"
                        class="w-full mt-2 border rounded-xl p-3">

                    <option>Laki-laki</option>
                    <option>Perempuan</option>

                </select>
            </div>

            <div class="col-span-2">
                <label>No HP</label>

                <input type="text"
                       name="no_hp"
                       class="w-full mt-2 border rounded-xl p-3">
            </div>

        </div>

        <button class="mt-6 px-5 py-3 bg-darkJet text-white rounded-xl">
            Simpan
        </button>

    </form>

</div>

@endsection