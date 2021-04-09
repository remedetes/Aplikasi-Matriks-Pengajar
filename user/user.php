<?php
@session_start();
if(!isset($_SESSION['username'])){
    header("location: login.php");
}
include '../data/koneksi.php';
date_default_timezone_set("Asia/Jakarta");
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
    <link rel="stylesheet" href="../assets/css/lib/datatable/dataTables.bootstrap.min.css">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="../assets/scss/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<script type="text/javascript" language="JavaScript">
 function konfirmasi()
 {
 tanya = confirm("Hapus data ini ?");
 if (tanya == true) return true;
 else return false;
 }</script>
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
                        <a href="../user.php"> <i class="menu-icon fa fa-user"></i>User </a>
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

                <?php if(isset($_SESSION['kt_gagal_message'])){ ?>
                        <div class="col-sm-12">
                        <div class="alert  alert-danger alert-dismissible fade show" role="alert">
                            <strong><?= $_SESSION['kt_gagal_message']; ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        </div></div>
                <?php } ?>
            
                 <?php if(isset($_SESSION['kt_del_message'])){ ?>
                        <div class="col-sm-12">
                        <div class="alert  alert-danger alert-dismissible fade show" role="alert">
                            <strong><?= $_SESSION['kt_del_message']; ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        </div></div>
                <?php } ?>

                <?php if(isset($_SESSION['kt_succ_message'])){ ?>
                        <div class="col-sm-12">
                        <div class="alert  alert-success alert-dismissible fade show" role="alert">
                            <strong><?= $_SESSION['kt_succ_message']; ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        </div></div>
                <?php } ?>

                <div class="col-md-12">
                <!--Start Database-->              
                    <?php
                        $sql = "SELECT * FROM `user` ORDER BY `id_user` ";
                        $query = mysql_query($sql);
                        $total = mysql_num_rows(mysql_query($sql));
                        ?>
                    <a href="tambah.php" class="btn btn-success"><i class="fa fa-plus"></i> Tambah</a>
                    <p style="float: right;">Total User : <?= $total; ?></p>
                    <hr>
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Data Table</strong>
                        </div>
                        <div class="card-body">
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama </th>
                        <th>No Telp </th>
                        <th>Email </th>
                        <th>Username</th>
                        <th>Level </th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $no = 0;
                        if($total > 0){
                             while ($row = mysql_fetch_array($query)) {
                                 $no++;
                                 echo "<tr>";
                                 echo "<td>".$no."</td>";
                                 echo "<td>".($row['nama_user'])."</td>";
                                 echo "<td>".($row['no_telp_user'])."</td>";
                                 echo "<td>".($row['email_user'])."</td>";
                                 echo "<td>".($row['username'])."</td>";

                                 if($row['level_user'] == 'admin'){
                                 echo "<td><span class='badge badge-info'>".($row['level_user'])."</span></td>";
                                 }else{
                                 echo "<td><span class='badge badge-success'>".($row['level_user'])."</span></td>";
                                 }
                                 
                                 echo '<td>
                                <div class="btn-group">
                                <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle btn btn-primary">Aksi</button>
                                <div tabindex="-1" aria-hidden="true" role="menu" class="dropdown-menu">
                                <button type="button" tabindex="0" class="dropdown-item">
                                <a href="edit.php?id='.$row['id_user'].'"><i class="fa fa-pencil"></i> Ubah</a></li></button>
                                <button type="button" tabindex="0" class="dropdown-item">
                                <a onclick="return konfirmasi()" href="hapus.php?id='.$row['id_user'].'">
                                <i class="fa fa-trash"></i> Hapus</a>
                                </button>
                                </div>
                                </div>
                                </td>';
                                 echo "</tr>";
                                        }
                         }else{
                             echo "<tr><td colspan=\"9\">Data tidak tersedia</td></tr>";
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


    <script src="../assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/main.js"></script>


    <script src="../assets/js/lib/data-table/datatables.min.js"></script>
    <script src="../assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="../assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="../assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="../assets/js/lib/data-table/jszip.min.js"></script>
    <script src="../assets/js/lib/data-table/pdfmake.min.js"></script>
    <script src="../assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="../assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="../assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="../assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="../assets/js/lib/data-table/datatables-init.js"></script>


    <script type="text/javascript">
        $(document).ready(function() {
          $('#bootstrap-data-table-export').DataTable();
        } );
    </script>
<?php
unset($_SESSION['kt_del_message']);
unset($_SESSION['kt_succ_message']);
unset($_SESSION['kt_gagal_message']);
?>
</body>
</html>
