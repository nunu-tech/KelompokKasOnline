<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Uang Kas Kelas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="flex">
        <!-- Manggil Sidebar -->
        @include('navigasi.sidebar')

        <!-- Main Content -->
        <div class="flex-1 p-10">
            <header class="flex justify-between items-center mb-10">
                <h2 class="text-3xl font-semibold text-gray-800">Selamat Datang, Admin</h2>
                <div class="text-gray-600">Jumat, 8 Mei 2026</div>
            </header>

            <!-- Ringkasan Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <!-- Total Saldo -->
                <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-green-500">
                    <p class="text-sm text-gray-500 uppercase font-bold">Total Saldo</p>
                    <p class="text-2xl font-bold text-gray-800">Rp 1.500.000</p>
                </div>

                <!-- Pemasukan Bulan Ini -->
                <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-blue-500">
                    <p class="text-sm text-gray-500 uppercase font-bold">Pemasukan (Mei)</p>
                    <p class="text-2xl font-bold text-gray-800">Rp 250.000</p>
                </div>

                <!-- Siswa Belum Bayar -->
                <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-red-500">
                    <p class="text-sm text-gray-500 uppercase font-bold">Belum Bayar Minggu Ini</p>
                    <p class="text-2xl font-bold text-gray-800">12 Orang</p>
                </div>
            </div>

            <!-- Tabel Transaksi Terakhir (Dummy) -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b">
                    <h3 class="font-bold text-gray-700">Transaksi Terakhir</h3>
                </div>
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-gray-600 text-sm italic">
                            <th class="p-4 border-b">Nama Siswa</th>
                            <th class="p-4 border-b">Tanggal</th>
                            <th class="p-4 border-b">Jumlah</th>
                            <th class="p-4 border-b">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        <tr>
                            <td class="p-4 border-b">Ahmad Dani</td>
                            <td class="p-4 border-b">07 Mei 2026</td>
                            <td class="p-4 border-b text-green-600 font-semibold">+ Rp 5.000</td>
                            <td class="p-4 border-b"><span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">Lunas</span></td>
                        </tr>
                        <tr>
                            <td class="p-4 border-b">Siti Aminah</td>
                            <td class="p-4 border-b">06 Mei 2026</td>
                            <td class="p-4 border-b text-green-600 font-semibold">+ Rp 5.000</td>
                            <td class="p-4 border-b"><span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">Lunas</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>