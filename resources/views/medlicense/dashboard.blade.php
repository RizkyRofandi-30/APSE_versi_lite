<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PTSP MedLicense</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Ubuntu, Arial, sans-serif;
            background: #eef7f0;
            overflow-x: hidden;
        }

        /* NAVBAR */
        .navbar {
            background: #2f9e44;
            padding: 12px 40px;
            display: flex;
            justify-content: space-between;
            color: white;
            font-weight: bold;
            height: 7vh;
            font-size: 16px;
            position: relative;
            z-index: 100;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.15);
        }

        .navbar-left,
        .navbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .navbar img {
            width: 55px;
        }

        .logout-btn {
            background: #ff4444;
            color: white;
            border: none;
            padding: 8px 18px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            font-size: 14px;
            transition: 0.2s;
            margin-left: 10px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
        }

        .logout-btn:hover {
            background: #ff2222;
            transform: translateY(-2px);
        }

        /* HERO */
        .hero {
            width: 100%;
            height: 93vh;
            position: relative;
            overflow: hidden;
            background: linear-gradient(180deg, #d8f5dd 0%, #fafffa 70%);
        }

        /* ORNAMEN */
        .hero::before {
            content: "";
            position: absolute;
            width: 650px;
            height: 650px;
            top: -160px;
            left: -100px;
            border-radius: 50%;
            background: rgba(120, 220, 150, 0.35);
            filter: blur(80px);
        }

        .hero::after {
            content: "";
            position: absolute;
            width: 600px;
            height: 600px;
            bottom: -180px;
            right: -160px;
            border-radius: 50%;
            background: rgba(90, 180, 120, 0.32);
            filter: blur(90px);
        }

        /* ORNAMEN GRADASI LEWAT DIAGONAL */
        .soft-glow {
            position: absolute;
            width: 800px;
            height: 800px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(25deg);
            background: linear-gradient(135deg, rgba(100, 200, 130, 0.18), rgba(255, 255, 255, 0));
            filter: blur(40px);
            opacity: 0.5;
        }

        /* GAMBAR ORANG — POSISI TETAP SESUAI PERMINTAAN */
        .hero-person {
            position: absolute;
            left: 380px;
            width: 320px;
            top: 100px;
            z-index: 5;
            pointer-events: none;
            transform: scaleX(-1);
            filter: drop-shadow(0 12px 15px rgba(0, 0, 0, 0.18));
        }

        /* KOTAK TEKS */
        .hero-text-box {
            width: 600px;
            position: absolute;
            right: 200px;
            top: 220px;
            z-index: 10;
            padding: 20px 25px;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(8px);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        }

        .hero-text {
            font-size: 30px;
            font-weight: bold;
            text-align: right;
            line-height: 1.35;
            color: #155c2e;
        }

        /* TABLE SECTION */
        .table-section {
            width: 100%;
            background: #b8e6c1;
            padding: 150px 0 200px 0;
            /* ⬅ TAMBAH tinggi */
            position: relative;
        }

        .content-card {
            width: 90%;
            max-width: 1200px;
            background: white;
            margin: -90px auto 40px auto;
            /* ⬅ geser lebih turun biar seimbang */
            border-radius: 22px;
            padding: 50px;
            /* ⬅ tambah padding agar tabel tidak menempel */
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
            position: relative;
            z-index: 20;
        }


        .content-title {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #155c2e;
        }

        .button-area {
            text-align: right;
            margin-bottom: 15px;
        }

        .btn {
            background: #ff8c00;
            text-decoration: none;
            color: white;
            border: none;
            padding: 10px 18px;
            margin-left: 10px;
            border-radius: 50px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.18);
            transition: 0.2s;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #72c472;
            color: white;
        }

        th,
        td {
            padding: 12px;
            border: 1px solid #cdeccc;
            text-align: center;
            font-size: 14px;
        }

        .btn-file {
            background-color: #007bff;
            color: white;
            padding: 7px 14px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 14px;
            /* Tambahkan transisi untuk efek hover yang lebih halus */
            transition: background-color 0.3s ease; 
        }

        .btn-file:hover {
            background-color: #0056b3;
        }

        /* Tombol Tidak Aktif */
        .btn-file.btn-inactive {
            background-color: #6c757d; 
            cursor: not-allowed;
            opacity: 0.7;
        }

        /* Tidak berubah saat hover */
        .btn-file.btn-inactive:hover {
            background-color: #6c757d;
        }

        /* FOOTER */
        .footer {
            background: #2f9e44;
            padding: 22px 50px;
            color: white;
            font-size: 13px;
            box-shadow: 0 -3px 10px rgba(0, 0, 0, 0.15);
        }

        .footer-flex {
            display: flex;
            justify-content: space-between;
        }

        /* MODAL */
        .select-box {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 999;
        }

        .modal-box {
            width: 450px;
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            animation: popup 0.25s ease;
        }

        @keyframes popup {
            from { transform: scale(0.8); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        .modal-header {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .input-wrap {
            margin-bottom: 15px;
            margin-right: 20px;
        }

        .file-input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .btn-submit {
            padding: 8px 15px;
            border-radius: 50px;
            cursor: pointer;
            float: right;
            margin-left: 10px;
            margin-top: 10px;
            border: none;
        }

        .btn-submit-enabled {
            background: #ff8c00;
            color: white;
        }

        .btn-submit-disabled {
            background: #cccccc;
            color: #666666;
            cursor: not-allowed;
        }

        .close-btn {
            background: #e63939;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 50px;
            cursor: pointer;
            float: right;
            margin-left: 10px;   /* Jarak antar tombol */
            margin-top: 10px;    /* Jarak atas */
        }
    </style>

</head>

<body>
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
    <!-- NAVBAR -->
    <div class="navbar">
        <div class="navbar-left">
            <img src="{{ asset('images/medlicense.png') }}" alt="Logo">
            <span>PTSP Kesehatan</span>
        </div>
        <div class="navbar-right">
            <span>Permohonan Saya</span>
            <span>Pengguna</span>
            <form action="{{ route('logout') }}" method="POST" class="absolute right-4">
                @csrf
                <button class="logout-btn" type="submit">Logout</button>
            </form>
        </div>
    </div>

    <!-- HERO -->
    <div class="hero">
        <div class="soft-glow"></div>

        <img src="{{ asset('images/v58_1560.png') }}" class="hero-person">

        <div class="hero-text-box">
            <div class="hero-text">
                Nikmati kemudahan pengajuan PERIZINAN KESEHATAN DENGAN LAYANAN
                PTSP DIGITAL YANG AMAN, CEPAT, DAN TERINTEGRASI UNTUK
                MEMENUHI KEBUTUHAN ANDA
            </div>
        </div>
    </div>

    <!-- TABEL -->
    <div class="table-section">
        <div class="content-card">
            <div class="content-title">
                Pilih layanan kesehatan yang ingin Anda akses.
            </div>
    
            <div class="button-area">
                <a href="{{ route('postPermohonanMedlicense') }}" class="btn">Tambah Permohonan</a>
                <a href="javascript:void(0)" class="btn" onclick="openModal()">Perpanjangan Layanan</a>
            </div>
    
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Jenis Layanan</th>
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                        <th>File</th>
                    </tr>
                </thead>
                <tbody>
                    @if($suratPerizinan->count() > 0)
                        @foreach($suratPerizinan as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ ucfirst($item->jenis_izin) }} Izin {{ ucfirst($item->jenis_profesi) }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</td>
                                <td>{{ $item->user->nama ?? 'N/A' }}</td>
                                <td>
                                    {{ ucfirst($item->status) }}
                                </td>
                                <td>
                                    {{ $item->keterangan ?? '-' }}
                                </td>
                                <td>
                                    <a href="{{ in_array($item->status, ['Diproses', 'Ditolak'])
                                        ? 'javascript:void(0)'
                                        : asset('storage/' . $item->surat_izin_profesi) }}"
                                        target="{{ in_array($item->status, ['Diproses', 'Ditolak']) ? '_self' : '_blank' }}" rel="noopener noreferrer"
                                        class="btn-file {{ in_array($item->status, ['Diproses', 'Ditolak']) ? 'btn-inactive' : '' }}">
                                        Surat izin layanan
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7">Belum ada data</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- FOOTER -->
    <div class="footer">
        <div class="footer-flex">
            <div>
                Customer Service<br>
                📞 +62 812-3456-7890
            </div>
            <div>
                © 2025 Pelayanan Terpadu Sektor Kesehatan
            </div>
        </div>
    </div>

    <!-- MODAL PERPANJANGAN LAYANAN -->
    <div class="modal-overlay" id="modalPerpanjangan">
        <div class="modal-box">
            <div class="modal-header">
                Surat Izin Profesi
            </div>
    
            <form action="{{ route('postPerpanjanganMedlicense') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <select class="select-box" id="jenisProfesi" name="jenis_profesi" required>
                    <option value="" selected disabled hidden>Pilih Profesi</option>
                    <option value="dokter">Dokter</option>
                    <option value="perawat">Perawat</option>
                    <option value="bidan">Bidan</option>
                    <option value="apoteker">Apoteker</option>
                </select>
                <input type="hidden" name="jenis_izin" value="Perpanjangan">
                <input type="file" class="file-input" accept=".pdf" name="izin_profesi_terbit" required>
                <button id="submitButton" class="btn-submit btn-submit-disabled" type="submit" disabled>
                    Kirim
                </button>
                <button type="button" class="close-btn" onclick="closeModal()">Tutup</button>
            </form>
        </div>
    </div>

    <script>

        // Fungsi untuk menampilkan modal
        function openModal() {
            document.getElementById('modalPerpanjangan').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('modalPerpanjangan').style.display = 'none';
        }

        const dropdown = document.getElementById("jenisProfesi");
        const submitButton = document.getElementById("submitButton");

        // JALANKAN setiap kali dropdown berubah
        dropdown.addEventListener("change", checkDropdown);

        function checkDropdown() {
            if (dropdown.value === "" || dropdown.value === null) {
                submitButton.disabled = true;
                submitButton.classList.remove("btn-submit-enabled");
                submitButton.classList.add("btn-submit-disabled");
            } else {
                submitButton.disabled = false;
                submitButton.classList.remove("btn-submit-disabled");
                submitButton.classList.add("btn-submit-enabled");
            }
        }

        // Jalankan saat halaman pertama kali dibuka
        checkDropdown();
    </script>
</body>

</html>