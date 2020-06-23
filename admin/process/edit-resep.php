<?php
	include 'connection.php';

	if ($_GET) {
		$ID_Resep = $_GET['id'];
		$validasi = $_GET['validasi'];

		if ($validasi == "True") {
			$ubah = "UPDATE Resep SET Validasi = 'False' WHERE ID_Resep='$ID_Resep' ";
			$mysql = mysqli_query($link, $ubah);
			echo "
				<script>
					document.location = '../tables-resep.php';
				</script>
			";
		} else {
			$ubah = "UPDATE Resep SET Validasi = 'True' WHERE ID_Resep='$ID_Resep' ";
			$mysql = mysqli_query($link, $ubah);
			echo "
				<script>
					document.location = '../tables-resep.php';
				</script>
			";
		}
	}

	if(isset($_POST)){
		$ID_Resep = $_POST['id'];
		$Judul = $_POST['Judul'];
		$Kategori = $_POST['Kategori'];
		$Waktu = $_POST['Prep']." ;;".$_POST['Cook']." ;;".$_POST['Yields'];
		$ingredients = $_POST['Bahan'];
		$step = $_POST['Langkah'];
		$foto = $_POST['foto']; //Nama foto yang lama

		$Bahan = "";
		$start = "true";
		foreach ($ingredients as $key => $value) {
			if ($value != "") {
				if ($start == "true") {
					$Bahan = $value;
					$start = "false";
				}else{
					$Bahan = $Bahan." ;;".$value;
				}
			}
		}

		$Langkah = "";
		$str = "true";
		foreach ($step as $key => $value) {
			if ($value != "") {
				if ($str == "true") {
					$Langkah = $value;
					$str = "false";
				}else{
					$Langkah = $Langkah." ;;".$value;
				}
			}
		}

		if ($_FILES['file']['error']!='4') {
			$ukuran	= $_FILES['file']['size'];
			$file_tmp = $_FILES['file']['tmp_name'];
			$namaFoto = $_FILES['file']['name'];
			$eks = array('png','jpg','jpeg');
			$x = explode('.', $namaFoto);
			$ekstensi = strtolower(end($x));

			if(in_array($ekstensi, $eks) === true){
				if($ukuran < 1044070){
					$target = "../../img/recipes/".$foto;
					if (file_exists($target)) {
					    unlink($target);
					   	move_uploaded_file($file_tmp, '../../img/recipes/'.$namaFoto);
					} else {
						move_uploaded_file($file_tmp, '../../img/recipes/'.$namaFoto);
					}

					$update = "
						UPDATE Resep
						SET Judul = '$Judul', Kategori = '$Kategori', Waktu = '$Waktu', Bahan = '$Bahan', Langkah = '$Langkah', Gambar = '$namaFoto'
						WHERE ID_Resep = '$ID_Resep'
					";
					$query = mysqli_query($link,$update);

					if($query){
						echo "
					        <script type='text/javascript'>
						        alert('Data Berhasil Disimpan!');
						        document.location = '../tables-resep.php';
					        </script>";
					}else{
						echo mysqli_error($link);
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
						alert('Ekstensi file tidak sesuai!');
					    history.back(self);
				    </script>";
			}
		}else{
			$update = "
				UPDATE Resep
				SET Judul = '$Judul', Kategori = '$Kategori', Waktu = '$Waktu', Bahan = '$Bahan', Langkah = '$Langkah'
				WHERE ID_Resep = '$ID_Resep'
			";
			$query = mysqli_query($link, $update);

			if($query){
				echo "
				<script type='text/javascript'>
					alert('Data Berhasil Disimpan!');
					document.location = '../tables-resep.php';
				</script>";
			}else{
				echo mysqli_error($link);
			}
		} 

	}
?>