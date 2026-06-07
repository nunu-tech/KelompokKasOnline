@extends('admin.app')

@section('title', 'Manajemen Role')

@section('content')
<div class="p-6 md:p-10 relative w-full border-box">

    <div class="absolute top-0 left-0 w-full h-64 bg-gradient-to-b from-indigo-50/50 to-transparent -z-10"></div>

    <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-5">
        <div>
            <h2 class="text-3xl font-extrabold tracking-tight text-slate-900">
                Manajemen Peran (Role)
            </h2>
            <p class="text-slate-500 mt-1.5 font-medium">Atur hak akses dan jumlah pengguna di tiap peran.</p>
        </div>

        <a href="{{ route('admin.peran.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl font-medium transition-all shadow-lg shadow-indigo-600/30 flex items-center gap-2 active:scale-95">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Role Baru
        </a>
    </header>

    @if(session('success'))
    <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl flex items-center gap-3 shadow-sm">
        <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <span class="font-medium">{{ session('success') }}</span>
    </div>
    @endif

    @if(session('error') || $errors->any())
    <div class="mb-6 bg-rose-50 border border-rose-200 text-rose-700 px-4 py-3 rounded-xl flex items-center gap-3 shadow-sm">
        <svg class="w-6 h-6 text-rose-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <span class="font-medium">
            {{ session('error') ?? $errors->first() }}
        </span>
    </div>
    @endif

    <div class="bg-white rounded-3xl shadow-lg border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/80 text-slate-500 text-xs uppercase tracking-wider font-semibold border-b border-slate-100">
                        <th class="px-6 py-5 w-16 text-center">No</th>
                        <th class="px-6 py-5">Nama Role</th>
                        <th class="px-6 py-5 text-center">Jumlah User</th>
                        <th class="px-6 py-5 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-slate-100">

                    @forelse($roles as $index => $role)
                    <tr class="hover:bg-indigo-50/30 transition-colors group">

                        <td class="px-6 py-4 text-center text-slate-500 font-medium">
                            {{ $index + 1 }}
                        </td>

                        <td class="px-6 py-4 font-bold text-slate-800">
                            {{ $role->nama_role }}
                        </td>

                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center justify-center px-3 py-1 rounded-full text-xs font-semibold {{ $role->users_count > 0 ? 'bg-indigo-100 text-indigo-700' : 'bg-slate-100 text-slate-500' }}">
                                {{ $role->users_count }} Orang
                            </span>
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">

                                <a href="{{ route('admin.peran.edit', $role->id) }}"
                                    class="p-2 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 hover:text-amber-700 transition-all active:scale-95"
                                    title="Edit Data">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>

                                <form id="delete-role-{{ $role->id }}"
                                    action="{{ route('admin.peran.destroy', $role->id) }}"
                                    method="POST"
                                    class="inline-block m-0">
                                    @csrf
                                    @method('DELETE')

                                    <button type="button"
                                        onclick="hapusRole({{ $role->id }})"
                                        class="p-2 rounded-lg transition-all {{ $role->users_count > 0 ? 'bg-slate-100 text-slate-400 cursor-not-allowed' : 'bg-rose-50 text-rose-600 hover:bg-rose-100 hover:text-rose-700 active:scale-95' }}"
                                        title="{{ $role->users_count > 0 ? 'Tidak bisa dihapus (ada user)' : 'Hapus Data' }}"
                                        {{ $role->users_count > 0 ? 'disabled' : '' }}>

                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-slate-500">
                            Belum ada data Role yang ditambahkan.
                        </td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>

</div>

<script>
    function hapusRole(id) {
        Swal.fire({
            title: 'Hapus Role?',
            text: 'Data peran yang dihapus tidak dapat dikembalikan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            customClass: {
                popup: 'rounded-3xl shadow-2xl',
                confirmButton: 'px-5 py-2 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-medium',
                cancelButton: 'px-5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium ml-3'
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                // Sekarang ID-nya sudah benar: delete-role-1, delete-role-2, dst.
                document.getElementById('delete-role-' + id).submit();
            }
        });
    }
</script>
@endsection