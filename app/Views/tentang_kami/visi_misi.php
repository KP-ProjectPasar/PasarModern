<?php
// Data dinamis dari controller/admin panel
$visi = $visi ?? 'Menjadi ekosistem pasar modern terdepan di Indonesia yang menginspirasi, memberdayakan, dan berkelanjutan melalui pelayanan prima, inovasi teknologi, serta kolaborasi komunitas.';
$misi = $misi ?? [
    'Menghadirkan layanan publik yang unggul, ramah, dan mudah diakses oleh seluruh lapisan masyarakat.',
    'Mendorong digitalisasi dan transparansi informasi harga serta aktivitas pasar secara real-time.',
    'Mendukung pertumbuhan UMKM dan pelaku usaha lokal melalui pelatihan, promosi, dan kemitraan.',
    'Membangun lingkungan pasar yang bersih, aman, inklusif, dan ramah keluarga.',
    'Mengembangkan inovasi berkelanjutan untuk menjawab tantangan dan peluang di era ekonomi digital.'
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visi & Misi - Pasar Modern Tangerang</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/landing-styles.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <img src="/assets/img/logo/Logorbg.png" alt="Logo Pasar Modern" class="img-fluid">
                <span class="fw-bold text-primary">Pasar Modern Tangerang</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/">Beranda</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Tentang Kami</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/tentang-kami/ringkasan">Ringkasan</a></li>
                            <li><a class="dropdown-item active bg-white text-primary fw-bold" style="border-radius: 10px;" href="/tentang-kami/visi-misi">Visi & Misi</a></li>
                            <li><a class="dropdown-item" href="/tentang-kami/peraturan">Peraturan</a></li>
                            <li><a class="dropdown-item" href="/tentang-kami/pesan-direksi">Pesan Direksi</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Informasi</a>
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

    <div class="container py-5">
        <div class="row justify-content-center mb-4">
            <div class="col-lg-10 col-xl-9">
                <div class="text-center mb-5">
                    <h2 class="fw-bold display-4 mb-3 text-primary" style="letter-spacing:1px;">Visi <span class="text-dark">&</span> Misi</h2>
                    <p class="lead text-secondary mb-0" style="max-width:700px;margin:auto;">Menjadi pusat transformasi pasar rakyat yang adaptif, inovatif, dan berdaya saing global, dengan mengedepankan nilai-nilai kepercayaan, kolaborasi, dan keberlanjutan.</p>
                </div>
                <div class="row g-4 mb-4 align-items-stretch">
                    <div class="col-md-6 mb-4 mb-md-0">
                        <div class="bg-white rounded-4 shadow p-5 h-100 border-0 d-flex flex-column justify-content-center position-relative corporate-card-hover">
                            <span class="position-absolute opacity-10" style="top:10px;right:20px;font-size:4rem;"><i class="bi bi-bullseye text-primary"></i></span>
                            <h5 class="fw-bold text-uppercase text-primary mb-3" style="letter-spacing:1px;"><i class="bi bi-bullseye me-2"></i>Visi</h5>
                            <blockquote class="blockquote fs-5 lh-lg mb-0 ps-2 border-start border-3 border-primary">“<?= htmlspecialchars($visi) ?>”</blockquote>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="bg-light rounded-4 shadow p-5 h-100 border-0 d-flex flex-column justify-content-center position-relative corporate-card-hover">
                            <span class="position-absolute opacity-10" style="bottom:10px;left:20px;font-size:4rem;"><i class="bi bi-lightbulb text-warning"></i></span>
                            <h5 class="fw-bold text-uppercase text-warning mb-3" style="letter-spacing:1px;"><i class="bi bi-lightbulb me-2"></i>Misi</h5>
                            <ol class="mb-0 fs-5 ps-3">
                                <?php foreach($misi as $item): ?>
                                    <li class="mb-2"> <?= htmlspecialchars($item) ?> </li>
                                <?php endforeach; ?>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="row g-4 mb-4">
                    <div class="col-md-12">
                        <div class="bg-white rounded-4 shadow p-5 h-100 border-0 d-flex flex-column justify-content-center corporate-card-hover">
                            <div class="d-flex align-items-center mb-3">
                                <span class="icon-square bg-primary text-white me-3 d-flex align-items-center justify-content-center" style="width:48px;height:48px;border-radius:12px;">
                                    <i class="bi bi-people-fill fs-3"></i>
                                </span>
                                <h5 class="fw-bold text-primary mb-0 text-uppercase" style="letter-spacing:1px;">Makna & Komitmen</h5>
                            </div>
                            <p class="mb-0 fs-5 text-secondary">Kami percaya, visi dan misi ini hanya dapat terwujud melalui <span class="fw-semibold text-primary">kolaborasi erat</span> antara pengelola, pedagang, pengunjung, dan seluruh pemangku kepentingan. Setiap langkah kami didasari semangat untuk menghadirkan pasar yang tidak hanya modern secara fasilitas, tetapi juga dalam budaya pelayanan, transparansi, dan pemberdayaan komunitas. <span class="fw-semibold text-primary">Bersama, kita wujudkan pasar yang menjadi kebanggaan dan pilar ekonomi masyarakat Tangerang.</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
    /* Card hover effect for corporate feel */
    .corporate-card-hover {
        transition: box-shadow 0.3s, transform 0.3s;
    }
    .corporate-card-hover:hover {
        box-shadow: 0 8px 32px 0 rgba(37,99,235,0.12), 0 1.5px 6px 0 rgba(56,189,248,0.10);
        transform: translateY(-4px) scale(1.02);
        z-index:2;
    }
    </style>

    <footer class="footer text-center bg-dark text-white">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h6>Pasar Modern Tangerang</h6>
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
                    <p class="small mb-0">&copy; 2024 Pasar Modern Tangerang. All Rights Reserved.</p>
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
    <script src="/assets/js/feedback.js"></script>
</body>
</html>