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

        <form action="{{ route('postPermohonanMedlicense') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="jenis_izin" name="Permohonan">
            <!-- DROPDOWN -->   
            <select class="select-box" id="jenisProfesi" name="jenis_profesi" required>
                <option value="" selected disabled hidden>Pilih Profesi</option>
                <option value="dokter">Dokter</option>
                <option value="perawat">Perawat</option>
                <option value="bidan">Bidan</option>
                <option value="apoteker">Apoteker</option>
            </select>
    
    
    
            <!-- BAGIAN A (Sama Semua Profesi) -->
            <div id="bagianA">
                <input type="hidden" name="jenis_izin" value="Permohonan">
                <div class="input-wrap">
                    <label>Surat Permohonan Izin Praktik bermaterai Rp. 10.000,-</label>
                    <input type="file" class="file-input" name="surat_permohonan" accept=".pdf">
                </div>
                
                <div class="input-wrap">
                    <label>KTP</label>
                    <input type="file" class="file-input" name="ktp" accept=".pdf">
                </div>
                
                <div class="input-wrap">
                    <label>STR</label>
                    <input type="file" class="file-input" name="str" accept=".pdf">
                </div>
                
                <div class="input-wrap">
                    <label>Ijazah</label>
                    <input type="file" class="file-input" name="ijazah" accept=".pdf">
                </div>
                
                <div class="input-wrap">
                    <label>Surat keterangan berbadan sehat</label>
                    <input type="file" class="file-input" name="surat_sehat" accept=".pdf">
                </div>
                
                <div class="input-wrap">
                    <label>Pas Photo berwarna 3x4</label>
                    <input type="file" class="file-input" name="pas_foto" accept=".pdf">
                </div>
                
                <div class="input-wrap">
                    <label>NPWP</label>
                    <input type="file" class="file-input" name="npwp" accept=".pdf">
                </div>
                
                <div class="input-wrap">
                    <label>BPJS Ketenagakerjaan</label>
                    <input type="file" class="file-input" name="bpjs_ketenagakerjaan" accept=".pdf">
                </div>
                
                <div class="input-wrap">
                    <label>BPJS Kesehatan</label>
                    <input type="file" class="file-input" name="bpjs_kesehatan" accept=".pdf">
                </div>

                <!-- BAGIAN B (Berbeda Tiap Profesi) -->
                <div id="bagianB"></div>
        
                <button class="" type="submit" id="submitButton" disabled>Ajukan</button>
            </div>
        </form>
            
        </div>
    </div>

    <script>
        const bagianB = document.getElementById("bagianB");
        const dropdown = document.getElementById("jenisProfesi");
        const submitButton = document.getElementById("submitButton");


        // Template untuk masing-masing profesi
        const templateDokter = `
            <div class="input-wrap">
                <label>Izin Praktik Dokter (SIP)</label>
                <input type="file" class="file-input" name="sip_dokter" accept=".pdf">
            </div>

            <div class="input-wrap">
                <label>Surat rekomendasi Organisasi Profesi (IDI / Himpunan Dokter Spesialis)</label>
                <input type="file" class="file-input" name="rekomendasi_idi" accept=".pdf">
            </div>

            <div class="input-wrap">
                <label>Photo Tempat Praktik</label>
                <input type="file" class="file-input" name="foto_tempat_praktik" accept=".pdf">
            </div>

            <div class="input-wrap">
                <label>Surat rekomendasi puskesmas wilayah setempat</label>
                <input type="file" class="file-input" name="rekomendasi_puskesmas" accept=".pdf">
            </div>
        `;

        const templatePerawat = `
            <div class="input-wrap">
                <label>Surat rekomendasi PPNI</label>
                <input type="file" class="file-input" name="rekomendasi_ppni" accept=".pdf">
            </div>

            <div class="input-wrap">
                <label>Surat rekomendasi puskesmas wilayah setempat</label>
                <input type="file" class="file-input" name="rekomendasi_puskesmas" accept=".pdf">
            </div>

            <div class="input-wrap">
                <label>Photo Tempat Praktik</label>
                <input type="file" class="file-input" name="foto_tempat_praktik" accept=".pdf">
            </div>
        `;

        const templateBidan = `
            <div class="input-wrap">
                <label>Surat rekomendasi IBI</label>
                <input type="file" class="file-input" name="rekomendasi_ibi" accept=".pdf">
            </div>

            <div class="input-wrap">
                <label>Surat rekomendasi puskesmas wilayah setempat</label>
                <input type="file" class="file-input" name="rekomendasi_puskesmas" accept=".pdf">
            </div>

            <div class="input-wrap">
                <label>Photo Tempat Praktik</label>
                <input type="file" class="file-input" name="foto_tempat_praktik" accept=".pdf">
            </div>
        `;



        const templateApoteker = `
            <div class="input-wrap">
                <label>Surat rekomendasi IAI</label>
                <input type="file" class="file-input" name="rekomendasi_iai" accept=".pdf">
            </div>

            <div class="input-wrap">
                <label>Surat Keterangan Tempat Kerja / Apotek</label>
                <input type="file" class="file-input" name="surat_tempat_kerja" accept=".pdf">
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

        dropdown.addEventListener("change", checkDropdown);
        checkDropdown();

        // Atur form dinamis
        function updateForm() {
            const profesi = dropdown.value;

            if (profesi === "dokter") {
                bagianB.innerHTML = templateDokter;
            } else if (profesi === "perawat") {
                bagianB.innerHTML = templatePerawat;
            } else if (profesi === "bidan") {
                bagianB.innerHTML = templateBidan;
            } else if (profesi === "apoteker") {
                bagianB.innerHTML = templateApoteker;
            } else {
                bagianB.innerHTML = "";
            }
        }
        dropdown.addEventListener("change", updateForm);

        // Saat halaman pertama kali dibuka, kosongkan bagian B
        bagianB.innerHTML = "";
    </script>


</body>

</html>