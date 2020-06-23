<?php
	include 'connection.php';

	$email = $_POST['email'];
	$password = $_POST['password'];

	$check = mysqli_query($link,"SELECT * FROM Akun WHERE Email='$email'");
	$result = mysqli_fetch_assoc($check);

	if ($result){
		if ($password == $result['Password'] && $result['Status'] == 'Admin') {
			session_start();
			$_SESSION['Admin_ID_Akun'] = $result['ID_Akun'];
			$_SESSION['Admin_Email'] = $result['Email'];
			$_SESSION['Admin_Password'] = $result['Password'];
			$_SESSION['Admin_Halaman'] = 'SufeeAdmin';
			header('location:../index.php');
		} else {
			echo "<script>alert('Login gagal, pastikan email atau password benar !');history.go(-1);</script>";
		}
	} else {
		echo "<script>alert('Email belum terdaftar !');history.go(-1);</script>";
	}
?>