<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perumda Pasar Modern - Website Resmi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <!-- Header & Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="/assets/img/Logorbg.png" alt="Logo" class="logo me-2">
                <span class="fw-bold">Perumda Pasar Modern</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">Beranda</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            Tentang Kami
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#selayang-pandang">Selayang Pandang</a></li>
                            <li><a class="dropdown-item" href="#visi-misi">Visi & Misi</a></li>
                            <li><a class="dropdown-item" href="#organisasi">Organisasi</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            Informasi
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#berita">Berita</a></li>
                            <li><a class="dropdown-item" href="#kegiatan">Info & Kegiatan</a></li>
                            <li><a class="dropdown-item" href="#harga">Harga Komoditas</a></li>
                            <li><a class="dropdown-item" href="#lokasi">Peta Lokasi Pasar</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#galeri">Galeri Foto</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kontak">Kontak Kami</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero text-center d-flex align-items-center justify-content-center" style="min-height: 60vh;">
        <div class="container">
            <h1 class="display-4 fw-bold">Perumda Pasar Modern</h1>
            <p class="lead">Website Resmi Perumda Pasar Modern ini menyajikan berbagai ragam informasi tentang pasar modern dan tradisional yang dikelola oleh pemerintah daerah</p>
            <a href="#harga" class="btn btn-light btn-lg mt-3">Lihat Harga Komoditas</a>
        </div>
    </section>

    <!-- Info Cards Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="bi bi-house-door-fill text-primary mb-3" style="font-size: 3rem;"></i>
                            <h5 class="card-title">Selamat Datang</h5>
                            <p class="card-text">Website Resmi Perumda Pasar Modern ini menyajikan berbagai ragam informasi tentang pasar modern dan tradisional yang ada di wilayah kami.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="bi bi-currency-dollar text-success mb-3" style="font-size: 3rem;"></i>
                            <h5 class="card-title">Info Harga</h5>
                            <p class="card-text">Perkembangan harga rata-rata sembako dan bahan-bahan penting lainnya berdasarkan kelompok yang telah ditentukan sebelumnya.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="bi bi-geo-alt-fill text-info mb-3" style="font-size: 3rem;"></i>
                            <h5 class="card-title">Peta Lokasi Pasar</h5>
                            <p class="card-text">Beberapa pasar yang dikelompokan berdasarkan potensi dan kedekatan lokasi dalam satu wilayah untuk memudahkan koordinasi.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Berita Section -->
    <section id="berita" class="py-5">
        <div class="container">
            <h2 class="section-title text-center">BERITA LAINNYA</h2>
            <div class="row" id="berita-list">
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="https://source.unsplash.com/400x250/?market,visit" class="card-img-top" alt="Kunjungan Kerja">
                        <div class="card-body">
                            <h6 class="card-title text-primary">Kunjungan Kerja Perumda Pasar Sewakadarma Bali ke Pasar Modern</h6>
                            <p class="text-muted small">Sabtu, 25 Mei 2024</p>
                            <p class="card-text">Kunjungan kerja dalam rangka studi banding pengelolaan pasar modern dan pertukaran informasi best practices.</p>
                            <a href="#" class="btn btn-outline-primary btn-sm">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="https://source.unsplash.com/400x250/?charity,children" class="card-img-top" alt="Santunan Anak Yatim">
                        <div class="card-body">
                            <h6 class="card-title text-primary">Kegiatan Tasyakuran dan Santunan Anak Yatim di Pasar Modern</h6>
                            <p class="text-muted small">Jum'at, 26 April 2024</p>
                            <p class="card-text">Kegiatan sosial dalam rangka memberikan bantuan kepada anak yatim dan dhuafa di sekitar pasar modern.</p>
                            <a href="#" class="btn btn-outline-primary btn-sm">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="https://source.unsplash.com/400x250/?food,monitoring" class="card-img-top" alt="Pemantauan Harga">
                        <div class="card-body">
                            <h6 class="card-title text-primary">Kegiatan Pemantauan Harga dan Pasokan Bahan Pangan di Pasar Modern</h6>
                            <p class="text-muted small">Kamis, 07 Maret 2024</p>
                            <p class="card-text">Pemantauan rutin untuk memastikan stabilitas harga dan ketersediaan bahan pangan di pasar modern.</p>
                            <a href="#" class="btn btn-outline-primary btn-sm">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Harga Komoditas Section -->
    <section id="harga" class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title text-center">INFO HARGA KOMODITAS</h2>
            <p class="text-center mb-4">Harga yang ditampilkan merupakan harga komoditas hari ini atau data terakhir dari <strong>Pasar Modern</strong>:</p>
            
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>Komoditas</th>
                                            <th class="text-end">Harga (Rp)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr><td>Beras IR I</td><td class="text-end">14,000.00</td></tr>
                                        <tr><td>Beras IR II</td><td class="text-end">13,000.00</td></tr>
                                        <tr><td>Gula Pasir Lokal</td><td class="text-end">19,000.00</td></tr>
                                        <tr><td>Minyak Goreng Curah</td><td class="text-end">19,000.00</td></tr>
                                        <tr><td>Daging Sapi</td><td class="text-end">140,000.00</td></tr>
                                        <tr><td>Daging Ayam Broiler</td><td class="text-end">40,000.00</td></tr>
                                        <tr><td>Telur Ayam Broiler</td><td class="text-end">29,000.00</td></tr>
                                        <tr><td>Telur Ayam Kampung</td><td class="text-end">3,000.00</td></tr>
                                        <tr><td>Susu Kental Bendera (397 gr)</td><td class="text-end">13,000.00</td></tr>
                                        <tr><td>Susu Kental Indomilk (397 gr)</td><td class="text-end">13,000.00</td></tr>
                                        <tr><td>Garam Halus (250 gr)</td><td class="text-end">3,000.00</td></tr>
                                        <tr><td>Garam Bata</td><td class="text-end">15,000.00</td></tr>
                                        <tr><td>Tepung Terigu</td><td class="text-end">13,000.00</td></tr>
                                        <tr><td>Kacang Kedelai (Ext/Impor)</td><td class="text-end">16,000.00</td></tr>
                                        <tr><td>Mie Instant (Indomie)</td><td class="text-end">3,000.00</td></tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-center mt-3">
                                <a href="#" class="btn btn-primary">Lihat harga selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Galeri Section -->
    <section id="galeri" class="py-5">
        <div class="container">
            <h2 class="section-title text-center">GALERI FOTO</h2>
            <div class="row g-3" id="galeri-list">
                <div class="col-6 col-md-3">
                    <img src="/assets/img/pasar1.jpeg" class="w-100 gallery-img" alt="Galeri Pasar 1">
                </div>
                <div class="col-6 col-md-3">
                    <img src="/assets/img/pasar2.jpeg" class="w-100 gallery-img" alt="Galeri Pasar 2">
                </div>
                <div class="col-6 col-md-3">
                    <img src="/assets/img/pasar3.jpeg" class="w-100 gallery-img" alt="Galeri Pasar 3">
                </div>
                <div class="col-6 col-md-3">
                    <img src="/assets/img/pasar4.jpeg" class="w-100 gallery-img" alt="Galeri Pasar 4">
                </div>
                <div class="col-6 col-md-3">
                    <img src="/assets/img/pasar5.jpeg" class="w-100 gallery-img" alt="Galeri Pasar 5">
                </div>
                <div class="col-6 col-md-3">
                    <img src="/assets/img/pasar6.jpeg" class="w-100 gallery-img" alt="Galeri Pasar 6">
                </div>
                <div class="col-6 col-md-3">
                    <img src="/assets/img/pasar7.jpeg" class="w-100 gallery-img" alt="Galeri Pasar 7">
                </div>
                <div class="col-6 col-md-3">
                    <img src="/assets/img/pasar8.jpeg" class="w-100 gallery-img" alt="Galeri Pasar 8">
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang Kami Section -->
    <section id="selayang-pandang" class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title text-center">TENTANG KAMI</h2>
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h4>Perumda Pasar Modern</h4>
                    <p class="lead">Visi - Menjadikan Perusahaan Daerah Pasar sebagai bagian penggerak perekonomian daerah dengan membangun dan mengembangkan pasar yang representatif.</p>
                    <p>Perumda Pasar Modern adalah perusahaan daerah yang bertugas mengelola dan mengembangkan pasar-pasar tradisional dan modern di wilayah kami. Kami berkomitmen memberikan pelayanan terbaik kepada pedagang dan pengunjung pasar.</p>
                    <div class="row mt-4">
                        <div class="col-6">
                            <h6><i class="bi bi-check-circle-fill text-success me-2"></i>Pasar Modern</h6>
                            <h6><i class="bi bi-check-circle-fill text-success me-2"></i>Pasar Tradisional</h6>
                        </div>
                        <div class="col-6">
                            <h6><i class="bi bi-check-circle-fill text-success me-2"></i>Pasar Keliling</h6>
                            <h6><i class="bi bi-check-circle-fill text-success me-2"></i>Pasar Digital</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <img src="/assets/img/Logorbg.png" alt="Logo Pasar" class="img-fluid" style="max-height: 200px;">
                </div>
            </div>
        </div>
    </section>

    <!-- Kontak Section -->
    <section id="kontak" class="py-5">
        <div class="container">
            <h2 class="section-title text-center">KONTAK KAMI</h2>
            <p class="text-center mb-5">Kami terbuka untuk komunikasi pada pertanyaan apa pun. Berikut kontak kami yang dapat anda hubungi:</p>
            
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title text-primary"><i class="bi bi-geo-alt-fill me-2"></i>Kantor</h5>
                            <p class="card-text">Jl. Pasar Modern No. 1, Kota Anda, Provinsi, Indonesia</p>
                            
                            <h5 class="card-title text-primary mt-4"><i class="bi bi-telephone-fill me-2"></i>Telepon</h5>
                            <p class="card-text">(021) 12345678</p>
                            
                            <h5 class="card-title text-primary mt-4"><i class="bi bi-envelope-fill me-2"></i>Email</h5>
                            <p class="card-text">info@pasarmodern.go.id</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title text-primary"><i class="bi bi-map-fill me-2"></i>Lokasi</h5>
                            <div class="ratio ratio-16x9">
                                <iframe src="https://www.google.com/maps?q=pasar+modern&output=embed" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer text-center bg-dark text-white">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h6>Perumda Pasar Modern</h6>
                    <p class="small">Visi - Menjadikan Perusahaan Daerah Pasar sebagai bagian penggerak perekonomian daerah dengan membangun dan mengembangkan pasar yang representatif.</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h6>Link & Afiliasi</h6>
                    <ul class="list-unstyled small">
                        <li><a href="#" class="text-white-50">Pemerintah Daerah</a></li>
                        <li><a href="#" class="text-white-50">Satu Data</a></li>
                        <li><a href="#" class="text-white-50">PDAM</a></li>
                        <li><a href="#" class="text-white-50">Asparindo</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-3">
                    <h6>Kontak Kami</h6>
                    <p class="small">
                        <strong>Kantor:</strong><br>
                        Jl. Pasar Modern No. 1, Kota Anda<br>
                        <strong>Telepon:</strong> (021) 12345678<br>
                        <strong>Email:</strong> info@pasarmodern.go.id
                    </p>
                </div>
            </div>
            <hr class="my-3">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="small mb-0">&copy; 2024 Perumda Pasar Modern. All Rights Reserved.</p>
                </div>
                <div class="col-md-6">
                    <div class="social-links">
                        <a href="#" class="text-white me-3"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-white me-3"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="text-white me-3"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/landing.js"></script>
</body>
</html> 