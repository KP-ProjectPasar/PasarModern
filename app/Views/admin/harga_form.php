<div class="container py-4">
    <h3><?= isset($harga) ? 'Edit' : 'Tambah' ?> Harga Komoditas</h3>
    <form method="post" action="<?= isset($harga) ? '/admin/harga/update/'.$harga['id'] : '/admin/harga/store' ?>">
        <div class="mb-3">
            <label>Komoditas</label>
            <input type="text" name="komoditas" class="form-control" value="<?= isset($harga) ? esc($harga['komoditas']) : '' ?>" required>
        </div>
        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" value="<?= isset($harga) ? esc($harga['harga']) : '' ?>" required>
        </div>
        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="<?= isset($harga) ? esc($harga['tanggal']) : '' ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="/admin/harga" class="btn btn-secondary">Kembali</a>
    </form>
</div> 