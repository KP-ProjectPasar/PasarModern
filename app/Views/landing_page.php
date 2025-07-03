<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasar Modern Pemerintahan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <!-- Header & Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="/assets/img/Logorbg.png" alt="Logo" class="logo me-2">
                <span class="fw-bold">Pasar Modern</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="#berita">Berita</a></li>
                    <li class="nav-item"><a class="nav-link" href="#galeri">Galeri</a></li>
                    <li class="nav-item"><a class="nav-link" href="#video">Video</a></li>
                    <li class="nav-item"><a class="nav-link" href="#harga">Harga Barang</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero text-center d-flex align-items-center justify-content-center" style="min-height: 60vh;">
        <div class="container">
            <h1 class="display-4 fw-bold">Selamat Datang di Pasar Modern</h1>
            <p class="lead">Pusat Belanja Terlengkap, Aman, dan Nyaman untuk Kebutuhan Anda</p>
            <a href="#harga" class="btn btn-primary btn-lg mt-3">Lihat Harga Barang</a>
        </div>
    </section>

    <!-- Tentang Section -->
    <section id="tentang" class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title text-center">Tentang Pasar Modern</h2>
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p>Pasar Modern adalah pusat perdagangan yang dikelola oleh pemerintah daerah, menyediakan berbagai kebutuhan pokok dan produk segar dengan harga terjangkau. Kami berkomitmen memberikan pelayanan terbaik, lingkungan yang bersih, serta fasilitas modern untuk kenyamanan pengunjung dan pedagang.</p>
                    <ul>
                        <li><b>Visi:</b> Menjadi pasar modern terbaik, bersih, dan terpercaya.</li>
                        <li><b>Misi:</b> Memberikan pelayanan prima, menjaga kualitas produk, dan mendukung perekonomian lokal.</li>
                    </ul>
                </div>
                <div class="col-md-6 text-center">
                    <img src="/assets/img/Logorbg.png" alt="Logo Pasar" class="img-fluid" style="max-height: 180px;">
                </div>
            </div>
        </div>
    </section>

    <!-- Berita Section -->
    <section id="berita" class="py-5">
        <div class="container">
            <h2 class="section-title text-center">Berita Terbaru</h2>
            <div class="row" id="berita-list">
                <!-- Dummy berita, nanti diganti AJAX -->
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="https://source.unsplash.com/400x250/?market,news" class="card-img-top" alt="Berita 1">
                        <div class="card-body">
                            <h5 class="card-title">Peresmian Fasilitas Baru</h5>
                            <p class="card-text">Pasar Modern kini memiliki area parkir baru dan fasilitas ramah difabel.</p>
                            <a href="#" class="btn btn-outline-primary btn-sm">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="https://source.unsplash.com/400x250/?market,people" class="card-img-top" alt="Berita 2">
                        <div class="card-body">
                            <h5 class="card-title">Promo Belanja Akhir Pekan</h5>
                            <p class="card-text">Dapatkan diskon menarik untuk produk segar setiap akhir pekan di Pasar Modern.</p>
                            <a href="#" class="btn btn-outline-primary btn-sm">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="https://source.unsplash.com/400x250/?market,food" class="card-img-top" alt="Berita 3">
                        <div class="card-body">
                            <h5 class="card-title">Lomba Kebersihan Kios</h5>
                            <p class="card-text">Ayo ikuti lomba kebersihan kios dan menangkan hadiah menarik dari pengelola pasar.</p>
                            <a href="#" class="btn btn-outline-primary btn-sm">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-3">
                <a href="#" class="btn btn-primary">Lihat Semua Berita</a>
            </div>
        </div>
    </section>

    <!-- Galeri Section -->
    <section id="galeri" class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title text-center">Galeri Foto</h2>
            <div class="row g-3" id="galeri-list">
                <!-- Galeri dengan gambar lokal -->
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

    <!-- Video Section -->
    <section id="video" class="py-5">
        <div class="container">
            <h2 class="section-title text-center">Video Kegiatan</h2>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/c3Tcq_jTJvw" title="Video Kegiatan" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Harga Barang Section -->
    <section id="harga" class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title text-center">Harga Barang Hari Ini</h2>
            <ul class="nav nav-pills justify-content-center price-tab mb-4" id="hargaTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="basah-tab" data-bs-toggle="pill" data-bs-target="#basah" type="button" role="tab">Basah</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="kering-tab" data-bs-toggle="pill" data-bs-target="#kering" type="button" role="tab">Kering</button>
                </li>
            </ul>
            <div class="tab-content" id="hargaTabContent">
                <div class="tab-pane fade show active" id="basah" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-primary">
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Satuan</th>
                                    <th>Harga (Rp)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td>Daging Sapi</td><td>Kg</td><td>120.000</td></tr>
                                <tr><td>Daging Ayam</td><td>Kg</td><td>38.000</td></tr>
                                <tr><td>Ikan Lele</td><td>Kg</td><td>28.000</td></tr>
                                <tr><td>Sayur Bayam</td><td>Ikatan</td><td>5.000</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="kering" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-primary">
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Satuan</th>
                                    <th>Harga (Rp)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td>Beras</td><td>Kg</td><td>14.000</td></tr>
                                <tr><td>Gula Pasir</td><td>Kg</td><td>16.000</td></tr>
                                <tr><td>Minyak Goreng</td><td>Liter</td><td>18.000</td></tr>
                                <tr><td>Bawang Merah</td><td>Kg</td><td>32.000</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Kontak Section -->
    <section id="kontak" class="py-5">
        <div class="container">
            <h2 class="section-title text-center">Kontak & Lokasi</h2>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <h5>Alamat</h5>
                    <p>Jl. Pasar Modern No. 1, Kota Anda, Provinsi, Indonesia</p>
                    <h5>Telepon</h5>
                    <p>(021) 12345678</p>
                    <h5>Email</h5>
                    <p>info@pasarmodern.go.id</p>
                </div>
                <div class="col-md-6">
                    <h5>Lokasi</h5>
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.google.com/maps?q=pasar+modern&output=embed" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer text-center">
        <div class="container">
            <div class="mb-2">
                <a href="#" class="text-white me-3"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-white me-3"><i class="bi bi-instagram"></i></a>
                <a href="#" class="text-white me-3"><i class="bi bi-twitter"></i></a>
            </div>
            <div>&copy; <?= date('Y') ?> Pasar Modern.</div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/landing.js"></script>
</body>
</html> 