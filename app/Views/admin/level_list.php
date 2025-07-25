<div class="container py-4">
    <h3>Daftar Level/Grup Admin</h3>
    <a href="/admin/level/create" class="btn btn-primary mb-3">Tambah Level</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nama Level</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($levels as $level): ?>
            <tr>
                <td><?= esc($level['nama']) ?></td>
                <td><?= esc($level['keterangan']) ?></td>
                <td>
                    <a href="/admin/level/edit/<?= $level['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="/admin/level/delete/<?= $level['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus level ini?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div> 