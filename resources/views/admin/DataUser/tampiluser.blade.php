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

        <!-- Container Tabel Data -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">

            <!-- Toolbar (Search & Filter) -->
            <div class="p-5 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-center gap-4">
                <!-- Input Pencarian -->
                <div class="relative w-full sm:max-w-xs">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" placeholder="Cari nama atau NIS..." class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-600/50 focus:border-indigo-600 transition-all placeholder-slate-400">
                </div>
            </div>

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

                                @elseif($user->role?->nama_role == 'Wali Kelas')
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

                                    <!-- DELETE -->
                                    <form id="delete-form-{{ $user->id_user }}"
                                        action="{{ route('admin.user.destroy', $user->id_user) }}"
                                        method="POST"
                                        class="m-0">

                                        @csrf
                                        @method('DELETE')

                                        <button type="button"
                                            onclick="hapusUser({{ $user->id_user }})"
                                            class="flex items-center justify-center w-9 h-9 rounded-lg text-rose-600 bg-rose-50 hover:bg-rose-600 hover:text-white transition">

                                            <!-- icon -->
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>

                                        </button>
                                    </form>

                                    <!-- EDIT -->
                                    <a href="{{ route('admin.user.tampiluser', $user->id_user) }}"
                                        class="flex items-center justify-center w-9 h-9 rounded-lg text-amber-600 bg-amber-50 hover:bg-amber-600 hover:text-white transition">

                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L12 15l-4 1 1-4 8.586-8.586z" />
                                        </svg>

                                    </a>

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

            <!-- Pagination (Contoh) -->
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50 flex justify-between items-center text-sm text-slate-500">
                <span>Menampilkan 1 hingga 2 dari 30 siswa</span>
                <div class="flex gap-1">
                    <button class="px-3 py-1.5 border border-slate-200 rounded-lg hover:bg-slate-100 transition-colors disabled:opacity-50" disabled>Sebelumnya</button>
                    <button class="px-3 py-1.5 border border-slate-200 rounded-lg hover:bg-slate-100 transition-colors bg-white">Selanjutnya</button>
                </div>
            </div>

        </div>

    </main>
</div>


</body>
<script>
    function hapusUser(id) {
        Swal.fire({
            title: 'Yakin hapus?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endsection