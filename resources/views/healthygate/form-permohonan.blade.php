<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Permohonan</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            background: #f5f5f5;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 420px;
            margin: 30px auto;
            background: #ffffff;
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.07);
        }

        h2 {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-size: 13px;
            font-weight: 500;
        }

        .select-box {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
            font-size: 14px;
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

        .btn-submit-enabled {
            width: 100%;
            padding: 12px;
            background: #ff9800;
            color: #fff;
            border: none;
            border-radius: 25px;
            font-size: 15px;
            cursor: pointer;
            margin-top: 10px;
        }

        .btn-submit-disabled {
            width: 100%;
            padding: 12px;
            background: #dba24e;
            color: #fff;
            border: none;
            border-radius: 25px;
            font-size: 15px;
            cursor: not-allowed;
            margin-top: 10px;
        }

        .btn-submit:hover {
            background: #ff8c00;
        }
    </style>

</head>

<body>

    <div class="container">
        <h2>FORM PERMOHONAN</h2>

        <form action="{{ route('postPermohonanHealthygate') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="jenis_izin" value="Permohonan">
            <!-- DROPDOWN -->
            <select class="select-box" id="jenisUsaha" name="jenis_usaha" required>
                <option value="" selected disabled hidden>Pilih Jenis Usaha</option>
                <option value="apotik">Apotik</option>
                <option value="klinik">Klinik</option>
            </select>
            
            
            
            <!-- BAGIAN A (Sama Semua Profesi) -->
            <div id="bagianA">
            
                <div class="input-wrap">
                    <label>Surat Permohonan Izin Praktik bermaterai Rp. 10.000,-</label>
                    <input type="file" class="file-input" name="surat_permohonan" accept=".pdf">
                </div>
            
                <div class="input-wrap">
                    <label>KTP Pemilik Usaha</label>
                    <input type="file" class="file-input" name="ktp_pemilik" accept=".pdf">
                </div>
            
                <div class="input-wrap">
                    <label>NPWP Pemilik Usaha</label>
                    <input type="file" class="file-input" name="npwp_pemilik" accept=".pdf">
                </div>
            
                <div class="input-wrap">
                    <label>Nomor Induk Berusaha (NIB)</label>
                    <input type="file" class="file-input" name="nib" accept=".pdf">
                </div>
            </div>
            
            <!-- BAGIAN B (Berbeda Tiap Profesi) -->
            <div id="bagianB"></div>
            <button class="" type="submit" id="submitButton" disabled>Ajukan</button>
        </form>
    </div>

    <script>
        const bagianB = document.getElementById("bagianB");
        const dropdown = document.getElementById("jenisUsaha");
        const submitButton = document.getElementById("submitButton");

        // Semua template memakai struktur yang sama seperti Bagian A
        const templateApotik = `
            <div class="input-wrap">
                <label>Surat Izin Praktik Apotik dan KTP Penanggung Jawab Apotik</label>
                <input type="file" class="file-input" name="sip_apt_jawab" accept=".pdf">
            </div>

            <div class="input-wrap">
                <label>Denah Lokasi Bangunan</label>
                <input type="file" class="file-input" name="denah_lokasi" accept=".pdf">
            </div>

            <div class="input-wrap">
                <label>Denah Ruangan</label>
                <input type="file" class="file-input" name="denah_ruangan" accept=".pdf">
            </div>

            <div class="input-wrap">
                <label>Surat Izin Praktik dan KTP Asisten Apoteker</label>
                <input type="file" class="file-input" name="sip_asisten_apoteker" accept=".pdf">
            </div>

            <div class="input-wrap">
                <label>Daftar Peralatan Apotik</label>
                <input type="file" class="file-input" name="daftar_peralatan_apotik" accept=".pdf">
            </div>

            <div class="input-wrap">
                <label>Surat rekomendasi puskesmas wilayah setempat</label>
                <input type="file" class="file-input" name="rekom_puskesmas" accept=".pdf">
            </div>

            <div class="input-wrap">
                <label>IMB/PBG</label>
                <input type="file" class="file-input" name="imb_pbg" accept=".pdf">
            </div>

            <div class="input-wrap">
                <label>Tanda Lunas PBB tahun berjalan</label>
                <input type="file" class="file-input" name="pbb_tahun" accept=".pdf">
            </div>

            <div class="input-wrap">
                <label>Dokumen Lingkungan/SPPL</label>
                <input type="file" class="file-input" name="sppl" accept=".pdf">
            </div>

            <div class="input-wrap">
                <label>BPJS Ketenagakerjaan Apoteker</label>
                <input type="file" class="file-input" name="bpjs_apoteker" accept=".pdf">
            </div>

            <div class="input-wrap">
                <label>BPJS Ketenagakerjaan Asisten Apoteker</label>
                <input type="file" class="file-input" name="bpjs_asisten" accept=".pdf">
            </div>

            <div class="input-wrap">
                <label>BPJS Kesehatan Asisten Apoteker</label>
                <input type="file" class="file-input" name="bpjs_kesehatan_asisten" accept=".pdf">
            </div>

            <div class="input-wrap">
                <label>Pas Photo berwarna ukuran 4x6</label>
                <input type="file" class="file-input" name="pas_foto" accept=".pdf">
            </div>
        `;


        const templateKlinik = `
            <div class="input-wrap">
                <label>BPJS Kesehatan Pemilik Klinik</label>
                <input type="file" class="file-input" name="bpjs_pemilik" accept=".pdf">
            </div>

            <div class="input-wrap">
                <label>Daftar Obat-obatan</label>
                <input type="file" class="file-input" name="daftar_obat" accept=".pdf">
            </div>

            <div class="input-wrap">
                <label>Surat Izin Praktik Semua Tenaga Kesehatan Klinik</label>
                <input type="file" class="file-input" name="surat_izin_tenaga_kesehatan" accept=".pdf">
            </div>

            <div class="input-wrap">
                <label>Perjanjian Kerja Sama Pembuangan Limbah B3</label>
                <input type="file" class="file-input" name="perjanjian_limbah_b3" accept=".pdf">
            </div>

            <div class="input-wrap">
                <label>Deskripsi Pengorganisasian</label>
                <input type="file" class="file-input" name="deskripsi_pengorganisasian" accept=".pdf">
            </div>

            <div class="input-wrap">
                <label>Lokasi Bangunan</label>
                <input type="file" class="file-input" name="lokasi_bangunan" accept=".pdf">
            </div>

            <div class="input-wrap">
                <label>Prasarana, Ketenagaan</label>
                <input type="file" class="file-input" name="prasarana_ketenagaan" accept=".pdf">
            </div>

            <div class="input-wrap">
                <label>Peralatan Kesehatan</label>
                <input type="file" class="file-input" name="peralatan_kesehatan" accept=".pdf">
            </div>

            <div class="input-wrap">
                <label>Kefarmasian</label>
                <input type="file" class="file-input" name="kefarmasian" accept=".pdf">
            </div>

            <div class="input-wrap">
                <label>Laboratorium</label>
                <input type="file" class="file-input" name="laboratorium" accept=".pdf">
            </div>
        `;

        
        function checkDropdown() {
            if (dropdown.value === "" || dropdown.value === null) {
                // Jika belum dipilih
                submitButton.disabled = true;
                submitButton.classList.remove("btn-submit-enabled");
                submitButton.classList.add("btn-submit-disabled");
            } else {
                // Jika sudah dipilih
                submitButton.disabled = false;
                submitButton.classList.remove("btn-submit-disabled");
                submitButton.classList.add("btn-submit-enabled");
            }
        }

        checkDropdown();

        dropdown.addEventListener("change", checkDropdown);

        function updateForm() {
            const profesi = dropdown.value;

            switch (profesi) {
                case "apotik":
                    bagianB.innerHTML = templateApotik;
                    break;
                case "klinik":
                    bagianB.innerHTML = templateKlinik;
                    break;
                default:
                    bagianB.innerHTML = "";
            }
        }

        dropdown.addEventListener("change", updateForm);

        // Default halaman pertama kali dibuka → Bagian B kosong
        bagianB.innerHTML = "";

    </script>



</body>

</html>