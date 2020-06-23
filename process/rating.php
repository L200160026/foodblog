<?php
	include 'connection.php';

	session_start();

	if ($_SESSION) {
		if ($_SESSION['Halaman'] == 'Foodblog') {
			$ID_Resep = $_GET['id'];
			$Rate = $_GET['rate'];

			$ID_Akun = $_SESSION['ID_Akun'];
			$Email = $_SESSION['Email'];
			$Password = $_SESSION['Password'];

			$query = "SELECT * FROM Akun WHERE ID_Akun='$ID_Akun' ";
			try {
				$exe = mysqli_query($link, $query);
				$result = mysqli_fetch_assoc($exe);
			} catch (Exception $e) {

			}

			if ($result) {
				if ($result['Email'] == $Email and $result['Password'] == $Password) {
					$kueri = "SELECT * FROM Rating WHERE ID_Akun ='$ID_Akun' AND ID_Resep = '$ID_Resep' ";
					try {
						$run = mysqli_query($link, $kueri);
						$hasil = mysqli_fetch_assoc($run);
						$ID_Rating = $hasil['ID_Rating'];
					} catch (Exception $e) {
							
					}

					if ($hasil) {
						$update = "
						UPDATE Rating
						SET Bintang = $Rate
						WHERE ID_Rating = '$ID_Rating' ";
						try {
							$exe = mysqli_query($link, $update);
							echo"
								<script>
									document.location = '../recipe-single.php?id=$ID_Resep';
								</script>
							";
						} catch (Exception $e) {
							
						}

					} else {
						$insert = "
						INSERT INTO Rating(ID_Rating, ID_Akun, ID_Resep, Bintang)
						VALUES(NULL, '$ID_Akun', '$ID_Resep', '$Rate')";
						try {
							$jalankan = mysqli_query($link, $insert);
							echo"
								<script>
									document.location = '../recipe-single.php?id=$ID_Resep';
								</script>
							";
						} catch (Exception $e) {

						}
					}
				}else{
					echo "
						<script>
							document.location = 'logout.php';
						</script>
					";
				}

			}else{
				echo "
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