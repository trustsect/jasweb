<?php
session_start();
include './../koneksi.php';

$error_log = "";
if(isset($_POST['u_submit'])){
  $username = $_POST['u_username'];
  $password = $_POST['u_password'];
  $data = mysqli_query($koneksi,"select * from users where u_username='$username' and u_password='$password'");
  $cek = mysqli_num_rows($data);
  if($cek > 0){
    $info = mysqli_fetch_assoc($data);
    $u_level = $info['u_level'];
    $_SESSION['u_name'] = $info['u_name'];
    $_SESSION['u_username'] = $username;
    $_SESSION['u_level'] = $u_level;
    $_SESSION['u_login'] = true;
    header('location: ./../dashboard/');
  } else {
    $error_log = "
      <script type='text/javascript'>
        swal({
          title: 'Gagal!',
          text: 'Not Found Username/Password!',
          icon: 'error',
          button: 'BACK',
        });
      </script>
    ";
  }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
    <link href="./../assets/css/home.css" rel="stylesheet">
    <link href="./../assets/css/bootstrap.min.css" rel="stylesheet">
    <title>JAS Airport Services | Login</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg fixed-top" id="navbar">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="./../assets/img/logo.png" width="130px">
      </a>
      <div class="d-flex">
          <a href="./../" class="btn-customblue w-100 text-center">
            <span classs="bi bi-arrow-left"></span>BACK</a>
        </div>
    </div>
  </nav>

  <div class="d-flex justify-content-center py-5 mt-5">
    <form class="mt-5 rounded-3 border-1 border p-3" method="post" action="">
      <h3 class="pb-3">JAS Staff | Login</h3>
      <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" class="form-control border-0 bg-light rounded-3" name="u_username" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" class="form-control border-0 bg-light rounded-3" name="u_password" id="thisFormPassword" required>
      </div>
      <div class="mb-3 float-end">
        <input type="checkbox" id="thisShowPassword" onclick="ShowPassword()">
        <span class="checkbox">Show Password</span>
      </div>
      <div class="mb-3">
        <input type="submit" class="btn-customblue border-0 w-100" value="Log In" name="u_submit">
      </div>
    </form>
  </div>

  <footer class="my-4">
    <p class="text-center">Copyright (c) Yatcode 2021</p>
  </footer>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <?php echo $error_log; ?>
    <script type="text/javascript">
      function ShowPassword() {
      var checkBox = document.getElementById("thisShowPassword");
      var formPassword = document.getElementById("thisFormPassword");

        if (checkBox.checked == true){
          formPassword.type = 'text';
        } else {
          formPassword.type = 'password';
        }
      } 
    </script>
    <script src="./../assets/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
