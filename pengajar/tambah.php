<?php
@session_start();
if(!isset($_SESSION['username'])){
  header("location: ../login.php");
}
include '../data/koneksi.php';
include '../data/fungsi.php';
date_default_timezone_set("Asia/Jakarta");

//proses tambah
if($_POST){
    $nama_pengajar = $_POST['nama_pengajar'];
    $nip_pengajar = $_POST['nip_pengajar'];
    $email = $_POST['email'];
    $no_tlp = $_POST['no_tlp'];


    if($nama_pengajar&&$nip_pengajar){
      $sqll = mysql_query("select * from pengajar where nama_pengajar='$nama_pengajar'");
    if(mysql_num_rows($sqll) > 0){
      $_SESSION['kt_del_message'] = "Data sudah ada !";
    }else{
    $sql = "INSERT INTO `pengajar`(`id_pengajar`,`nama_pengajar`,`nip_pengajar`,`email_pengajar`,`no_telp_pengajar`) VALUES ('','$nama_pengajar','$nip_pengajar','$email','$no_tlp')";
    if(mysql_query($sql)){
        $sucess_msg = "Data berhasil ditambahkan";
        $_SESSION['kt_succ_message'] = $sucess_msg;
      }
    }
  }
      if(empty($error_msg)){
        header("location: pengajar.php");
    }else{
        echo '<script>alert("'.$error_msg.'");</script>';
    }
}
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PUSDIKLAT | ANRI</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="../apple-icon.png">
    <link rel="shortcut icon" href="../favicon.png">

    <link rel="stylesheet" href="../assets/css/normalize.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="../assets/css/cs-skin-elastic.css">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="../assets/scss/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body>
        <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./"><img src="../images/logoanri2.png" alt="Logo"></a>
                <a class="navbar-brand hidden" href="./"><img src="../images/logo.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="../index.php"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                    <li>
                        <a href="../pengajar/pengajar.php"> <i class="menu-icon fa fa-group"></i>Pengajar </a>
                    </li>
                    <li>
                        <a href="../jadwal/jadwal.php"> <i class="menu-icon fa fa-list-alt"></i>Jadwal Pengajar </a>
                    </li>
                    <li class="active">
                        <a href="user.php"> <i class="menu-icon fa fa-user"></i>User </a>
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
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">
                        <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="../images/admin.jpg" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="#"><i class="fa fa- user"></i>My Profile</a>
                            <a class="nav-link" href="#"><i class="fa fa -cog"></i>Settings</a>
                            <a class="nav-link" href="../data/keluar.php"><i class="fa fa-power -off"></i>Logout</a>
                        </div>
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
                            <li><a href="../index.php">Dashboard</a></li>
                            <li><a href="#">User</a></li>
                            <li class="active">Data User</li>
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
                        <strong>Input</strong> User
                      </div>
                      <div class="card-body card-block">

                    <form action="" method="post" class="form-horizontal">

                          <div class="row form-group">
                            <div class="col col-md-2"><label for="text-input" class=" form-control-label">Nama Pengajar</label></div>
                            <div class="col-12 col-md-10"><input type="text" id="nama_pengajar" name="nama_pengajar" placeholder="Masukan Nama Pengajar" class="form-control"></div>
                          </div>

                          <div class="row form-group">
                            <div class="col col-md-2"><label for="text-input" class=" form-control-label">NIP Pengajar</label></div>
                            <div class="col-12 col-md-10"><input type="text" id="nip_pengajar" name="nip_pengajar" placeholder="Masukan Nomor Telp" class="form-control"></div>
                          </div>

                          <div class="row form-group">
                            <div class="col col-md-2"><label for="text-input" class=" form-control-label">Email</label></div>
                            <div class="col-12 col-md-10"><input type="email" id="email" name="email" placeholder="Masukan Email" class="form-control"></div>
                          </div>

                          <div class="row form-group">
                            <div class="col col-md-2"><label for="text-input" class=" form-control-label">No Telepon</label></div>
                            <div class="col-12 col-md-10"><input type="text" id="no_tlp" name="no_tlp" placeholder="Masukan No Telepon" class="form-control"></div>
                          </div>
                      </div>
                      <div class="card-footer">
                        <button type="button" class="btn btn- btn-sm" style="float: left;">
                        <a href="user.php"><i class="fa fa-arrow-left"></i> Kembali</a>
                        </button>
                        <button type="reset" class="btn btn-danger btn-sm" style="float: right;">
                          <i class="fa fa-ban"></i> Reset
                        </button>
                        <button type="submit" class="btn btn-success btn-sm" style="float: right;">
                          <i class="fa fa-dot-circle-o"></i> Submit
                        </button>
                      </div>
                     </form>
                    </div>
                  </div>            

                </div>


            </div><!-- .animated -->
        </div><!-- .content -->


    </div><!-- /#right-panel -->

    <!-- Right Panel -->


    <script src="../assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/main.js"></script>


</body>
</html>
