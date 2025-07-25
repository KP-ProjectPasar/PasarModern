<div class="container py-4">
    <h3><?= isset($galeri) ? 'Edit' : 'Tambah' ?> Galeri Foto</h3>
    <form method="post" action="<?= isset($galeri) ? '/admin/galeri/update/'.$galeri['id'] : '/admin/galeri/store' ?>">
        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" value="<?= isset($galeri) ? esc($galeri['judul']) : '' ?>" required>
        </div>
        <div class="mb-3">
            <label>Gambar (URL)</label>
            <input type="text" name="gambar" class="form-control" value="<?= isset($galeri) ? esc($galeri['gambar']) : '' ?>">
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="/admin/galeri" class="btn btn-secondary">Kembali</a>
    </form>
</div> 