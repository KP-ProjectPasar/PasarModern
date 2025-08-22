<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Harga Komoditas - Pasar Modern Tangerang</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/landing-styles.css">
    <style>
        .komoditas-card {
            border-radius: 18px;
            box-shadow: 0 4px 18px rgba(37,99,235,0.07);
            transition: box-shadow 0.3s, transform 0.3s;
            background: #fff;
            border: none;
        }
        .komoditas-card:hover {
            box-shadow: 0 8px 32px rgba(37,99,235,0.13);
            transform: translateY(-4px) scale(1.01);
        }
        .komoditas-icon {
            font-size: 2.2rem;
            color: #2563eb;
        }
        .komoditas-harga {
            font-size: 1.25rem;
            font-weight: 600;
            color: #2563eb;
        }
        .komoditas-nama {
            font-size: 1.08rem;
            font-weight: 500;
            color: #374151;
        }
        .komoditas-satuan {
            font-size: 0.98rem;
            color: #6b7280;
        }
        .update-info {
            font-size: 0.98rem;
            color: #6b7280;
        }
        @media (max-width: 767px) {
            .komoditas-card {
                margin-bottom: 1.2rem;
            }
        }
    </style>
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
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Tentang Kami</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/tentang-kami/ringkasan">Ringkasan</a></li>
                            <li><a class="dropdown-item" href="/tentang-kami/visi-misi">Visi & Misi</a></li>
                            <li><a class="dropdown-item" href="/tentang-kami/peraturan">Peraturan</a></li>
                            <li><a class="dropdown-item" href="/tentang-kami/pesan-direksi">Pesan Direksi</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Informasi</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item active" href="/informasi/harga">Harga</a></li>
                            <li><a class="dropdown-item" href="/informasi/berita">Berita</a></li>
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
        <h2 class="section-title text-center mb-2">Harga Komoditas Hari Ini</h2>
        <p class="update-info text-center mb-4">Update terakhir: <span class="fw-semibold text-primary"><?= esc($lastUpdate) ?> WIB</span></p>
        <div class="row justify-content-center mb-4">
            <div class="col-lg-6 col-md-8">
                <form class="d-flex gap-2" method="get" action="">
                    <input type="text" name="q" class="form-control" placeholder="Cari komoditas..." value="<?= esc($q ?? '') ?>">
                    <select name="kategori" class="form-select">
                        <option value="">Semua Kategori</option>
                        <?php foreach ($kategoriList as $kat): ?>
                            <option value="<?= esc($kat) ?>" <?= ($kategori == $kat) ? 'selected' : '' ?>><?= esc($kat) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                </form>
            </div>
        </div>
        <div class="row g-4" id="komoditasGridFull">
            <?php if (!empty($komoditasList)): ?>
                <?php foreach ($komoditasList as $komoditas): ?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="komoditas-card p-3 h-100 d-flex flex-column align-items-center text-center">
                            <div class="mb-2">
                                <i class="bi bi-basket komoditas-icon"></i>
                            </div>
                            <div class="komoditas-nama mb-1">
                                <?= esc($komoditas['nama'] ?? $komoditas['nama_komoditas']) ?>
                            </div>
                            <div class="komoditas-harga mb-1">
                                Rp <?= number_format($komoditas['harga'],0,',','.') ?>
                            </div>
                            <?php if (isset($komoditas['satuan']) && $komoditas['satuan']): ?>
                                <div class="komoditas-satuan mb-2">/ <?= esc($komoditas['satuan']) ?></div>
                            <?php endif; ?>
                            <?php if (isset($komoditas['kategori']) && $komoditas['kategori']): ?>
                                <div class="small text-secondary">Kategori: <?= esc($komoditas['kategori']) ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center text-muted py-5">
                    <i class="bi bi-emoji-frown fs-1"></i><br>
                    Data harga komoditas belum tersedia.
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer text-center bg-dark text-white mt-5">
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
</body>
</html>