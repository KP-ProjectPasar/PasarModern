<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<div class="container py-4">
    <h3><?= isset($video) ? 'Edit' : 'Tambah' ?> Video</h3>
    <form method="post" action="<?= isset($video) ? '/admin/video/update/'.$video['id'] : '/admin/video/store' ?>" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Judul Video</label>
            <input type="text" name="judul" class="form-control" value="<?= isset($video) ? esc($video['judul']) : '' ?>" required>
        </div>
        
        <div class="mb-3">
            <label>Tipe Video</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="tipe" id="tipe_url" value="url" <?= (!isset($video) || $video['tipe'] === 'url') ? 'checked' : '' ?>>
                <label class="form-check-label" for="tipe_url">
                    URL Video (YouTube, Vimeo, dll)
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="tipe" id="tipe_file" value="file" <?= (isset($video) && $video['tipe'] === 'file') ? 'checked' : '' ?>>
                <label class="form-check-label" for="tipe_file">
                    Upload File Video
                </label>
            </div>
        </div>
        
        <div class="mb-3" id="url_section">
            <label>URL Video</label>
            <input type="url" name="url" class="form-control" value="<?= isset($video) ? esc($video['url']) : '' ?>" 
                   placeholder="https://www.youtube.com/watch?v=... atau https://vimeo.com/...">
            <small class="text-muted">Masukkan URL video dari YouTube, Vimeo, atau platform video lainnya</small>
        </div>
        
        <div class="mb-3" id="file_section" style="display: none;">
            <label>File Video</label>
            <?php if (isset($video) && $video['file_video']): ?>
                <div class="mb-2">
                    <video controls style="max-width: 300px; height: auto;" class="border rounded">
                        <source src="/uploads/video/<?= esc($video['file_video']) ?>" type="video/mp4">
                        Browser Anda tidak mendukung tag video.
                    </video>
                </div>
            <?php endif; ?>
            <input type="file" name="file_video" class="form-control" accept="video/*">
            <small class="text-muted">Format: MP4, AVI, MOV. Maksimal 100MB.</small>
        </div>
        
        <?php if (isset($video) && $video['url']): ?>
        <div class="mb-3">
            <label>Preview Video</label>
            <div class="ratio ratio-16x9">
                <?php 
                $videoId = '';
                if (strpos($video['url'], 'youtube.com/watch?v=') !== false) {
                    $videoId = substr($video['url'], strpos($video['url'], 'v=') + 2);
                } elseif (strpos($video['url'], 'youtu.be/') !== false) {
                    $videoId = substr($video['url'], strpos($video['url'], 'youtu.be/') + 9);
                }
                ?>
                <?php if ($videoId): ?>
                    <iframe src="https://www.youtube.com/embed/<?= $videoId ?>" 
                            title="<?= esc($video['judul']) ?>" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen></iframe>
                <?php else: ?>
                    <div class="bg-light d-flex align-items-center justify-content-center">
                        <p class="text-muted">URL tidak valid atau tidak didukung</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
        
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="/admin/video" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const urlRadio = document.getElementById('tipe_url');
    const fileRadio = document.getElementById('tipe_file');
    const urlSection = document.getElementById('url_section');
    const fileSection = document.getElementById('file_section');
    
    function toggleSections() {
        if (urlRadio.checked) {
            urlSection.style.display = 'block';
            fileSection.style.display = 'none';
        } else {
            urlSection.style.display = 'none';
            fileSection.style.display = 'block';
        }
    }
    
    urlRadio.addEventListener('change', toggleSections);
    fileRadio.addEventListener('change', toggleSections);
    
    // Initial state
    toggleSections();
});
</script>
<?= $this->endSection() ?> 