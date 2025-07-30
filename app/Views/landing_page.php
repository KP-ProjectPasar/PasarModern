<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Pasar Tangerang - Pasar Modern Tangerang</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#beranda">
                <img src="/assets/img/logo/Logorbg.png" alt="Logo Pasar Modern" class="img-fluid">
                <span class="fw-bold text-primary">E-Pasar Tangerang</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="/">Beranda</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Tentang Kami <i class="bi bi-chevron-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/tentang-kami/ringkasan">Ringkasan</a></li>
                            <li><a class="dropdown-item" href="/tentang-kami/visi-misi">Visi & Misi</a></li>
                            <li><a class="dropdown-item" href="/tentang-kami/peraturan">Peraturan</a></li>
                            <li><a class="dropdown-item" href="/tentang-kami/pesan-direksi">Pesan Direksi</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Informasi <i class="bi bi-chevron-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/informasi/berita">Berita</a></li>
                            <li><a class="dropdown-item" href="/informasi/harga">Harga</a></li>
                            <li><a class="dropdown-item" href="/informasi/informasi-pasar">Informasi Pasar</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#galeri">Galeri</a></li>
                    <li class="nav-item"><a class="nav-link" href="#faq">FAQ</a></li>
                    <li class="nav-item"><a class="nav-link" href="#feedback">Feedback</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="hero d-flex align-items-center" style="min-height: 80vh;">
        <div class="container position-relative z-2">
            <div class="row align-items-center">
                <div class="col-lg-6 text-center text-lg-start mb-4 mb-lg-0">
                    <h1 class="display-4 fw-bold mb-3">Belanja Mudah, Aman, dan Modern di <span class="text-primary">E-Pasar Tangerang</span></h1>
                    <p class="lead mb-4">Temukan kebutuhan harian, cek harga komoditas, dan nikmati layanan digital pasar modern Tangerang. Semua dalam satu klik!</p>
                    <a href="#layanan" class="btn btn-primary btn-lg me-2" aria-label="Jelajahi Layanan"><i class="bi bi-grid-1x2 me-2"></i>Jelajahi Layanan</a>
                    <a href="#feedback" class="btn btn-feedback btn-lg" aria-label="Kirim Feedback"><i class="bi bi-chat-dots me-2"></i>Kirim Feedback</a>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="/assets/img/banner/bannerpasar.jpeg" alt="Banner Pasar Modern" class="img-fluid rounded-4 shadow-lg hero-img">
                </div>
            </div>
        </div>
    </section>

    <!-- Layanan Publik Section -->
    <section id="layanan" class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title text-center">Layanan E-Pasar</h2>
            <div class="row g-4 justify-content-center">
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card h-100 text-center p-3 border-0 shadow-sm layanan-card">
                        <div class="mb-3"><i class="bi bi-basket2-fill text-primary" style="font-size:2.5rem;"></i></div>
                        <h6 class="fw-bold mb-2">Cek Harga Komoditas</h6>
                        <p class="small text-muted">Lihat harga terbaru bahan pokok di pasar modern Tangerang.</p>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card h-100 text-center p-3 border-0 shadow-sm layanan-card">
                        <div class="mb-3"><i class="bi bi-image text-success" style="font-size:2.5rem;"></i></div>
                        <h6 class="fw-bold mb-2">Galeri Pasar</h6>
                        <p class="small text-muted">Lihat suasana dan aktivitas pasar melalui galeri foto kami.</p>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card h-100 text-center p-3 border-0 shadow-sm layanan-card">
                        <div class="mb-3"><i class="bi bi-newspaper text-warning" style="font-size:2.5rem;"></i></div>
                        <h6 class="fw-bold mb-2">Berita & Info</h6>
                        <p class="small text-muted">Update berita, kegiatan, dan pengumuman pasar modern Tangerang.</p>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card h-100 text-center p-3 border-0 shadow-sm layanan-card">
                        <div class="mb-3"><i class="bi bi-geo-alt-fill text-info" style="font-size:2.5rem;"></i></div>
                        <h6 class="fw-bold mb-2">Peta Lokasi Pasar</h6>
                        <p class="small text-muted">Temukan lokasi pasar modern terdekat di Tangerang.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Berita Section (Ringkasan) -->
    <section id="berita" class="py-5">
        <div class="container">
            <h2 class="section-title text-center">Berita & Info Terkini</h2>
            <div class="row g-4" id="beritaList"></div>
            <div class="text-center mt-4">
                <a href="/informasi/berita" class="btn btn-primary">Lihat Semua Berita</a>
            </div>
        </div>
    </section>

    <!-- Harga Komoditas Section (Ringkasan) -->
    <section id="harga" class="py-5 bg-gradient-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Harga Komoditas Hari Ini</h2>
                <p class="text-muted mb-4">Update terakhir: <span class="fw-semibold text-primary"><?= date('d F Y, H:i') ?> WIB</span></p>
            </div>
            <div class="row g-4 justify-content-center" id="komoditasGrid"></div>
            <div class="text-center mt-5">
                <a href="/informasi/harga" class="btn btn-outline-primary btn-lg">
                    <i class="bi bi-list-ul me-2"></i>Lihat Semua Komoditas
                </a>
            </div>
        </div>
    </section>

    <!-- Galeri Section -->
    <section id="galeri" class="py-5">
        <div class="container">
            <h2 class="section-title text-center">Galeri E-Pasar</h2>
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

    <!-- FAQ Section -->
    <section id="faq" class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title text-center">FAQ - Pertanyaan Umum</h2>
            <div class="accordion" id="faqAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faq1">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                            Apa itu E-Pasar Tangerang?
                        </button>
                    </h2>
                    <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="faq1" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            E-Pasar Tangerang adalah platform digital resmi untuk pasar modern di Tangerang, menyediakan informasi harga, berita, galeri, dan layanan publik secara online.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faq2">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                            Bagaimana cara cek harga komoditas?
                        </button>
                    </h2>
                    <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="faq2" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Anda dapat melihat harga komoditas terbaru di section "Harga Komoditas" pada halaman utama E-Pasar.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faq3">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                            Bagaimana cara memberikan feedback atau saran?
                        </button>
                    </h2>
                    <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="faq3" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Silakan isi form pada section "Feedback" di bawah untuk mengirimkan saran, kritik, atau pertanyaan Anda.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faq4">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                            Apakah E-Pasar bisa diakses di mobile?
                        </button>
                    </h2>
                    <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="faq4" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Ya, E-Pasar Tangerang didesain responsif dan dapat diakses dengan baik di perangkat mobile maupun desktop.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Feedback Section -->
    <section id="feedback" class="py-5">
        <div class="container">
            <h2 class="section-title text-center">Kirim Feedback & Saran</h2>
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <form id="feedbackForm" class="card border-0 shadow-sm p-4">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="pesan" class="form-label">Pesan / Saran</label>
                            <textarea class="form-control" id="pesan" name="pesan" rows="4" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Rating</label>
                            <div id="ratingStars" class="mb-2">
                                <i class="bi bi-star" data-value="1"></i>
                                <i class="bi bi-star" data-value="2"></i>
                                <i class="bi bi-star" data-value="3"></i>
                                <i class="bi bi-star" data-value="4"></i>
                                <i class="bi bi-star" data-value="5"></i>
                            </div>
                            <input type="hidden" name="rating" id="rating" value="0">
                        </div>
                        <button type="submit" class="btn btn-primary w-100" aria-label="Kirim Feedback"><i class="bi bi-send me-2"></i>Kirim Feedback</button>
                        <div id="feedbackMsg" class="mt-3"></div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Kontak Section -->
    <section id="kontak" class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title text-center">Kontak & Lokasi</h2>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title text-primary"><i class="bi bi-geo-alt-fill me-2"></i>Kantor</h5>
                            <p class="card-text">Jl. Pasar Modern No. 1, Kota Tangerang, Banten, Indonesia</p>
                            <h5 class="card-title text-primary mt-4"><i class="bi bi-telephone-fill me-2"></i>Telepon</h5>
                            <p class="card-text">(021) 12345678</p>
                            <h5 class="card-title text-primary mt-4"><i class="bi bi-envelope-fill me-2"></i>Email</h5>
                            <p class="card-text">info@epasar-tangerang.go.id</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title text-primary"><i class="bi bi-map-fill me-2"></i>Lokasi</h5>
                            <div class="ratio ratio-16x9">
                                <iframe src="https://www.google.com/maps?q=pasar+modern+tangerang&output=embed" allowfullscreen></iframe>
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
                    <h6>E-Pasar Tangerang</h6>
                    <p class="small">Platform digital pasar modern Tangerang untuk layanan publik, informasi harga, dan berita pasar.</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h6>Link Penting</h6>
                    <ul class="list-unstyled small">
                        <li><a href="#layanan" class="text-white-50">Layanan</a></li>
                        <li><a href="#berita" class="text-white-50">Berita</a></li>
                        <li><a href="#harga" class="text-white-50">Harga</a></li>
                        <li><a href="#galeri" class="text-white-50">Galeri</a></li>
                        <li><a href="#faq" class="text-white-50">FAQ</a></li>
                        <li><a href="#feedback" class="text-white-50">Feedback</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-3">
                    <h6>Kontak Kami</h6>
                    <p class="small">
                        <strong>Kantor:</strong><br>
                        Jl. Pasar Modern No. 1, Kota Tangerang<br>
                        <strong>Telepon:</strong> (021) 12345678<br>
                        <strong>Email:</strong> info@epasar-tangerang.go.id
                    </p>
                </div>
            </div>
            <hr class="my-3">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="small mb-0">&copy; 2024 E-Pasar Tangerang. All Rights Reserved.</p>
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
    <script src="/assets/js/komoditas.js"></script>
    <script src="/assets/js/feedback.js"></script>
</body>
</html> 