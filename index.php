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

	//Start Latest Recipes
	$kueri = "
	SELECT Resep.ID_Resep, Judul, Gambar, avg(Bintang) as Bintang
	FROM (Resep LEFT JOIN Rating ON Resep.ID_Resep = Rating.ID_Resep)
	WHERE Validasi = 'True'
	GROUP BY Judul
	ORDER BY Tanggal DESC
	limit 9";
	try {
		$run = mysqli_query($link, $kueri);
		$hasil = mysqli_fetch_all($run, MYSQLI_ASSOC);
		// print_r($hasil);
	} catch (Exception $e) {
		
	}
	//END Latest Recipes

	$txt = "
	SELECT Resep.ID_Resep, Judul, Gambar, Tanggal, avg(Bintang) as Bintang
	FROM (Resep LEFT JOIN Rating ON Resep.ID_Resep = Rating.ID_Resep)
	WHERE Validasi = 'True'
	GROUP BY Resep.ID_Resep
	ORDER BY Bintang DESC";
	try {
		$jalankan = mysqli_query($link, $txt);
		if ($jalankan) {
			$output = mysqli_fetch_all($jalankan, MYSQLI_ASSOC);
		}
	} catch (Exception $e) {
		
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
	<section class="hero-section">
		<div class="hero-slider owl-carousel">
			<div class="hero-slide-item set-bg" data-setbg="img/slider-bg-1.jpg">
				<div class="hs-text">
					<h2 class="hs-title-1"><span>Healthy Recipes</span></h2>
					<h2 class="hs-title-2"><span>from the best chefs</span></h2>
					<h2 class="hs-title-3"><span>for all the foodies</span></h2>
				</div>
			</div>
			<div class="hero-slide-item set-bg" data-setbg="img/slider-bg-2.jpg">
				<div class="hs-text">
					<h2 class="hs-title-1"><span>Healthy Recipes</span></h2>
					<h2 class="hs-title-2"><span>from the best chefs</span></h2>
					<h2 class="hs-title-3"><span>for all the foodies</span></h2>
				</div>
			</div>
		</div>
	</section>
	<!-- Hero section end -->


	<!-- Add section end -->
	<section class="add-section spad">
		<div class="container">
			<div class="add-warp">
				<div class="add-slider owl-carousel">
					<div class="as-item set-bg" data-setbg="img/add/1.jpg"></div>
					<div class="as-item set-bg" data-setbg="img/add/2.jpg"></div>
					<div class="as-item set-bg" data-setbg="img/add/3.jpg"></div>
				</div>
				<div class="row add-text-warp">
					<div class="col-lg-4 col-md-5 offset-lg-8 offset-md-7">
						<div class="add-text text-white">
							<div class="at-style"></div>
							<h2>Amazing deserts</h2>
							<ul>
								<li>Easy to make</li>
								<li>Step by Step Video Tutorial</li>
								<li>Gluten Free</li>
								<li>Healty  Ingredients</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Add section end -->


	<!-- Recipes section -->
	<section class="recipes-section spad pt-0">
		<div class="container">
			<div class="section-title">
				<h2>Latest recipes</h2>
			</div>
			<div class="row">

				<?php
					foreach ($hasil as $key => $value) {
						$ID_Resep = $value['ID_Resep'];
						$Judul = $value['Judul'];
						$Gambar = $value['Gambar'];
						$Tanggal = $value['Tanggal'];
						if ($value['Bintang']) {
							$Bintang = $value['Bintang'];
						} else {
							$Bintang = 0;
						}
				?>
				<div class="col-lg-4 col-md-6">
					<div class="recipe">
						<a href="recipe-single.php?id=<?php echo $ID_Resep; ?>">
							<img <?php echo "src = 'img/recipes/$Gambar'"; ?> alt="" height="300">
						</a>
						<div class="recipe-info-warp">
							<div class="recipe-info">
								<h3 style="overflow: hidden; height: 20px;"><?php echo $Judul; ?></h3>
								<div class="rating">
									<i 
										<?php
											if ($Bintang >= 1) {
												echo "class = 'fa fa-star'";
											} else {
												echo "class = 'fa fa-star is-fade'";
											}
										?>
									></i>
									<i 
										<?php
											if ($Bintang >= 2) {
												echo "class = 'fa fa-star'";
											} else {
												echo "class = 'fa fa-star is-fade'";
											}
										?>
									></i>
									<i
										<?php
											if ($Bintang >= 3) {
												echo "class = 'fa fa-star'";
											} else {
												echo "class = 'fa fa-star is-fade'";
											}
										?>
									></i>
									<i
										<?php
											if ($Bintang >= 4) {
												echo "class = 'fa fa-star'";
											} else {
												echo "class = 'fa fa-star is-fade'";
											}
										?>
									></i>
									<i
										<?php
											if ($Bintang >= 5) {
												echo "class = 'fa fa-star'";
											} else {
												echo "class = 'fa fa-star is-fade'";
											}
										?>
									></i>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
					}
				?>


			</div>
		</div>
	</section>
	<!-- Recipes section end -->


	<!-- Footer widgets section -->
	<section class="bottom-widgets-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-6 ftw-warp">
					<div class="section-title">
						<h3>Top rated recipes</h3>
					</div>
					<ul class="sp-recipes-list">
						<?php
							if ($output) {
								foreach ($output as $key => $value) {
									if ($key < 5) {
										$ID_Resep = $value['ID_Resep'];
										$Judul = $value['Judul'];
										$Gambar = $value['Gambar'];
										$Tanggal = $value ['Tanggal'];
										$Bintang = $value['Bintang'];
									} else {
										break;
									}
						?>
						<li>
							<a href="recipe-single.php?id=<?php echo $ID_Resep;?>">
								<div class="rl-thumb set-bg">
									<img src="img/recipes/<?php echo $Gambar; ?>" width="100%" height="100%">
								</div>
							</a>
							<div class="rl-info">
								<span><?php echo $Tanggal; ?></span>
								<h6><?php echo $Judul; ?></h6>
								<div class="rating">
									<i 
										<?php
											if ($Bintang >= 1) {
												echo "class = 'fa fa-star'";
											} else {
												echo "class = 'fa fa-star is-fade'";
											}
										?>
									></i>
									<i 
										<?php
											if ($Bintang >= 2) {
												echo "class = 'fa fa-star'";
											} else {
												echo "class = 'fa fa-star is-fade'";
											}
										?>
									></i>
									<i
										<?php
											if ($Bintang >= 3) {
												echo "class = 'fa fa-star'";
											} else {
												echo "class = 'fa fa-star is-fade'";
											}
										?>
									></i>
									<i
										<?php
											if ($Bintang >= 4) {
												echo "class = 'fa fa-star'";
											} else {
												echo "class = 'fa fa-star is-fade'";
											}
										?>
									></i>
									<i
										<?php
											if ($Bintang >= 5) {
												echo "class = 'fa fa-star'";
											} else {
												echo "class = 'fa fa-star is-fade'";
											}
										?>
									></i>
								</div>
							</div>
						</li>

						<?php
								}
							}
						?>
						
					</ul>
				</div>




				<div class="col-lg-6 col-md-6 ftw-warp">
					<div class="section-title">
						<h3>Most liked recipes</h3>
					</div>
					<ul class="sp-recipes-list">
						<?php
							if ($output) {
								$pilihan = array_rand($output, 5);
								foreach ($pilihan as $key => $value) {
									$data = $output[$value] ;
									$ID_Resep = $data['ID_Resep'];
									$Judul = $data['Judul'];
									$Gambar = $data['Gambar'];
									$Tanggal = $data ['Tanggal'];
									$Bintang = $data['Bintang'];
						?>
						<li>
							<a href="recipe-single.php?id=<?php echo $ID_Resep;?>">
								<div class="rl-thumb set-bg">
									<img src="img/recipes/<?php echo $Gambar; ?>" width="100%" height="100%">
								</div>
							</a>
							<div class="rl-info">
								<span><?php echo $Tanggal; ?></span>
								<h6><?php echo $Judul; ?></h6>
								<div class="rating">
									<i 
										<?php
											if ($Bintang >= 1) {
												echo "class = 'fa fa-star'";
											} else {
												echo "class = 'fa fa-star is-fade'";
											}
										?>
									></i>
									<i 
										<?php
											if ($Bintang >= 2) {
												echo "class = 'fa fa-star'";
											} else {
												echo "class = 'fa fa-star is-fade'";
											}
										?>
									></i>
									<i
										<?php
											if ($Bintang >= 3) {
												echo "class = 'fa fa-star'";
											} else {
												echo "class = 'fa fa-star is-fade'";
											}
										?>
									></i>
									<i
										<?php
											if ($Bintang >= 4) {
												echo "class = 'fa fa-star'";
											} else {
												echo "class = 'fa fa-star is-fade'";
											}
										?>
									></i>
									<i
										<?php
											if ($Bintang >= 5) {
												echo "class = 'fa fa-star'";
											} else {
												echo "class = 'fa fa-star is-fade'";
											}
										?>
									></i>
								</div>
							</div>
						</li>

						<?php
								}
							}
						?>
					</ul>
				</div>
			</div>
		</div>
	</section>
	<!-- Footer widgets section end -->


	<!-- Review section end -->
<!-- 	<section class="review-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-8 offset-lg-0 offset-md-2">
					<div class="review-item">
						<a href="#">
							<div class="review-thumb set-bg" data-setbg="img/thumb/11.jpg">
								<div class="review-date">
									<span>May 04, 2018</span>
								</div>
							</div>
						</a>
						<div class="review-text">
							<span>March 14, 2018</span>
							<h6>Feta Cheese Burgers</h6>
							<div class="rating">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star is-fade"></i>
							</div>
							<div class="author-meta">
								<div class="author-pic set-bg" data-setbg="img/author.jpg"></div>
								<p>By Janice Smith</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-8 offset-lg-0 offset-md-2">
					<div class="review-item">
						<a href="#">
							<div class="review-thumb set-bg" data-setbg="img/thumb/12.jpg">
								<div class="review-date">
									<span>May 04, 2018</span>
								</div>
							</div>
						</a>
						<div class="review-text">
							<span>March 14, 2018</span>
							<h6>Mozarella Pasta</h6>
							<div class="rating">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star is-fade"></i>
							</div>
							<div class="author-meta">
								<div class="author-pic set-bg" data-setbg="img/author.jpg"></div>
								<p>By Janice Smith</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section> -->
	<!-- Review section end -->


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