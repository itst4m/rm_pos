<?php include "head.php" ?>
<?php
$role = $_SESSION['status']; // 1 = superadmin, 2 = pimpinan, 3 = kasir

// Cegah akses ke form tambah/edit jika Pimpinan
if (isset($_GET['action']) && $_GET['action'] == "tambah_barang" && $role != 2) {
	include "tambah_barang.php";
} else if (isset($_GET['action']) && $_GET['action'] == "edit_barang" && $role != 2) {
	include "edit_barang.php";
} else {
?>
<script type="text/javascript">
	document.title = "Makanan";
	document.getElementById('makanan').classList.add('active');
</script>
<script type="text/javascript" src="assets/jquery.tablesorter.min.js"></script>
<script type="text/javascript">
    $(function(){
    	$.tablesorter.addWidget({
    		id: "indexFirstColumn",
    		format: function(table) {
    			$(table).find("tr td:first-child").each(function(index){
    				$(this).text(index + 1);
    			})
    		}
    	});
    	$("table").tablesorter({
    		widgets: ['indexFirstColumn'],
    		headers: {
        		0: { sorter: false },
        		3: { sorter: false },
        		4: { sorter: false },
        		5: { sorter: false },
        		6: { sorter: false },
        		7: { sorter: false },
        		8: { sorter: false },
        	}
    	});
    });
</script>
<div class="content">
	<div class="padding">
		<div class="bgwhite">
			<div class="padding">
			<div class="contenttop">
				<div class="left">
					<?php if ($role != 2): ?>
						<a href="?action=tambah_barang" class="btnblue"><i class="fa fa-plus"></i> Tambah Makanan</a>
					<?php endif; ?>
				</div>
				<div class="right">
					<script type="text/javascript">
						function gotocat(val){
							var value = val.options[val.selectedIndex].value;
							window.location.href = "makanan.php?id_cat=" + value;
						}
					</script>
					<select class="leftin1" onchange="gotocat(this)">
						<option value="">Filter kategori</option>
						<?php
							$data = $root->con->query("SELECT * FROM kategori");
							while ($f = $data->fetch_assoc()) {
								?>
								<option <?php if (isset($_GET['id_cat']) && $_GET['id_cat'] == $f['id_kategori']) echo "selected"; ?> value="<?= $f['id_kategori'] ?>">
									<?= $f['nama_kategori'] ?>
								</option>
								<?php
							}
						?>
					</select>
					<form class="leftin">
						<input type="search" name="q" placeholder="Cari Makanan..." value="<?php echo $keyword = isset($_GET['q']) ? $_GET['q'] : ""; ?>">
						<button><i class="fa fa-search"></i></button>
					</form>
				</div>
				<div class="both"></div>
			</div>
			<span class="label">Jumlah Makanan : <?= $root->show_jumlah_makanan() ?></span>
			<table class="datatable" id="datatable">
				<thead>
				<tr>
					<th width="10px">#</th>
					<th style="cursor: pointer;">Nama Makanan <i class="fa fa-sort"></i></th>
					<th style="cursor: pointer;" width="100px">Kategori <i class="fa fa-sort"></i></th>
					<th>Stok</th>
					<th width="120px">Harga Jual</th>
					<th width="150px">Tanggal Ditambahkan</th>
					<th width="80px">Gambar</th>
					<th width="60px">Aksi</th>
				</tr>
				</thead>
				<tbody>
					<?php
					if (isset($_GET['id_cat']) && $_GET['id_cat']) {
						$root->tampil_makanan_filter($_GET['id_cat']);
					} else {
						$keyword = isset($_GET['q']) ? $_GET['q'] : "null";
						$root->tampil_makanan($keyword);
					}
					?>
				</tbody>
			</table>
			</div>
		</div>
	</div>
</div>

<?php 
}
include "foot.php" ?>
