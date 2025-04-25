<script type="text/javascript">
	document.title = "Edit User";
	document.getElementById('users').classList.add('active');
</script>

<div class="content">
	<div class="padding">
		<div class="bgwhite">
			<div class="padding">
				<h3 class="jdl">Edit Kasir</h3>
				<?php $f = $root->edit_user($_GET['id']); ?>
				<form class="form-input" method="post" action="handler.php?action=edit_user">
					<input type="hidden" name="id" value="<?= $f['id'] ?>">
					
					<input type="text" name="nama_kasir" placeholder="Username User" required value="<?= $f['username'] ?>">
					
					<input autocomplete="off" type="text" name="password" placeholder="Password">
					
					<label for="role">Pilih Role:</label>
					<select name="status" id="role" required>
						<option value="2" <?= $f['status'] == '2' ? 'selected' : '' ?>>Pimpinan</option>
						<option value="3" <?= $f['status'] == '3' ? 'selected' : '' ?>>Kasir</option>
					</select>

					<label>* Kosongkan password jika tidak ingin mengubahnya</label><br><br>
					
					<button class="btnblue" type="submit"><i class="fa fa-save"></i> Simpan</button>
					<a href="users.php" class="btnblue" style="background: #f33155"><i class="fa fa-close"></i> Batal</a>
				</form>
			</div>
		</div>
	</div>
</div>
