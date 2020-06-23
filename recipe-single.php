<?php
	include 'process/connection.php';
	session_start();

	if ($_GET) {
		$ID_Resep = $_GET['id'];
		$query = "SELECT * FROM Resep WHERE ID_Resep = '$ID_Resep' AND Validasi = 'True' ";
		$qry = "SELECT Akun.ID_Akun, ID_Komentar, Nama, Foto, Komentar, Tanggal
		FROM Akun, Komentar 
		WHERE Akun.ID_Akun = Komentar.ID_Akun
		AND ID_Resep = $ID_Resep";
		try {
			$exe = mysqli_query($link, $query);
			$data = mysqli_fetch_assoc($exe);
			if (!$data) {
				echo "
					<script>
						document.location = 'index.php';
					</script>
				";	
			}else{
				$do = mysqli_query($link, $qry);
				$revenue = mysqli_fetch_all($do, MYSQLI_ASSOC);

				$Waktu = explode(" ;;", $data['Waktu']);
				$Bahan = explode(" ;;", $data['Bahan']);
				$Langkah = explode(" ;;", $data['Langkah']);

				$text = "SELECT avg(Bintang) as Bintang FROM Rating WHERE ID_Resep='$ID_Resep' ";
				$jln = mysqli_query($link, $text);
				$fetch = mysqli_fetch_assoc($jln);
				$Bintang = $fetch['Bintang'];
			}
		} catch (Exception $e) {
			
		}
	} else {
		echo "
			<script>
				document.location = 'index.php';
			</script>
		";	
	}



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


			if ($result) {
				$ID_Akun = $result['ID_Akun'];
				$kueri = "SELECT * FROM Rating WHERE ID_Akun ='$ID_Akun' AND ID_Resep = '$ID_Resep' ";
				try {
					$run = mysqli_query($link, $kueri);
					$hasil = mysqli_fetch_assoc($run);
					$Bintang = $hasil['Bintang'];
				} catch (Exception $e) {
					
				}	
			}
		} elseif ($_SESSION['Admin_Halaman'] == 'SufeeAdmin') {
			
		} else {
			session_destroy();
		}
	}





	// $txt = "SELECT Bintang
	// FROM Rating
	// WHERE ID_Akun = '$ID_Akun'
	// AND ID_Resep = '$ID_Resep' ";
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


	<h1>&nbsp;</h1>

	
	<!-- Recipe big view -->
	<div class="recipe-view-section">
		<div class="rv-warp set-bg">
			<img src="img/recipes/<?php echo $data['Gambar'] ;?>" height="100%" width="100%">
		</div>
	</div>

	<!-- Recipe details section -->
	<section class="recipe-details-section">
		<div class="container">
			<div class="recipe-meta">
				<div class="racipe-cata">
					<span><?php echo $data['Kategori']; ?></span>
				</div>
				<h2><?php echo $data['Judul']; ?></h2>
				<div class="recipe-date"><?php echo $data['Tanggal']; ?></div>
				<div class="rating">
					<?php
						if ($Bintang) {
					?>
							<a href="process/rating.php?id=<?php echo $ID_Resep ;?>&rate=1">
								<i 
									<?php
										if ($Bintang >= 1) {
											echo "class = 'fa fa-star'";
										} else {
											echo "class = 'fa fa-star is-fade'";
										}
									?>
								></i>
							</a>
							<a href="process/rating.php?id=<?php echo $ID_Resep ;?>&rate=2">
								<i 
									<?php
										if ($Bintang >= 2) {
											echo "class = 'fa fa-star'";
										} else {
											echo "class = 'fa fa-star is-fade'";
										}
									?>
								></i>
							</a>
							<a href="process/rating.php?id=<?php echo $ID_Resep ;?>&rate=3">
								<i
									<?php
										if ($Bintang >= 3) {
											echo "class = 'fa fa-star'";
										} else {
													echo "class = 'fa fa-star is-fade'";
										}
									?>
								></i>
							</a>
							<a href="process/rating.php?id=<?php echo $ID_Resep ;?>&rate=4">
								<i
									<?php
										if ($Bintang >= 4) {
											echo "class = 'fa fa-star'";
										} else {
											echo "class = 'fa fa-star is-fade'";
										}
									?>
								></i>
							</a>
							<a href="process/rating.php?id=<?php echo $ID_Resep ;?>&rate=5">
								<i
									<?php
										if ($Bintang >= 5) {
											echo "class = 'fa fa-star'";
										} else {
											echo "class = 'fa fa-star is-fade'";
										}
									?>
								></i>
							</a>
					<?php
						} else {
					?>
						<a href="process/rating.php?id=<?php echo $ID_Resep ;?>&rate=1"><i class="fa fa-star is-fade"></i></a>
						<a href="process/rating.php?id=<?php echo $ID_Resep ;?>&rate=2"><i class="fa fa-star is-fade"></i></a>
						<a href="process/rating.php?id=<?php echo $ID_Resep ;?>&rate=3"><i class="fa fa-star is-fade"></i></a>
						<a href="process/rating.php?id=<?php echo $ID_Resep ;?>&rate=4"><i class="fa fa-star is-fade"></i></a>
						<a href="process/rating.php?id=<?php echo $ID_Resep ;?>&rate=5"><i class="fa fa-star is-fade"></i></a>
					<?php } ?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-5">
					<div class="recipe-filter-warp">
						<div class="filter-top">
							<div class="filter-top-text">
								<p>Prep: <?php echo $Waktu[0] ;?> mins</p>
								<p>Cook: <?php echo $Waktu[1] ;?> mins</p>
								<p>Yields: <?php echo $Waktu[2] ;?> Servings</p>
							</div>
						</div>
						<!-- recipe filter form -->
						<div class="filter-form-warp">
							<h2>Ingredients</h2>
							<form class="filter-form">
								<?php
									$num = ['one','two','three','four','five','six','seven','eight','nine','ten','eleven','twelve'];
									foreach ($Bahan as $key => $value) {
								?>
								<div class="check-warp">
									<input type="checkbox" id="<?php echo $num[$key] ;?>">
									<label for="<?php echo $num[$key] ;?>"><?php echo $value ;?></label>
								</div>
								<?php
									}
								?>
							</form>
						</div>
					</div>
				</div>
				<div class="col-lg-7">
					<ul class="recipe-info-list">
						<?php
							foreach ($Langkah as $key => $value) {
								$nomor = $key + 1;
						?>
						<li>
							<h2><?php echo '0'.$nomor.'.';?></h2>
							<p><?php echo $value; ?></p>
						</li>
						<?php
							}
						?>
					</ul>
				</div>
			</div>
		</div>
	</section>
	<!-- Recipe details section end -->


	<!-- Comment section -->
	<section class="comment-section spad pt-0">
		<div class="container">
			<h4 style="margin-bottom: 5px">Comments</h4>

			<?php
				if ($revenue) {
					foreach ($revenue as $key => $value) {
			?>
			<div class="review-item">
				<a href="#">
					<div class="review-thumb set-bg">
						<img src="img/profile/<?php echo $value['Foto'];?>" width="100%" height="100%">
						<div class="review-date">
							<span><?php echo $value['Tanggal']; ?></span>
						</div>
					</div>
				</a>
				<div class="review-text" style="
					padding-top: 10px;
					padding-left: 180px;">
					<h6 style="margin-bottom: 5px;"><?php echo $value['Nama']; ?></h6>
					<p style="
						padding-left: 0px;
						padding-right: 3px;
						margin-right: 5px;
						margin-bottom: 5px;
						display: block;
						height: 79px;
						overflow: auto;
						line-height: 1;">
						<?php echo $value['Komentar']; ?>
					</p>
					<?php
						if ($result) {
							if ($result['Email'] == $Email and $result['Password'] == $Password) {
								if ($value['ID_Akun'] == $ID_Akun) {
					?>
					<a href="process/delete-comment.php?id=<?php echo $ID_Resep;?>&del=<?php echo $value['ID_Komentar'];?>" style="float: right; margin-right: 4px">
						<button type="button" class="btn btn-danger btn-xs">Delete</button>
					</a>
					<?php
								}
							}else{
								header("location:process/logout.php");
							}
						}
					?>
				</div>
			</div>
			<?php
					}
				}
			?>


		</div>
		<div class="container">
			<h4 style="margin-top: 50px; margin-bottom: 5px;">Leave a comment</h4>
			<form action="process/comment.php" method="post" class="comment-form">
				<div class="row">
					<div class="col-md-12">
						<input type="hidden" name="ID_Resep" value="<?php echo $ID_Resep;?>">
						<textarea placeholder="Message" name="komentar" required></textarea>
						<button type="submit" name="submit" class="site-btn" id="button">Send</button>
					</div>
				</div>
			</form>
		</div>
	</section>
	<!-- Comment section -->


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