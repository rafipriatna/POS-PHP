<?php
$host = 'localhost';
$user = 'root';
$pass = 'rafipriatna';
$data = 'db_pos';

$koneksi = new mysqli("$host", "$user", "$pass", "$data");
if (mysqli_connect_error())
  {
  echo "Waduh error gan :( </br> " . mysqli_connect_error();
  }
  error_reporting(E_ALL & ~E_NOTICE);
?>