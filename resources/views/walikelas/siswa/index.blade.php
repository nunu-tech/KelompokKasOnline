@extends('waliKelas.layouts.app')

@section('content')

<div class="space-y-6">

    <div class="flex items-center justify-between">

        <div>
            <h2 class="text-2xl font-bold">
                Data Siswa
            </h2>

            <p class="text-sm text-gray-400">
                Daftar seluruh siswa kelas
            </p>
        </div>

    </div>

    <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead>
                    <tr class="border-b border-gray-100 text-left">

                        <th class="pb-4">No</th>
                        <th class="pb-4">Nama</th>
                        <th class="pb-4">Kelas</th>
                        <th claas="pb-4">jenis kelamin</th>

                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-50">

                    @forelse($siswa as $item)

                    <tr>

                        <td class="py-4">
                            {{ $loop->iteration }}
                        </td>

                        <td class="py-4 font-medium">
                            {{ $item->nama }}
                        </td>

                        <td class="py-4">
                            {{ $item->kelas }}
                        </td>

                        <td class="py-4">
                            {{ $item->jenis_kelamin }}
                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="7" class="py-6 text-center text-gray-400">
                            Belum ada data siswa
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection