@extends('admin.app')

@section('title', 'Data Kelas')

@section('content')
<div class="p-6">

    <main class="flex-1 overflow-y-auto p-8 md:p-10">

        <!-- HEADER -->
        <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">

            <div>
                <h2 class="text-3xl font-bold tracking-tight text-slate-900">
                    Data Kelas
                </h2>
                <p class="text-slate-500 mt-1">
                    Kelola data kelas untuk sistem kas.
                </p>
            </div>

            <a href="{{ route('admin.kelas.create') }}"
                class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl font-medium shadow-lg shadow-indigo-200 transition">

                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>

                Tambah Kelas
            </a>

        </header>

        <!-- STATISTIK KELAS -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-6">

            <!-- Total Kelas -->
            <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-500 text-sm">Total Kelas</p>
                        <h3 class="text-3xl font-bold text-slate-800">
                            {{ $totalKelas }}
                        </h3>
                    </div>
                </div>
            </div>

            <!-- Total Siswa -->
            <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-500 text-sm">Total Siswa</p>
                        <h3 class="text-3xl font-bold text-slate-800">
                            {{ $totalSiswa }}
                        </h3>
                    </div>
                </div>
            </div>

            <!-- Total Bendahara -->
            <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-500 text-sm">Total Bendahara</p>
                        <h3 class="text-3xl font-bold text-slate-800">
                            {{ $totalBendahara }}
                        </h3>
                    </div>
                </div>
            </div>

            <!-- Total Wali Kelas -->
            <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-500 text-sm">Wali Kelas</p>
                        <h3 class="text-3xl font-bold text-slate-800">
                            {{ $totalWaliKelas }}
                        </h3>
                    </div>
                </div>
            </div>

        </div>
        <div class="bg-white rounded-2xl border border-slate-200 p-4 mb-6">

            <form method="GET"
                class="flex flex-col lg:flex-row gap-3 items-stretch lg:items-center">

                <!-- Search -->
                <div class="relative flex-1">

                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <svg class="w-5 h-5 text-slate-400"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari nama kelas..."
                        class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!-- Tingkat -->
                <select name="tingkat"
                    class="px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl">

                    <option value="">Semua Tingkat</option>
                    <option value="X" {{ request('tingkat') == 'X' ? 'selected' : '' }}>X</option>
                    <option value="XI" {{ request('tingkat') == 'XI' ? 'selected' : '' }}>XI</option>
                    <option value="XII" {{ request('tingkat') == 'XII' ? 'selected' : '' }}>XII</option>

                </select>

                <!-- Jurusan -->
                <select name="jurusan"
                    class="px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl">

                    <option value="">Semua Jurusan</option>
                    <option value="RPL" {{ request('jurusan') == 'RPL' ? 'selected' : '' }}>RPL</option>
                    <option value="TKJ" {{ request('jurusan') == 'TKJ' ? 'selected' : '' }}>TKJ</option>
                    <option value="AKL" {{ request('jurusan') == 'AKL' ? 'selected' : '' }}>AKL</option>

                </select>

                <!-- Submit -->
                <button type="submit"
                    class="px-5 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-medium transition">
                    Terapkan
                </button>

                <!-- Reset -->
                <a href="{{ route('admin.kelas.index') }}"
                    class="px-5 py-3 border border-slate-200 rounded-xl hover:bg-slate-50 text-center transition">
                    Reset
                </a>

            </form>

        </div>
        <!-- TABLE CARD -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">


            <div class="overflow-x-auto">



                <table class="w-full text-left">

                    <thead>
                        <tr class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider">
                            <th class="px-6 py-4 w-16 text-center">No</th>
                            <th class="px-6 py-4">Nama Kelas</th>
                            <th class="px-6 py-4">Wali Kelas</th>
                            <th class="px-6 py-4">Jumlah Siswa</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="text-sm divide-y divide-slate-100">

                        @forelse($data_kelas as $kelas)
                        <tr class="hover:bg-slate-50 transition">

                            <td class="px-6 py-4 text-center text-slate-400 font-medium">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-6 py-4 font-semibold text-slate-800">
                                {{ $kelas->nama_kelas }}
                            </td>
                            <td class="px-6 py-4">
                                @if($kelas->waliKelas)
                                {{ $kelas->waliKelas->nama_lengkap }}
                                @else
                                <span class="text-slate-400 text-sm">Belum ada wali kelas</span>
                                @endif
                            </td>
                            <td class="px-6 py-4  font-semibold text-indigo-600">
                                {{ $kelas->total_anggota }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">

                                    <a href="{{ route('admin.kelas.edit', $kelas->id) }}"
                                        class="p-2 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 hover:text-amber-700 transition-all active:scale-95"
                                        title="Edit Kelas">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L12 15l-4 1 1-4 8.586-8.586z" />
                                        </svg>
                                    </a>

                                    <form id="delete-kelas-{{ $kelas->id }}"
                                        action="{{ route('admin.kelas.destroy', $kelas->id) }}"
                                        method="POST"
                                        class="inline-block m-0">
                                        @csrf
                                        @method('DELETE')

                                        <button type="button"
                                            onclick="hapusKelas({{ $kelas->id }})"
                                            class="p-2 rounded-lg transition-all bg-rose-50 text-rose-600 hover:bg-rose-100 hover:text-rose-700 active:scale-95"
                                            title="Hapus Kelas">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-8 text-slate-500">
                                Data kelas belum tersedia
                            </td>
                        </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </main>
</div>

<!-- SCRIPT DELETE -->
<script>
    function hapusKelas(id) {
        Swal.fire({
            title: 'Hapus Kelas?',
            text: 'Data kelas yang dihapus tidak dapat dikembalikan.',
            icon: 'warning',

            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',

            reverseButtons: true,
            focusCancel: true,

            background: '#ffffff',
            color: '#334155',

            customClass: {
                popup: 'rounded-3xl shadow-2xl',
                title: 'text-xl font-bold',
                confirmButton: 'px-5 py-2 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-medium',
                cancelButton: 'px-5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium'
            },

            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-kelas-' + id).submit();
            }
        });
    }
</script>

@if(session('success'))

<script>
    Swal.fire({

        toast: true,

        position: 'top-end',

        icon: 'success',

        title: "{{ session('success') }}",

        showConfirmButton: false,

        timer: 3000,

        timerProgressBar: true

    });
</script>

@endif

@if(session('error'))

<script>
    Swal.fire({

        toast: true,

        position: 'top-end',

        icon: 'error',

        title: "{{ session('error') }}",

        showConfirmButton: false,

        timer: 4000,

        timerProgressBar: true

    });
</script>

@endif



@endsection