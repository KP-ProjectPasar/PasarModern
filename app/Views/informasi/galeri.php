<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri - Pasar Modern Tangerang</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f8f9fa; }
        .galeri-section { background: #fff; border-radius: 16px; box-shadow: 0 4px 24px rgba(0,0,0,0.07); padding: 2rem; margin-top: 2rem; }
        .galeri-title { font-weight: 700; color: #1a237e; }
        .galeri-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 2rem; }
        .galeri-card { background: #f8fafc; border-radius: 14px; box-shadow: 0 2px 8px rgba(37,99,235,0.07); overflow: hidden; transition: box-shadow 0.2s; }
        .galeri-card:hover { box-shadow: 0 8px 32px rgba(37,99,235,0.12); }
        .galeri-img { width: 100%; height: 180px; object-fit: cover; background: #e3e6f3; }
        .galeri-info { padding: 1rem; }
        .galeri-judul { font-weight: 600; color: #1976d2; margin-bottom: 0.5rem; }
        .galeri-meta { font-size: 0.95rem; color: #616161; }
        @media (max-width: 768px) {
            .galeri-section { padding: 1rem; }
            .galeri-title { font-size: 1.5rem; }
            .galeri-img { height: 120px; }
        }
    </style>
</head>
<body>
    <?php include(APPPATH.'Views/landing_page.php'); ?>
    <main class="container">
        <section class="galeri-section">
            <div class="row mb-4">
                <div class="col text-center">
                    <h2 class="galeri-title mb-2"><i class="bi bi-images me-2"></i>Galeri Pasar Modern Tangerang</h2>
                    <p class="lead">Kumpulan dokumentasi dan momen terbaik dari aktivitas pasar modern Tangerang.</p>
                </div>
            </div>
            <div class="galeri-grid">
                <?php
                $galeriModel = new \App\Models\GaleriModel();
                $galeriList = $galeriModel->getPublishedGaleri();
                if (!empty($galeriList)):
                    foreach ($galeriList as $item): ?>
                        <div class="galeri-card">
                            <?php if (!empty($item['gambar'])): ?>
                                <img src="<?= esc($item['gambar']) ?>" alt="<?= esc($item['judul']) ?>" class="galeri-img">
                            <?php else: ?>
                                <div class="galeri-img d-flex align-items-center justify-content-center text-muted"><i class="bi bi-image" style="font-size:2rem;"></i></div>
                            <?php endif; ?>
                            <div class="galeri-info">
                                <div class="galeri-judul"><?= esc($item['judul']) ?></div>
                                <div class="galeri-meta"><i class="bi bi-eye me-1"></i><?= esc($item['views']) ?> views</div>
                                <div class="galeri-meta"><i class="bi bi-calendar me-1"></i><?= date('d M Y', strtotime($item['created_at'])) ?></div>
                            </div>
                        </div>
                    <?php endforeach;
                else: ?>
                    <div class="text-center text-muted w-100">Belum ada galeri tersedia.</div>
                <?php endif; ?>
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
</body>
</html>
