<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical License</title>
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
            <div class=" p-4 border-b border-white/30 flex justify-center">
                <img src="{{ asset('images/logo_ptsp.png') }}" alt="Logo" class="w-40">
            </div>

            <nav class="mt-6 space-y-1 flex-1">

                <!-- Page aktif -->
                <a href="{{ route('admin-ptspMedlicense') }}" class="flex items-center px-4 py-3 bg-white text-blue-900 font-semibold">
                    <i class="fas fa-home mr-3"></i> Medical License
                </a>
                <a href="{{ route('admin-ptsphealthygate') }}" class="flex items-center px-4 py-3 hover:bg-white/20 transition text-white">
                    <i class="fas fa-chart-bar mr-3"></i> Healthygate
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
                <h1 class="text-4xl font-bold text-gray-800">Medlicense</h1>
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
                <!-- PERPANJANGAN -->
                <h2 class="text-2xl font-bold text-gray-800 mb-1 text-center">Perpanjangan Izin</h2>
                <p class="text-gray-600 mb-6 text-center">Semua pengajuan perpanjangan dapat dipantau dan dikelola melalui halaman ini.
                </p>
                
                <div class="overflow-x-auto bg-white shadow rounded-lg border mb-12">
                    <table class="min-w-full text-sm text-center">
                        <thead class="bg-gray-100 font-semibold text-gray-700">
                            <tr>
                                <th class="px-4 py-3 border">No</th>
                                <th class="px-4 py-3 border">Nama Pemohon</th>
                                <th class="px-4 py-3 border">Jenis Izin</th>
                                <th class="px-4 py-3 border">Tanggal Pengajuan</th>
                                <th class="px-4 py-3 border">Proses Berkas</th>
                                <th class="px-4 py-3 border text-center">Status</th>
                                <th class="px-4 py-3 border text-center">Proses Pengajuan</th>
                            </tr>
                        </thead>
                
                        <tbody>
                            @if(isset($perpanjangan) && $perpanjangan->count())
                                @foreach ($perpanjangan as $p)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3 border">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-3 border">{{ $p->nama }}</td>
                                        <td class="px-4 py-3 border">{{ $p->profesi ?? 'Perpanjangan' }}</td>
                                        <td class="px-4 py-3 border">
                                            {{ isset($p->created_at) ? \Carbon\Carbon::parse($p->created_at)->format('d M Y') : '-' }}
                                        </td>

                                        <td class="px-4 py-3 border text-blue-600 font-semibold">
                                            <button data-id="{{ $p->id_medlicense }}" data-jenis="{{ $p->profesi ?? 'Perpanjangan' }}" data-status_proses="{{ $p->status_proses }}"
                                                onclick="openFormPerizinan(this.dataset.id, this.dataset.jenis, this.dataset.status_proses)"
                                                class="bg-gray-600 text-white px-3 py-1 rounded hover:bg-gray-700">
                                                Berkas
                                            </button>
                                        </td>

                                        <td class="px-4 py-3 border">{{ $p->status ?? '—' }}</td>

                                        <td class="px-4 py-3 border">
                                            @if ($p->status_proses === "ptsp")
                                                Admin PTSP
                                            @elseif ($p->status_proses === "dinkes")
                                                Dinkes
                                            @elseif ($p->status_proses === "kepala")
                                                Kepala PTSP
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="px-4 py-6 border text-center" colspan="7">Belum ada data perpanjangan.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <!-- PERMOHONAN -->
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
                                <th class="px-4 py-3 border">Status</th>
                                <th class="px-4 py-3 border">Proses Pengajuan</th>
                            </tr>
                        </thead>
                
                        <tbody>
                            @if(isset($permohonan) && $permohonan->count())
                                @foreach ($permohonan as $p)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3 border">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-3 border">{{ $p->nama }}</td>
                                        <td class="px-4 py-3 border">{{ $p->profesi ?? '-' }}</td>
                                        <td class="px-4 py-3 border">
                                            {{ isset($p->created_at) ? \Carbon\Carbon::parse($p->created_at)->format('d M Y') : '-' }}
                                        </td>

                                        <td class="px-4 py-3 border text-blue-600 font-semibold">
                                            <button data-id="{{ $p->id_medlicense }}" data-jenis="{{ $p->profesi}}" data-status_proses="{{ $p->status_proses }}"
                                                onclick="openFormPerizinan(this.dataset.id, this.dataset.jenis, this.dataset.status_proses)"
                                                class="bg-gray-600 text-white px-3 py-1 rounded hover:bg-gray-700">
                                                Berkas
                                            </button>
                                        </td>

                                        <td class="px-4 py-3 border">{{ $p->status ?? '—' }}</td>

                                        <td class="px-4 py-3 border">
                                            @if ($p->status_proses === "ptsp")
                                                Admin PTSP
                                            @elseif ($p->status_proses === "dinkes")
                                                Dinkes
                                            @elseif ($p->status_proses === "kepala")
                                                Kepala PTSP
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="px-4 py-6 border text-center" colspan="8">Belum ada data permohonan.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pop Up Permohonan -->
            <div id="myForm" class="fixed inset-0 bg-black/60 hidden z-50 flex items-center justify-center p-4">
                <div class="bg-white rounded-lg shadow-md p-6 md:p-8 relative max-h-[90vh] overflow-y-auto">
                    <!-- Close Button -->
                    <button onclick="closeFormPerizinan()"
                        class="absolute top-3 right-3 text-gray-600 hover:text-red-500 text-xl font-bold">✕</button>

                    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">BERKAS</h1>

                    <div class="space-y-6">
                        <!-- DATA DOKTER -->
                        <div class="border-b pb-4 hidden" id="form-dokter">
                            <h2 class="text-xl font-bold text-gray-700 mb-4">Dokumen Dokter</h2>

                            <!-- Surat Permohonan Izin -->
                            @foreach ($berkasDokter as $item)
                                <div class="dokter-item" data-id="{{ $item->id_medlicense }}">
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>Surat Permohonan Izin Bermaterai Rp. 10.000,-</span>
                                            <a href="{{ asset('storage/' . $item->surat_permohonan) }}" target="_blank"
                                                class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>KTP</span>
                                            <a href="{{ asset('storage/' . $item->ktp) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>STR (Surat Tanda Registrasi)</span>
                                            <a href="{{ asset('storage/' . $item->str) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>Ijazah</span>
                                            <a href="{{ asset('storage/' . $item->ijazah) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>Surat Keterangan Berbadan Sehat</span>
                                            <a href="{{ asset('storage/' . $item->surat_sehat) }}" target="_blank"
                                                class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>Pas Foto Berwarna 3 x 4</span>
                                            <a href="{{ asset('storage/' . $item->pas_foto) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>NPWP</span>
                                            <a href="{{ asset('storage/' . $item->npwp) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>BPJS Ketenagakerjaan</span>
                                            <a href="{{ asset('storage/' . $item->bpjs_ketenagakerjaan) }}" target="_blank"
                                                class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>BPJS Kesehatan</span>
                                            <a href="{{ asset('storage/' . $item->bpjs_kesehatan) }}" target="_blank"
                                                class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>SIP (Surat Izin Praktik) Dokter</span>
                                            <a href="{{ asset('storage/' . $item->sip_dokter) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>Surat Rekomendasi IDI (Ikatan Dokter Indonesia)</span>
                                            <a href="{{ asset('storage/' . $item->rekomendasi_idi) }}" target="_blank"
                                                class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>Foto Tempat Praktik</span>
                                            <a href="{{ asset('storage/' . $item->foto_tempat_praktik) }}" target="_blank"
                                                class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>Surat Rekomendasi Puskesmas Wilayah Setempat</span>
                                            <a href="{{ asset('storage/' . $item->rekomendasi_puskesmas) }}" target="_blank"
                                                class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <!-- DATA PERAWAT -->
                        <div class="border-b pb-4 hidden" id="form-perawat">
                            <h2 class="text-xl font-bold text-gray-700 mb-4">Dokumen Perawat</h2>
                            
                            @foreach ($berkasPerawat as $item)
                                <div class="perawat-item" data-id="{{ $item->id_medlicense }}">
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>Surat Permohonan Izin Bermaterai Rp. 10.000,-</span>
                                            <a href="{{ asset('storage/' . $item->surat_permohonan) }}" target="_blank"
                                                class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>KTP</span>
                                            <a href="{{ asset('storage/' . $item->ktp) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>STR (Surat Tanda Registrasi)</span>
                                            <a href="{{ asset('storage/' . $item->str) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>Ijazah</span>
                                            <a href="{{ asset('storage/' . $item->ijazah) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>Surat Keterangan Berbadan Sehat</span>
                                            <a href="{{ asset('storage/' . $item->surat_sehat) }}" target="_blank"
                                                class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>Pas Foto Berwarna 3 x 4</span>
                                            <a href="{{ asset('storage/' . $item->pas_foto) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>NPWP</span>
                                            <a href="{{ asset('storage/' . $item->npwp) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>BPJS Ketenagakerjaan</span>
                                            <a href="{{ asset('storage/' . $item->bpjs_ketenagakerjaan) }}" target="_blank"
                                                class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>BPJS Kesehatan</span>
                                            <a href="{{ asset('storage/' . $item->bpjs_kesehatan) }}" target="_blank"
                                                class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>Surat Rekomendasi PPNI (Persatuan Perawat Nasional Indonesia)</span>
                                            <a href="{{ asset('storage/' . $item->rekomendasi_ppni) }}" target="_blank"
                                                class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>Surat Rekomendasi Puskesmas Wilayah Setempat</span>
                                            <a href="{{ asset('storage/' . $item->rekomendasi_puskesmas) }}" target="_blank"
                                                class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>Foto Tempat Praktik</span>
                                            <a href="{{ asset('storage/' . $item->foto_tempat_praktik) }}" target="_blank"
                                                class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                </div>  
                            @endforeach
                        </div>

                        <!-- DATA BIDAN -->
                        <div class="border-b pb-4 hidden" id="form-bidan">
                            <h2 class="text-xl font-bold text-gray-700 mb-4">Dokumen Bidan</h2>
                        
                            <!-- Surat Permohonan Izin -->
                            @foreach ($berkasBidan as $item)
                                <div class="bidan-item" data-id="{{ $item->id_medlicense }}">
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>Surat Permohonan Izin Bermaterai Rp. 10.000,-</span>
                                            <a href="{{ asset('storage/' . $item->surat_permohonan) }}" target="_blank"
                                                class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>KTP</span>
                                            <a href="{{ asset('storage/' . $item->ktp) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>STR (Surat Tanda Registrasi)</span>
                                            <a href="{{ asset('storage/' . $item->str) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>Ijazah</span>
                                            <a href="{{ asset('storage/' . $item->ijazah) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>Surat Keterangan Berbadan Sehat</span>
                                            <a href="{{ asset('storage/' . $item->surat_sehat) }}" target="_blank"
                                                class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>Pas Foto Berwarna 3 x 4</span>
                                            <a href="{{ asset('storage/' . $item->pas_foto) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>NPWP</span>
                                            <a href="{{ asset('storage/' . $item->npwp) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>BPJS Ketenagakerjaan</span>
                                            <a href="{{ asset('storage/' . $item->bpjs_ketenagakerjaan) }}" target="_blank"
                                                class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>BPJS Kesehatan</span>
                                            <a href="{{ asset('storage/' . $item->bpjs_kesehatan) }}" target="_blank"
                                                class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>Surat Rekomendasi IBI (Ikatan Bidan Indonesia)</span>
                                            <a href="{{ asset('storage/' . $item->rekomendasi_ibi) }}" target="_blank"
                                                class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>Surat Rekomendasi Puskesmas Wilayah Setempat</span>
                                            <a href="{{ asset('storage/' . $item->rekomendasi_puskesmas) }}" target="_blank"
                                                class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>Foto Tempat Praktik</span>
                                            <a href="{{ asset('storage/' . $item->foto_tempat_praktik) }}" target="_blank"
                                                class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- DATA APOTEKER-->
                        <div class="border-b pb-4 hidden" id="form-apoteker">
                            <h2 class="text-xl font-bold text-gray-700 mb-4">Dokumen Apoteker</h2>
                        
                            <!-- Surat Permohonan Izin -->
                            @foreach ($berkasApoteker as $item)
                                <div class="apoteker-item" data-id="{{ $item->id_medlicense }}">
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>Surat Permohonan Izin Bermaterai Rp. 10.000,-</span>
                                            <a href="{{ asset('storage/' . $item->surat_permohonan) }}" target="_blank"
                                                class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>KTP</span>
                                            <a href="{{ asset('storage/' . $item->ktp) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>STR (Surat Tanda Registrasi)</span>
                                            <a href="{{ asset('storage/' . $item->str) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>Ijazah</span>
                                            <a href="{{ asset('storage/' . $item->ijazah) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>Surat Keterangan Berbadan Sehat</span>
                                            <a href="{{ asset('storage/' . $item->surat_sehat) }}" target="_blank"
                                                class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>Pas Foto Berwarna 3 x 4</span>
                                            <a href="{{ asset('storage/' . $item->pas_foto) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>NPWP</span>
                                            <a href="{{ asset('storage/' . $item->npwp) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>BPJS Ketenagakerjaan</span>
                                            <a href="{{ asset('storage/' . $item->bpjs_ketenagakerjaan) }}" target="_blank"
                                                class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>BPJS Kesehatan</span>
                                            <a href="{{ asset('storage/' . $item->bpjs_kesehatan) }}" target="_blank"
                                                class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>Surat Rekomendasi IAI (Ikatan Apoteker Indonesia)</span>
                                            <a href="{{ asset('storage/' . $item->rekomendasi_iai) }}" target="_blank"
                                                class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>Surat Tempat Kerja</span>
                                            <a href="{{ asset('storage/' . $item->surat_tempat_kerja) }}" target="_blank"
                                                class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- DATA Perpanjangan -->
                        <div class="hidden" id="form-perpanjangan">
                            @foreach ($perpanjangan as $item)
                                <div class="perpanjangan-item" data-id="{{ $item->id_medlicense }}">
                                    <div class="mb-4">
                                        <div class="flex justify-between gap-16 p-4 border rounded-lg bg-gray-50">
                                            <span>Dokumen Perpanjangan Izin Usaha</span>
                                            <a href="{{ asset('storage/' . $item->izin_profesi_terbit) }}" target="_blank"
                                                class="text-blue-600 hover:text-blue-800">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-2 justify-center md:justify-end pt-6">
                        <button type="button" onclick="openBatalkan(selectedID)"
                            class="px-8 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700">
                            Tolak
                        </button>
                        <form id="formSetujui" method="POST">
                            @csrf
                            <button id="btnSetujui" type="submit" class="px-8 py-3 rounded-lg text-white bg-gray-400 cursor-not-allowed"
                                disabled>
                                Setujui 
                            </button>
                        </form>
                    </div>
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
                                onclick="document.getElementById('inputLainnya').classList.add('hidden')" class="peer hidden">
                            <span
                                class="w-4 h-4 rounded-full border border-gray-500 peer-checked:border-blue-600 peer-checked:bg-blue-600"></span>
                            Berkas Tidak Lengkap
                        </label>
                    
                        <label class="flex items-center cursor-pointer gap-3">
                            <input type="radio" name="status" value="lainnya"
                                onclick="document.getElementById('inputLainnya').classList.remove('hidden')" class="peer hidden">
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
            
                        <!-- Batal -->
                        <button onclick="closeBatalkan()"
                            class="flex-1 px-4 py-3 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700">
                            Batal
                        </button>
            
                        <!-- Form Submit -->
                        <form id="formTolak" method="POST" class="contents">
                            @csrf
            
                            <!-- Hidden input untuk mengirim keterangan -->
                            <input type="hidden" name="keterangan" id="inputKeterangan">
            
                            <button type="submit"
                                class="flex-1 px-4 py-3 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700">
                                Kirim
                            </button>
                        </form>
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
    let selectedID = null;

    function openModal() {
        document.getElementById("myModal").classList.remove("hidden");
    }

    function closeModal() {
        document.getElementById("myModal").classList.add("hidden");
    }
    function closeFormPerizinan() {
        document.getElementById("myForm").classList.add("hidden");
    }

    function openFormPerizinan(id, jenis, status_proses) {
        selectedID = id;
        document.getElementById("myForm").classList.remove("hidden");
    
        // Semua form disembunyikan dulu
        const forms = ["form-dokter", "form-perawat", "form-bidan", "form-apoteker", "form-perpanjangan"];
        forms.forEach(f => document.getElementById(f).classList.add("hidden"));

        // Normalisasi teks profesi → lowercase
        jenis = jenis.toLowerCase();

        if (jenis === "dokter") {
            const items = document.querySelectorAll('.dokter-item');

            items.forEach(item => {
                if (item.dataset.id === id) {
                    item.classList.remove('hidden');  // tampilkan
                } else {
                    item.classList.add('hidden');     // sembunyikan
                }
            });

            document.getElementById("form-dokter").classList.remove("hidden");
        }
        else if (jenis === "perawat") {
            const items = document.querySelectorAll('.perawat-item');

            items.forEach(item => {
                if (item.dataset.id === id) {
                    item.classList.remove('hidden');  // tampilkan
                } else {
                    item.classList.add('hidden');     // sembunyikan
                }
            });

            document.getElementById("form-perawat").classList.remove("hidden");
        }
        else if (jenis === "bidan") {
            const items = document.querySelectorAll('.bidan-item');

            items.forEach(item => {
                if (item.dataset.id === id) {
                    item.classList.remove('hidden');  // tampilkan
                } else {
                    item.classList.add('hidden');     // sembunyikan
                }
            });

            document.getElementById("form-bidan").classList.remove("hidden");
        }
        else if (jenis === "apoteker") {
            const items = document.querySelectorAll('.apoteker-item');

            items.forEach(item => {
                if (item.dataset.id === id) {
                    item.classList.remove('hidden');  // tampilkan
                } else {
                    item.classList.add('hidden');     // sembunyikan
                }
            });

            document.getElementById("form-apoteker").classList.remove("hidden");
        }
        else if (jenis === "perpanjangan") {
            const items = document.querySelectorAll('.perpanjangan-item');

            items.forEach(item => {
                if (item.dataset.id === id) {
                    item.classList.remove('hidden');  // tampilkan
                } else {
                    item.classList.add('hidden');     // sembunyikan
                }
            });

            document.getElementById("form-perpanjangan").classList.remove("hidden");
        }
        
        const btn = document.getElementById("btnSetujui");
        if (status_proses === "ptsp") {
            btn.disabled = false;
            btn.classList.remove("bg-gray-400", "cursor-not-allowed");
            btn.classList.add("bg-green-600", "hover:bg-green-700");
        } else {
            btn.disabled = true;
            btn.classList.add("bg-gray-400", "cursor-not-allowed");
            btn.classList.remove("bg-green-600", "hover:bg-green-700");
        }
    }

    // function openFormPerizinan() {
    //     document.getElementById("myForm").classList.remove("hidden");
    // }

    function openBatalkan(id) {
        selectedID = id;
        document.getElementById("modalWarning").classList.remove("hidden");
    }


    document.addEventListener('DOMContentLoaded', function () {
        const formTolak = document.getElementById("formTolak");
        const inputKeterangan = document.getElementById("inputKeterangan");

        formTolak.addEventListener("submit", function (e) {
            if (!selectedID) {
                e.preventDefault();
                alert("Silakan pilih berkas terlebih dahulu dari tabel.");
                return;
            }

            const selectedStatus = document.querySelector('input[name="status"]:checked');

            if (!selectedStatus) {
                e.preventDefault();
                alert("Silakan pilih alasan penolakan.");
                return;
            }

            if (selectedStatus.value === "berkas-tidak-lengkap") {
                inputKeterangan.value = "Berkas tidak lengkap";
            } else {
                const lainnyaText = document.getElementById("inputLainnya").value.trim();
                if (lainnyaText === "") {
                    e.preventDefault();
                    alert("Silakan isi keterangan lainnya.");
                    return;
                }
                inputKeterangan.value = lainnyaText;
            }

            this.action = "/ptsp/medlicense/tolak/" + selectedID;
        });
    });

    function closeBatalkan() {
        document.getElementById("modalWarning").classList.add("hidden");
    }
</script>

<script>

    function toggleDropdown() {
        const menu = document.getElementById('dropdownMenu');
        menu.classList.toggle('hidden');
    }

    function selectDropdown(option) {
        const dropdown = option.closest('.dropdown');
        const button = dropdown.querySelector('button');
        button.firstChild.textContent = option.textContent; // ubah teks tombol
        option.parentElement.classList.add('hidden'); // sembunyikan menu
    }


    // =========================
    // Setujui → kirim ke PTSP Medlicense
    // =========================
    document.addEventListener('DOMContentLoaded', function () {
        const formSetujui = document.getElementById("formSetujui");

        if (formSetujui) {
            formSetujui.addEventListener("submit", function (e) {
                if (!selectedID) {
                    e.preventDefault();
                    alert("Silakan pilih berkas terlebih dahulu dari tabel.");
                    return;
                }

                // Route Medlicense PTSP
                this.action = "/ptsp/medlicense/setujui/" + selectedID;
                
            });
        }
    });

</script>

</html>