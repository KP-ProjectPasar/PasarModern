<div class="container py-4">
    <h3><?= isset($video) ? 'Edit' : 'Tambah' ?> Video</h3>
    <form method="post" action="<?= isset($video) ? '/admin/video/update/'.$video['id'] : '/admin/video/store' ?>">
        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" value="<?= isset($video) ? esc($video['judul']) : '' ?>" required>
        </div>
        <div class="mb-3">
            <label>URL Video</label>
            <input type="text" name="url" class="form-control" value="<?= isset($video) ? esc($video['url']) : '' ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="/admin/video" class="btn btn-secondary">Kembali</a>
    </form>
</div> 