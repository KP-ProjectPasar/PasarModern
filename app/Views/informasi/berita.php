<?= $this->extend('layout') ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/informasi-styles.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <h2 class="section-title text-center">Berita & Info Terkini</h2>
    <div class="row g-4" id="beritaListFull">
        <div class="col-12 text-center">
            <p>Memuat data berita...</p>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/berita.js') ?>"></script>
<?= $this->endSection() ?>