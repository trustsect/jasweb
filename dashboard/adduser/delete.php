<?php
session_start();
include './../../koneksi.php';
if (($_SESSION["u_level"]) == "HRD") {
  header("location: ./../../login/");
  exit;
}
$username = $_GET['username'];
mysqli_query($koneksi,"DELETE FROM users WHERE u_username='$username'");
header("location:./index.php");
?>