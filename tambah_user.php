<script type="text/javascript">
	document.title="Tambah User";
	document.getElementById('users').classList.add('active');
</script>

<div class="content">
	<div class="padding">
		<div class="bgwhite">
			<div class="padding">
				<h3 class="jdl">Tambah User</h3>
				<form class="form-input" method="post" action="handler.php?action=tambah_kasir">
					<input type="text" name="nama_kasir" placeholder="Username User" required="required">
					<input autocomplete="off" type="text" name="password" placeholder="Password" required="required">
					<label for="role">Pilih Role:</label>
					<select name="status" id="role" required>
						<option value="2">Pimpinan</option>
						<option value="3">Kasir</option>
					</select>
					<button class="btnblue" type="submit"><i class="fa fa-save"></i> Simpan</button>
					<a href="users.php" class="btnblue" style="background: #f33155"><i class="fa fa-close"></i> Batal</a>
				</form>
			</div>
		</div>
	</div>
</div>
