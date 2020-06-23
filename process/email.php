<?php
	include 'connection.php';
	session_start();

	if ($_SESSION) {
		if ($_SESSION['Halaman'] == 'Foodblog') {
			$Subject = $_POST['subject'];
			$Message = $_POST['message'];
			$Tanggal = date('Y-m-d');

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
					$kueri = "
						INSERT INTO Email(ID_Email, ID_Akun, Subject, Message, Tanggal)
						VALUES(NULL, '$ID_Akun', '$Subject', '$Message', '$Tanggal')
					";
					try {
						$run = mysqli_query($link, $kueri);
					} catch (Exception $e) {
							
					}

					if ($run) {
						echo "
							<script>
								alert('Berhasil mengirim email');
								document.location = '../contact.php';
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