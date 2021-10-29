<?php
session_start();
include './../../koneksi.php';
if (($_SESSION["u_level"]) == "HRD") {
  header("location: ./../../login/");
  exit;
}
$id = $_GET['id'];
mysqli_query($koneksi,"DELETE FROM ahp_db WHERE id='$id'");
header("location:./index.php");
?>