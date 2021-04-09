<?php

@session_start();
include("koneksi.php");
$username = $_POST['username'];
$password = $_POST['password'];
$MD5 = MD5($password);
$sql = mysql_query("SELECT * FROM `staff` WHERE `username` LIKE '$username' AND `password` LIKE '$MD5'");
$_SESSION['username']="$_POST[username]"; 	
$row = mysql_fetch_array($sql);

if ($row['level_user']=='admin'){
	echo"<script>alert('Selamat Datang $_SESSION[username]');document.location.href='../index.php';</script>";
}
elseif ($row['level_user']=='user'){
	echo"<script>alert('Selamat Datang $_SESSION[username]');document.location.href='../../index.php';</script></script>";
}
else{
	echo"<script>alert('Akun Tidak Terdaftar');document.location.href='../login.php';</script>";
}


?>