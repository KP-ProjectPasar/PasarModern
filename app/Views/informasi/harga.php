<?= $this->extend('layout') ?>

<?= $this->section('title') ?>Informasi Harga Komoditas<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
	body { font-family: 'Poppins', sans-serif; background: #f4f6f9; }
	.harga-wrapper { padding: 2rem 0; }
	.harga-card { background: #fff; border: 1px solid #e9edf5; border-radius: 16px; box-shadow: 0 8px 24px rgba(17,24,39,0.06); }
	.harga-header { border-bottom: 1px solid #eef2f7; padding: 1.5rem 1.75rem; }
	.harga-title { font-weight: 800; color: #0d6efd; letter-spacing: .3px; }
	.harga-subtitle { color: #6b7280; }
	.badge-update { background: #eef5ff; color: #0d6efd; border: 1px solid #d6e7ff; }
	.filter-bar { padding: 1rem 1.75rem; background: #fbfdff; border-bottom: 1px solid #eef2f7; }
	.table-harga { margin: 0; }
	.table-harga thead th { background: linear-gradient(90deg,#0d6efd,#0056b3); color: #fff; border: none; }
	.table-harga tbody tr { transition: background-color .15s ease; }
	.table-harga tbody tr:hover { background: #f8fbff; }
	.table-harga td, .table-harga th { vertical-align: middle; }
	/* Simplified text styles */
	.text-komoditas { font-weight: 600; color: #111827; }
	.text-kategori { color: #374151; }
	.text-price { font-weight: 700; color: #111827; }
	.empty-state { padding: 3rem 1rem; color: #94a3b8; }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<main class="container harga-wrapper">
	<div class="harga-card">
		<div class="harga-header text-center">
			<h2 class="harga-title mb-2"><i class="bi bi-currency-dollar me-2"></i>Informasi Harga Komoditas</h2>
			<p class="harga-subtitle mb-2">Update harga komoditas pasar modern Tangerang secara real-time, transparan, dan akurat.</p>
			<span class="badge badge-update"><i class="bi bi-clock-history me-1"></i>Update terakhir: <?= esc($lastUpdate) ?></span>
		</div>

		<form id="filterForm" method="get" class="filter-bar row g-2 align-items-center justify-content-center m-0">
			<div class="col-md-5">
				<input type="text" name="q" id="q" class="form-control" placeholder="Cari komoditas..." value="<?= esc($q) ?>">
			</div>
			<div class="col-md-3">
				<select name="kategori" id="kategori" class="form-select">
					<option value="">Semua Kategori</option>
					<?php foreach ($kategoriList as $kat): ?>
						<option value="<?= esc($kat) ?>" <?= $kategori == $kat ? 'selected' : '' ?>><?= esc(ucfirst($kat)) ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="col-md-2">
				<button type="submit" class="btn btn-primary w-100"><i class="bi bi-search"></i> Cari</button>
			</div>
		</form>

		<div class="table-responsive p-3 p-md-4">
			<table class="table table-hover table-harga">
				<thead>
					<tr>
						<th style="width:64px">#</th>
						<th>Komoditas</th>
						<th style="width:180px">Kategori</th>
						<th style="width:200px">Harga</th>
						<th style="width:200px">Tanggal</th>
					</tr>
				</thead>
				<tbody>
					<?php if (!empty($komoditasList)): ?>
						<?php foreach ($komoditasList as $i => $h): ?>
							<tr>
								<td><?= $i+1 ?></td>
								<td class="text-komoditas"><?= esc($h['nama_komoditas'] ?? $h['komoditas'] ?? '-') ?></td>
								<td class="text-kategori"><?= esc(ucfirst($h['kategori'] ?? '-')) ?></td>
								<td class="text-price">Rp <?= number_format($h['harga'], 0, ',', '.') ?></td>
								<td><?= esc(date('d M Y', strtotime($h['tanggal'] ?? $h['created_at'] ?? ''))) ?></td>
							</tr>
						<?php endforeach; ?>
					<?php else: ?>
						<tr>
							<td colspan="5" class="text-center empty-state">
								<i class="bi bi-inbox me-1"></i>Tidak ada data harga tersedia.
							</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</main>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
(function(){
	const form = document.getElementById('filterForm');
	const select = document.getElementById('kategori');
	const input = document.getElementById('q');

	// Auto-submit when category changes
	if (select) {
		select.addEventListener('change', () => form.submit());
	}
	// Submit on Enter inside search input
	if (input) {
		input.addEventListener('keydown', (e) => {
			if (e.key === 'Enter') { e.preventDefault(); form.submit(); }
		});
	}
})();
</script>
<?= $this->endSection() ?>
