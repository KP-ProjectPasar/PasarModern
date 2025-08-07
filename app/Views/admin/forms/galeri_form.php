<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<div class="container py-4">
    <h3><?= isset($galeri) ? 'Edit' : 'Tambah' ?> Galeri</h3>
    <form method="post" action="<?= isset($galeri) ? '/admin/galeri/update/'.$galeri['id'] : '/admin/galeri/store' ?>" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Judul Galeri</label>
            <input type="text" name="judul" class="form-control" value="<?= isset($galeri) ? esc($galeri['judul']) : '' ?>" required>
        </div>
        <div class="mb-3">
            <label>Gambar</label>
            <?php if (isset($galeri) && $galeri['gambar']): ?>
                <div class="mb-2">
                    <img src="/uploads/galeri/<?= esc($galeri['gambar']) ?>" alt="Current Image" style="max-width: 300px; height: auto;" class="border rounded">
                </div>
            <?php endif; ?>
            <input type="file" name="gambar" class="form-control" accept="image/*" <?= !isset($galeri) ? 'required' : '' ?>>
            <small class="text-muted">Format: JPG, PNG, GIF. Maksimal 5MB.</small>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="/admin/galeri" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<?= $this->endSection() ?> 