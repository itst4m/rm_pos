<?php 
include "root.php"; 
session_start();
if (!isset($_SESSION['username'])) {
	$root->redirect("index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="assets/index.css">
	<link rel="stylesheet" type="text/css" href="assets/awesome/css/font-awesome.min.css">
	<script type="text/javascript" src="assets/jquery.js"></script>
</head>
<body>

<div class="sidebar">
	<h3><i class="fa fa-shopping-cart"></i> Rumah Makan HI-TAM</h3>
	<ul>
		<?php
		$role = $_SESSION['status']; // 1 = admin, 2 = kasir, 3 = pimpinan

		// Info admin/kasir/pimpinan
		?>
		<li class="admin-info">
			<img src="assets/img/neon.jpg">
			<span><?= $_SESSION['username']; ?></span>
		</li>

		<?php if ($role == 1): // Admin ?>
			<li><a id="dash" href="home.php"><i class="fa fa-home"></i> Dashboard</a></li>
			<li><a id="makanan" href="makanan.php"><i class="fa fa-bars"></i> Menu Makan</a></li>
			<li><a id="kategori" href="kategori.php"><i class="fa fa-tags"></i> Kategori Makanan</a></li>
			<li><a id="users" href="users.php"><i class="fa fa-users"></i> Users</a></li>
			<li><a id="laporan" href="laporan.php"><i class="fa fa-book"></i> Laporan</a></li>

		<?php elseif ($role == 2): // Kasir ?>
			<li><a id="makanan" href="makanan.php"><i class="fa fa-bars"></i> Menu Makan</a></li>
			<li><a id="laporan" href="laporan.php"><i class="fa fa-book"></i> Laporan</a></li>
			
		<?php elseif ($role == 3): // Pimpinan ?>
			<li><a id="transaksi" href="transaksi.php"><i class="fa fa-money"></i> Transaksi</a></li>
			<li><a id="makanan" href="makanan.php"><i class="fa fa-bars"></i> Menu Makan</a></li>
		<?php endif; ?>
	</ul>
</div>

<div class="nav">
	<ul>
		<li>
			<a href="#"><i class="fa fa-user"></i> <?= $_SESSION['username'] ?></a>
			<ul>
				<?php if ($role == 1): ?>
					<li><a href="setting_akun.php"><i class="fa fa-cog"></i> Pengaturan Akun</a></li>
				<?php endif; ?>
				<li><a href="handler.php?action=logout"><i class="fa fa-sign-out"></i> Logout</a></li>
			</ul>
		</li>
	</ul>
</div>
