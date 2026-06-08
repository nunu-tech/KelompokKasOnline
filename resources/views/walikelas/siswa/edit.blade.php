@extends('waliKelas.layouts.app')

@section('content')

<div class="bg-white p-8 rounded-[24px] border border-gray-100 shadow-sm">

    <div class="mb-6">

        <h2 class="text-2xl font-bold font-poppins text-darkJet">
            Edit Data Siswa
        </h2>

        <p class="text-sm text-gray-400 mt-1">
            Perbarui data siswa
        </p>

    </div>

    <form action="{{ route('walikelas.siswa.update', $siswa->id) }}"
          method="POST">

        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>
                <label class="text-sm font-medium text-darkJet">
                    Nama Siswa
                </label>

                <input type="text"
                       name="nama"
                       value="{{ $siswa->nama }}"
                       class="w-full mt-2 border border-gray-200 rounded-2xl p-3">
            </div>

            <div>
                <label class="text-sm font-medium text-darkJet">
                    Kelas
                </label>

                <input type="text"
                       name="kelas"
                       value="{{ $siswa->kelas }}"
                       class="w-full mt-2 border border-gray-200 rounded-2xl p-3">
            </div>

            <div>
                <label class="text-sm font-medium text-darkJet">
                    Jenis Kelamin
                </label>

                <select name="jenis_kelamin"
                        class="w-full mt-2 border border-gray-200 rounded-2xl p-3">

                    <option value="Laki-laki"
                        {{ $siswa->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>
                        Laki-laki
                    </option>

                    <option value="Perempuan"
                        {{ $siswa->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                        Perempuan
                    </option>

                </select>
            </div>
        </div>

        <div class="mt-8 flex gap-3">

            <button type="submit"
                    class="px-5 py-3 bg-darkJet text-white rounded-2xl hover:bg-luxuryGold hover:text-darkJet transition-all">

                Update

            </button>

            <a href="{{ route('walikelas.siswa.index') }}"
               class="px-5 py-3 border border-gray-200 rounded-2xl">

                Kembali

            </a>

        </div>

    </form>

</div>

@endsection