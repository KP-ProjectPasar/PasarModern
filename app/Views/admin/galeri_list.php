<div class="container py-4">
    <h3>Daftar Galeri Foto</h3>
    <a href="/admin/galeri/create" class="btn btn-primary mb-3">Tambah Galeri</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($galeris as $galeri): ?>
            <tr>
                <td><?= esc($galeri['judul']) ?></td>
                <td><?php if ($galeri['gambar']): ?><img src="<?= esc($galeri['gambar']) ?>" width="80"><?php endif; ?></td>
                <td>
                    <a href="/admin/galeri/edit/<?= $galeri['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="/admin/galeri/delete/<?= $galeri['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus galeri ini?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div> 