<?php include "head.php" ?>
<?php
	if (isset($_GET['action']) && $_GET['action']=="tambah_user") {
		include "tambah_user.php";
	}
	else if (isset($_GET['action']) && $_GET['action']=="edit_user") {
		include "edit_user.php";
	}
	else{
?>
<script type="text/javascript">
	document.title="Data User";
	document.getElementById('users').classList.add('active');
</script>

<div class="content">
	<div class="padding">
		<div class="bgwhite">
			<div class="padding">
			<div class="contenttop">
				<div class="left">
				<a href="?action=tambah_user" class="btnblue">Tambah User</a>
				</div>
				<div class="both"></div>
			</div>
			<span class="label">Jumlah User : <?= $root->show_jumlah_user() ?></span>
			<table class="datatable" id="datatable" style="width: 600px;">
				<thead>
				<tr>
					<th width="10px">#</th>
					<th>Username</th>
					<th>Status</th>
					<th>Tanggal Didaftarkan</th>
					<th width="60px">Aksi</th>
				</tr>
			</thead>
			<tbody>
					<?php
					$root->tampil_user();
					?>
</tbody>

			</table>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function myconfirm(){
	return confirm("Yakin Ingin Menghapus User?");
	}
</script>

<?php 
}
include "foot.php" ?>
