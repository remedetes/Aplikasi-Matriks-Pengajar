<?php
@session_start();
if(!isset($_SESSION['username'])){
  header("location: ../login.php");
}
include '../data/koneksi.php';
include '../data/fungsi.php';
date_default_timezone_set("Asia/Jakarta");

// Proses Tambah
if($_POST){
    $id_user = anti_injection($_GET['id']);
    $nama_user = $_POST['nama_user'];
    $no_telp_user = $_POST['no_telp_user'];
    $email_user = $_POST['email_user'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level_user = $_POST['level_user'];

    if($password&&$level_user){
      $sqll = mysql_query("select * from user where password='".$_POST['password']."'");
    $sql = "UPDATE `user` SET `nama_user`='$nama_user',`no_telp_user`='$no_telp_user',`email_user`='$email_user',`username`='$username',`password`=MD5('$password'),`level_user`='$level_user' WHERE `id_user`='$id_user'";
    if(mysql_query($sql)){
        $sucess_msg = "Data berhasil diperbaharui";
        $_SESSION['kt_succ_message'] = $sucess_msg;
    }else{
        $error_msg = "Error updating record: " . mysql_error($con);
    }
  }
  else{
      $_SESSION['kt_gagal_message'] = "GAGAL MENGUBAH DATA ! LENGKAPI PASSWORD DAN LEVEL !";
  }

    if(empty($error_msg)){
        header("location: user.php");
    }else{
        echo '<script>alert("'.$error_msg.'");</script>';
    }
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM `user` WHERE `id_user`='$id'";
    $query = mysql_query($sql);
    if(mysql_num_rows($query) > 0){
        while ($row = mysql_fetch_array($query)) {
            $nama_user = $row['nama_user'];
            $no_telp_user = $row['no_telp_user'];
            $email_user = $row['email_user'];
            $username = $row['username'];
            $password = $row['password'];
            $level_user = $row['level_user'];
        }
    }else{
        echo "Not Found";
        die();
    }
}else{
    die();
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

                    <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">

                          <div class="row form-group">
                            <div class="col col-md-2"><label for="text-input" class=" form-control-label">Nama User</label></div>
                            <div class="col-12 col-md-10"><input type="text" id="nama_user" name="nama_user" value="<?= $nama_user;?>" class="form-control"></div>
                          </div>

                          <div class="row form-group">
                            <div class="col col-md-2"><label for="text-input" class=" form-control-label">Nomor Telp</label></div>
                            <div class="col-12 col-md-10"><input type="text" id="no_telp_user" name="no_telp_user" value="<?= $no_telp_user;?>" class="form-control"></div>
                          </div>

                          <div class="row form-group">
                            <div class="col col-md-2"><label for="text-input" class=" form-control-label">Email User</label></div>
                            <div class="col-12 col-md-10"><input type="text" id="email_user" name="email_user" value="<?= $email_user;?>" class="form-control"></div>
                          </div>

                          <div class="row form-group">
                            <div class="col col-md-2"><label for="text-input" class=" form-control-label">Username</label></div>
                            <div class="col-12 col-md-10"><input type="text" id="username" name="username" value="<?= $username;?>" class="form-control"></div>
                          </div>

                          <div class="row form-group">
                            <div class="col col-md-2"><label for="text-input" class=" form-control-label">Password</label></div>
                            <div class="col-12 col-md-10"><input type="password" id="password" name="password" required class="form-control"><small class="help-block form-text">Masukan Password Kembali !</small></div>
                          </div>

                          <div class="row form-group">
                            <div class="col col-md-2"><label for="select" class=" form-control-label">Level User
                            </label></div>
                            <div class="col-12 col-md-10">
                              <select name="level_user" id="level_user" class="form-control">
                                <option value="<?= $level_user;?>"><?= $level_user;?></option>
                                <option><hr></option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                              </select>
                            </div>
                          </div>

                      </div>
                      <div class="card-footer">
                        <button type="button" class="btn btn- btn-sm" style="float: left;">
                        <a href="user.php"><i class="fa fa-arrow-left"></i> Kembali</a>
                        </button>
                        <button type="submit" class="btn btn-primary btn-sm" style="float: right;">
                          <i class="fa fa-dot-circle-o"></i> Ubah
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
