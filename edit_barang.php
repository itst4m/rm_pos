<script type="text/javascript">
	document.title = "Edit Makanan";
	document.getElementById('barang').classList.add('active');
</script>

<div class="content">
	<div class="padding">
		<div class="bgwhite">
			<div class="padding">
				<h3 class="jdl">Edit Data Makanan</h3>
				<?php $f = $root->edit_makanan($_GET['id_barang']); ?>
				<form class="form-input" method="post" action="handler.php?action=edit_barang" enctype="multipart/form-data" style="padding-top: 30px;">
					<input type="hidden" name="id_barang" value="<?= $f['id_barang'] ?>">
					<input type="hidden" name="gambar_lama" value="<?= $f['gambar'] ?>">

					<input type="text" disabled value="ID barang : <?= $f['id_barang'] ?>">

					<label>Nama Makanan :</label>
					<input type="text" name="nama_barang" placeholder="Nama Barang" required value="<?= $f['nama_barang'] ?>">

					<label>Stock :</label>
					<input type="number" name="stok" placeholder="Stok" required value="<?= $f['stok'] ?>">

					<label>Harga Jual :</label>
					<input type="number" name="harga_jual" placeholder="Harga Jual" required value="<?= $f['harga_jual'] ?>">

					<label>Kategori Makanan :</label>
					<select style="width: 372px; cursor: pointer;" required name="kategori">
						<option value="">Pilih Kategori Makanan :</option>
						<?php $root->tampil_kategori3($_GET['id_barang']); ?>
					</select>

					<label>Gambar Saat Ini:</label><br>
					<?php if (!empty($f['gambar']) && file_exists("uploads/makanan/{$f['gambar']}")): ?>
						<img src="uploads/makanan/<?= $f['gambar'] ?>" alt="Gambar Makanan" width="150" style="margin-bottom: 10px;"><br>
					<?php else: ?>
						<span style="color: #aaa;">(Tidak ada gambar)</span><br>
					<?php endif; ?>

					<label>Ganti Gambar (opsional):</label>
					<input type="file" name="gambar" accept="image/*">

					<br><br>
					<button class="btnblue" type="submit"><i class="fa fa-save"></i> Simpan</button>
					<a href="makanan.php" class="btnblue" style="background: #f33155"><i class="fa fa-close"></i> Batal</a>
				</form>
			</div>
		</div>
	</div>
</div>
