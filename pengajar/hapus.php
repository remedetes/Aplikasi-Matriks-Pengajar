<?php
@session_start();
if(!isset($_SESSION['username'])){
	header("location: ../login.php");
}
include '../data/koneksi.php';
include '../data/fungsi.php';
if(isset($_GET['id'])){
	$id = anti_injection($_GET['id']);
	$sql = "DELETE FROM `pengajar` WHERE `id_pengajar`='$id'";
	$query = mysql_query($sql);
	$_SESSION['kt_del_message'] = "Data telah berhasil di hapus";
	header("location: pengajar.php");
}else{
	header("location: pengajar.php");
}
?>