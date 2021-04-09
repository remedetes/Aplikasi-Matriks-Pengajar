<?php 
@session_start();
session_unset();
session_destroy();
?>
<script language="JavaScript">
 		alert("Anda yakin ingin keluar ?");
 		document.location.href="../login.php";
 </script>