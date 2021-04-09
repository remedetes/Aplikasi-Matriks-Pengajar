<?php
@session_start();
if(!isset($_SESSION['username'])){
	header("location: ../login.php");
}
include '../data/koneksi.php';
include '../data/fungsi.php';
if(isset($_GET['id'])){
	$id = anti_injection($_GET['id']);
	$sql = "DELETE FROM `user` WHERE `id_user`='$id'";
	$query = mysql_query($sql);
	$_SESSION['kt_del_message'] = "Data telah berhasil di hapus";
	header("location: user.php");
}else{
	header("location: user.php");
}
?>