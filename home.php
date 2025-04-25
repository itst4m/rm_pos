<?php include "head.php"; ?>
<script type="text/javascript">
	document.title="Dashboard";
	document.getElementById('dash').classList.add('active');
</script>

<div class="content">
	<div class="padding">

		<!-- Grid Dashboard -->
		<div class="dashboard-grid" style="display: flex; flex-wrap: wrap; gap: 20px;">
			<div class="box" style="flex: 1; min-width: 200px; background: #fff; border-radius: 10px; padding: 20px;">
				<i class="fa fa-user"></i> Login sebagai
				<span class="status" style="color: #4CAF50; font-weight: bold;">
					<?php 
					if ($_SESSION['status'] == 1) {
						echo "Owner";
					} elseif ($_SESSION['status'] == 2) {
						echo "Pimpinan";
					} else {
						echo "Kasir";
					}
					?>
				</span>
			</div>
			<div class="box" style="flex: 1; min-width: 200px; background: #fff; border-radius: 10px; padding: 20px;">
				<i class="fa fa-calendar"></i> Waktu
				<span class="status" style="color: #2196F3; font-weight: bold;">
					<?= date("d-m-Y") ?>
				</span>
			</div>
			<div class="box" style="flex: 1; min-width: 200px; background: #fff; border-radius: 10px; padding: 20px;">
				<i class="fa fa-bars"></i> Data Makanan
				<span class="status" style="color: #2196F3; font-weight: bold;">
					<?= $root->show_jumlah_makanan() ?>
				</span>
			</div>
			<div class="box" style="flex: 1; min-width: 200px; background: #fff; border-radius: 10px; padding: 20px;">
				<i class="fa fa-book"></i> Laporan
				<span class="status" style="color: #2196F3; font-weight: bold;">
					<?= $root->show_jumlah_trans2() ?>
				</span>
			</div>
		</div>

		<!-- Chart -->
		<div class="chart-container" style="margin-top: 40px; background: #fff; border-radius: 10px; padding: 30px;">
			<h3 style="margin-bottom: 20px;">📊 Makanan Paling Sering Dibeli</h3>
			<canvas id="chartMakanan" height="100"></canvas>
		</div>

	</div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Chart Rendering -->
<script>
const ctx = document.getElementById('chartMakanan');
new Chart(ctx, {
	type: 'bar',
	data: {
		labels: <?= json_encode($root->get_nama_makanan_terlaris()) ?>,
		datasets: [{
			label: 'Jumlah Terjual',
			data: <?= json_encode($root->get_jumlah_makanan_terlaris()) ?>,
			backgroundColor: 'rgba(33, 150, 243, 0.7)',
			borderColor: 'rgba(33, 150, 243, 1)',
			borderWidth: 2
		}]
	},
	options: {
		scales: {
			y: {
				beginAtZero: true
			}
		},
		plugins: {
			legend: {
				display: false
			}
		}
	}
});
</script>

<?php include "foot.php"; ?>
