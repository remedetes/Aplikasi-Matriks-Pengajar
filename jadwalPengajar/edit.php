<?php
@session_start();
if(!isset($_SESSION['username'])){
  header("location: ../login.php");
}
include '../data/koneksi.php';
include '../data/fungsi.php';
date_default_timezone_set("Asia/Jakarta");

// Proses tambah
if($_POST){
  $id_pengajar = anti_injection($_GET['id']);
  $nama_pengajar = $_POST['nama_pengajar'];
  $nip_pengajar = $_POST['nip_pengajar'];
  $tampil = $_POST['tampil'];

    $sql = "UPDATE `pengajar` SET `nama_pengajar`='$nama_pengajar',`nip_pengajar`='$nip_pengajar',`tampil`='$tampil' WHERE `id_pengajar`='$id_pengajar'";
    if(mysql_query($sql)){
        $sucess_msg = "Data berhasil diperbaharui";
        $_SESSION['kt_succ_message'] = $sucess_msg;
    }else{
        $error_msg = "Error updating record: " . mysql_error($con);
    }

    if(empty($error_msg)){
        header("location: pengajar.php");
    }else{
        echo '<script>alert("'.$error_msg.'");</script>';
    }
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM `pengajar` WHERE `id_pengajar`='$id'";
    $query = mysql_query($sql);
    if(mysql_num_rows($query) > 0){
        while ($row = mysql_fetch_array($query)) {
        $id_pengajar = $row['id_pengajar'];
        $kategori = $row['kategori'];
        $nama_pengajar = $row['nama_pengajar'];
        $tampil = $row['tampil'];
        }
    }else{
        echo "Not Found";
        die();
    }
}else{
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Aplikasi Penilaian Pusdiklat || Admin</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="../css/bootstrap.min.css" />
<link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="../css/colorpicker.css" />
<link rel="stylesheet" href="../css/datepicker.css" />
<link rel="stylesheet" href="../css/uniform.css" />
<link rel="stylesheet" href="../css/select2.css" />
<link rel="stylesheet" href="../css/matrix-style.css" />
<link rel="stylesheet" href="../css/matrix-media.css" />
<link rel="stylesheet" href="../css/bootstrap-wysihtml5.css" />
<link href="../font-awesome/css/font-awesome.css" rel="stylesheet" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>
<body>

<!--Header-part-->
<div id="header">
  <h1><a href="pengajar.php">PUSDIKLAT ANRI BOGOR.</a></h1>
</div>
<!--close-Header-part--> 


<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <li  class="dropdown" id="profile-messages" ><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"></i>  <span class="text">Selamat Datang <?php $sql = mysql_query("select * from staff where username='".$_SESSION['username']."'");
      while($row=mysql_fetch_array($sql)): 
        echo $row['nama_staff'];
      endwhile;?></span><b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="#"><i class="icon-user"></i>Profil Saya</a></li>
        <li class="divider"></li>
        <li><a href="../data/keluar.php"><i class="icon-signout"></i>Keluar</a></li>
      </ul>
    </li>    
    <li class=""><a title="" href="#"><i class="icon icon-cog"></i> <span class="text">Bantuan</span></a></li>
    <li class=""><a title="" href="../data/keluar.php"><i class="icon icon-signout"></i> <span class="text">Keluar</span></a></li>
  </ul>
</div>
<!--close-top-Header-menu-->
<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Beranda</a>
  <ul>
    <li><a href="../index.php"><i class="icon icon-home"></i> <span>Beranda</span></a> </li>
    <li class="active"><a href="pengajar.php"><i class="icon icon-file"></i> <span>pengajar</span></a></li>
    <li><a href="../penyelenggaraan/penyelenggaraan.php"><i class="icon icon-copy"></i> <span>Penyelenggaraan</span></a></li>
    <li><a href="../hasil_pengajar/hasil_pengajar.php"><i class="icon icon-copy"></i> <span>Hasil Pengajar</span></a></li>
    <li><a href="../hasil_penyelenggaraan/hasil_penyelenggaraan.php"><i class="icon icon-copy"></i> <span>Hasil Penyelenggaraan</span></a></li>
    <li><a href="../diklat/diklat.php"><i class="icon icon-copy"></i> <span>Diklat</span></a></li>
    <li><a href="../materi/materi.php"><i class="icon icon-copy"></i> <span>Materi</span></a></li>
    <li><a href="../pengajar/pengajar.php"><i class="icon icon-copy"></i> <span>Pengajar</span></a></li>
    <li><a href="../grafik/grafik.php"><i class="icon icon-signal"></i> <span>Grafik</span></a> </li>
    <li><a href="../staff/staff.php"><i class="icon icon-user"></i> <span>Staff</span></a> </li>
  </ul>
</div>
<!--sidebar-menu-->

<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="../index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Beranda
    </a> <a href="pengajar.php" class="current">pengajar</a></a> <a href="#" class="current">Ubah</a></div>
  </div>
<!--End-breadcrumbs-->

<!--Action boxes-->
  <div class="container-fluid">
    <div class="quick-actions_homepage">
       <h3 align="left">Ubah pengajar</h3>    
    </div>
<!--End-Action boxes-->    

<!--Chart-box-->    
    <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title bg_lg"><span class="icon"><i class="icon-file"></i></span>
          <h5>pengajar</h5>
        </div>
        <div class="widget-content" >
          <div class="row-fluid">
          <div class="span9">
<!--Start Database-->              
        <div class="nopadding">
      <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="post" class="form-horizontal">
        <div class="control-group"><label class="control-label">Id pengajar :</label><div class="controls">
            <input type="text" class="span11" name="id_pengajar" id="id_pengajar" value="<?= $id_pengajar;?>" readonly/></div>
        </div>
       <div class="control-group"><label class="control-label">Nama Pengajar :</label><div class="controls">
          <input type="text" class="span11" placeholder="Nama Pengajar" name="nama_pengajar" id="nama_pengajar" value="<?= $nama_pengajar;?>"/>
       </div>
       <div class="control-group"><label class="control-label">Nip Pengajar :</label><div class="controls">
          <input type="text" class="span11" placeholder="Nip Pengajar" name="nip_pengajar" id="nip_pengajar" value="<?= $nip_pengajar;?>"/>
       </div>

        <label class="control-label">Tampilkan :</label>
        <div class="controls">
          <select class="span11" name="tampil" id="tampil">
            <option value="<?php echo $tampil; ?>"><?php echo $tampil; ?></option>
            <option></option>
            <option value="Tampil">Tampil</option>
            <option value="Sembunyikan">Sembunyikan</option>
          </select>
       </div>

        <div class="form-actions">
             <button type="submit" class="btn btn-success">Ubah</button></div>
          </form>
        </div>   
<!--End Database--> 
        </div>
          </div>
          </div>
        </div>
      </div>
    </div>
<!--End-Chart-box--> 
      </div>
    </div>
<!--end-main-container-part-->

<!--Footer-part-->

<div class="row-fluid">
  <div id="footer" class="span12"> 2018 &copy; PUSDIKLAT ANRI 2019. <a href="#">PUSDIKLAT ANRI 2019.</a></div>
</div>

<!--end-Footer-part-->

<script src="../js/jquery.min.js"></script> 
<script src="../js/jquery.ui.custom.js"></script> 
<script src="../js/bootstrap.min.js"></script> 
<script src="../js/bootstrap-colorpicker.js"></script> 
<script src="../js/bootstrap-datepicker.js"></script> 
<script src="../js/jquery.toggle.buttons.js"></script> 
<script src="../js/masked.js"></script> 
<script src="../js/jquery.uniform.js"></script> 
<script src="../js/select2.min.js"></script> 
<script src="../js/matrix.js"></script> 
<script src="../js/matrix.form_common.js"></script> 
<script src="../js/wysihtml5-0.3.0.js"></script> 
<script src="../js/jquery.peity.min.js"></script> 
<script src="../js/bootstrap-wysihtml5.js"></script> 
<script>
  $('.textarea_editor').wysihtml5();
</script>
</body>
</html>
