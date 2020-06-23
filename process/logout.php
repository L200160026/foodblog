<?php
	session_start(); // memulai session
	if ($_SESSION['Halaman'] == 'Foodblog') {
		unset($_SESSION['ID_Akun']);
		unset($_SESSION['Email']);
		unset($_SESSION['Password']);
		unset($_SESSION['Halaman']);
	} else {
		session_destroy(); // menghapus session
	}
	header("location:../index.php"); // mengambalikan ke index.php
?>