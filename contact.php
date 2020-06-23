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
			<h2>Contact</h2>
		</div>
	</section>
	<!-- Hero section end -->


	<section class="contact-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="contact-form-warp">
						<h4>Leave a comment</h4>
						<form class="contact-form" method="post" action="process/email.php">
							<div class="row">
								<div class="col-md-6">
									<input type="text" name="nama" placeholder="Name" required
										<?php
											if ($result['Nama']) {
												$Nama = $result['Nama'];
												echo "readonly value = '$Nama' ";
											}
										?>
									>
								</div>
								<div class="col-md-6">
									<input type="text" name="email" placeholder="E-mail" required
										<?php
											if ($result['Email']) {
												$Email = $result['Email'];
												echo "readonly value = '$Email' ";
											}
										?>
									>
								</div>
								<div class="col-md-12">
									<input type="text" name="subject" placeholder="Subject" required>
									<textarea placeholder="Message" name="message" required></textarea>
									<button type="submit" class="site-btn">Send</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="contact-logo">
						<img src="img/logo.png" alt="">
					</div>
					<div class="contact-info">
						<ul class="ct-list">
							<li>
								<h6>Address:</h6>
								<p>481 Creekside Lane Avila</p>
								<p>Beach, CA 93424</p>
							</li>
							<li>
								<h6>Phone:</h6>
								<p>+53 345 7953 32453</p>
								<p>+53 345 7557 822112</p>
							</li>
							<li>
								<h6>Email:</h6>
								<p>yourmail@gmail.com</p>
							</li>
						</ul>
						<div class="contact-social">
							<a href="https://id.pinterest.com/"><i class="fa fa-pinterest"></i></a>
							<a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a>
							<a href="https://twitter.com/"><i class="fa fa-twitter"></i></a>
							<a href="https://dribbble.com/"><i class="fa fa-dribbble"></i></a>
							<a href="https://www.behance.net/"><i class="fa fa-behance"></i></a>
							<a href="https://id.linkedin.com/"><i class="fa fa-linkedin"></i></a>
						</div>
					</div>
				</div>
			</div>
			<!-- map -->
			<div class="location-map" id="map-canvas"></div>	
		</div>
	</section>

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


	<!-- load for map -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCWTIlluowDL-X4HbYQt3aDw_oi2JP0Krc"></script>
	<script src="js/map.js"></script>
	
</body>
</html>