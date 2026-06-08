@extends('admin.app')
<title>Data User</title>
@section('content')
<div class="p-6">
    <!-- MAIN CONTENT AREA -->
    <main class="flex-1 overflow-y-auto p-8 md:p-10">

        <!-- Header Halaman -->
        <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-bold tracking-tight text-slate-900">Data User</h2>
                <p class="text-slate-500 mt-1">Kelola data pengguna untuk pencatatan iuran kas.</p>
            </div>
            <!-- Tombol Tambah Siswa -->
            <a href="{{ route('admin.user.create') }}"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl font-medium transition-all shadow-lg shadow-indigo-200 flex items-center gap-2 w-fit">

                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>

                Tambah Siswa
            </a>
        </header>
        <div class="flex items-center justify-between mb-4">
            <div>
                <h3 class="text-lg font-semibold text-slate-800">
                    Ringkasan Pengguna
                </h3>

                <p class="text-sm text-slate-500">
                    Statistik berdasarkan filter yang sedang aktif
                </p>
            </div>

            @if(request()->filled('search') || request()->filled('role') || request()->filled('tingkat') || request()->filled('jurusan'))
            <span class="px-3 py-1 text-xs font-medium rounded-full bg-indigo-50 text-indigo-700 border border-indigo-200">
                Filter Aktif
            </span>
            @endif
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-5 gap-5 mb-8">

            <!-- Total User -->
            <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Total Pengguna</p>
                        <h3 class="text-3xl font-bold text-slate-800 mt-1">
                            {{ $totalUser }}
                        </h3>
                    </div>

                    <div class="w-12 h-12 rounded-xl bg-indigo-50 flex items-center justify-center">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5V18a4 4 0 00-5-3.87M9 20H4V18a4 4 0 015-3.87m8-6.13a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Siswa -->
            <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Siswa</p>
                        <h3 class="text-3xl font-bold text-slate-800 mt-1">
                            {{ $totalSiswa }}
                        </h3>
                    </div>

                    <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 14l9-5-9-5-9 5 9 5zm0 0v6m-6-3h12" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Bendahara -->
            <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Bendahara</p>
                        <h3 class="text-3xl font-bold text-slate-800 mt-1">
                            {{ $totalBendahara }}
                        </h3>
                    </div>

                    <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-3 0-5 1.5-5 4s2 4 5 4 5-1.5 5-4-2-4-5-4z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Wali Kelas -->
            <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Wali Kelas</p>
                        <h3 class="text-3xl font-bold text-slate-800 mt-1">
                            {{ $totalWaliKelas }}
                        </h3>
                    </div>

                    <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 14c4 0 7 2 7 4v2H5v-2c0-2 3-4 7-4zm0-2a4 4 0 100-8 4 4 0 000 8z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Admin -->
            <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Admin</p>
                        <h3 class="text-3xl font-bold text-slate-800 mt-1">
                            {{ $totalAdmin }}
                        </h3>
                    </div>

                    <div class="w-12 h-12 rounded-xl bg-purple-50 flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6l3 6 6 .75-4.5 4 1.5 6.25L12 19l-6 4 1.5-6.25L3 12.75 9 12l3-6z" />
                        </svg>
                    </div>
                </div>
            </div>

        </div>

        <!-- Toolbar (Search & Filter) -->
        <form method="GET" class="flex flex-wrap gap-3 items-center">

            <!-- Search -->
            <input type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nama, username, email..."
                class="px-4 py-2 border border-slate-300 rounded-xl w-64">

            <!-- Role -->
            <select name="role"
                class="px-4 py-2 border border-slate-300 rounded-xl">

                <option value="">Semua Role</option>
                <option value="1" {{ request('role') == 1 ? 'selected' : '' }}>Admin</option>
                <option value="2" {{ request('role') == 2 ? 'selected' : '' }}>Siswa</option>
                <option value="3" {{ request('role') == 3 ? 'selected' : '' }}>Wali Kelas</option>
                <option value="4" {{ request('role') == 4 ? 'selected' : '' }}>Bendahara</option>

            </select>

            <!-- Tingkat -->
            <select name="tingkat"
                class="px-4 py-2 border border-slate-300 rounded-xl">

                <option value="">Semua Tingkat</option>
                <option value="X" {{ request('tingkat') == 'X' ? 'selected' : '' }}>X</option>
                <option value="XI" {{ request('tingkat') == 'XI' ? 'selected' : '' }}>XI</option>
                <option value="XII" {{ request('tingkat') == 'XII' ? 'selected' : '' }}>XII</option>

            </select>

            <!-- Jurusan -->
            <select name="jurusan"
                class="px-4 py-2 border border-slate-300 rounded-xl">

                <option value="">Semua Jurusan</option>
                <option value="RPL" {{ request('jurusan') == 'RPL' ? 'selected' : '' }}>RPL</option>
                <option value="TKJ" {{ request('jurusan') == 'TKJ' ? 'selected' : '' }}>TKJ</option>
                <option value="AKL" {{ request('jurusan') == 'AKL' ? 'selected' : '' }}>AKL</option>

            </select>

            <button type="submit"
                class="bg-indigo-600 text-white px-4 py-2 rounded-xl hover:bg-indigo-700">
                Filter
            </button>

            <a href="{{ route('admin.user.tampiluser') }}"
                class="px-4 py-2 border border-slate-300 rounded-xl hover:bg-slate-100">
                Reset
            </a>

        </form>

        <!-- Container Tabel Data -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
            <!-- Tabel Siswa -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 text-slate-500 text-xs uppercase tracking-wider">
                            <th class="px-6 py-4 font-medium w-12 text-center">No</th>
                            <th class="px-6 py-4 font-medium">Nama Lengkap</th>
                            <th class="px-6 py-4 font-medium">Username</th>
                            <th class="px-6 py-4 font-medium">Kelas</th>
                            <th class="px-6 py-4 font-medium">Jenis Kelamin</th>
                            <th class="px-6 py-4 font-medium">Role</th>
                            <th class="px-6 py-4 font-medium text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-slate-100">
                        @forelse($data_user as $user)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4 text-center text-slate-400 font-medium">{{ $loop->iteration }}</td>

                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->nama_lengkap) }}&background=e2e8f0&color=475569&rounded=true" alt="Avatar" class="w-9 h-9 rounded-full">
                                    <div>
                                        <p class="font-semibold text-slate-800">{{ $user->nama_lengkap }}</p>
                                        <p class="text-xs text-slate-500">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-slate-600">{{ $user->username }}</td>
                            <td class="px-6 py-4 text-slate-600">
                                {{ $user->kelas?->nama_kelas ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-slate-600">{{ $user->kelamin }}</td>

                            <td class="px-6 py-4">
                                @if($user->role?->nama_role == 'Admin')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-purple-100 text-purple-700 border border-purple-200">
                                    {{ $user->role->nama_role }}
                                </span>

                                @elseif($user->role?->nama_role == 'Bendahara')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-green-100 text-green-700 border border-green-200">
                                    {{ $user->role->nama_role }}
                                </span>

                                @elseif($user->role?->nama_role == 'Walikelas')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-yellow-100 text-yellow-700 border border-yellow-200">
                                    {{ $user->role->nama_role }}
                                </span>

                                @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-blue-100 text-blue-700 border border-blue-200">
                                    {{ $user->role?->nama_role ?? '-' }}
                                </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">

                                    <a href="{{ route('admin.user.edit', $user->id_user) }}"
                                        class="p-2 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 hover:text-amber-700 transition-all active:scale-95"
                                        title="Edit User">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L12 15l-4 1 1-4 8.586-8.586z" />
                                        </svg>
                                    </a>

                                    <form id="delete-form-{{ $user->id_user }}"
                                        action="{{ route('admin.user.destroy', $user->id_user) }}"
                                        method="POST"
                                        class="inline-block m-0">
                                        @csrf
                                        @method('DELETE')

                                        <button type="button"
                                            onclick="hapusUser({{ $user->id_user }})"
                                            class="p-2 rounded-lg transition-all bg-rose-50 text-rose-600 hover:bg-rose-100 hover:text-rose-700 active:scale-95"
                                            title="Hapus User">
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
                            <td colspan="5" class="px-6 py-4 text-center text-slate-500">Tidak ada data user.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm">

            <span class="text-slate-500">
                Menampilkan Data
            </span>

            <span class="font-semibold text-slate-800">
                {{ $data_user->firstItem() }}
                -
                {{ $data_user->lastItem() }}
            </span>

            <span class="text-slate-400">|</span>

            <span class="text-slate-500">
                Total
            </span>

            <span class="font-semibold-600">
                {{ $data_user->total() }}
            </span>

            <span class="text-slate-500">
                pengguna
            </span>

        </div>
</div>

</main>
</div>


</body>
<!-- Success Alert -->
@if(session('sukses'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session("sukses") }}',
        showConfirmButton: false,
        timer: 2200,
        timerProgressBar: true,
        toast: true,
        position: 'top-end',

        background: '#ffffff',
        color: '#0f172a',

        showClass: {
            popup: 'animate__animated animate__fadeInRight'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutRight'
        }
    });
</script>
@endif
<!-- Error Alert -->
@if(session('gagal'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Aksi Ditolak',
        text: '{{ session("gagal") }}',
        confirmButtonText: 'Mengerti',

        confirmButtonColor: '#ef4444',

        background: '#ffffff',
        color: '#0f172a',

        showClass: {
            popup: 'animate__animated animate__zoomIn'
        },
        hideClass: {
            popup: 'animate__animated animate__zoomOut'
        }
    });
</script>
@endif
<!-- Confirmation Alert for Delete -->
<script>
    function hapusUser(id) {
        Swal.fire({
            title: 'Hapus User?',
            text: 'Data user ini akan dihapus permanen dari sistem.',
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
                cancelButton: 'px-5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium ml-3'
            },

            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                // Pastikan ID form di file HTML-mu adalah 'delete-form-' + id
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endsection