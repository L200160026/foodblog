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
                            <li><a href="#">Dashboard</a></li>
                            <li class="active">Add Recipe</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Add Recipe</strong>
                            </div>
                            <form action="process/recipe-add.php" method="post" enctype="multipart/form-data" class="">
                                <div class="card-body card-block">

                                    <!-- <input type="hidden" name="id">
                                    <input type="hidden" name="foto"> -->

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="col-sm-2">
                                                <label class=" form-control-label">Judul</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" name="judul" placeholder="Judul" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="col-sm-2">
                                                <label class=" form-control-label">Kategori</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <select name="kategori" id="select" class="form-control" required>
                                                    <option hidden>--Kategori--</option>
                                                    <option value="Appetizer">
                                                    Appetizer</option>

                                                    <option value="Main Course">
                                                    Main Course</option>

                                                    <option value="Dessert">
                                                    Dessert</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="col-sm-2">
                                                <label for="input-small" class=" form-control-label">Waktu</label>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="prep" placeholder="Prep" class="form-control" required>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="cook" placeholder="Cook" class="form-control" required>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="yields" placeholder="Yields" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="col-sm-2">
                                                <label for="input-small" class=" form-control-label">Bahan</label>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="bahan[]" placeholder="Bahan 1" class="form-control" required>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="bahan[]" placeholder="Bahan 2" class="form-control" required>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="bahan[]" placeholder="Bahan 3" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            <div class="col-sm-2">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="bahan[]" placeholder="Bahan 4" class="form-control">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="bahan[]" placeholder="Bahan 5" class="form-control">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="bahan[]" placeholder="Bahan 6" class="form-control">
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            <div class="col-sm-2">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="bahan[]" placeholder="Bahan 7" class="form-control">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="bahan[]" placeholder="Bahan 8" class="form-control">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="bahan[]" placeholder="Bahan 9" class="form-control">
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            <div class="col-sm-2">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="bahan[]" placeholder="Bahan 10" class="form-control">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="bahan[]" placeholder="Bahan 11" class="form-control">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="bahan[]" placeholder="Bahan 12" class="form-control">
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="col-sm-2">
                                                <label for="input-small" class=" form-control-label">Langkah</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" name="langkah[]" placeholder="Langkah 1" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            <div class="col-sm-2">
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" name="langkah[]" placeholder="Langkah 2" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            <div class="col-sm-2">
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" name="langkah[]" placeholder="Langkah 3" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            <div class="col-sm-2">
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" name="langkah[]" placeholder="Langkah 4" class="form-control">
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            <div class="col-sm-2">
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" name="langkah[]" placeholder="Langkah 5" class="form-control">
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            <div class="col-sm-2">
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" name="langkah[]" placeholder="Langkah 6" class="form-control">
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            <div class="col-sm-2">
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" name="langkah[]" placeholder="Langkah 7" class="form-control">
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            <div class="col-sm-2">
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" name="langkah[]" placeholder="Langkah 8" class="form-control">
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            <div class="col-sm-2">
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" name="langkah[]" placeholder="Langkah 9" class="form-control">
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            <div class="col-sm-2">
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" name="langkah[]" placeholder="Langkah 10" class="form-control">
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="col-sm-2">Gambar</div>
                                            <div class="col-sm-10">
                                              <div class="custom-file">
                                                <input type="file" name="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" required>
                                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <br>
                                </div>
                                <div class="card-footer" align="center">
                                    <button type="submit" name="submit" class="btn btn-success">
                                        <i class="fa fa-dot-circle-o"></i> Submit
                                    </button>

                                    <a href="tables-resep.php">
                                    <button type="reset" class="btn btn-danger">
                                        <i class="fa fa-ban"></i> Reset
                                    </button>
                                    </a>
                                </div>
                            </form>

                        </div>
                    </div>
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
