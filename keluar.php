<?php
session_start();
include ('koneksi.php');
$id_pelogin     = $_SESSION['id'];
$last           = $_SESSION['masuk'];
$sql = $koneksi->query("UPDATE tb_pengguna SET kpn_masuk= '$last' WHERE id='$id_pelogin'");
session_destroy();
header( "location:masuk.php" );
?>

