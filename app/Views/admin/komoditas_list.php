<div class="container py-4">
    <h3>Daftar Komoditas</h3>
    <a href="/admin/komoditas/create" class="btn btn-primary mb-3">Tambah Komoditas</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Gambar</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($komoditas as $k): ?>
            <tr>
                <td><?= esc($k['nama']) ?></td>
                <td><?php if ($k['gambar']): ?><img src="<?= esc($k['gambar']) ?>" width="80"><?php endif; ?></td>
                <td><?= esc($k['deskripsi']) ?></td>
                <td>
                    <a href="/admin/komoditas/edit/<?= $k['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="/admin/komoditas/delete/<?= $k['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus komoditas ini?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div> 