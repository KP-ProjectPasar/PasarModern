<?= $this->extend('admin/layout') ?>

<?= $this->section('head') ?>
<link rel="stylesheet" href="/assets/css/admin/video-list-styles.css">
<link rel="stylesheet" href="/assets/css/admin/status-styles.css">
<script src="/assets/js/admin/video-list.js" defer></script>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Rest of your content above the status cell -->

<td>
    <div class="dropdown">
        <?php
        $currentStatus = $video['status'] ?? 'draft';
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
            ],
            
        ];
        $currentStatusConfig = $statusConfig[$currentStatus] ?? $statusConfig['draft'];
        ?>
        <button class="status-badge status-badge-<?= $currentStatus ?> dropdown-toggle" 
                type="button" 
                data-bs-toggle="dropdown" 
                data-bs-auto-close="outside"
                aria-expanded="false">
            <i class="bi bi-<?= $currentStatusConfig['icon'] ?>"></i>
            <span><?= $currentStatusConfig['text'] ?></span>
        </button>
        <ul class="dropdown-menu">
            <?php foreach ($statusConfig as $status => $config): ?>
            <li>
                <a class="dropdown-item <?= $currentStatus === $status ? 'active' : '' ?>"
                   href="/admin/video/changeStatus/<?= $video['id'] ?>/<?= $status ?>">
                    <i class="bi bi-<?= $config['icon'] ?> me-2 <?= $config['class'] ?>"></i>
                    <?= $config['text'] ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</td>

<!-- Rest of your content below the status cell -->
<?= $this->endSection() ?>
