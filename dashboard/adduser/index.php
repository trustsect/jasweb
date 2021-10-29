<?php
session_start();
include './../../koneksi.php';

if (($_SESSION["u_login"]) == false) {
  header("location: ./../../login/");
  exit;
}

if (($_SESSION["u_level"]) == "adminweb" || ($_SESSION["u_level"]) == "HRD" || ($_SESSION["u_level"]) == "manager") {
  header("location: ./../../dashboard/");
  exit;
}

$success_log = "";
if(isset($_POST['u_submit'])){
  $nama = $_POST['u_name'];
  $username = $_POST['u_username'];
  $password = $_POST['u_password'];
  $level = $_POST['u_level'];
  mysqli_query($koneksi,"INSERT INTO users VALUES('','$nama','$username','$password', '$level')");
  $success_log = "
      <script type='text/javascript'>
        swal({
          title: 'Success!',
          text: 'Data Berhasil Di Simpan!',
          icon: 'success',
          button: 'Kembali',
        });
      </script>
    ";
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./../../assets/js/jquery.table2excel.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
    <link href="./../../assets/css/home.css" rel="stylesheet">
    <link href="./../../assets/css/bootstrap.min.css" rel="stylesheet">
    <title>JAS Airport Services | Dashboard</title>
  </head>
  <body>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <?php echo $success_log; ?>

  <nav class="navbar navbar-expand-lg fixed-top bg-white navbar-light" id="navbar">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="./../../assets/img/logo.png" width="130px">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="bi bi-grid"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="./../">DASHBOARD</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./../ahp/">AHP</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./../hasil/">HASIL</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./../saw/">SAW</a>
          </li>

          <?php if ($_SESSION['u_level'] == "superuser") { ?>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">ADD USER</a>
            </li>
          <?php } ?>

        </ul>
        <div class="d-flex">
          <a href="./../../dashboard/logout.php" class="btn-customblue w-100 text-center">LOG OUT</a>
        </div>
      </div>
    </div>
  </nav>

  <div class="py-5 mt-5 container">
    <div class="row">
      <div class="col-sm-4 mb-2">
        <form class="rounded-3 border-1 border p-3 w-100" method="post" action="">
          <h3 class="pb-3">Add User+</h3>
          <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" class="form-control border-0 bg-light rounded-3" name="u_name" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" class="form-control border-0 bg-light rounded-3" name="u_username" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control border-0 bg-light rounded-3" name="u_password" id="thisFormPassword" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Level User</label>
            <select class="form-select" aria-label="Default select example" name="u_level" required>
              <option value="HRD" selected>Open this select menu</option>
              <option value="adminweb">AdminWeb</option>
              <option value="manager">Manager</option>
              <option value="HRD">HRD</option>
              <option value="superuser">SuperUser</option>
            </select>
          </div>
          <div class="mb-3">
            <input type="submit" class="btn-customblue border-0 w-100" value="ADD USER" name="u_submit">
          </div>
        </form>
      </div>

      <div class="col-sm-8 container">
        <div class="rounded-3 border-1 border w-100 h-100 p-2">
          <div class="row">
            <div class="col-sm-4 mb-2">
              <input type="text" class="form-control w-100" placeholder="Search" id="search-bar">
            </div>
            <div class="col-sm-3 mb-2">
              <button class="btn btn-success exportToExcel float-end w-100">EXCEL</button>
            </div>
          </div>
      
          <div class="table-responsive">
            <table class="table table2excel table2excel_with_colors table-borderless table-hover">
              <thead>
                <tr style="background: #0b4e83;">
                  <th scope="col" >Username</th>
                  <th scope="col">Password</th>
                  <th scope="col">Level</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $data = mysqli_query($koneksi, "SELECT * FROM users");
                  while($d = mysqli_fetch_array($data)){
                ?>
                <tr>
                  <td class="text-center">
                    <?php echo $d['u_username']; ?>
                  </td>
                  <td class="text-center">
                    <?php echo $d['u_password']; ?>
                  </td>
                  <td class="text-center">
                    <?php echo $d['u_level']; ?>
                  </td>
                  <td class="text-center">
                    <a href="delete.php?username=<?php echo $d['u_username']; ?>"
                       class="text-danger bi bi-trash fs-5">
                    </a>
                  </td>
                </tr>
                  <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="my-2">
    <p class="text-center">Copyright (c) Yatcode 2021</p>
  </footer>

    <script type="text/javascript">
      $(document).ready(function(){
       $("#search-bar").on("keyup", function() {
         var value = $(this).val().toLowerCase();
         $("tbody tr").filter(function() {
           $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
         });
       });
      });
    </script>
    <script src="./../../assets/js/core.table2excel.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="./../../assets/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
