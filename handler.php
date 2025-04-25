<?php
include "root.php";

if (isset($_GET['action'])) {
	$action=$_GET['action'];
	if ($action=="login") {
		$root->login($_POST['username'],$_POST['pass'],$_POST['loginas']);
	}
	if ($action=="logout") {
		session_start();
		session_destroy();
		$root->redirect("index.php");
	}
	if ($_GET['action'] == "tambah_barang") {
		$nama_barang = $_POST['nama_barang'];
		$id_kategori = intval($_POST['kategori']);
		$stok = intval($_POST['stok']);
		$harga_jual = intval($_POST['harga_jual']);
	
		// Folder upload
		$folder = "uploads/makanan/";
		if (!is_dir($folder)) {
			mkdir($folder, 0755, true);
		}
	
		// Proses upload gambar
		$gambar = $_FILES['gambar']['name'];
		$tmp = $_FILES['gambar']['tmp_name'];
		$error = $_FILES['gambar']['error'];
	
		$ext = pathinfo($gambar, PATHINFO_EXTENSION);
		$nama_file = uniqid('makanan_') . '.' . $ext;
	
		// Validasi ekstensi file (optional tapi disarankan)
		$allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
		if (!in_array(strtolower($ext), $allowed_ext)) {
			echo "<script>alert('Format file tidak didukung!'); window.history.back();</script>";
			exit;
		}
	
		if ($error === UPLOAD_ERR_OK && move_uploaded_file($tmp, $folder . $nama_file)) {
			// Simpan ke database
			$stmt = $root->con->prepare("INSERT INTO makanan (nama_barang, id_kategori, stok, harga_jual, gambar, date_added) VALUES (?, ?, ?, ?, ?, NOW())");
			$stmt->bind_param("siiis", $nama_barang, $id_kategori, $stok, $harga_jual, $nama_file);
	
			if ($stmt->execute()) {
				echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='makanan.php';</script>";
			} else {
				echo "<script>alert('Gagal menambahkan data ke database!'); window.history.back();</script>";
			}
		} else {
			echo "<script>alert('Upload gambar gagal!'); window.history.back();</script>";
		}
	}	
	if ($action == "tambah_kategori") {
		$nama_kategori = trim($_POST['nama_kategori']);
		if (empty($nama_kategori)) {
			echo "<script>alert('Nama kategori tidak boleh kosong!'); window.history.back();</script>";
		} else {
			$root->tambah_kategori($nama_kategori);
		}
	}	
	if ($action == "hapus_kategori") {
		$root->hapus_kategori($_GET['id_kategori']);
	}
	if ($action == "edit_kategori") {
		$id_kategori = $_POST['id_kategori'];
		$nama_kategori = trim($_POST['nama_kategori']);
	
		if (empty($nama_kategori)) {
			echo "<script>alert('Nama kategori tidak boleh kosong!'); window.history.back();</script>";
		} else {
			$root->aksi_edit_kategori($id_kategori, $nama_kategori);
		}
	}	
	if ($_GET['action'] == "hapus_barang") {
		$id_barang = $_GET['id_barang'];
	
		// Ambil data gambar terlebih dulu
		$data = $con->query("SELECT gambar FROM makanan WHERE id_barang='$id_barang'")->fetch_assoc();
		$gambar = $data['gambar'];
	
		// Hapus dari DB
		$hapus = $con->query("DELETE FROM makanan WHERE id_barang='$id_barang'");
	
		if ($hapus) {
			// Hapus file gambar juga
			if (file_exists("uploads/" . $gambar)) {
				unlink("uploads/" . $gambar);
			}
	
			echo "<script>
				alert('Data berhasil dihapus!');
				window.location.href='makanan.php';
			</script>";
		} else {
			echo "<script>
				alert('Gagal menghapus data!');
				window.history.back();
			</script>";
		}
	}	
	if ($_GET['action'] == "edit_barang") {
		$id_barang   = $_POST['id_barang'];
		$nama_barang = $_POST['nama_barang'];
		$id_kategori = intval($_POST['kategori']);
		$stok        = intval($_POST['stok']);
		$harga_jual  = intval($_POST['harga_jual']);
		$gambar_lama = $_POST['gambar_lama'];
	
		$folder = "uploads/makanan/";
		if (!is_dir($folder)) {
			mkdir($folder, 0755, true);
		}
	
		$gambar_baru = $_FILES['gambar']['name'];
		$tmp         = $_FILES['gambar']['tmp_name'];
		$error       = $_FILES['gambar']['error'];
	
		$nama_file = $gambar_lama;
	
		// Jika user upload gambar baru
		if (!empty($gambar_baru)) {
			$ext = pathinfo($gambar_baru, PATHINFO_EXTENSION);
			$allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
	
			if (!in_array(strtolower($ext), $allowed_ext)) {
				echo "<script>alert('Format file tidak didukung!'); window.history.back();</script>";
				exit;
			}
	
			$nama_file = uniqid('makanan_') . '.' . $ext;
	
			if ($error === UPLOAD_ERR_OK && move_uploaded_file($tmp, $folder . $nama_file)) {
				// Hapus gambar lama
				if (file_exists($folder . $gambar_lama)) {
					unlink($folder . $gambar_lama);
				}
			} else {
				echo "<script>alert('Gagal upload gambar baru!'); window.history.back();</script>";
				exit;
			}
		}
	
		// Update data
		$stmt = $root->con->prepare("UPDATE makanan SET nama_barang=?, id_kategori=?, stok=?, harga_jual=?, gambar=? WHERE id_barang=?");
		$stmt->bind_param("siiisi", $nama_barang, $id_kategori, $stok, $harga_jual, $nama_file, $id_barang);
	
		if ($stmt->execute()) {
			echo "<script>alert('Data berhasil diupdate!'); window.location.href='makanan.php';</script>";
		} else {
			echo "<script>alert('Gagal update data!'); window.history.back();</script>";
		}
	}	
	// Tambah User
	if ($action == "tambah_user") {
		$root->tambah_user($_POST['nama_kasir'], $_POST['password'], $_POST['status']);
	}

	// Edit User
	if ($action == "edit_user") {
		$root->aksi_edit_user($_POST['nama_kasir'], $_POST['password'], $_POST['status'], $_POST['id']);
	}

	// Hapus User
	if ($action == "hapus_user") {
		$root->hapus_user($_GET['id_user']);
	}		
	if ($action=="edit_admin") {
		$root->aksi_edit_admin($_POST['username'],$_POST['password']);
	}
	if ($action=="reset_admin") {
		$pass=sha1("admin");
		$q=$root->con->query("update user set username='admin',password='$pass',date_created=date_created where id='1'");
		if ($q === TRUE) {
			$root->alert("admin berhasil direset, username & password = 'admin'");
			session_start();
			session_destroy();
			$root->redirect("index.php");
		}
	}
	if ($action=="tambah_tempo") {
		$root->tambah_tempo($_POST['id_barang'],$_POST['jumlah'],$_POST['trx']);
	}
	if ($action=="hapus_tempo") {
		$root->hapus_tempo($_GET['id_tempo'],$_GET['id_barang'],$_GET['jumbel']);
	}
	if ($action=="selesai_transaksi") {
		session_start();
		$trx=date("d")."/AF/".$_SESSION['id']."/".date("y/h/i/s");

			$query=$root->con->query("insert into transaksi set kode_kasir='$_SESSION[id]',total_bayar='$_POST[total_bayar]',no_invoice='$trx',nama_pembeli='$_POST[nama_pembeli]'");

		$trx2=date("d")."/AF/".$_SESSION['id']."/".date("y");
		$get1=$root->con->query("select *  from transaksi where no_invoice='$trx'");
		$datatrx=$get1->fetch_assoc();
		$id_transaksi2=$datatrx['id_transaksi'];

		$query2=$root->con->query("select * from tempo where trx='$trx2'");
		while ($f=$query2->fetch_assoc()) {
			$root->con->query("insert into sub_transaksi set id_barang='$f[id_barang]',id_transaksi='$id_transaksi2',jumlah_beli='$f[jumlah_beli]',total_harga='$f[total_harga]',no_invoice='$trx'");
		}
		$root->con->query("delete from tempo where trx='$trx2'");
		$root->alert("Transaksi berhasil");
		$root->redirect("transaksi.php");


	}
	if ($action=="delete_transaksi") {
		$q1=$root->con->query("delete from transaksi where id_transaksi='$_GET[id]'");
		$q2=$root->con->query("delete from sub_transaksi where id_transaksi='$_GET[id]'");
		if ($q1===TRUE && $q2 === TRUE) {
			$root->alert("Transaksi No $_GET[id] Berhasil Dihapus");
			$root->redirect("laporan.php");
		}
	}


}else{
	echo "no direct script are allowed";
}
?>
