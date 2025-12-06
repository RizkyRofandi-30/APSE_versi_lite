<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PTSP Kesehatan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #f7f7f7;
        }

        /* NAVBAR */
        .navbar {
            background-color: #073B5E;
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-container {
            max-width: 1300px;
            margin: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .logo {
            color: white;
            font-size: 20px;
            font-weight: 600;
        }

        .nav-menu {
            list-style: none;
            display: flex;
            gap: 30px;
        }

        .nav-menu li a {
            color: white;
            text-decoration: none;
            font-size: 14px;
        }

        /* HERO */
        .hero {
            background-color: #CBE3FF;
            padding: 80px 0;
        }

        .hero-content {
            width: 90%;
            max-width: 1300px;
            display: flex;
            margin: auto;
            align-items: center;
            justify-content: space-between;
            gap: 40px;
        }

        .hero-image {
            width: 100%;
            max-width: 450px;
        }

        /* SECTION */
        .section {
            padding: 80px 20px;
            text-align: center;
        }

        .section-title {
            font-size: 32px;
            margin-bottom: 50px;
            color: #073B5E;
        }

        /* VISI MISI */
        .visi-misi-grid {
            display: flex;
            justify-content: center;
            gap: 40px;
            flex-wrap: wrap;
        }

        .card {
            background: white;
            padding: 30px;
            width: 350px;
            border-radius: 10px;
            box-shadow: 0 3px 10px #00000015;
            text-align: left;
        }

        /* MICROservices */
        .service-grid {
            display: flex;
            justify-content: center;
            gap: 40px;
            flex-wrap: wrap;
        }

        .service-card {
            background: transparent;
            box-shadow: none;
            width: 400px;
            padding: 5px;
            border-radius: 10px;
        }

        /* SYARAT */
        .requirements {
            background: #f8f9fa;
            padding: 4rem 20px;
        }

        .req-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .req-card {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            border: 2px solid #ddd;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .req-card h4 {
            color: #1e3a5f;
            margin-bottom: 1rem;
            font-size: 0.95rem;
            line-height: 1.4;
        }

        .req-card ol {
            padding-left: 1.2rem;
            font-size: 0.85rem;
        }

        .req-card li {
            margin-bottom: 0.5rem;
        }

        .section-title {
            text-align: center;
            color: #1e3a5f;
            font-size: 2rem;
            margin-bottom: 3rem;
        }



        /* FOOTER */
        .footer {
            background: #1e3a5f;
            /* dari hijau tua */
            padding: 22px 50px;
            color: white;
            font-size: 13px;
            box-shadow: 0 -3px 10px rgba(0, 0, 0, 0.15);
        }

        .footer-flex {
            display: flex;
            justify-content: space-between;
        }


        /* RESPONSIVE */
        @media (max-width: 900px) {
            .hero-content {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="nav-container">
            <img src="{{ asset('images/ptsp.png') }}" alt="" style="width: 60px">   
            <ul class="nav-menu">
                <li><a href="#visi">Visi & Misi</a></li>
                <li><a href="#microservices">Microservices</a></li>
                <li><a href="#syarat">Syarat Perizinan</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- HERO -->
    <section class="hero">
        <div class="hero-content">
            <div class="hero-left">
                <img src="{{ asset('images/v58_990.png') }}" class="hero-image">
            </div>
            <div class="hero-right">
                <h2>Layanan Perizinan Kesehatan Terintegrasi,<br>Akses seluruh layanan kesehatan dalam satu sistem yang
                    efektif dan terpercaya.</h2>
            </div>
        </div>
    </section>

    <!-- VISI MISI -->
    <section id="visi" class="section">
        <h2 class="section-title">Visi & Misi</h2>

        <div class="visi-misi-grid">
            <div class="card">
                <h3>Visi</h3>
                <p>Mewujudkan layanan perizinan kesehatan terpadu yang cepat, efektif, dan terpercaya.</p>
            </div>

            <div class="card">
                <h3>Misi</h3>
                <ul>
                    <li>Meningkatkan kualitas layanan kesehatan.</li>
                    <li>Mempermudah proses administrasi perizinan.</li>
                    <li>Mempercepat integrasi data kesehatan.</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- MICROSERVICES -->
    <section id="microservices" class="section" style="background-color:#CBE3FF;">
        <h2 class="section-title">Microservices</h2>
    
        <div class="service-grid">
            <a href="/login?source=medlicense" class="service-link"
                style="color:black;text-decoration:none;">
                <div class="service-card">
                    <img src="{{ asset('images/medlicense.png') }}" alt="logo_medlicense">
                </div>
            </a>
    
            <a href="/login?source=healthygate" class="service-link"
                style="color:black;text-decoration:none;">
                <div class="service-card">
                    <img src="{{ asset('images/healthygate.png') }}" alt="logo_healthygate">
                </div>
            </a>
        </div>
    </section>


    <!-- SYARAT PERIZINAN -->
    <section id="requirements" class="requirements">
        <div class="container">
            <h2 class="section-title">Persyaratan Izin</h2>
            <div class="req-grid">
                <div class="req-card">
                    <h4>Izin Praktik DOKTER/DOKTER GIGI</h4>
                    <ol>
                        <li>Pas foto berwarna ukuran 4x6 (2 lembar)</li>
                        <li>Surat rekomendasi dari IDI/PDGI</li>
                        <li>Fotokopi Ijazah dan STR yang masih berlaku</li>
                        <li>Surat keterangan sehat dari dokter yang memiliki SIP</li>
                        <li>Surat keterangan dari tempat praktik/kerja</li>
                        <li>Fotokopi KTP dan NPWP</li>
                        <li>Surat pernyataan memiliki tempat praktik</li>
                    </ol>
                </div>
                <div class="req-card">
                    <h4>Izin Praktik PERAWAT</h4>
                    <ol>
                        <li>Surat permohonan izin ditandatangani pemohon</li>
                        <li>Fotokopi Ijazah</li>
                        <li>Fotokopi STR yang masih berlaku</li>
                        <li>Surat rekomendasi dari organisasi profesi</li>
                        <li>Pas foto berwarna ukuran 4x6 (4 lembar)</li>
                        <li>Fotokopi KTP</li>
                    </ol>
                </div>
                <div class="req-card">
                    <h4>Izin Praktik BIDAN</h4>
                    <ol>
                        <li>Surat permohonan</li>
                        <li>Fotokopi ijazah</li>
                        <li>Fotokopi STR yang masih berlaku</li>
                        <li>Surat rekomendasi dari IBI</li>
                        <li>Surat keterangan sehat dari dokter</li>
                        <li>Pas foto 4x6 (4 lembar)</li>
                    </ol>
                </div>
                <div class="req-card">
                    <h4>Izin Praktik APOTEKER</h4>
                    <ol>
                        <li>Fotokopi KTP</li>
                        <li>Fotokopi Ijazah</li>
                        <li>Fotokopi STR yang berlaku</li>
                        <li>Surat pernyataan dari tempat praktik</li>
                        <li>Pas foto 4x6 (4 lembar)</li>
                        <li>Surat rekomendasi dari organisasi profesi</li>
                    </ol>
                </div>
                <div class="req-card">
                    <h4>Izin Praktik DOKTER/DOKTER GIGI</h4>
                    <ol>
                        <li>Fotokopi KTP pemohon</li>
                        <li>Pas foto 4x6 (4 lembar)</li>
                        <li>Fotokopi IMB/status tanah</li>
                        <li>Denah bangunan yang telah disetujui</li>
                        <li>Daftar peralatan medis dan non medis</li>
                    </ol>
                </div>
                <div class="req-card">
                    <h4>Izin Praktik DOKTER/DOKTER GIGI (Lanjut)</h4>
                    <ol>
                        <li>Daftar tenaga kesehatan</li>
                        <li>Surat pernyataan kesanggupan</li>
                        <li>Rekomendasi dari dinas kesehatan</li>
                        <li>NPWP fasilitas kesehatan</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>


    <!-- FOOTER -->
    <div class="footer">
        <div class="footer-flex">
            <div>
                Customer Service<br>
                📞 +62 812-3456-7890
            </div>
            <div>
                © Copyright 2025 Pelayan Terpadu Sektor Kesehatan. All Right Reserved
            </div>
        </div>
    </div>

</body>

</html>