<?= $this->extend('layout') ?>

<?= $this->section('title') ?><?= esc($berita['judul']) ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Hero Section -->
<section class="hero-section bg-primary text-white py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-3">
                        <li class="breadcrumb-item"><a href="/" class="text-white-50">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="/informasi/berita" class="text-white-50">Berita</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Detail</li>
                    </ol>
                </nav>
                <h1 class="display-5 fw-bold mb-3"><?= esc($berita['judul']) ?></h1>
                <div class="d-flex justify-content-center align-items-center gap-4">
                    <span class="text-white-75">
                        <i class="bi bi-calendar3 me-2"></i>
                        <?= date('d F Y', strtotime($berita['tanggal_publish'])) ?>
                    </span>
                    <span class="text-white-75">
                        <i class="bi bi-eye me-2"></i>
                        <span id="viewsDisplay"><?= $berita['views'] ?? 0 ?> views</span>
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Berita Detail Section -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Back Button -->
                <div class="mb-4">
                    <a href="/informasi/berita" class="btn btn-outline-primary">
                        <i class="bi bi-arrow-left me-2"></i>
                        Kembali ke Daftar Berita
                    </a>
                </div>
                
                <!-- Berita Content -->
                <article class="card border-0 shadow-sm">
                    <?php if ($berita['gambar']): ?>
                        <img src="/uploads/berita/<?= esc($berita['gambar']) ?>" 
                             alt="<?= esc($berita['judul']) ?>" 
                             class="card-img-top"
                             style="height: 400px; object-fit: cover;">
                    <?php endif; ?>
                    
                    <div class="card-body p-4">
                        <div class="berita-content">
                            <?= $berita['isi'] ?>
                        </div>
                        
                        <!-- Share Buttons -->
                        <div class="mt-4 pt-4 border-top">
                            <h6 class="text-muted mb-3">Bagikan berita ini:</h6>
                            <div class="d-flex gap-2">
                                <button class="btn btn-outline-primary btn-sm" onclick="shareBerita()">
                                    <i class="bi bi-share me-1"></i>Bagikan
                                </button>
                                <button class="btn btn-outline-success btn-sm" onclick="copyLink()">
                                    <i class="bi bi-link-45deg me-1"></i>Salin Link
                                </button>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    window.beritaId = <?= $berita['id'] ?>;
    
    function shareBerita() {
        if (navigator.share) {
            navigator.share({
                title: '<?= esc($berita['judul']) ?>',
                text: '<?= esc(substr($berita['isi'], 0, 100)) ?>...',
                url: window.location.href
            });
        } else {
            copyLink();
        }
    }
    
    function copyLink() {
        navigator.clipboard.writeText(window.location.href).then(function() {
            alert('Link berhasil disalin!');
        });
    }
</script>
<script src="<?= base_url('assets/js/berita-detail.js') ?>"></script>
<?= $this->endSection() ?>
