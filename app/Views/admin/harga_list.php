<div class="container py-4">
    <h3>Daftar Harga Komoditas</h3>
    <a href="/admin/harga/create" class="btn btn-primary mb-3">Tambah Harga</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Komoditas</th>
                <th>Harga</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hargas as $harga): ?>
            <tr>
                <td><?= esc($harga['komoditas']) ?></td>
                <td><?= number_format($harga['harga'],0,',','.') ?></td>
                <td><?= esc($harga['tanggal']) ?></td>
                <td>
                    <a href="/admin/harga/edit/<?= $harga['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="/admin/harga/delete/<?= $harga['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div> 