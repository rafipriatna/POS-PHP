<?php
	include('koneksi.php');
	// Proses masuk.
	if(isset($_POST['masuk'])){
		$username = mysqli_real_escape_string($koneksi, $_POST['username']);
		$password = mysqli_real_escape_string($koneksi, $_POST['password']);
		// Cek username dari database.
		$cek 			= $koneksi->query("SELECT * FROM tb_pengguna WHERE username = '".$username."'");
		$data 			= mysqli_num_rows($cek);

		if($data  == 1){
			$row = mysqli_fetch_assoc($cek);
			// Meriksa password dari database.
			if(password_verify($password, $row['password'])){
				$id_pelogin				= $row['id'];
				$nama_pelogin 			= $row['nama'];
				$foto_pelogin 			= $row['foto'];
				$level_pelogin			= $row['level'];
				session_start();
				$_SESSION['id']			= $id_pelogin;
    			$_SESSION['nama'] 		= $nama_pelogin;
      			$_SESSION['foto'] 		= $foto_pelogin;
				$_SESSION['level'] 		= $level_pelogin;
				// Mengambil waktu last login.
				$setting    			= new DateTime('NOW', new DateTimeZone('Asia/Jakarta'));
				$waktu					= $setting->format('Y-m-d g:i:s');
				$_SESSION['masuk']		= $waktu;
				// Diberi waktu 30 x 60 detik. ( 30 Menit ).
				$_SESSION['habis'] 		= 30 * 60;
			// Jika password cocok dengan yang di database.
			// Cek level.
			if($level_pelogin == 'Admin'){
				header('location:index.php');
			}elseif($level_pelogin == 'Kasir'){
				header('location:index.php');
			}
			}else{
			// Jika password dan username tidak cocok dengan yang di database.
				echo "<script type='text/javascript'>alert('Username atau password salah!'); window.location.href='masuk.php';</script>";
			}
		}
	}
?>