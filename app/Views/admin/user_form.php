<div class="container py-4">
    <h3><?= isset($user) ? 'Edit' : 'Tambah' ?> User Admin</h3>
    <form method="post" action="<?= isset($user) ? '/admin/user/update/'.$user['id'] : '/admin/user/store' ?>">
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="<?= isset($user) ? esc($user['username']) : '' ?>" required>
        </div>
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="<?= isset($user) ? esc($user['nama']) : '' ?>" required>
        </div>
        <div class="mb-3">
            <label>Password <?= isset($user) ? '(Kosongkan jika tidak diubah)' : '' ?></label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="mb-3">
            <label>Level</label>
            <input type="text" name="level" class="form-control" value="<?= isset($user) ? esc($user['level']) : '' ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="/admin/user" class="btn btn-secondary">Kembali</a>
    </form>
</div> 