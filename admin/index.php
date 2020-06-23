<?php
    include 'process/connection.php';
    session_start();

    if (!$_SESSION) {
        echo "
            <script>
                document.location = 'page-login.php';;
            </script>
        ";
    } else {
        if ($_SESSION['Admin_Halaman'] == 'SufeeAdmin') {
            $ID_Akun = $_SESSION['Admin_ID_Akun'];
            $Email = $_SESSION['Admin_Email'];
            $Password = $_SESSION['Admin_Password'];

            $query = "SELECT * FROM Akun WHERE ID_Akun='$ID_Akun' AND Status='Admin' ";
            try {
                $exe = mysqli_query($link, $query);
                $result = mysqli_fetch_assoc($exe);

                $kueri = mysqli_query($link, "SELECT * FROM Akun WHERE Status='Admin' ");
                $admin = mysqli_fetch_all($kueri, MYSQLI_ASSOC);

                if (!$result) {
                    echo "
                        <script>
                            document.location = 'page-login.php';;
                        </script>
                    ";
                }
            } catch (Exception $e) {
                
            }
        } elseif ($_SESSION['Halaman'] == 'Foodblog') {
            echo "
                <script>
                    document.location = 'page-login.php';
                </script>
            ";
        } else {
            session_destroy();
        }
    }
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sufee Admin - HTML5 Admin Template</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="vendors/jqvmap/dist/jqvmap.min.css">


    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>

<body>


    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./"><img src="images/logo.png" alt="Logo"></a>
                <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="index.php"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>

                    <h3 class="menu-title">FoodBlog</h3><!-- /.menu-title -->
                    <li>
                        <a href="recipe-add.php"> <i class="menu-icon fa fa-cutlery"></i>Add Recipe</a>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Tabel</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li>
                                <i class="menu-icon fa fa-table"></i>
                                <a href="tables-akun.php">Akun</a>
                            </li>
                            <li>
                                <i class="menu-icon fa fa-table"></i>
                                <a href="tables-resep.php">Resep</a>
                            </li>
                            <li>
                                <i class="menu-icon fa fa-table"></i>
                                <a href="tables-komentar.php">Komentar</a>
                            </li>
                            <li>
                                <i class="menu-icon fa fa-table"></i>
                                <a href="tables-rating.php">Rating</a>
                            </li>
                            <li>
                                <i class="menu-icon fa fa-table"></i>
                                <a href="tables-email.php">Email</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="../img/profile/<?php echo $result['Foto'] ;?>" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="process/logout.php"><i class="fa fa-power-off"></i> Logout</a>
                        </div>
                    </div>

                    <div class="language-select dropdown" id="language-select">
                        <label>
                            <font><?php echo $result['Nama']; ?></font>
                        </label>
                    </div>

                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active"></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                    <?php
                        foreach ($admin as $key => $value) {
                    ?>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title mb-3">Profile Card</strong>
                            </div>
                            <div class="card-body">
                                <div class="mx-auto d-block">
                                    <img class="rounded-circle mx-auto d-block" src="../img/profile/<?php echo $value['Foto'] ;?>" alt="Card image cap">
                                    <h5 class="text-sm-center mt-2 mb-1"><?php echo $value['Nama'] ;?></h5>
                                    <div class="location text-sm-center"><i class="fa fa-envelope-o"></i>
                                        <?php echo $value['Email'] ;?>
                                    </div>
                                </div>
                                <hr>
                                <div class="card-text text-sm-center">
                                    <a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook pr-1"></i></a>
                                    <a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter pr-1"></i></a>
                                    <a href="https://id.linkedin.com/" target="_blank"><i class="fa fa-linkedin pr-1"></i></a>
                                    <a href="https://id.pinterest.com/" target="_blank"><i class="fa fa-pinterest pr-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>


    <script src="vendors/chart.js/dist/Chart.bundle.min.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/widgets.js"></script>
    <script src="vendors/jqvmap/dist/jquery.vmap.min.js"></script>
    <script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script>
        (function($) {
            "use strict";

            jQuery('#vmap').vectorMap({
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: ['#1de9b6', '#03a9f5'],
                normalizeFunction: 'polynomial'
            });
        })(jQuery);
    </script>

</body>

</html>