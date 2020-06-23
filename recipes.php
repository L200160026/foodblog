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

	$count1 = "SELECT count(Kategori) as Appetizer FROM Resep WHERE Kategori = 'Appetizer' ";
	$count2 = "SELECT count(Kategori) as MainCourse FROM Resep WHERE Kategori = 'Main Course' ";
	$count3 = "SELECT count(Kategori) as Dessert FROM Resep WHERE Kategori = 'Dessert' ";

	$jml1 = mysqli_query($link, $count1);
	$jml2 = mysqli_query($link, $count2);
	$jml3 = mysqli_query($link, $count3);

	$Appetizer = mysqli_fetch_assoc($jml1);
	$MainCourse = mysqli_fetch_assoc($jml2);
	$Dessert = mysqli_fetch_assoc($jml3);


	$limit = 0;
	$where = "Validasi = 'True' ";

	if ($_GET) {
		if ($_GET['Kategori'] AND $_GET['Judul'] or $_GET['Kategori'] AND $_GET['Judul']=="") {
			$kategori = $_GET['Kategori'];
			$judul = $_GET['Judul'];

			if ($kategori == "All") {
				$where = "Validasi = 'True' AND Judul like '%$judul%' ";
			} else {
				$where = "Validasi = 'True' AND Kategori = '$kategori' AND Judul like '%$judul%' ";
			}
		} 
	}

	//Menghitung Jumlah Data Resep Guna Membagi Pagination(halaman)
	$hitung = "SELECT count(ID_Resep) as jml FROM Resep WHERE ".$where;
	$do = mysqli_query($link, $hitung);
	$jmlh = mysqli_fetch_assoc($do);
	$halaman = ceil($jmlh['jml']/12);
	//Akhir hitung

	if ($_GET) {
		if ($_GET['page']) {
			$kelipatan = 12 * $halaman;
			$loop = 1;
			for ($i=0; $i <= $kelipatan ; $i=$i+12) { 
				if ($loop == $_GET['page']) {
					$limit = $i;
					break;
				} else {
					$loop++;
				}
			}
		}
	}


	$kueri = "
	SELECT Resep.ID_Resep, Judul, Gambar, avg(Bintang) as Bintang
	FROM (Resep LEFT JOIN Rating ON Resep.ID_Resep = Rating.ID_Resep)
	WHERE " .$where. "
	GROUP BY Judul
	ORDER BY Tanggal DESC
	limit ".$limit.",12";
	try {
		$run = mysqli_query($link, $kueri);
		$hasil = mysqli_fetch_all($run, MYSQLI_ASSOC);
		// print_r($hasil);
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
	<section class="page-top-section set-bg" data-setbg="img/page-top-bg.jpg">
		<div class="container">
			<h2>Recipe</h2>
		</div>
	</section>
	<!-- Hero section end -->


	<!-- Search section -->
	<div class="search-form-section">
		<div class="sf-warp">
			<div class="container">
				<form action="recipes.php" method="GET" class="big-search-form">
					<input type="hidden" name="page">
					<select name="Kategori">
						<option value="All">All Ingredients</option>
						<option value="Appetizer">Appetizer</option>
						<option value="Main Course">Main Course</option>
						<option value="Dessert">Dessert</option>
					</select>
					<input type="text" name="Judul" placeholder="Search Receipies">
					<button type="submit" class="bsf-btn">Search</button>
				</form>
			</div>
		</div>
	</div>
	<!-- Search section end -->


	<!-- Recipes section -->
	<section class="recipes-page spad">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class="section-title">
						<h2>
							<?php
								if ($_GET) {
									if ($_GET['Kategori']=="All") {
										echo "Latest Recipes";
									} else {
										echo $_GET['Kategori'];
									}
								} else {
									echo "Latest Recipes";
								}
							?>
						 </h2>
					</div>
				</div>
				<div class="col-md-4">
					<div class="recipe-view">
						<i class="fa fa-bars"></i>
						<i class="fa fa-th active"></i>
					</div>
				</div>
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
				<?php } ?>
			</div>
			<div class="site-pagination">
				<?php
					for ($i=1; $i <= $halaman ; $i++) {
						$hal = sprintf("%02d",$i);

						if ($_GET) {
							if ($i == $_GET['page']) {
								echo "<span>$hal</span>";
							} else {
								if ($kategori) {
									if ($_GET['page'] == "" AND $i == 1) {
										echo "<span>$hal</span>";
									} else {
										echo "<a href='recipes.php?page=$i&Kategori=$kategori&Judul=$judul'>$hal</a>";
									}
								} else {
									echo "<a href='recipes.php?page=$i'>$hal</a>";
								}
							}
						}else{
							if ($i == 1) {
								echo "<span>$hal</span>";
							} else {
								if ($kategori) {
									echo "<a href='recipes.php?page=$i&Kategori=$kategori&Judul=$judul'>$hal</a>";
								} else {
									echo "<a href='recipes.php?page=$i'>$hal</a>";
								}
							}
						}
					}
				?>
			</div>
		</div>
	</section>
	<!-- Recipes section end -->

	<!-- Facts section -->
	<section class="facts-section">
		<div class="facts-warp">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-sm-6 fact-item">
						<div class="fact-icon">
							<img src="img/icon/3.png" alt="">
						</div>
						<h2><?php echo $Appetizer['Appetizer']; ?></h2>
						<p>Appetizer Receipies</p>
					</div>
					<div class="col-lg-4 col-sm-6 fact-item">
						<div class="fact-icon">
							<img src="img/icon/1.png" alt="">
						</div>
						<h2><?php echo $MainCourse['MainCourse']; ?></h2>
						<p>Main Course Receipies</p>
					</div>
					<div class="col-lg-4 col-sm-6 fact-item">
						<div class="fact-icon">
							<img src="img/icon/4.png" alt="">
						</div>
						<h2><?php echo $Dessert['Dessert']; ?></h2>
						<p>Desert Receipies</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Facts section end -->

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