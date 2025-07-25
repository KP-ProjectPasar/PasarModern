<div class="container py-4">
    <h3><?= isset($level) ? 'Edit' : 'Tambah' ?> Level/Grup</h3>
    <form method="post" action="<?= isset($level) ? '/admin/level/update/'.$level['id'] : '/admin/level/store' ?>">
        <div class="mb-3">
            <label>Nama Level</label>
            <input type="text" name="nama" class="form-control" value="<?= isset($level) ? esc($level['nama']) : '' ?>" required>
        </div>
        <div class="mb-3">
            <label>Keterangan</label>
            <input type="text" name="keterangan" class="form-control" value="<?= isset($level) ? esc($level['keterangan']) : '' ?>">
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="/admin/level" class="btn btn-secondary">Kembali</a>
    </form>
</div> 