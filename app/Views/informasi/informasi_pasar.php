<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Pasar - Pasar Modern Tangerang</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f8f9fa; }
        .main-section { background: #fff; border-radius: 24px; box-shadow: 0 8px 32px rgba(37,99,235,0.08); padding: 2.5rem 2rem; margin-top: 2.5rem; }
        .title-main { font-weight: 700; font-size: 2.5rem; color: #1a237e; }
        .subtitle-main { color: #3949ab; font-size: 1.15rem; margin-bottom: 2rem; }
        .info-card { background: #f8fafc; border-radius: 14px; padding: 1.5rem; margin-bottom: 1.5rem; border-left: 4px solid #1976d2; }
        .info-title { font-weight: 700; color: #1976d2; margin-bottom: 1rem; }
        .info-content { color: #374151; line-height: 1.7; }
        .feature-card { background: #fff; border-radius: 12px; box-shadow: 0 2px 8px rgba(37,99,235,0.07); padding: 1.5rem; margin-bottom: 1.5rem; transition: transform 0.2s; }
        .feature-card:hover { transform: translateY(-2px); }
        .feature-icon { font-size: 2.5rem; color: #1976d2; margin-bottom: 1rem; }
        @media (max-width: 768px) {
            .main-section { padding: 1rem; }
            .title-main { font-size: 1.5rem; }
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
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Tentang Kami
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/tentang-kami/ringkasan">Ringkasan</a></li>
                            <li><a class="dropdown-item" href="/tentang-kami/visi-misi">Visi & Misi</a></li>
                            <li><a class="dropdown-item" href="/tentang-kami/peraturan">Peraturan</a></li>
                            <li><a class="dropdown-item" href="/tentang-kami/pesan-direksi">Pesan Direksi</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Informasi
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/informasi/berita">Berita</a></li>
                            <li><a class="dropdown-item" href="/informasi/harga">Harga</a></li>
                            <li><a class="dropdown-item active" href="/informasi/informasi-pasar">Informasi Pasar</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="/informasi/galeri">Galeri</a></li>
                    <li class="nav-item"><a class="nav-link" href="/#faq">FAQ</a></li>
                    <li class="nav-item"><a class="nav-link" href="/#feedback">Feedback</a></li>
                    <li class="nav-item"><a class="nav-link" href="/#kontak">Kontak</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container">
        <section class="main-section">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="title-main mb-2">Informasi Pasar</h1>
                    <div class="subtitle-main">Pilih pasar untuk melihat informasi lengkap tentang lokasi, jam operasional, dan layanan yang tersedia.</div>
                </div>
            </div>
            
            <!-- Pasar Selection -->
            <div class="row mb-4">
                <div class="col-lg-12">
                    <div class="info-card">
                        <h3 class="info-title">
                            <i class="bi bi-building me-2"></i>
                            Pilih Pasar
                        </h3>
                        <div class="info-content">
                            <div class="row">
                                <?php foreach ($pasar_list as $pasar): ?>
                                <div class="col-md-4 mb-3">
                                    <div class="card h-100 border-0 shadow-sm <?= ($selected_pasar && $selected_pasar['id'] == $pasar['id']) ? 'border-primary' : ''; ?>">
                                        <div class="card-body text-center">
                                            <div class="mb-3">
                                                <i class="bi bi-shop text-primary" style="font-size: 2.5rem;"></i>
                                            </div>
                                            <h5 class="card-title"><?= esc($pasar['nama_pasar']) ?></h5>
                                            <p class="card-text text-muted small"><?= esc($pasar['alamat']) ?></p>
                                            <div class="mb-2">
                                                <span class="badge <?= $pasar['status'] == 'aktif' ? 'bg-success' : 'bg-warning' ?>">
                                                    <?= ucfirst($pasar['status']) ?>
                                                </span>
                                            </div>
                                            <a href="/informasi/informasi-pasar/<?= $pasar['id'] ?>" class="btn btn-primary btn-sm">
                                                Lihat Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php if ($selected_pasar): ?>
            <!-- Selected Pasar Detail -->
            <div class="row mb-4">
                <div class="col-lg-12">
                    <div class="info-card bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="info-title text-white mb-1">
                                    <i class="bi bi-shop me-2"></i>
                                    <?= esc($selected_pasar['nama_pasar']) ?>
                                </h3>
                                <p class="mb-0"><?= esc($selected_pasar['alamat']) ?></p>
                            </div>
                            <a href="/informasi/informasi-pasar" class="btn btn-light btn-sm">
                                <i class="bi bi-arrow-left me-1"></i>Kembali ke Daftar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-8">
                    <div class="info-card">
                        <h3 class="info-title">
                            <i class="bi bi-geo-alt me-2"></i>
                            Lokasi dan Akses
                        </h3>
                        <div class="info-content">
                            <p><strong>Alamat:</strong><br>
                            <?= esc($selected_pasar['alamat']) ?></p>
                            
                            <?php if ($selected_pasar['deskripsi']): ?>
                            <p><strong>Deskripsi:</strong><br>
                            <?= esc($selected_pasar['deskripsi']) ?></p>
                            <?php endif; ?>
                            
                            <p><strong>Akses Transportasi:</strong></p>
                            <ul>
                                <li><strong>Angkutan Umum:</strong> Bus Transjakarta, Angkot Tangerang</li>
                                <li><strong>Kereta:</strong> Stasiun Tangerang (5 menit dengan ojek online)</li>
                                <li><strong>Mobil Pribadi:</strong> Tersedia area parkir luas</li>
                                <li><strong>Ojek Online:</strong> Gojek, Grab, Maxim tersedia</li>
                            </ul>
                        </div>
                    </div>

                    <div class="info-card">
                        <h3 class="info-title">
                            <i class="bi bi-clock me-2"></i>
                            Jam Operasional
                        </h3>
                        <div class="info-content">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Jam Buka Pasar:</h5>
                                    <ul>
                                        <li><strong>Jam Buka:</strong> <?= date('H:i', strtotime($selected_pasar['jam_buka'])) ?> WIB</li>
                                        <li><strong>Jam Tutup:</strong> <?= date('H:i', strtotime($selected_pasar['jam_tutup'])) ?> WIB</li>
                                        <li><strong>Status:</strong> 
                                            <span class="badge <?= $selected_pasar['status'] == 'aktif' ? 'bg-success' : ($selected_pasar['status'] == 'maintenance' ? 'bg-warning' : 'bg-danger') ?>">
                                                <?= ucfirst($selected_pasar['status']) ?>
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h5>Jam Puncak:</h5>
                                    <ul>
                                        <li><strong>Pagi:</strong> 07:00 - 10:00 WIB</li>
                                        <li><strong>Sore:</strong> 16:00 - 19:00 WIB</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="info-card">
                        <h3 class="info-title">
                            <i class="bi bi-currency-dollar me-2"></i>
                            Tarif Parkir
                        </h3>
                        <div class="info-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="text-center p-3 bg-light rounded">
                                        <i class="bi bi-bicycle text-primary fs-1"></i>
                                        <h6 class="mt-2">Motor</h6>
                                        <p class="mb-0"><strong>Rp 2.000</strong></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="text-center p-3 bg-light rounded">
                                        <i class="bi bi-car-front text-primary fs-1"></i>
                                        <h6 class="mt-2">Mobil</h6>
                                        <p class="mb-0"><strong>Rp 5.000</strong></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="text-center p-3 bg-light rounded">
                                        <i class="bi bi-truck text-primary fs-1"></i>
                                        <h6 class="mt-2">Truk</h6>
                                        <p class="mb-0"><strong>Rp 10.000</strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="info-card">
                        <h3 class="info-title">
                            <i class="bi bi-telephone me-2"></i>
                            Kontak Darurat
                        </h3>
                        <div class="info-content">
                            <?php if ($selected_pasar['telepon']): ?>
                            <p><strong>Telepon:</strong><br>
                            <?= esc($selected_pasar['telepon']) ?></p>
                            <?php endif; ?>
                            
                            <?php if ($selected_pasar['email']): ?>
                            <p><strong>Email:</strong><br>
                            <?= esc($selected_pasar['email']) ?></p>
                            <?php endif; ?>
                            
                            <p><strong>Keamanan:</strong><br>
                            (021) 12345679</p>
                            
                            <p><strong>Kebersihan:</strong><br>
                            (021) 12345680</p>
                        </div>
                    </div>

                    <div class="info-card">
                        <h3 class="info-title">
                            <i class="bi bi-shield-check me-2"></i>
                            Protokol Kesehatan
                        </h3>
                        <div class="info-content">
                            <ul>
                                <li>Wajib menggunakan masker</li>
                                <li>Jaga jarak minimal 1 meter</li>
                                <li>Cuci tangan di tempat yang disediakan</li>
                                <li>Gunakan hand sanitizer</li>
                                <li>Jika sakit, sebaiknya tidak datang</li>
                            </ul>
                        </div>
                    </div>

                    <div class="info-card">
                        <h3 class="info-title">
                            <i class="bi bi-info-circle me-2"></i>
                            Fasilitas Umum
                        </h3>
                        <div class="info-content">
                            <ul>
                                <li>Toilet umum (gratis)</li>
                                <li>Musholla</li>
                                <li>Area istirahat</li>
                                <li>ATM Center</li>
                                <li>Warung makan</li>
                                <li>Area bermain anak</li>
                                <li>Pos keamanan</li>
                                <li>P3K</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <div class="row mt-4">
                <div class="col-lg-12">
                    <h3 class="info-title">
                        <i class="bi bi-star me-2"></i>
                        Keunggulan Pasar Modern Tangerang
                    </h3>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="feature-card text-center">
                                <div class="feature-icon">
                                    <i class="bi bi-shield-check"></i>
                                </div>
                                <h5>Keamanan Terjamin</h5>
                                <p class="text-muted">Sistem keamanan 24 jam dengan CCTV dan petugas keamanan yang siap siaga.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="feature-card text-center">
                                <div class="feature-icon">
                                    <i class="bi bi-droplet"></i>
                                </div>
                                <h5>Kebersihan Terjaga</h5>
                                <p class="text-muted">Area pasar yang bersih dengan sistem pengelolaan sampah yang terorganisir.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="feature-card text-center">
                                <div class="feature-icon">
                                    <i class="bi bi-people"></i>
                                </div>
                                <h5>Ramah Keluarga</h5>
                                <p class="text-muted">Lingkungan yang nyaman dan aman untuk dikunjungi bersama keluarga.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

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
                        <li><a href="/#layanan" class="text-white-50">Layanan</a></li>
                        <li><a href="/informasi/berita" class="text-white-50">Berita</a></li>
                        <li><a href="/informasi/harga" class="text-white-50">Harga</a></li>
                        <li><a href="/informasi/galeri" class="text-white-50">Galeri</a></li>
                        <li><a href="/#faq" class="text-white-50">FAQ</a></li>
                        <li><a href="/#feedback" class="text-white-50">Feedback</a></li>
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
</body>
</html>
