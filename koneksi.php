<?php 
$koneksi = mysqli_connect("localhost","root","infr@systc0m","jasweb");
if (mysqli_connect_error()){
	echo "koneksi database gagal" .mysqli_connect_error();
}
?>