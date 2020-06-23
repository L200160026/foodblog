<?php
	include 'process/connection.php';
	session_start();

	if ($_SESSION) {
		if ($_SESSION['Halaman'] == 'Foodblog') {
			$ID_Akun = $_SESSION['ID_Akun'];
			$Email = $_SESSION['Email'];
			$Password = $_SESSION['Password'];

			$query = "SELECT * FROM Akun WHERE ID_Akun='$ID_Akun' ";
			try {
				$exe = mysqli_query($link, $query);
				$result = mysqli_fetch_assoc($exe);
			} catch (Exception $e) {
				
			}
		} elseif ($_SESSION['Admin_Halaman'] == 'SufeeAdmin') {
			
		} else {
			session_destroy();
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Food Blog</title>
	<meta charset="UTF-8">
	<meta name="description" content="Food Blog Web Template">
	<meta name="keywords" content="food, unica, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->   
	<link href="img/favicon.ico" rel="shortcut icon"/>

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,400i,500,500i,600,600i,700" rel="stylesheet">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/owl.carousel.css"/>
	<link rel="stylesheet" href="css/animate.css"/>
	<link rel="stylesheet" href="css/style.css"/>


	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>

	<!-- Header section -->
	<header class="header-section">
		<div class="header-top">
			<div class="container">
				<div class="header-social">
					<a href="https://id.pinterest.com/" target="_blank"><i class="fa fa-pinterest"></i></a>
					<a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a>
					<a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter"></i></a>
					<a href="https://dribbble.com/" target="_blank"><i class="fa fa-dribbble"></i></a>
					<a href="https://www.behance.net/" target="_blank"><i class="fa fa-behance"></i></a>
					<a href="https://id.linkedin.com/" target="_blank"><i class="fa fa-linkedin"></i></a>
				</div>
				<div class="user-panel">
					<?php
						if ($result) {						
							if ($result['Email'] == $Email and $result['Password'] == $Password) {
								$nama = $result['Nama'];
								echo "$nama / <a href='process/logout.php'>Logout</a>";
							}else{
								header("location:process/logout.php");
							}	
						}else{
							echo "
								<a href='register.php'>Register</a> / 
								<a href='login.php'>Login</a>";
						}
					?>
				</div>
			</div>
		</div>
		<div class="header-bottom">
			<div class="container">
				<a href="index.php" class="site-logo">
					<img src="img/logo.png" alt="">
				</a>
				<div class="nav-switch">
					<i class="fa fa-bars"></i>
				</div>
				<div class="header-search">
					<a href="recipes.php"><i class="fa fa-search"></i></a>
				</div>
				<ul class="main-menu">
					<li><a href="index.php">Home</a></li>
					<li><a href="about.php">About</a></li>
					<li><a href="recipes.php">Receipies</a></li>
					<li><a href="recipe-add.php">+Recipe</a></li>
					<li><a href="contact.php">Contact</a></li>
				</ul>
			</div>
		</div>
	</header>
	<!-- Header section end -->


	<!-- Hero section -->
	<section class="page-top-section set-bg" data-setbg="img/page-top-bg.jpg">
		<div class="container">
			<h2>About us</h2>
		</div>
	</section>
	<!-- Hero section end -->


	<!-- About section -->
	<section class="about-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 about-text">
					<h2>Ridwan Renaldi</h2>
					<p>Saya adalah Ridwan Renaldi. Saya lahir dan tinggal di Solo, saat ini saya adalah Mahasiswa UMS jurusan informatika. Saya yang sudah 3 tahun bergelut dibidang IT memutuskan untuk menjadi Web Developer nantinya. Memang pengalaman saya dalam membuat Web tidak seberapa, tetapi tekad dan semangat yang kuat membuat saya bertahan dibidang ini. Oleh karena itu dalam pembuatan Web ini saya bekerja sebagai Web Developer. Semoga Web yang saya buat dengan teman saya ini dapat bermanfaat bagi banyak orang.</p>
				</div>
				<div class="col-lg-6">
					<img src="img/about/Ridwan.jpeg" alt="">
				</div>
			</div>
		</div>
	</section>

	<section class="about-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<img src="img/about/Budi.jpg" alt="">
				</div>
				<div class="col-lg-6 about-text">
					<h2>Irfan Budi Wicaksono</h2>
					<p>Irfan Budi Wicaksono adalah seorang Mahasiswa Informatika UMS jurusan Sistem Informasi yang berkonsentrasi di Bidang Pemrograman. Selain itu saya juga ahli dalam bidang Agama juga Keorganisasian, Terbukti saat ini saya menjadi Asisten Praktikum Mata Kuliah “Sistem Operasi” dan juga Menjadi Pementor Kemuhammadiyahan, juga terlibat aktif dalam FOSTI.
						<br><br>
					Latar belakang pendidikan saya berasal dari SD Serengan 1 Surakarta, SMP N 4 Surakarta, dan SMA N 3 Surakarta. Hobi saya yakni berolah raga seperti Jogging ataupun Futsal. Selain itu saya memiliki Hobi Membaca untuk meningkatkan Literasi wawasan saya. Serta melakukan coding untuk pemahaman Latihan bidang jurusan saya, yakni Informatika.
						<br><br>
					Saat ini, saya sedang bekerja sama dengan kedua rekan saya, yakni Ridwan Renaldi dan Ainun Rafidah mengembangkan sebuah web yang berjudul “Food Blog”. Dalam Blog ini, membahas tentang berbagai cara membuat macam resep olahan yang kami rekomendasikan untuk berbagai kategori, seperti Menu untuk Breakfast, Lunch, juga Dinner. Serta menu tambahan bagi yang memerlukan makanan pembuka atau penutup.
						<br><br>
					Oleh karena itu, dalam mengerjakan blog ini saya mengucapkan terima kasih banyak kepada Dosen Pembimbing saya Bapak Yogiek Indra Kurniawan, S.T, M.T yang telah membimbing kami dalam mengerjakan web ini. Juga kepada Kedua rekan saya yakni Ridwan Renaldi dan Ainun Rafidah dlam menyelsaikan tugas ini, tak lupa kepada para pengunjung Web dalam kontribusinya memberikan Rating juga Komentar yang berkonstribusi untuk kelancaran pembuatan web ini.</p>
				</div>
			</div>
		</div>
	</section>

	<section class="about-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 about-text">
					<h2>Ainun Rafidah</h2>
					<p>Ainun Rafidah adalah seorang Mahasiswa Informatika UMS jurusan Sistem Informasi. Selain dari itu, saya juga memiliki pengalaman organisasi, yakni terlibat aktif dalam organisasi HIMATIF. Saya bekerja sama dengan kedua rekan saya, yakni Ridwan Renaldi dan Irfan Budi Wicaksono dalam mengembangkan sebuah web yang berjudul “Food Blog”. Dalam project ini saya berkonsentrasi dalam marketing.</p>
				</div>
				<div class="col-lg-6">
					<img src="img/about/Ainun.jpeg" alt="">
				</div>
			</div>
		</div>
	</section>
	<!-- About section end -->


	<!-- Gallery section -->
	<div class="gallery">
		<div class="gallery-slider owl-carousel">
			<a href="#">
				<div class="gs-item set-bg" data-setbg="img/instagram/1.jpg"></div>
			</a>
			<a href="#">
				<div class="gs-item set-bg" data-setbg="img/instagram/2.jpg"></div>
			</a>
			<a href="#">
				<div class="gs-item set-bg" data-setbg="img/instagram/3.jpg"></div>
			</a>
			<a href="#">
				<div class="gs-item set-bg" data-setbg="img/instagram/4.jpg"></div>
			</a>
			<a href="#">
				<div class="gs-item set-bg" data-setbg="img/instagram/5.jpg"></div>
			</a>
			<a href="#">
				<div class="gs-item set-bg" data-setbg="img/instagram/6.jpg"></div>
			</a>
		</div>
	</div>
	<!-- Gallery section end -->


	<!-- Footer section  -->
	<footer class="footer-section set-bg" data-setbg="img/footer-bg.jpg">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-6">
					<div class="footer-logo">
						<img src="img/logo.png" alt="">
					</div>
					<div class="footer-social">
						<a href="https://id.pinterest.com/" target="_blank"><i class="fa fa-pinterest"></i></a>
						<a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a>
						<a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter"></i></a>
						<a href="https://dribbble.com/" target="_blank"><i class="fa fa-dribbble"></i></a>
						<a href="https://www.behance.net/" target="_blank"><i class="fa fa-behance"></i></a>
						<a href="https://id.linkedin.com/" target="_blank"><i class="fa fa-linkedin"></i></a>
					</div>
				</div>
				<div class="col-lg-6 text-lg-right">
					<ul class="footer-menu">
						<li><a href="index.php">Home</a></li>
						<li><a href="about.php">About</a></li>
						<li><a href="recipes.php">Receipies</a></li>
						<li><a href="recipe-add.php">+Recipe</a></li>
						<li><a href="contact.php">Contact</a></li>
					</ul>
					<p class="copyright"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
</p>
				</div>
			</div>
		</div>
	</footer>
	<!-- Footer section end -->



	<!--====== Javascripts & Jquery ======-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>