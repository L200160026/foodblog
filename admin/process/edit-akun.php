<?php
	include 'connection.php';

	if(isset($_POST)){
		$ID_Akun = $_POST['id'];
		$Nama = $_POST['nama'];
		$Email = $_POST['email'];
		$Password = $_POST['password'];
		$Status = $_POST['status'];
		$foto = $_POST['foto']; //Nama foto yang lama

		if ($_FILES['file']['error']!='4') {
			$ukuran	= $_FILES['file']['size'];
			$file_tmp = $_FILES['file']['tmp_name'];
			$namaFoto = $_FILES['file']['name'];
			$eks = array('png','jpg','jpeg');
			$x = explode('.', $namaFoto);
			$ekstensi = strtolower(end($x));

			if(in_array($ekstensi, $eks) === true){
				if($ukuran < 1044070){
					$target = "../../img/profile/".$foto;
					if (file_exists($target)) {
					    unlink($target);
					   	move_uploaded_file($file_tmp, '../../img/profile/'.$namaFoto);
					} else {
						move_uploaded_file($file_tmp, '../../img/profile/'.$namaFoto);
					}

					$update = "
						UPDATE Akun
						SET Nama = '$Nama' ,Email = '$Email' ,Password = '$Password' ,Foto = '$namaFoto' ,Status = '$Status'
						WHERE ID_Akun = '$ID_Akun'
					";
					$query = mysqli_query($link,$update);

					if($query){
						echo "
					        <script type='text/javascript'>
						        alert('Data Berhasil Diubah!');
						        document.location = '../tables-akun.php';
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
				UPDATE Akun
				SET Nama = '$Nama' ,Email = '$Email' ,Password = '$Password' ,Status = '$Status'
				WHERE ID_Akun = '$ID_Akun'
			";
			$query = mysqli_query($link, $update);

			if($query){
				echo "
				<script type='text/javascript'>
					alert('Data Berhasil Diubah!');
					document.location = '../tables-akun.php';
				</script>";
			}else{
				echo mysqli_error($link);
			}
		} 

	}
?>