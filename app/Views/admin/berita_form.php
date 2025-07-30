<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<div class="container py-4">
    <h3><?= isset($berita) ? 'Edit' : 'Tambah' ?> Berita</h3>
    <form method="post" action="<?= isset($berita) ? '/admin/berita/update/'.$berita['id'] : '/admin/berita/store' ?>" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Judul Berita</label>
            <input type="text" name="judul" class="form-control" value="<?= isset($berita) ? esc($berita['judul']) : '' ?>" required>
        </div>
        <div class="mb-3">
            <label>Gambar</label>
            <?php if (isset($berita) && $berita['gambar']): ?>
                <div class="mb-2">
                    <img src="/uploads/berita/<?= esc($berita['gambar']) ?>" alt="Current Image" style="max-width: 200px; height: auto;" class="border rounded">
                </div>
            <?php endif; ?>
            <input type="file" name="gambar" class="form-control" accept="image/*">
            <small class="text-muted">Format: JPG, PNG, GIF. Maksimal 2MB.</small>
        </div>
        <div class="mb-3">
            <label>Isi Berita</label>
            <textarea name="isi" class="form-control" rows="10" required><?= isset($berita) ? esc($berita['isi']) : '' ?></textarea>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="/admin/berita" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<script>
// Simple rich text editor
document.addEventListener('DOMContentLoaded', function() {
    const textarea = document.querySelector('textarea[name="isi"]');
    if (textarea) {
        textarea.addEventListener('keydown', function(e) {
            if (e.ctrlKey || e.metaKey) {
                switch(e.key) {
                    case 'b':
                        e.preventDefault();
                        wrapText('**', '**');
                        break;
                    case 'i':
                        e.preventDefault();
                        wrapText('*', '*');
                        break;
                }
            }
        });
        
        function wrapText(before, after) {
            const start = textarea.selectionStart;
            const end = textarea.selectionEnd;
            const selectedText = textarea.value.substring(start, end);
            const replacement = before + selectedText + after;
            textarea.value = textarea.value.substring(0, start) + replacement + textarea.value.substring(end);
            textarea.selectionStart = start + before.length;
            textarea.selectionEnd = end + before.length;
            textarea.focus();
        }
    }
});
</script>
<?= $this->endSection() ?> 