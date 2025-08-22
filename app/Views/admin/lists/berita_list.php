<?= $this->extend('admin/layout') ?>

<?= $this->section('head') ?>
<style>
.status-badge {
    display: inline-flex;
    align-items: center;
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-size: 0.875rem;
    font-weight: 500;
    cursor: pointer;
    border: 1px solid transparent;
    transition: all 0.2s ease;
}

.status-badge i {
    margin-right: 0.5rem;
    font-size: 1rem;
}

/* Status badge styles */
.status-badge-draft {
    background-color: #FEF3C7;
    color: #D97706;
    border-color: #FDE68A;
}

.status-badge-draft:hover {
    background-color: #FDE68A;
}

.status-badge-published {
    background-color: #D1FAE5;
    color: #059669;
    border-color: #A7F3D0;
}

.status-badge-published:hover {
    background-color: #A7F3D0;
}

.status-badge-archived { display:none; }

/* Dropdown styles */
.dropdown-menu {
    padding: 0.5rem;
    border: 1px solid #E5E7EB;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    border-radius: 0.5rem;
    min-width: 160px;
}

.dropdown-item {
    display: flex;
    align-items: center;
    padding: 0.5rem 0.75rem;
    border-radius: 0.375rem;
    font-size: 0.875rem;
    color: #374151;
    transition: all 0.2s ease;
}

.dropdown-item i {
    margin-right: 0.75rem;
    font-size: 1rem;
}

.dropdown-item:hover {
    background-color: #F8FAFC;
}

.dropdown-item.active {
    background-color: #F1F5F9;
    font-weight: 500;
}

.status-draft { color: #D97706; }
.status-published { color: #059669; }
.status-archived { display:none; }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h1 class="page-title">
                <i class="bi bi-newspaper me-2"></i>Kelola Berita
            </h1>
            <p class="page-subtitle mb-0">Manajemen informasi berita untuk sistem informasi pasar modern</p>
        </div>
        <div class="col-auto">
            <a href="/admin/berita/create" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Tambah Berita
            </a>
        </div>
    </div>
</div>

<div class="content-card">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" style="width: 50px;">#</th>
                    <th scope="col">INFORMASI BERITA</th>
                    <th scope="col">PENULIS</th>
                    <th scope="col">STATUS</th>
                    <th scope="col">VIEWS</th>
                    <th scope="col">TANGGAL PUBLIKASI</th>
                    <th scope="col" style="width: 150px;">AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($berita as $index => $item): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            <?php if (!empty($item['gambar'])): ?>
                                <img src="/uploads/berita/<?= $item['gambar'] ?>" alt="<?= esc($item['judul']) ?>" class="berita-thumbnail">
                            <?php endif; ?>
                            <div>
                                <div class="fw-medium"><?= esc($item['judul']) ?></div>
                                <div class="text-muted small"><?= substr(strip_tags($item['konten']), 0, 100) ?>...</div>
                            </div>
                        </div>
                    </td>
                    <td><?= esc($item['penulis'] ?? 'Admin') ?></td>
                    <td>
                        <div class="dropdown">
                            <?php
                            $statusConfig = [
                                'draft' => [
                                    'icon' => 'pencil-fill',
                                    'text' => 'Draft',
                                    'class' => 'status-draft'
                                ],
                                'published' => [
                                    'icon' => 'check-circle-fill',
                                    'text' => 'Published',
                                    'class' => 'status-published'
                                ]
                            ];
                            $currentStatus = $item['status'] ?? 'draft';
                            $statusInfo = $statusConfig[$currentStatus] ?? $statusConfig['draft'];
                            ?>
                            <button class="status-badge status-badge-<?= $currentStatus ?> dropdown-toggle" 
                                    type="button" 
                                    data-bs-toggle="dropdown" 
                                    data-bs-auto-close="true" 
                                    aria-expanded="false">
                                <i class="bi bi-<?= $statusInfo['icon'] ?>"></i>
                                <span><?= $statusInfo['text'] ?></span>
                            </button>
                            <ul class="dropdown-menu">
                                <?php foreach ($statusConfig as $status => $config): ?>
                                <li>
                                    <a class="dropdown-item <?= $currentStatus === $status ? 'active' : '' ?>"
                                       href="/admin/berita/changeStatus/<?= $item['id'] ?>/<?= $status ?>">
                                        <i class="bi bi-<?= $config['icon'] ?> <?= $config['class'] ?>"></i>
                                        <?= $config['text'] ?>
                                    </a>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </td>
                    <td><?= number_format($item['views'] ?? 0) ?></td>
                    <td><?= date('d M Y', strtotime($item['created_at'])) ?></td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="/admin/berita/edit/<?= $item['id'] ?>" class="btn btn-sm btn-outline-primary" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete(<?= $item['id'] ?>, '<?= esc($item['judul']) ?>')" title="Hapus">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Anda yakin ingin menghapus berita "<span id="deleteBeritaTitle"></span>"?</p>
                <p class="text-danger mb-0"><small>Tindakan ini tidak dapat dibatalkan.</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <a href="#" id="deleteBeritaBtn" class="btn btn-danger">Hapus</a>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(id, title) {
    document.getElementById('deleteBeritaTitle').textContent = title;
    document.getElementById('deleteBeritaBtn').href = '/admin/berita/delete/' + id;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
<?= $this->endSection() ?>
