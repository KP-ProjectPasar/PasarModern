<!-- admin/lists/direksi_list.php -->
<div class="container py-4">
    <h3 class="mb-4">Data Direksi</h3>
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">{{ session()->getFlashdata('success') }}</div>
    <?php endif; ?>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Pesan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($direksi as $d): ?>
            <tr>
                <td>
                    <?php if (!empty($d['foto'])): ?>
                        <img src="<?= esc($d['foto']) ?>" alt="Foto" style="width:60px; height:60px; object-fit:cover;" class="rounded">
                    <?php else: ?>
                        <span class="text-muted">-</span>
                    <?php endif; ?>
                </td>
                <td><?= esc($d['nama']) ?></td>
                <td><?= esc($d['jabatan']) ?></td>
                <td><?= esc($d['pesan']) ?></td>
                <td>
                    <a href="/admin/direksi/edit/<?= esc($d['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
