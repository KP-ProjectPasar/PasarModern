<div class="container py-4">
    <h3><?= isset($komoditas) ? 'Edit' : 'Tambah' ?> Komoditas</h3>
    <form method="post" action="<?= isset($komoditas) ? '/admin/komoditas/update/'.$komoditas['id'] : '/admin/komoditas/store' ?>">
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="<?= isset($komoditas) ? esc($komoditas['nama']) : '' ?>" required>
        </div>
        <div class="mb-3">
            <label>Gambar (URL)</label>
            <input type="text" name="gambar" class="form-control" value="<?= isset($komoditas) ? esc($komoditas['gambar']) : '' ?>">
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3"><?= isset($komoditas) ? esc($komoditas['deskripsi']) : '' ?></textarea>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="/admin/komoditas" class="btn btn-secondary">Kembali</a>
    </form>
</div> 