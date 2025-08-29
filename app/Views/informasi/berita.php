<?= $this->extend('layout') ?>

<?= $this->section('title') ?>Berita & Info Terkini<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Hero Section -->
<section class="hero-section bg-primary text-white py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h1 class="display-4 fw-bold mb-3">Berita & Info Terkini</h1>
                <p class="lead mb-0">Update terbaru seputar kegiatan, pengumuman, dan informasi pasar modern Tangerang</p>
            </div>
        </div>
    </div>
</section>

<!-- Berita Section -->
<section class="py-5">
    <div class="container">
        <div class="row g-4" id="beritaListFull">
            <div class="col-12 text-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-3 text-muted">Memuat data berita...</p>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/berita.js') ?>"></script>
<?= $this->endSection() ?>
