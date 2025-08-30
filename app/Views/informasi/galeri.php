<?= $this->extend('layout') ?>

<?= $this->section('title') ?>Galeri<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
	body { font-family: 'Poppins', sans-serif; background: #f4f6f9; }
	.galeri-wrapper { padding: 2rem 0; }
	.galeri-card { background: #fff; border: 1px solid #e9edf5; border-radius: 16px; box-shadow: 0 8px 24px rgba(17,24,39,0.06); }
	.galeri-header { border-bottom: 1px solid #eef2f7; padding: 1.5rem 1.75rem; text-align: center; }
	.galeri-title { font-weight: 800; color: #0d6efd; letter-spacing: .3px; }
	.galeri-subtitle { color: #6b7280; }
	
	/* Navigation tabs */
	.nav-pills { border-bottom: 1px solid #eef2f7; padding: 0 1.75rem; }
	.nav-pills .nav-link { border: 1px solid #dbe7ff; border-radius: 8px 8px 0 0; margin-right: 0.5rem; color: #6b7280; }
	.nav-pills .nav-link.active { background: #0d6efd; color: #fff; border-color: #0d6efd; }
	.nav-pills .nav-link:hover:not(.active) { background: #f8fbff; color: #0d6efd; }
	
	/* Content area */
	.tab-content { padding: 1.75rem; }
	
	/* Gallery grid */
	.gallery-card { 
		background: #fff; 
		border: 1px solid #e9edf5; 
		border-radius: 14px; 
		overflow: hidden; 
		transition: transform .15s ease, box-shadow .15s ease; 
		height: 100%; 
		display: flex; 
		flex-direction: column;
	}
	.gallery-card:hover { transform: translateY(-2px); box-shadow: 0 12px 28px rgba(17,24,39,.08); }
	.gallery-thumb { 
		position: relative; 
		width: 100%; 
		padding-top: 62%; 
		background: #e3e6f3; 
		flex-shrink: 0;
	}
	.gallery-thumb > img, .gallery-thumb > iframe, .gallery-thumb > video { 
		position: absolute; 
		inset: 0; 
		width: 100%; 
		height: 100%; 
		object-fit: cover; 
		border: 0; 
	}
	
	/* YouTube iframe specific styles */
	.gallery-thumb iframe[src*="youtube.com"] {
		background: #000;
		position: absolute !important;
		top: 0 !important;
		left: 0 !important;
		width: 100% !important;
		height: 100% !important;
		z-index: 1;
	}
	.gallery-info { 
		padding: .75rem 1rem; 
		flex: 1; 
		display: flex; 
		flex-direction: column; 
		justify-content: space-between;
	}
	.gallery-title { 
		font-weight: 600; 
		color: #111827; 
		margin: 0 0 0.5rem 0; 
		font-size: .95rem; 
		line-height: 1.3; 
		word-wrap: break-word; 
		overflow-wrap: break-word; 
		flex: 1;
	}
	.featured-toggle { 
		display: flex; 
		align-items: center; 
		justify-content: space-between; 
		gap: 0.5rem; 
		flex-wrap: wrap; 
		margin-top: auto;
	}
	.play-overlay { position: absolute; right: .5rem; bottom: .5rem; background: rgba(0,0,0,.55); color: #fff; border-radius: 999px; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; }
	
	/* Featured toggle */
	.featured-toggle { 
		display: flex; 
		align-items: center; 
		justify-content: space-between; 
		gap: 0.5rem; 
		flex-wrap: wrap; 
		margin-top: 0.5rem;
	}
	.featured-badge { 
		font-size: 0.75rem; 
		padding: 0.25rem 0.5rem; 
		border-radius: 4px; 
		flex-shrink: 0;
	}
	.featured-badge.featured { background: #dcfce7; color: #166534; }
	.featured-badge.not-featured { background: #f3f4f6; color: #6b7280; }
	.toggle-btn { 
		padding: 0.25rem 0.5rem; 
		font-size: 0.75rem; 
		border-radius: 4px; 
		border: 1px solid; 
		cursor: pointer; 
		transition: all 0.2s; 
		flex-shrink: 0;
		white-space: nowrap;
	}
	.toggle-btn.featured { background: #dcfce7; color: #166534; border-color: #bbf7d0; }
	.toggle-btn.featured:hover { background: #bbf7d0; }
	.toggle-btn.not-featured { background: #f3f4f6; color: #6b7280; border-color: #d1d5db; }
	.toggle-btn.not-featured:hover { background: #e5e7eb; }
	
	/* Empty state */
	.empty-state { padding: 3rem 1rem; color: #94a3b8; text-align: center; }
	
	/* Responsive adjustments */
	@media (max-width: 768px) {
		.gallery-card {
			margin-bottom: 1rem;
		}
		.gallery-title {
			font-size: 0.9rem;
			line-height: 1.2;
		}
		.featured-toggle {
			flex-direction: column;
			align-items: stretch;
			gap: 0.25rem;
		}
		.toggle-btn {
			width: 100%;
			text-align: center;
		}
	}
	
	@media (max-width: 576px) {
		.gallery-info {
			padding: 0.5rem 0.75rem;
		}
		.gallery-title {
			font-size: 0.85rem;
			margin-bottom: 0.25rem;
		}
		.featured-badge, .toggle-btn {
			font-size: 0.7rem;
			padding: 0.2rem 0.4rem;
		}
	}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<main class="container galeri-wrapper">
	<div class="galeri-card">
		<div class="galeri-header">
			<h2 class="galeri-title mb-2"><i class="bi bi-images me-2"></i>Galeri Pasar Modern</h2>
			<p class="galeri-subtitle">Kumpulan foto dan video kegiatan di Pasar Modern Tangerang. Pilih konten yang akan ditampilkan di halaman utama.</p>
		</div>

		<ul class="nav nav-pills" id="galeriTabs" role="tablist">
			<li class="nav-item" role="presentation">
				<button class="nav-link active" id="foto-tab" data-bs-toggle="pill" data-bs-target="#tab-foto" type="button" role="tab" aria-controls="tab-foto" aria-selected="true">
					<i class="bi bi-image me-1"></i> Foto
				</button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link" id="video-tab" data-bs-toggle="pill" data-bs-target="#tab-video" type="button" role="tab" aria-controls="tab-video" aria-selected="false">
					<i class="bi bi-camera-video me-1"></i> Video
				</button>
			</li>
		</ul>

		<div class="tab-content" id="galeriTabsContent">
			<div class="tab-pane fade show active" id="tab-foto" role="tabpanel" aria-labelledby="foto-tab">
				<div class="row g-3">
					<?php
					$galeriModel = new \App\Models\GaleriModel();
					$galeriList = $galeriModel->findAll();
					if (!empty($galeriList)):
						foreach ($galeriList as $item):
							$img = $item['gambar'] ?? $item['foto'] ?? '';
							if ($img && !str_starts_with($img, '/uploads')) { $img = '/uploads/galeri/' . $img; }
							$isFeatured = $item['featured'] ?? 0;
					?>
					<div class="col-6 col-md-4 col-lg-3">
						<div class="gallery-card">
							<div class="gallery-thumb">
								<img src="<?= esc($img ?: '/assets/img/Picture2.png') ?>" alt="<?= esc($item['judul'] ?? 'Galeri') ?>" onerror="this.src='/assets/img/Picture2.png'">
							</div>
							<div class="gallery-info">
								<p class="gallery-title" title="<?= esc($item['judul'] ?? 'Galeri') ?>"><?= esc($item['judul'] ?? 'Galeri') ?></p>
								<div class="featured-toggle">
									<span class="featured-badge <?= $isFeatured ? 'featured' : 'not-featured' ?>">
										<?= $isFeatured ? 'Ditampilkan' : 'Tidak Ditampilkan' ?>
									</span>
									<button class="toggle-btn <?= $isFeatured ? 'featured' : 'not-featured' ?>" 
											onclick="toggleFeatured('galeri', <?= $item['id'] ?>, <?= $isFeatured ? 0 : 1 ?>)"
											style="min-width: 80px; padding: 4px 8px; font-size: 12px; border-radius: 4px; cursor: pointer; white-space: nowrap;">
										<?= $isFeatured ? 'Hapus' : 'Tampilkan' ?>
									</button>
								</div>
							</div>
						</div>
					</div>
					<?php endforeach; else: ?>
						<div class="col-12">
							<div class="empty-state">
								<i class="bi bi-images me-2" style="font-size: 2rem;"></i>
								<p class="mb-0">Belum ada foto tersedia.</p>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<div class="tab-pane fade" id="tab-video" role="tabpanel" aria-labelledby="video-tab">
				<div class="row g-3">
					<?php
					$videoModel = new \App\Models\VideoModel();
					$videos = $videoModel->getPublishedVideos();
					$toEmbed = function(string $url): string {
						// YouTube URL patterns - simplified and more robust
						if (preg_match('/(?:https?:\/\/)?(?:www\.)?(?:m\.)?(?:youtube\.com|youtu\.be)\/(?:watch\?v=|embed\/|v\/|shorts\/)?([\w-]{11})(?:\S+)?/', $url, $matches)) {
							$videoId = $matches[1];
							// Simplified embed URL without complex parameters
							$embedUrl = 'https://www.youtube.com/embed/' . $videoId;
							
							// Debug logging
							error_log("YouTube URL processed: {$url} -> {$embedUrl}");
							
							return $embedUrl;
						}
						
						// Google Drive view URL to preview
						if (preg_match('/drive\.google\.com\/file\/d\/([a-zA-Z0-9_-]+)\/view/', $url, $matches)) {
							return 'https://drive.google.com/file/d/' . $matches[1] . '/preview';
						}
						
						// Vimeo URLs
						if (preg_match('/(?:https?:\/\/)?(?:www\.)?(?:vimeo\.com\/)(\d+)/', $url, $matches)) {
							return 'https://player.vimeo.com/video/' . $matches[1];
						}
						
						// TikTok URLs (basic support)
						if (preg_match('/(?:https?:\/\/)?(?:www\.)?(?:tiktok\.com\/@[\w.-]+\/video\/)(\d+)/', $url, $matches)) {
							return 'https://www.tiktok.com/embed/' . $matches[1];
						}
						
						// If it's already an embed URL, return as is
						if (strpos($url, 'embed') !== false || strpos($url, 'player') !== false) {
							return $url;
						}
						
						// For other URLs, try to make them embeddable
						return $url;
					};
					?>
					<?php if (!empty($videos)): foreach ($videos as $v): 
						$isFeatured = $v['featured'] ?? 0;
					?>
					<div class="col-12 col-md-6 col-lg-4">
						<div class="gallery-card">
							<div class="gallery-thumb">
								<?php if (($v['tipe'] ?? '') === 'url' && !empty($v['url'])): 
									$embed = $toEmbed($v['url']);
									$isYouTube = strpos($embed, 'youtube.com/embed') !== false;
									$isGoogleDrive = strpos($embed, 'drive.google.com') !== false;
									$isVimeo = strpos($embed, 'vimeo.com') !== false;
									
									// Debug info
									if ($isYouTube) {
										echo "<!-- Debug: Original URL: " . esc($v['url']) . " -->";
										echo "<!-- Debug: Embed URL: " . esc($embed) . " -->";
									}
								?>
									<?php if ($isYouTube): ?>
										<iframe src="<?= esc($embed) ?>" 
												width="100%" 
												height="100%" 
												frameborder="0" 
												allowfullscreen>
										</iframe>
									<?php elseif ($isGoogleDrive): ?>
										<iframe src="<?= esc($embed) ?>" 
												allowfullscreen 
												referrerpolicy="no-referrer"
												style="width: 100%; height: 100%; border: 0;">
										</iframe>
									<?php elseif ($isVimeo): ?>
										<iframe src="<?= esc($embed) ?>" 
												allowfullscreen 
												referrerpolicy="no-referrer"
												style="width: 100%; height: 100%; border: 0;">
										</iframe>
									<?php else: ?>
										<iframe src="<?= esc($embed) ?>" 
												allowfullscreen 
												referrerpolicy="no-referrer"
												onload="this.style.display='block'"
												onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
												style="display: none;">
										</iframe>
										<div class="video-fallback" style="display: flex; align-items: center; justify-content: center; height: 100%; background: #f8f9fa; color: #6c757d; text-align: center; padding: 1rem;">
											<div>
												<i class="bi bi-play-circle" style="font-size: 2rem; margin-bottom: 0.5rem;"></i>
												<div class="small">
													Video Eksternal<br>
													<small class="text-muted"><?= esc($v['url']) ?></small>
												</div>
											</div>
										</div>
									<?php endif; ?>
								<?php elseif (!empty($v['file_video'])): 
									$src = str_starts_with($v['file_video'], '/uploads') ? $v['file_video'] : '/uploads/video/' . $v['file_video']; 
								?>
									<video controls preload="metadata" style="width: 100%; height: 100%; object-fit: cover;">
										<source src="<?= esc($src) ?>" type="video/mp4">
										<div class="video-fallback" style="display: flex; align-items: center; justify-content: center; height: 100%; background: #f8f9fa; color: #6c757d;">
											<i class="bi bi-file-earmark-play me-2"></i>Video tidak dapat diputar
										</div>
									</video>
								<?php else: ?>
									<div class="d-flex align-items-center justify-content-center h-100 text-muted">
										<i class="bi bi-exclamation-triangle me-2"></i>Video tidak tersedia
									</div>
								<?php endif; ?>
								<?php if (!$isYouTube): ?>
									<div class="play-overlay"><i class="bi bi-play-fill"></i></div>
								<?php endif; ?>
							</div>
							<div class="gallery-info">
								<p class="gallery-title"><?= esc($v['judul'] ?? 'Video') ?></p>
								<div class="featured-toggle" style="min-height: 40px; display: flex; align-items: center; justify-content: center; gap: 8px;">
									<span class="featured-badge <?= $isFeatured ? 'featured' : 'not-featured' ?>">
										<?= $isFeatured ? 'Ditampilkan' : 'Tidak Ditampilkan' ?>
									</span>
									<button class="toggle-btn <?= $isFeatured ? 'featured' : 'not-featured' ?>" 
											onclick="toggleFeatured('video', <?= $v['id'] ?>, <?= $isFeatured ? 0 : 1 ?>)"
											style="min-width: 80px; padding: 4px 8px; font-size: 12px; border-radius: 4px; cursor: pointer;">
										<?= $isFeatured ? 'Hapus' : 'Tampilkan' ?>
									</button>
								</div>
							</div>
						</div>
					</div>
					<?php endforeach; else: ?>
						<div class="col-12">
							<div class="empty-state">
								<i class="bi bi-camera-video me-2" style="font-size: 2rem;"></i>
								<p class="mb-0">Belum ada video tersedia.</p>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</main>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function toggleFeatured(type, id, featured) {
    const url = `/admin/${type}/toggle-featured/${id}`;
    
    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({ featured: featured })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Reload the page to show updated status
            location.reload();
        } else {
            alert('Gagal mengubah status featured: ' + (data.message || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat mengubah status featured');
    });
}

// YouTube iframe error handling
document.addEventListener('DOMContentLoaded', function() {
    const youtubeIframes = document.querySelectorAll('iframe[src*="youtube.com"]');
    
    youtubeIframes.forEach(function(iframe) {
        iframe.addEventListener('load', function() {
            console.log('YouTube iframe loaded successfully:', iframe.src);
        });
        
        iframe.addEventListener('error', function() {
            console.error('YouTube iframe failed to load:', iframe.src);
            // Show fallback
            const fallback = iframe.nextElementSibling;
            if (fallback && fallback.classList.contains('video-fallback')) {
                fallback.style.display = 'flex';
            }
        });
    });
});
</script>
<?= $this->endSection() ?>
