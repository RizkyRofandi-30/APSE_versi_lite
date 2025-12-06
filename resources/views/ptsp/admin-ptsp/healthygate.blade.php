<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healtygate</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        table,
        th,
        td {
            border: 2px solid black;
            border-collapse: collapse;
            padding: 8px;
        }
    </style>
</head>

<body class="bg-gray-100">
    {{-- Notifikasi --}}
    @if (session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif
    <div class="flex h-screen">

        <!-- SIDEBAR -->
        <div class="w-64 shadow-lg text-white flex flex-col" style="background-color:#1E3557;">
        
            <!-- Logo -->
            <div class="p-4 border-b border-white/30 flex justify-center">
                <img src="{{ asset('images/logo_ptsp.png') }}" alt="Logo" class="w-40">
            </div>
        
            <!-- NAV MENU -->
            <nav class="mt-6 space-y-1 flex-1">
        
                <a href="#" class="flex items-center px-4 py-3 hover:bg-white/20 transition text-white">
                    <i class="fas fa-chart-bar mr-3"></i> Medical License
                </a>
        
                <a href="#" class="flex items-center px-4 py-3 bg-white text-blue-900 font-semibold">
                    <i class="fas fa-home mr-3"></i> Healthygate
                </a>
        
            </nav>
        
            <!-- LOGOUT BUTTON -->
            <div class="p-4 border-t border-white/20">
        
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
        
                    <button type="submit"
                        class="w-full flex items-center gap-3 px-4 py-3 rounded-lg bg-red-600 text-white hover:bg-red-700 transition font-semibold">
                        <i class="fas fa-sign-out-alt text-white text-lg"></i>
                        Logout
                    </button>
                </form>
        
            </div>
        
        </div>

        <!-- MAIN CONTENT -->
        <div class="flex-1 flex flex-col bg-white overflow-y-auto">

            <!-- HEADER -->
            <div class="bg-white h-16 flex items-center justify-between p-8">
                <h1 class="text-4xl font-bold text-gray-800">Healthygate</h1>
                <a href="#" class="font-medium">Admin PTSP</a>
            </div>

            <hr>

            <!-- Pencarian -->
            <div class="w-full max-w-md py-3 px-3">
                <form class="flex">
                    <input type="text" placeholder="Cari..."
                        class="flex-grow px-4 py-2 rounded-l-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <button type="submit"
                        class="bg-blue-900 text-white px-4 py-2 rounded-r-lg hover:bg-blue-600 transition-colors">
                        Cari
                    </button>
                </form>
            </div>

            <!-- CONTENT -->
            <div class="p-8">

                <h2 class="text-2xl font-bold text-gray-800 mb-1 text-center">Perpanjangan Izin</h2>
                <p class="text-gray-600 mb-6 text-center">Semua pengajuan permohonan dapat dipantau dan dikelola melalui
                    halaman ini.</p>

                <!-- TABEL PERPANJANGAN -->
                <div class="overflow-x-auto bg-white shadow rounded-lg border mb-12">
                    <table class="min-w-full text-sm text-center">
                        <thead class="bg-gray-100 font-semibold text-gray-700">
                            <tr>
                                <th class="px-4 py-3 border">No</th>
                                <th class="px-4 py-3 border">Nama Pemohon</th>
                                <th class="px-4 py-3 border">Jenis Izin</th>
                                <th class="px-4 py-3 border">Tanggal Pengajuan</th>
                                <th class="px-4 py-3 border">Proses Berkas</th>
                                <th class="px-4 py-3 border text-center">File</th>
                                <th class="px-4 py-3 border text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 border">1</td>
                                <td class="px-4 py-3 border">Dimas Satyo</td>
                                <td class="px-4 py-3 border">Medical License</td>
                                <td class="px-4 py-3 border">12 Jan 2025</td>
                                <td class="px-4 py-3 border text-blue-600 font-semibold">
                                    <!-- Klik Berkas Bakal Muncul Form -->
                                    <button onclick="openFormPerizinan()"
                                        class="bg-gray-600 text-white px-3 py-1 rounded hover:bg-gray-700">Berkas</button>
                                </td>
                                <td class="px-4 py-3 border text-center">
                                    <button
                                        class="bg-orange-600 text-white px-3 py-1 rounded hover:bg-orange-700">Perizinan</button>
                                </td>
                                <td class="px-4 py-3 border">Sedang Diproses</td>
                            </tr>

                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 border">2</td>
                                <td class="px-4 py-3 border">Alya Putri</td>
                                <td class="px-4 py-3 border">Medical License</td>
                                <td class="px-4 py-3 border">14 Jan 2025</td>
                                <td class="px-4 py-3 border text-green-600 font-semibold">
                                    <button onclick="openFormPerizinan()"
                                        class="bg-gray-600 text-white px-3 py-1 rounded hover:bg-gray-700">Berkas</button>
                                </td>
                                <td class="px-4 py-3 border text-center">
                                    <button
                                        class="bg-orange-600 text-white px-3 py-1 rounded hover:bg-orange-700">Perizinan</button>
                                </td>
                                <td class="px-4 py-3 border">Sedang Diproses</td>
                            </tr>

                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 border">3</td>
                                <td class="px-4 py-3 border">Alya Putri</td>
                                <td class="px-4 py-3 border">Medical License</td>
                                <td class="px-4 py-3 border">14 Jan 2025</td>
                                <td class="px-4 py-3 border text-green-600 font-semibold">
                                    <button onclick="openFormPerizinan()"
                                        class="bg-gray-600 text-white px-3 py-1 rounded hover:bg-gray-700">Berkas</button>
                                </td>
                                <td class="px-4 py-3 border text-center">
                                    <button
                                        class="bg-orange-600 text-white px-3 py-1 rounded hover:bg-orange-700">Perizinan</button>
                                </td>
                                <td class="px-4 py-3 border">Sedang Diproses</td>
                            </tr>
                        </tbody>
                    </table>
                </div>


                <!-- Tabel kedua -->
                <h2 class="text-2xl font-bold text-gray-800 mb-1 text-center">Permohonan Izin</h2>
                <p class="text-gray-600 mb-6 text-center">Semua pengajuan permohonan dapat dipantau dan dikelola.</p>

                <div class="overflow-x-auto bg-white shadow rounded-lg border">
                    <table class="min-w-full text-sm text-center">
                        <thead class="bg-gray-100 font-semibold text-gray-700">
                            <tr>
                                <th class="px-4 py-3 border">No</th>
                                <th class="px-4 py-3 border">Nama Pemohon</th>
                                <th class="px-4 py-3 border">Jenis Izin</th>
                                <th class="px-4 py-3 border">Tanggal Pengajuan</th>
                                <th class="px-4 py-3 border">Proses Berkas</th>
                                <th class="px-4 py-3 border">File</th>
                                <th class="px-4 py-3 border">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 border">1</td>
                                <td class="px-4 py-3 border">Dimas Satyo</td>
                                <td class="px-4 py-3 border">Medical License</td>
                                <td class="px-4 py-3 border">12 Jan 2025</td>
                                <td class="px-4 py-3 border text-blue-600 font-semibold">
                                    <button onclick="openFormPerizinan()"
                                        class="bg-gray-600 text-white px-3 py-1 rounded hover:bg-gray-700">Berkas</button>
                                </td>
                                <td class="px-4 py-3 border text-center">
                                    <button
                                        class="bg-orange-600 text-white px-3 py-1 rounded hover:bg-orange-700">Perizinan</button>
                                </td>
                                <td class="px-4 py-3 border">Sedang Diproses</td>
                            </tr>

                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 border">2</td>
                                <td class="px-4 py-3 border">Alya Putri</td>
                                <td class="px-4 py-3 border">Medical License</td>
                                <td class="px-4 py-3 border">14 Jan 2025</td>
                                <td class="px-4 py-3 border text-green-600 font-semibold">
                                    <button onclick="openFormPerizinan()"
                                        class="bg-gray-600 text-white px-3 py-1 rounded hover:bg-gray-700">Berkas</button>
                                </td>
                                <td class="px-4 py-3 border text-center">
                                    <button
                                        class="bg-orange-600 text-white px-3 py-1 rounded hover:bg-orange-700">Perizinan</button>
                                </td>
                                <td class="px-4 py-3 border">Sedang Diproses</td>
                            </tr>

                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 border">3</td>
                                <td class="px-4 py-3 border">Alya Putri</td>
                                <td class="px-4 py-3 border">Medical License</td>
                                <td class="px-4 py-3 border">14 Jan 2025</td>
                                <td class="px-4 py-3 border text-green-600 font-semibold"><button
                                        onclick="openFormPerizinan()"
                                        class="bg-gray-600 text-white px-3 py-1 rounded hover:bg-gray-700">Berkas</button>
                                </td>
                                <td class="px-4 py-3 border text-center">
                                    <button
                                        class="bg-orange-600 text-white px-3 py-1 rounded hover:bg-orange-700">Perizinan</button>
                                </td>
                                <td class="px-4 py-3 border">Sedang Diproses</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pop Up Rekomendasi -->
            <!-- <div id="myModal" class="fixed inset-0 bg-black/60 hidden z-50 flex items-center justify-center p-4">
                <div class="w-full max-w-xs rounded-xl shadow-2xl text-center p-5" style="background-color:#F5F5F5;">

                    <div class="mb-4">
                        <h2 class="font-bold text-lg text-black mt-0">Surat Rekomendasi</h2>
                    </div>

                    <form enctype="multipart/form-data">
                        <div class="mb-3">
                            <p class="text-black mb-1 text-left text-sm">Surat Rekomendasi</p>
                            <input type="text" placeholder="surat rekomendasi"
                                class="w-full px-3 py-2 rounded-md text-sm bg-white text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-300 border border-gray-300">
                        </div>

                        <button type="button"
                            class="w-full py-2 bg-orange-400 text-black mb-2 rounded-md hover:bg-orange-500 transition duration-200 text-sm">
                            Ajukan Rekomendasi
                        </button>
                    </form>
                </div>
            </div> -->

            <div id="myForm" class="fixed inset-0 bg-black/60 hidden z-50 flex items-center justify-center p-4">
                <div class="bg-white rounded-lg shadow-md p-6 md:p-8 relative max-h-[90vh] overflow-y-auto">
                    <!-- Close Button -->
                    <button onclick="closeFormPerizinan()"
                        class="absolute top-3 right-3 text-gray-600 hover:text-red-500 text-xl font-bold">✕</button>

                    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">FORM PERMOHONAN</h1>

                    <form>
                        <div class="space-y-6">
                            <!-- DATA UMUM UNTUK SEMUA PROFESI INDIVIDU -->
                            <div class="border-b pb-4">
                                <h2 class="text-xl font-bold text-gray-700 mb-4">Dokumen Umum Profesi Kesehatan</h2>

                                <!-- Surat Permohonan Izin -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-medium mb-2">Surat Permohonan Izin Bermaterai
                                        Rp. 10.000,-</label>
                                    <div class="flex justify-between p-4 border rounded-lg bg-gray-50">
                                        <span>Download File...</span>
                                        <button type="button" class="text-blue-600 hover:text-blue-800">Unduh</button>
                                    </div>
                                </div>

                                <!-- KTP -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-medium mb-2">KTP</label>
                                    <div class="flex justify-between p-4 border rounded-lg bg-gray-50">
                                        <span>Download File...</span>
                                        <button type="button" class="text-blue-600 hover:text-blue-800">Unduh</button>
                                    </div>
                                </div>

                                <!-- STR -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-medium mb-2">STR (Surat Tanda
                                        Registrasi)</label>
                                    <div class="flex justify-between p-4 border rounded-lg bg-gray-50">
                                        <span>Download File...</span>
                                        <button type="button" class="text-blue-600 hover:text-blue-800">Unduh</button>
                                    </div>
                                </div>

                                <!-- Ijazah -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-medium mb-2">Ijazah</label>
                                    <textarea rows="3" readonly
                                        class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 bg-gray-50"></textarea>
                                </div>

                                <!-- Surat Keterangan Berbadan Sehat -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-medium mb-2">Surat Keterangan Berbadan
                                        Sehat</label>
                                    <div class="flex justify-between p-4 border rounded-lg bg-gray-50">
                                        <span>Download File...</span>
                                        <button type="button" class="text-blue-600 hover:text-blue-800">Unduh</button>
                                    </div>
                                </div>

                                <!-- Pas Foto -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-medium mb-2">Pas Foto Berwarna 3 x 4</label>
                                    <div class="flex justify-between p-4 border rounded-lg bg-gray-50">
                                        <span>Download File...</span>
                                        <button type="button" class="text-blue-600 hover:text-blue-800">Unduh</button>
                                    </div>
                                </div>

                                <!-- NPWP -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-medium mb-2">NPWP</label>
                                    <textarea rows="2" readonly
                                        class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 bg-gray-50"></textarea>
                                </div>

                                <!-- BPJS Ketenagakerjaan -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-medium mb-2">BPJS Ketenagakerjaan</label>
                                    <div class="flex justify-between p-4 border rounded-lg bg-gray-50">
                                        <span>Download File...</span>
                                        <button type="button" class="text-blue-600 hover:text-blue-800">Unduh</button>
                                    </div>
                                </div>

                                <!-- BPJS Kesehatan -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-medium mb-2">BPJS Kesehatan</label>
                                    <div class="flex justify-between p-4 border rounded-lg bg-gray-50">
                                        <span>Download File...</span>
                                        <button type="button" class="text-blue-600 hover:text-blue-800">Unduh</button>
                                    </div>
                                </div>

                                <!-- Foto Tempat Praktik -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-medium mb-2">Foto Tempat Praktik</label>
                                    <div class="flex justify-between p-4 border rounded-lg bg-gray-50">
                                        <span>Download File...</span>
                                        <button type="button" class="text-blue-600 hover:text-blue-800">Unduh</button>
                                    </div>
                                </div>

                                <!-- Surat Rekomendasi Puskesmas -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-medium mb-2">Surat Rekomendasi Puskesmas
                                        Wilayah Setempat</label>
                                    <div class="flex justify-between p-4 border rounded-lg bg-gray-50">
                                        <span>Download File...</span>
                                        <button type="button" class="text-blue-600 hover:text-blue-800">Unduh</button>
                                    </div>
                                </div>

                                <!-- Surat Rekomendasi Dinas Kesehatan -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-medium mb-2">Surat Rekomendasi Dinas
                                        Kesehatan</label>
                                    <div class="flex justify-between p-4 border rounded-lg bg-gray-50">
                                        <span>Download File...</span>
                                        <button type="button" class="text-blue-600 hover:text-blue-800">Unduh</button>
                                    </div>
                                </div>
                            </div>

                            <!-- DATA KHUSUS DOKTER -->
                            <div class="border-b pb-4">
                                <h2 class="text-xl font-bold text-gray-700 mb-4">Dokumen Khusus Dokter</h2>

                                <!-- Surat Rekomendasi Organisasi Profesi Dokter -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-medium mb-2">Surat Rekomendasi dari
                                        Organisasi Profesi (IDI/Himpunan Profesi Spesialis)</label>
                                    <div class="flex justify-between p-4 border rounded-lg bg-gray-50">
                                        <span>Download File...</span>
                                        <button type="button" class="text-blue-600 hover:text-blue-800">Unduh</button>
                                    </div>
                                </div>
                            </div>

                            <!-- DATA KHUSUS APOTEKER -->
                            <div class="border-b pb-4">
                                <h2 class="text-xl font-bold text-gray-700 mb-4">Dokumen Khusus Apoteker</h2>

                                <!-- Surat Rekomendasi Organisasi Profesi Apoteker -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-medium mb-2">Surat Rekomendasi dari
                                        Organisasi Profesi Apoteker</label>
                                    <div class="flex justify-between p-4 border rounded-lg bg-gray-50">
                                        <span>Download File...</span>
                                        <button type="button" class="text-blue-600 hover:text-blue-800">Unduh</button>
                                    </div>
                                </div>
                            </div>

                            <!-- DATA APOTIK -->
                            <div class="border-b pb-4">
                                <h2 class="text-xl font-bold text-gray-700 mb-4">Dokumen Apotik</h2>

                                <!-- KTP Pemilik Usaha -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-medium mb-2">KTP Pemilik Usaha</label>
                                    <div class="flex justify-between p-4 border rounded-lg bg-gray-50">
                                        <span>Download File...</span>
                                        <button type="button" class="text-blue-600 hover:text-blue-800">Unduh</button>
                                    </div>
                                </div>

                                <!-- NPWP Pemilik Usaha -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-medium mb-2">NPWP Pemilik Usaha</label>
                                    <div class="flex justify-between p-4 border rounded-lg bg-gray-50">
                                        <span>Download File...</span>
                                        <button type="button" class="text-blue-600 hover:text-blue-800">Unduh</button>
                                    </div>
                                </div>

                                <!-- NIB -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-medium mb-2">Nomor Induk Berusaha
                                        (NIB)</label>
                                    <textarea rows="2" readonly
                                        class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 bg-gray-50"></textarea>
                                </div>

                                <!-- SIP Apoteker + KTP Penanggung Jawab -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-medium mb-2">Surat Izin Praktik Apotik dan
                                        KTP Penanggung Jawab Apotik</label>
                                    <textarea rows="2" readonly
                                        class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 bg-gray-50"></textarea>
                                </div>

                                <!-- Denah Lokasi Bangunan -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-medium mb-2">Denah Lokasi Bangunan</label>
                                    <div class="flex justify-between p-4 border rounded-lg bg-gray-50">
                                        <span>Download File...</span>
                                        <button type="button" class="text-blue-600 hover:text-blue-800">Unduh</button>
                                    </div>
                                </div>

                                <!-- Denah Ruangan -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-medium mb-2">Denah Ruangan</label>
                                    <div class="flex justify-between p-4 border rounded-lg bg-gray-50">
                                        <span>Download File...</span>
                                        <button type="button" class="text-blue-600 hover:text-blue-800">Unduh</button>
                                    </div>
                                </div>

                                <!-- SIP + KTP Asisten Apoteker -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-medium mb-2">Surat Izin Praktik Apotik dan
                                        KTP Asisten Apoteker</label>
                                    <div class="flex justify-between p-4 border rounded-lg bg-gray-50">
                                        <span>Download File...</span>
                                        <button type="button" class="text-blue-600 hover:text-blue-800">Unduh</button>
                                    </div>
                                </div>

                                <!-- Daftar Peralatan Apotik -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-medium mb-2">Daftar Nama Peralatan
                                        Apotik</label>
                                    <div class="flex justify-between p-4 border rounded-lg bg-gray-50">
                                        <span>Download File...</span>
                                        <button type="button" class="text-blue-600 hover:text-blue-800">Unduh</button>
                                    </div>
                                </div>

                                <!-- BPJS Ketenagakerjaan Apoteker -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-medium mb-2">BPJS Ketenagakerjaan
                                        Apoteker</label>
                                    <div class="flex justify-between p-4 border rounded-lg bg-gray-50">
                                        <span>Download File...</span>
                                        <button type="button" class="text-blue-600 hover:text-blue-800">Unduh</button>
                                    </div>
                                </div>

                                <!-- BPJS Ketenagakerjaan Asisten Apoteker -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-medium mb-2">BPJS Ketenagakerjaan Asisten
                                        Apoteker</label>
                                    <div class="flex justify-between p-4 border rounded-lg bg-gray-50">
                                        <span>Download File...</span>
                                        <button type="button" class="text-blue-600 hover:text-blue-800">Unduh</button>
                                    </div>
                                </div>

                                <!-- BPJS Kesehatan Asisten Apoteker -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-medium mb-2">BPJS Kesehatan Asisten
                                        Apoteker</label>
                                    <div class="flex justify-between p-4 border rounded-lg bg-gray-50">
                                        <span>Download File...</span>
                                        <button type="button" class="text-blue-600 hover:text-blue-800">Unduh</button>
                                    </div>
                                </div>

                                <!-- Pas Foto 4x6 -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-medium mb-2">Pas Foto Berwarna 4 x 6</label>
                                    <div class="flex justify-between p-4 border rounded-lg bg-gray-50">
                                        <span>Download File...</span>
                                        <button type="button" class="text-blue-600 hover:text-blue-800">Unduh</button>
                                    </div>
                                </div>

                                <!-- IMG/PBG -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-medium mb-2">IMG / PBG (Izin Mendirikan
                                        Bangunan)</label>
                                    <div class="flex justify-between p-4 border rounded-lg bg-gray-50">
                                        <span>Download File...</span>
                                        <button type="button" class="text-blue-600 hover:text-blue-800">Unduh</button>
                                    </div>
                                </div>

                                <!-- PBB -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-medium mb-2">Tanda Lunas PBB Tahun
                                        Berjalan</label>
                                    <div class="flex justify-between p-4 border rounded-lg bg-gray-50">
                                        <span>Download File...</span>
                                        <button type="button" class="text-blue-600 hover:text-blue-800">Unduh</button>
                                    </div>
                                </div>

                                <!-- SPPL -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-medium mb-2">Dokumen Lingkungan SPPL</label>
                                    <div class="flex justify-between p-4 border rounded-lg bg-gray-50">
                                        <span>Download File...</span>
                                        <button type="button" class="text-blue-600 hover:text-blue-800">Unduh</button>
                                    </div>
                                </div>
                            </div>

                            <!-- DATA KLINIK -->
                            <div class="pb-4">
                                <h2 class="text-xl font-bold text-gray-700 mb-4">Dokumen Klinik</h2>

                                <!-- NPWP Pemilik Klinik -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-medium mb-2">NPWP Pemilik Klinik</label>
                                    <div class="flex justify-between p-4 border rounded-lg bg-gray-50">
                                        <span>Download File...</span>
                                        <button type="button" class="text-blue-600 hover:text-blue-800">Unduh</button>
                                    </div>
                                </div>

                                <!-- BPJS Kesehatan Pemilik Klinik -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-medium mb-2">BPJS Kesehatan Pemilik
                                        Klinik</label>
                                    <div class="flex justify-between p-4 border rounded-lg bg-gray-50">
                                        <span>Download File...</span>
                                        <button type="button" class="text-blue-600 hover:text-blue-800">Unduh</button>
                                    </div>
                                </div>

                                <!-- Daftar Obat-Obatan -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-medium mb-2">Daftar Obat-Obatan</label>
                                    <div class="flex justify-between p-4 border rounded-lg bg-gray-50">
                                        <span>Download File...</span>
                                        <button type="button" class="text-blue-600 hover:text-blue-800">Unduh</button>
                                    </div>
                                </div>

                                <!-- Deskripsi Pengorganisasian -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-medium mb-2">Deskripsi Pengorganisasian,
                                        Lokasi, Bangunan, Prasarana, Ketenagaan, Peralatan Kesehatan, Kefarmasian,
                                        Laboratorium</label>
                                    <div class="flex justify-between p-4 border rounded-lg bg-gray-50">
                                        <span>Download File...</span>
                                        <button type="button" class="text-blue-600 hover:text-blue-800">Unduh</button>
                                    </div>
                                </div>

                                <!-- Perjanjian Limbah B3 -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-medium mb-2">Perjanjian Kerja Sama Pembuangan
                                        Limbah B3</label>
                                    <div class="flex justify-between p-4 border rounded-lg bg-gray-50">
                                        <span>Download File...</span>
                                        <button type="button" class="text-blue-600 hover:text-blue-800">Unduh</button>
                                    </div>
                                </div>

                                <!-- SIP Semua Tenaga Kesehatan -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 font-medium mb-2">Surat Izin Praktik Semua Tenaga
                                        Kesehatan Klinik</label>
                                    <div class="flex justify-between p-4 border rounded-lg bg-gray-50">
                                        <span>Download File...</span>
                                        <button type="button" class="text-blue-600 hover:text-blue-800">Unduh</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-end pt-6 border-t mt-6">
                            <button type="button" onclick="openBatalkan()"
                                class="px-8 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700">Tolak</button>
                            <button type="button"
                                class="px-8 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700">Setujui</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Popup Warning -->
            <div id="modalWarning" class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center p-4">

                <div class="bg-white p-6 rounded-xl w-full max-w-sm shadow-2xl text-center">

                    <h2 class="font-bold text-xl text-gray-800 mb-4">Pilih Status Lanjutan</h2>

                    <!-- LIST RADIO -->
                    <div class="space-y-2 mb-4">
                        <label class="flex items-center cursor-pointer gap-3">
                            <input type="radio" name="status" value="berkas-tidak-lengkap"
                                onclick="document.getElementById('inputLainnya').classList.add('hidden')"
                                class="peer hidden">
                            <span
                                class="w-4 h-4 rounded-full border border-gray-500 peer-checked:border-blue-600 peer-checked:bg-blue-600"></span>
                            Berkas Tidak Lengkap
                        </label>

                        <label class="flex items-center cursor-pointer gap-3">
                            <input type="radio" name="status" value="lainnya"
                                onclick="document.getElementById('inputLainnya').classList.remove('hidden')"
                                class="peer hidden">
                            <span
                                class="w-4 h-4 rounded-full border border-gray-500 peer-checked:border-green-600 peer-checked:bg-green-600"></span>
                            Lainnya
                        </label>
                    </div>

                    <!-- INPUT MUNCUL KALAU PILIH LAINNYA -->
                    <input id="inputLainnya" type="text" placeholder="Masukkan keterangan..."
                        class="hidden w-full border rounded-lg px-3 py-2 text-sm mb-4">

                    <!-- BUTTON BAWAH -->
                    <div class="flex gap-3 pt-2 justify-center">
                        <button onclick="closeBatalkan()"
                            class="flex-1 px-4 py-3 bg-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-400">
                            Batal
                        </button>

                        <button type="submit"
                            class="flex-1 px-4 py-3 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700">
                            Kirim
                        </button>
                    </div>
                </div>
            </div>

            <!-- FOOTER -->
            <footer class="bg-white-800 text-sm py-4 mt-auto">
                <div
                    class="container mx-auto flex flex-col md:flex-row justify-between items-center text-center md:text-left gap-2 px-6">

                    <div>
                        <h6 class="font-semibold text-lg">Customer Service</h6>
                        <p class="text-sm">+62 812-3456-7890</p>
                    </div>

                    <p>© 2025 Pelayan Terpadu Sektor Kesehatan — All Rights Reserved.</p>
                </div>
            </footer>

        </div>
    </div>
</body>

<script>
    // Untuk Surat Rekomendasi
    function openModal() {
        document.getElementById("myModal").classList.remove("hidden");
    }

    function closeModal() {
        document.getElementById("myModal").classList.add("hidden");
    }

    // Untuk Tabel Permohonan
    function openFormPermohonanan() {
        document.getElementById("myForm").classList.remove("hidden");
    }

    // Untuk Tabel Perizinan
    function openFormPerizinan() {
        document.getElementById("myForm").classList.remove("hidden");
    }

    function closeFormPerizinan() {
        document.getElementById("myForm").classList.add("hidden");
    }

    // Untuk Tolak Berkas
    function openBatalkan() {
        document.getElementById("modalWarning").classList.remove("hidden");
    }

    function closeBatalkan() {
        document.getElementById("modalWarning").classList.add("hidden");
    }
</script>

<script>
    function toggleDropdown() {
        const menu = document.getElementById('dropdownMenu');
        menu.classList.toggle('hidden');
    }
</script>

</html>