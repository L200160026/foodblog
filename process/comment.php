<?php
	include 'connection.php';
	session_start();

	if ($_SESSION) {
		if ($_SESSION['Halaman'] == 'Foodblog') {
			$ID_Akun = $_SESSION['ID_Akun'];
			$Email = $_SESSION['Email'];
			$Password = $_SESSION['Password'];

			$ID_Resep = $_POST['ID_Resep'];
			$Komentar = $_POST['komentar'];
			$tanggal = date('Y-m-d');

			$query = "SELECT * FROM Akun WHERE ID_Akun='$ID_Akun' ";
			try {
				$exe = mysqli_query($link, $query);
				$result = mysqli_fetch_assoc($exe);
			} catch (Exception $e) {
				
			}

			if ($result) {
				if ($result['Email'] == $Email and $result['Password'] == $Password) {
					$insert = "
					INSERT INTO Komentar(ID_Komentar, ID_Akun, ID_Resep, Komentar, Tanggal)
					VALUES(NULL, '$ID_Akun', '$ID_Resep', '$Komentar', '$tanggal')";
					$run = mysqli_query($link, $insert);
					echo "
					<script type='text/javascript'>
						document.location = '../recipe-single.php?id=$ID_Resep';
					</script>";
				}
			} else {
				echo"
					<script>
						document.location = 'logout.php';
					</script>
				";	
			}
		} elseif ($_SESSION['Admin_Halaman'] == 'SufeeAdmin') {
			echo "
				<script type='text/javascript'>
					alert('Login Terlebih Dahulu!');
					history.back(self);
				</script>";
		} else {
			session_destroy();
		}
	} else {
		echo "
			<script type='text/javascript'>
				alert('Login Terlebih Dahulu!');
				history.back(self);
			</script>";
	}
?>