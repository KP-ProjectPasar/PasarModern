<!-- admin/forms/direksi_form.php -->
<div class="container py-4">
    <h3 class="mb-4">Edit Data Direksi</h3>
    <form action="/admin/direksi/update/<?= esc($direksi['id']) ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= esc($direksi['nama']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="jabatan" class="form-label">Jabatan</label>
            <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?= esc($direksi['jabatan']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="pesan" class="form-label">Isi Pesan</label>
            <textarea class="form-control" id="pesan" name="pesan" rows="4" required><?= esc($direksi['pesan']) ?></textarea>
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Foto Direksi (opsional)</label><br>
            <?php if (!empty($direksi['foto'])): ?>
                <img src="<?= esc($direksi['foto']) ?>" alt="Foto Direksi" class="rounded mb-2" style="width:100px; height:100px; object-fit:cover;">
            <?php endif; ?>
            <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="/admin/direksi" class="btn btn-secondary">Batal</a>
    </form>
</div>
