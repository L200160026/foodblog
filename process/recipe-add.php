<?php
	include 'connection.php';
	session_start();
	if ($_SESSION) {
		if ($_SESSION['Halaman'] == 'Foodblog') {
			$ID_Akun = $_SESSION['ID_Akun'];
			$Email = $_SESSION['Email'];
			$Password = $_SESSION['Password'];

			$query = "SELECT * FROM Akun WHERE ID_Akun='$ID_Akun' ";
			$exe = mysqli_query($link, $query);
			$result = mysqli_fetch_assoc($exe);
			if ($result['Email'] == $Email and $result['Password'] == $Password) {

				$judul = $_POST['judul'];
				$kategori = $_POST['kategori'];

				$prep = $_POST['prep'];
				$cook = $_POST['cook'];
				$yields = $_POST['yields'];
				$waktu = $prep." ;;".$cook." ;;".$yields;

				$ingredients = $_POST['bahan'];
				$step = $_POST['langkah'];

				$tanggal = date('Y-m-d');
				if ($result['Status'] == "Admin") {
					$validasi = "True";
				} else {
					$validasi = "False";
				}

				$namaFoto = $_FILES['file']['name'];
				$ukuran	= $_FILES['file']['size'];
				$file_tmp = $_FILES['file']['tmp_name'];
				$eks = array('png','jpg','jpeg');
				$x = explode('.', $namaFoto);
				$ekstensi = strtolower(end($x));


				$bahan = "";
				$start = "true";
				foreach ($ingredients as $key => $value) {
					if ($value != "") {
						if ($start == "true") {
							$bahan = $value;
							$start = "false";
						}else{
							$bahan = $bahan." ;;".$value;
						}
					}
				}

				$langkah = "";
				$str = "true";
				foreach ($step as $key => $value) {
					if ($value != "") {
						if ($str == "true") {
							$langkah = $value;
							$str = "false";
						}else{
							$langkah = $langkah." ;;".$value;
						}
					}
				}

				if(in_array($ekstensi, $eks) === true){
					if($ukuran < 1044070){			
						move_uploaded_file($file_tmp, '../img/recipes/'.$namaFoto);
						$queryInsert = "
						INSERT INTO resep(ID_Resep, ID_Akun, Judul, Bahan, Langkah, Waktu, Gambar, Kategori, Tanggal, Validasi)
						VALUES(NULL, '$ID_Akun', '$judul', '$bahan', '$langkah', '$waktu', '$namaFoto', '$kategori', '$tanggal', '$validasi')";
						$run = mysqli_query($link, $queryInsert);
							
						if($run){
							echo "
						        <script type='text/javascript'>
							        alert('Resep kamu akan muncul jika sudah diverifikasi oleh admin');
							        document.location = '../index.php';
						        </script>";
						}else{
							echo "
						        <script type='text/javascript'>
							        alert('Data Gagal Disimpan!');
							        history.back(self);
						        </script>";
						}
					}else{
						echo "
						    <script type='text/javascript'>
							    alert('Ukuran file terlalu besar!');
							    history.back(self);
						    </script>";
					}
				}else{
					echo "
						<script type='text/javascript'>
							alert('Ekstensi yang di upload tidak diperbolehkan!');
							history.back(self);
						</script>";
				}

			}else{
				header("location:logout.php");
			}
		} elseif ($_SESSION['Admin_Halaman'] == 'SufeeAdmin') {
			echo "
				<script type='text/javascript'>
					alert('Login Terlebih Dahulu!');
					document.location = '../login.php';
				</script>";
		} else {
			session_destroy();
		}				
	}else{
		echo "
			<script type='text/javascript'>
				alert('Login Terlebih Dahulu!');
				document.location = '../login.php';
			</script>";
		// header("location:../login.php");
	}
?>