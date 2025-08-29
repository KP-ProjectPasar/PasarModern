<?php
// Jika $ringkasan, $visi, $misi, $kontak dikirim dari controller, gunakan data dinamis. Jika tidak, fallback ke default.
$ringkasan = $ringkasan ?? 'Pasar Modern Tangerang adalah platform digital resmi yang menyediakan layanan publik, informasi harga komoditas, berita, galeri, dan kemudahan transaksi di lingkungan pasar modern Tangerang. Kami hadir untuk mendukung transparansi, kemudahan akses, dan modernisasi pasar tradisional menuju era digital.';
$visi = $visi ?? 'Menjadi pasar modern terdepan di Indonesia yang mengedepankan pelayanan prima, transparansi, dan inovasi berbasis teknologi.';
$misi = $misi ?? [
    'Meningkatkan kualitas layanan publik dan kenyamanan pengunjung.',
    'Mendorong digitalisasi dan transparansi informasi pasar.',
    'Mendukung pertumbuhan ekonomi lokal melalui ekosistem pasar yang sehat.',
    'Mengembangkan inovasi berkelanjutan untuk kemajuan pasar modern.'
];
$kontak = $kontak ?? [
    'alamat' => 'Jl. Pasar Modern No. 1, Kota Tangerang, Banten',
    'telepon' => '(021) 12345678',
    'email' => 'info@epasar-tangerang.go.id'
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Pasar Modern Tangerang</title>
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
                    <li class="nav-item"><a class="nav-link active" href="/">Beranda</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Tentang Kami</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item active" href="/tentang-kami/ringkasan">Ringkasan</a></li>
                            <li><a class="dropdown-item" href="/tentang-kami/visi-misi">Visi & Misi</a></li>
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
                    <h2 class="fw-bold display-5 mb-2 text-primary">Tentang Pasar Modern Tangerang</h2>
                    <p class="lead text-secondary mb-0">
                        <?= nl2br(htmlspecialchars($ringkasan ?? 'Pasar Modern Tangerang hadir sebagai pusat transformasi pasar rakyat menuju era digital. Kami bukan sekadar tempat bertransaksi, melainkan ruang kolaborasi, inovasi, dan pemberdayaan ekonomi lokal. Dengan mengedepankan transparansi, kenyamanan, dan teknologi, kami berkomitmen menciptakan pengalaman belanja yang aman, ramah keluarga, serta mendukung pertumbuhan UMKM. Setiap interaksi di Pasar Modern Tangerang adalah langkah bersama membangun kepercayaan, memperkuat jejaring komunitas, dan mewujudkan pasar yang adaptif terhadap perubahan zaman. Selamat datang di pasar masa depan yang tetap berpijak pada nilai-nilai tradisi dan kebersamaan.') ) ?>
                    </p>
                </div>
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div class="bg-white rounded-4 shadow-sm p-4 h-100">
                            <h4 class="fw-semibold text-primary mb-3"><i class="bi bi-bullseye me-2 text-info"></i>Visi</h4>
                            <p class="mb-2"><?= htmlspecialchars($visi ?? 'Menjadi ekosistem pasar modern terdepan di Indonesia yang menginspirasi, memberdayakan, dan berkelanjutan melalui pelayanan prima, inovasi teknologi, serta kolaborasi komunitas.') ?></p>
                            <h4 class="fw-semibold text-primary mb-3 mt-4"><i class="bi bi-lightbulb me-2 text-warning"></i>Misi</h4>
                            <ul class="mb-0">
                                <?php foreach(($misi ?? [
                                    'Menghadirkan layanan publik yang unggul, ramah, dan mudah diakses oleh seluruh lapisan masyarakat.',
                                    'Mendorong digitalisasi dan transparansi informasi harga serta aktivitas pasar secara real-time.',
                                    'Mendukung pertumbuhan UMKM dan pelaku usaha lokal melalui pelatihan, promosi, dan kemitraan.',
                                    'Membangun lingkungan pasar yang bersih, aman, inklusif, dan ramah keluarga.',
                                    'Mengembangkan inovasi berkelanjutan untuk menjawab tantangan dan peluang di era ekonomi digital.'
                                ]) as $item): ?>
                                    <li><?= htmlspecialchars($item) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="bg-white rounded-4 shadow-sm p-4 h-100">
                            <h4 class="fw-semibold text-primary mb-3"><i class="bi bi-star-fill me-2 text-warning"></i>Layanan Unggulan</h4>
                            <ul class="list-unstyled mb-0">
                                                        <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i>Informasi harga komoditas harian yang transparan & mudah diakses</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i>Galeri foto & video inspiratif aktivitas pasar dan UMKM</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i>Berita, edukasi, dan info terkini seputar pasar, UMKM, dan komunitas</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i>Peta digital lokasi, fasilitas, dan tenant pasar modern Tangerang</li>
                        <li><i class="bi bi-check-circle-fill text-primary me-2"></i>Form feedback & saran digital untuk membangun pasar bersama</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row g-4 mb-4">
                    <div class="col-md-12">
                        <div class="bg-white rounded-4 shadow-sm p-4 h-100">
                            <h4 class="fw-semibold text-primary mb-3"><i class="bi bi-geo-alt-fill me-2 text-danger"></i>Kontak & Lokasi</h4>
                            <div class="row align-items-center">
                                <div class="col-sm-7 mb-3 mb-sm-0">
                                    <p class="mb-2"><i class="bi bi-geo-alt me-2"></i><?= htmlspecialchars($kontak['alamat'] ?? 'Jl. Pasar Modern No. 1, Kota Tangerang, Banten') ?></p>
                                    <p class="mb-2"><i class="bi bi-telephone me-2"></i><?= htmlspecialchars($kontak['telepon'] ?? '(021) 12345678') ?></p>
                                    <p class="mb-0"><i class="bi bi-envelope me-2"></i><?= htmlspecialchars($kontak['email'] ?? 'info@epasar-tangerang.go.id') ?></p>
                                </div>
                                <div class="col-sm-5">
                                    <div class="ratio ratio-16x9 rounded-4 overflow-hidden shadow-sm">
                                        <iframe src="https://www.google.com/maps?q=pasar+modern+tangerang&output=embed" allowfullscreen style="border:0;"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
