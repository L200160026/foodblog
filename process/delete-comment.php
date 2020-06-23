<?php
	include 'connection.php';
	session_start();

	if ($_SESSION) {
		if ($_SESSION['Halaman'] == 'Foodblog') {
			$ID_Akun = $_SESSION['ID_Akun'];
			$Email = $_SESSION['Email'];
			$Password = $_SESSION['Password'];
			$ID_Komentar = $_GET['del'];
			$ID_Resep = $_GET['id'];

			$query = "SELECT * FROM Akun WHERE ID_Akun='$ID_Akun' ";
			try {
				$exe = mysqli_query($link, $query);
				$result = mysqli_fetch_assoc($exe);
			} catch (Exception $e) {
				
			}

			if ($result) {
				if ($result['Email'] == $Email and $result['Password'] == $Password) {
					$delete = "DELETE FROM Komentar WHERE ID_Komentar='$ID_Komentar' ";
					$run = mysqli_query($link, $delete);
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