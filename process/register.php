<?php
	include 'connection.php';

	if ($_POST['submit']) {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$confirmPassword = $_POST['confirmPassword'];

		
		$namaFoto = $_FILES['file']['name'];
		$ukuran	= $_FILES['file']['size'];
		$file_tmp = $_FILES['file']['tmp_name'];
		$eks = array('png','jpg','jpeg');
		$x = explode('.', $namaFoto);
		$ekstensi = strtolower(end($x));


		$query = "SELECT * FROM Akun WHERE Email='$email' ";
		$check = mysqli_query($link, $query);

		if (mysqli_num_rows($check)>0) {
			echo "
		    <script type='text/javascript'>
			    alert('Email sudah digunakan!');
			    history.back(self);
		    </script>";
		}else{
			if ($password == $confirmPassword) {
				if(in_array($ekstensi, $eks) === true){
					if($ukuran < 1048576){			
						move_uploaded_file($file_tmp, '../img/profile/'.$namaFoto);
						$queryInsert = "
						INSERT INTO Akun(ID_Akun, Nama, Email, Password, Foto, Status)
						VALUES(NULL, '$name','$email','$password','$namaFoto','User')";
						$exe = mysqli_query($link, $queryInsert);
						
						if($exe){
							$check = mysqli_query($link,"SELECT * FROM Akun WHERE Email='$email'");
							$result = mysqli_fetch_assoc($check);

							session_start();
							$_SESSION['ID_Akun'] = $result['ID_Akun'];
							$_SESSION['Email'] = $result['Email'];
							$_SESSION['Password'] = $result['Password'];
							$_SESSION['Halaman'] = 'Foodblog';
							echo "
						        <script type='text/javascript'>
							        alert('Selamat $name berhasil mendaftar!');
							        document.location='../index.php';
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
				echo "
			    <script type='text/javascript'>
				    alert('Penulisan ulang password salah!');
				    history.back(self);
			    </script>";
			}
		}
	}
?>