<div class="container py-4">
    <h3>Daftar User Admin</h3>
    <a href="/admin/user/create" class="btn btn-primary mb-3">Tambah User</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Username</th>
                <th>Nama</th>
                <th>Level</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= esc($user['username']) ?></td>
                <td><?= esc($user['nama']) ?></td>
                <td><?= esc($user['level']) ?></td>
                <td>
                    <a href="/admin/user/edit/<?= $user['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="/admin/user/delete/<?= $user['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus user ini?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div> 