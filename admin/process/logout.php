<?php
	session_start(); // memulai session
	if ($_SESSION['Admin_Halaman'] == 'SufeeAdmin') {
		unset($_SESSION['Admin_ID_Akun']);
		unset($_SESSION['Admin_Email']);
		unset($_SESSION['Admin_Password']);
		unset($_SESSION['Admin_Halaman']);
	} else {
		session_destroy(); // menghapus session
	}
	header("location:../page-login.php"); // mengambalikan ke index.php
?>