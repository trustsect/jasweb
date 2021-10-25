<?php
include './../../koneksi.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$u_username = $_POST['u_username'];
	$u_password = md5($_POST['u_password']);
	$data = mysqli_query($koneksi,"select * from admin where u_username='$u_username' and u_password='$u_password'");
	$cek = mysqli_num_rows($data);
	
	if($cek > 0){
		$response = array(
			'status' => 200,
            'message' => 'Success',
            'username' => $u_username
        );
        echo json_encode($response);
	} else {
		$response = array(
			'status' => 404,
            'message' => 'Not Found',
            'username' => $u_username
        );
        echo json_encode($response);
	}
} else {
	echo json_encode("Invalid Method Type");
}
?>

