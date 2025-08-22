<?= $this->extend('layout') ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/informasi-styles.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Back Button -->
            <div class="mb-4">
                <a href="/informasi/berita" class="back-button">
                    <i class="bi bi-arrow-left"></i>
                    Kembali ke Daftar Berita
                </a>
            </div>
            
            <!-- Views Counter -->
            <div class="views-counter">
                <div class="views-number" id="viewsCount"><?= $berita['views'] ?? 0 ?></div>
                <div class="views-label">Total Views</div>
            </div>
            
            <!-- Berita Detail -->
            <div class="berita-detail">
                <div class="berita-header">
                    <h1 class="berita-title"><?= esc($berita['judul']) ?></h1>
                    <div class="berita-meta">
                        <div class="meta-item">
                            <i class="bi bi-calendar3"></i>
                            <span><?= date('d M Y', strtotime($berita['tanggal_publish'])) ?></span>
                        </div>
                        <div class="meta-item">
                            <i class="bi bi-eye"></i>
                            <span id="viewsDisplay"><?= $berita['views'] ?? 0 ?> views</span>
                        </div>
                    </div>
                </div>
                
                <?php if ($berita['gambar']): ?>
                    <img src="/uploads/berita/<?= esc($berita['gambar']) ?>" 
                         alt="<?= esc($berita['judul']) ?>" 
                         class="berita-image">
                <?php endif; ?>
                
                <div class="berita-content">
                    <?= $berita['isi'] ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    window.beritaId = <?= $berita['id'] ?>;
</script>
<script src="<?= base_url('assets/js/berita-detail.js') ?>"></script>
<?= $this->endSection() ?>
