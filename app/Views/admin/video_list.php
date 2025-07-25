<div class="container py-4">
    <h3>Daftar Video</h3>
    <a href="/admin/video/create" class="btn btn-primary mb-3">Tambah Video</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Judul</th>
                <th>URL</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($videos as $video): ?>
            <tr>
                <td><?= esc($video['judul']) ?></td>
                <td><a href="<?= esc($video['url']) ?>" target="_blank">Lihat Video</a></td>
                <td>
                    <a href="/admin/video/edit/<?= $video['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="/admin/video/delete/<?= $video['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus video ini?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div> 