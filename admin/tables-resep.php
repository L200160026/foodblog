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
            $kueri = "SELECT * FROM Resep";
            try {
                $exe = mysqli_query($link, $query);
                $result = mysqli_fetch_assoc($exe);
                if (!$result) {
                    echo "
                        <script>
                            document.location = 'page-login.php';;
                        </script>
                    ";
                } else {
                    $run = mysqli_query($link, $kueri);
                    $data = mysqli_fetch_all($run, MYSQLI_ASSOC);

                    if ($_GET) {
                        if ($_GET['ubah']) {
                            $id = $_GET['ubah'];
                            $txt = "SELECT * FROM Resep WHERE ID_Resep = '$id' ";
                            $jalan = mysqli_query($link, $txt);
                            $hasil = mysqli_fetch_assoc($jalan);
                            $bahan = explode(" ;;", $hasil['Bahan']);
                            $langkah = explode(" ;;", $hasil['Langkah']);
                            $waktu = explode(" ;;", $hasil['Waktu']);
                        } elseif ($_GET['hapus']) {
                            $id = $_GET['hapus'];

                            $pilih = "SELECT Gambar FROM Resep WHERE ID_Resep = '$id' ";
                            $cek = mysqli_query($link, $pilih);
                            $fetch = mysqli_fetch_assoc($cek);
                            $GambarResep = $fetch['Gambar'];
                            $target = "../img/recipes/".$GambarResep;
                            if (file_exists($target)) {
                                unlink($target);
                            }

                            $teks = "DELETE FROM Resep WHERE ID_Resep = '$id' ";
                            $do = mysqli_query($link, $teks);
                            echo"
                                <script>
                                    document.location = 'tables-resep.php';
                                </script>
                            ";
                        }
                    }
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
    <link rel="stylesheet" href="vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">

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
                        <h1>Tabel</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Dashboard</a></li>
                            <li><a href="#">Table</a></li>
                            <li class="active">Table Resep</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                    <?php
                        if ($hasil) {
                    ?>
                    <div class="col-md-12" align="center">
                        <form class="md-form">
                            <div class="file-field">
                                <div class="z-depth-1-half mb-4">
                                    <?php
                                        if ($hasil['Gambar']) {
                                            $nma = $hasil['Gambar'];
                                            $foto = "../img/recipes/$nma";
                                        } else {
                                            $foto = "../img/author.jpg";
                                        }
                                    ?>
                                    <img src="<?php echo $foto ;?>" class="img-fluid" alt="example placeholder" height="70%" width="100%">
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Edit Form</strong>
                            </div>
                            <form action="process/edit-resep.php" method="post" enctype="multipart/form-data" class="">
                                <div class="card-body card-block">
                                    <input type="hidden" name="id"
                                        <?php
                                            if ($hasil['ID_Resep']) {
                                                $ID_Resep = $hasil['ID_Resep'];
                                                echo "value='$ID_Resep' ";
                                            }
                                        ?>
                                    >
                                    <input type="hidden" name="foto"
                                    <?php
                                            if ($hasil['Gambar']) {
                                                $Gambar = $hasil['Gambar'];
                                                echo "value='$Gambar' ";
                                            }
                                        ?>
                                    >
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="col-sm-2">
                                                <label class=" form-control-label">Judul</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" name="Judul" placeholder="Judul" class="form-control"
                                                <?php
                                                    if ($hasil['Judul']) {
                                                        $Judul = $hasil['Judul'];
                                                        echo "value='$Judul' ";
                                                    }
                                                ?>
                                                >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="col-sm-2">
                                                <label class=" form-control-label">Kategori</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <select name="Kategori" id="select" class="form-control">
                                                    <option hidden>--Kategori--</option>
                                                    <option value="Appetizer"
                                                    <?php
                                                        if ($hasil['Kategori']=="Appetizer") {
                                                            echo "selected";
                                                        }
                                                    ?>
                                                    >Appetizer</option>

                                                    <option value="Main Course"
                                                    <?php
                                                        if ($hasil['Kategori']=="Main Course") {
                                                            echo "selected";
                                                        }
                                                    ?>
                                                    >Main Course</option>

                                                    <option value="Dessert"
                                                    <?php
                                                        if ($hasil['Kategori']=="Dessert") {
                                                            echo "selected";
                                                        }
                                                    ?>
                                                    >Dessert</option>
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
                                                <input type="text" name="Prep" placeholder="Prep" class="form-control"
                                                <?php
                                                    if ($waktu) {
                                                        echo "value='$waktu[0]' ";
                                                    }
                                                ?>
                                                >
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="Cook" placeholder="Cook" class="form-control"
                                                <?php
                                                    if ($waktu) {
                                                        echo "value='$waktu[1]' ";
                                                    }
                                                ?>
                                                >
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="Yields" placeholder="Yields" class="form-control"
                                                <?php
                                                    if ($waktu) {
                                                        echo "value='$waktu[2]' ";
                                                    }
                                                ?>
                                                >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="col-sm-2">
                                                    <label for="input-small" class=" form-control-label">Bahan</label>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="Bahan[]" placeholder="Bahan 1" class="form-control"
                                                <?php
                                                    if ($bahan) {
                                                        echo "value='$bahan[0]' ";
                                                    }
                                                ?>
                                                >
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="Bahan[]" placeholder="Bahan 2" class="form-control"
                                                <?php
                                                    if ($bahan) {
                                                        echo "value='$bahan[1]' ";
                                                    }
                                                ?>
                                                >
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="Bahan[]" placeholder="Bahan 3" class="form-control"
                                                <?php
                                                    if ($bahan) {
                                                        echo "value='$bahan[2]' ";
                                                    }
                                                ?>
                                                >
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            <div class="col-sm-2">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="Bahan[]" placeholder="Bahan 4" class="form-control"
                                                <?php
                                                    if ($bahan) {
                                                        echo "value='$bahan[3]' ";
                                                    }
                                                ?>
                                                >
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="Bahan[]" placeholder="Bahan 5" class="form-control"
                                                <?php
                                                    if ($bahan) {
                                                        echo "value='$bahan[4]' ";
                                                    }
                                                ?>
                                                >
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="Bahan[]" placeholder="Bahan 6" class="form-control"
                                                <?php
                                                    if ($bahan) {
                                                        echo "value='$bahan[5]' ";
                                                    }
                                                ?>
                                                >
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            <div class="col-sm-2">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="Bahan[]" placeholder="Bahan 7" class="form-control"
                                                <?php
                                                    if ($bahan) {
                                                        echo "value='$bahan[6]' ";
                                                    }
                                                ?>
                                                >
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="Bahan[]" placeholder="Bahan 8" class="form-control"
                                                <?php
                                                    if ($bahan) {
                                                        echo "value='$bahan[7]' ";
                                                    }
                                                ?>
                                                >
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="Bahan[]" placeholder="Bahan 9" class="form-control"
                                                <?php
                                                    if ($bahan) {
                                                        echo "value='$bahan[8]' ";
                                                    }
                                                ?>
                                                >
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            <div class="col-sm-2">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="Bahan[]" placeholder="Bahan 10" class="form-control"
                                                <?php
                                                    if ($bahan) {
                                                        echo "value='$bahan[9]' ";
                                                    }
                                                ?>
                                                >
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="Bahan[]" placeholder="Bahan 11" class="form-control"
                                                <?php
                                                    if ($bahan) {
                                                        echo "value='$bahan[10]' ";
                                                    }
                                                ?>
                                                >
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="Bahan[]" placeholder="Bahan 12" class="form-control"
                                                <?php
                                                    if ($bahan) {
                                                        echo "value='$bahan[11]' ";
                                                    }
                                                ?>
                                                >
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="col-sm-2">
                                                    <label for="input-small" class=" form-control-label">Langkah</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" name="Langkah[]" placeholder="Langkah 1" class="form-control"
                                                <?php
                                                    if ($langkah) {
                                                        echo "value='$langkah[0]' ";
                                                    }
                                                ?>
                                                >
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            <div class="col-sm-2">
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" name="Langkah[]" placeholder="Langkah 2" class="form-control"
                                                <?php
                                                    if ($langkah) {
                                                        echo "value='$langkah[1]' ";
                                                    }
                                                ?>
                                                >
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            <div class="col-sm-2">
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" name="Langkah[]" placeholder="Langkah 3" class="form-control"
                                                <?php
                                                    if ($langkah) {
                                                        echo "value='$langkah[2]' ";
                                                    }
                                                ?>
                                                >
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            <div class="col-sm-2">
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" name="Langkah[]" placeholder="Langkah 4" class="form-control"
                                                <?php
                                                    if ($langkah) {
                                                        echo "value='$langkah[3]' ";
                                                    }
                                                ?>
                                                >
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            <div class="col-sm-2">
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" name="Langkah[]" placeholder="Langkah 5" class="form-control"
                                                <?php
                                                    if ($langkah) {
                                                        echo "value='$langkah[4]' ";
                                                    }
                                                ?>
                                                >
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            <div class="col-sm-2">
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" name="Langkah[]" placeholder="Langkah 6" class="form-control"
                                                <?php
                                                    if ($langkah) {
                                                        echo "value='$langkah[5]' ";
                                                    }
                                                ?>
                                                >
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            <div class="col-sm-2">
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" name="Langkah[]" placeholder="Langkah 7" class="form-control"
                                                <?php
                                                    if ($langkah) {
                                                        echo "value='$langkah[6]' ";
                                                    }
                                                ?>
                                                >
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            <div class="col-sm-2">
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" name="Langkah[]" placeholder="Langkah 8" class="form-control"
                                                <?php
                                                    if ($langkah) {
                                                        echo "value='$langkah[7]' ";
                                                    }
                                                ?>
                                                >
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            <div class="col-sm-2">
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" name="Langkah[]" placeholder="Langkah 9" class="form-control"
                                                <?php
                                                    if ($langkah) {
                                                        echo "value='$langkah[8]' ";
                                                    }
                                                ?>
                                                >
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            <div class="col-sm-2">
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" name="Langkah[]" placeholder="Langkah 10" class="form-control"
                                                <?php
                                                    if ($langkah) {
                                                        echo "value='$langkah[9]' ";
                                                    }
                                                ?>
                                                >
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="col-sm-2">Gambar</div>
                                            <div class="col-sm-10">
                                              <div class="custom-file">
                                                <input type="file" name="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
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
                                    <button type="button" class="btn btn-danger">
                                        <i class="fa fa-ban"></i> Cancel
                                    </button>
                                    </a>
                                </div>
                            </form>

                        </div>
                    </div>
                    <?php
                        }
                    ?>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Data Table</strong>
                            </div>

                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID<br>Resep</th>
                                            <th>ID<br>Akun</th>
                                            <th>Judul</th>
                                            <th>Kategori</th>
                                            <th>Waktu</th>
                                            <th>Bahan</th>
                                            <th>Langkah</th>
                                            <th>Gambar</th>
                                            <th>Tanggal</th>
                                            <th>Validasi</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach ($data as $key => $value) {
                                        ?>
                                        <tr>
                                            <td><?php echo $value['ID_Resep'] ;?></td>
                                            <td><?php echo $value['ID_Akun'] ;?></td>
                                            <td><?php echo $value['Judul'] ;?></td>
                                            <td><?php echo $value['Kategori'] ;?></td>
                                            <td><?php echo $value['Waktu'] ;?></td>
                                            
                                            <td>
                                                <div style="overflow: hidden; height: 100px">
                                                <?php echo $value['Bahan'] ;?>
                                                </div>
                                            </td>
                                            
                                            
                                            <td>
                                                <div style="overflow: hidden; height: 100px">
                                                <?php echo $value['Langkah'] ;?>
                                                </div> 
                                            </td>
                                            <td>
                                                <img src="../img/recipes/<?php echo $value['Gambar']?>" height="70" width="100">
                                            </td>
                                            <td><?php echo $value['Tanggal'] ;?></td>
                                            <td><?php
                                                if ($value['Validasi'] == "True") {
                                                    $idresep = $value['ID_Resep'];
                                                    echo "
                                                    <a href='process/edit-resep.php?validasi=True&id=$idresep'>
                                                    <button class='btn btn-success'>True</button>
                                                    </a>
                                                    ";
                                                } else {
                                                    $idresep = $value['ID_Resep'];
                                                    echo "
                                                    <a href='process/edit-resep.php?validasi=False&id=$idresep'>
                                                    <button class='btn btn-warning'>False</button>
                                                    </a>
                                                    ";
                                                }
                                            ?></td>
                                            <td>
                                                <a href="tables-resep.php?ubah=<?php echo $value['ID_Resep'];?>">
                                                    <button class="btn btn-primary"><span class="fa fa-edit"></span></button>
                                                </a>
                                                <a href="tables-resep.php?hapus=<?php echo $value['ID_Resep'];?>" onclick="return confirm('Yakin ingin menghapusnya?')">
                                                    <button class="btn btn-danger"><span class="fa fa-trash-o"></span></button>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div><!-- .animated -->
        </div><!-- .content -->


    </div><!-- /#right-panel -->

    <!-- Right Panel -->


    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>


    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="assets/js/init-scripts/data-table/datatables-init.js"></script>


</body>

</html>
