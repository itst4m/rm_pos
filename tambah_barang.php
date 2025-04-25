<script type="text/javascript">
	document.title="Tambah Makanan";
	document.getElementById('barang').classList.add('active');
</script>

<div class="content">
	<div class="padding">
		<div class="bgwhite">
			<div class="padding">
				<h3 class="jdl">Tambah Barang</h3>
				<form class="form-input" method="post" action="handler.php?action=tambah_barang" enctype="multipart/form-data">
					<input type="text" name="nama_barang" placeholder="Nama Barang" required="required">
					<input type="number" name="stok" placeholder="Stok" required="required">
					<input type="number" name="harga_jual" placeholder="Harga Jual" required="required">
					<select style="width: 372px;cursor: pointer;" required="required" name="kategori">
						<option value="">Pilih Kategori :</option>
						<?php $root->tampil_kategori2(); ?>
					</select>
					<input type="file" name="gambar" accept="image/*" required="required">
					<button class="btnblue" type="submit"><i class="fa fa-save"></i> Simpan</button>
					<a href="makanan.php" class="btnblue" style="background: #f33155"><i class="fa fa-close"></i> Batal</a>
				</form>
			</div>
		</div>
	</div>
</div>
