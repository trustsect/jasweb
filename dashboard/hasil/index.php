<?php
session_start();
include './../../koneksi.php';

if (($_SESSION["u_login"]) == false) {
  header("location: ./../../login/");
  exit;
}

$success_log = "";
if(isset($_POST['update'])){
  $id = $_POST['id'];
  $nama = $_POST['update_nama'];
  $masa_kerja = $_POST['update_masa'];
  $jabatan = $_POST['update_jabatan'];
  $jam_masuk = $_POST['update_jam'];
  $admin = $_POST['update_admin'];
  mysqli_query($koneksi,"UPDATE ahp_db SET nama='$nama', jabatan='$jabatan', masa_kerja='$masa_kerja', jam_masuk='$jam_masuk', adminweb='$admin' WHERE id='$id'");
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
            <a class="nav-link active" aria-current="page" href="./../hasil/">HASIL</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./../saw/">SAW</a>
          </li>

          <?php if ($_SESSION['u_level'] == "superuser") { ?>
            <li class="nav-item">
              <a class="nav-link" href="./../adduser/">ADD USER</a>
            </li>
          <?php } ?>

        </ul>
        <div class="d-flex">
          <a href="./../../dashboard/logout.php" class="btn-customblue w-100 text-center">LOG OUT</a>
        </div>
      </div>
    </div>
  </nav>

  <div class="container pt-3 pb-5 mb-5">
    <div class="mt-5 pt-5">
      <div class="row">
        <div class="col-sm-3 mb-3">
          <input type="text" class="form-control w-100" placeholder="Search" id="search-bar">
        </div>
        <div class="col-sm-2 mb-3">
          <button class="btn btn-success w-100 exportToExcel">EXCEL</button>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table2excel table2excel_with_colors table-borderless table-hover">
          <thead>
            <tr style="background: #0b4e83;">
              <th scope="col" class="text-start">No</th>
              <th scope="col" class="text-start">Nama</th>
              <th scope="col" class="text-start">Jabatan</th>
              <th scope="col" class="text-start">Masa</th>
              <th scope="col" class="text-start">Jam</th>
              <th scope="col" class="text-start">Admin</th>

            <?php if ($_SESSION['u_level'] == "superuser" || $_SESSION['u_level'] == "adminweb") { ?>
              <th scope="col" class="text-start"></th>
              <th scope="col" class="text-start"></th>
            <?php } ?>
            </tr>
          </thead>
          <tbody>
          <?php
            $i=1;
            $data = mysqli_query($koneksi, "SELECT * FROM ahp_db");
            while($d = mysqli_fetch_array($data)){
          ?>
            <tr>
              <td scope="row"><?php echo $i++; ?></td>
              <td><?php echo $d['nama']; ?></td>
              <td><?php echo $d['jabatan']; ?></td>
              <td><?php echo $d['masa_kerja']; ?></td>
              <td><?php echo $d['jam_masuk']; ?></td>
              <td><?php echo $d['adminweb']; ?></td>

            <?php if ($_SESSION['u_level'] == "superuser" || $_SESSION['u_level'] == "adminweb") { ?>
              <td>
                <a style="color: #0b4e83;"
                   data-bs-toggle="modal"
                   data-bs-target="#modal<?php echo $d['id']; ?>"
                   class="bi bi-pencil-square">
                </a>
              </td>
              <td>
                <a href="delete.php?id=<?php echo $d['id']; ?>" class="text-danger bi bi-trash"></a>
              </td>
            <?php } ?>

            </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>

        <?php
    $data = mysqli_query($koneksi, "SELECT * FROM ahp_db");
    while($d = mysqli_fetch_array($data)){
  ?>

    <?php if ($_SESSION['u_level'] == "HRD" || $_SESSION['u_level'] == "manager") { ?>
      <div class="modal fade" id="modal<?php echo $d['id']; ?>" tabindex="-1" aria-labelledby="modal<?php echo $d['id']; ?>" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Data AHP</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label class="form-label">Nama Karyawan</label>
                <input class="form-control form-disabled border-0" type="text" value="<?php echo $d['nama']; ?>" aria-label="Disabled input example" disabled readonly>
              </div>

              <div class="row">
                <div class="col-sm">
                  <div class="mb-3">
                    <label class="form-label">Jabatan</label>
                    <input class="form-control form-disabled border-0" type="text" value="<?php echo $d['jabatan']; ?>" aria-label="Disabled input example" disabled readonly>
                  </div>
                </div>
                <div class="col-sm">
                  <div class="mb-3">
                    <label class="form-label">Masa Kerja</label>
                    <input class="form-control form-disabled border-0" type="text" value="<?php echo $d['masa_kerja']; ?>" aria-label="Disabled input example" disabled readonly>
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-sm">
                  <div class="mb-3">
                    <label class="form-label">Jam Masuk</label>
                    <input class="form-control form-disabled border-0" type="text" value="<?php echo $d['jam_masuk']; ?>" aria-label="Disabled input example" disabled readonly>
                  </div>
                </div>
                <div class="col-sm">
                  <div class="mb-3">
                    <label class="form-label">AdminWEB</label>
                    <input class="form-control form-disabled border-0" type="text" value="<?php echo $d['adminweb']; ?>" aria-label="Disabled input example" disabled readonly>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>

    <?php } else { ?>
      <form method="post" action="">
      <div class="modal fade" id="modal<?php echo $d['id']; ?>" tabindex="-1" aria-labelledby="modal<?php echo $d['id']; ?>" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Data AHP</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label class="form-label">Nama Karyawan</label>
                <input class="form-control d-none" type="text" value="<?php echo $d['id']; ?>" name="id" required>
                <input class="form-control" type="text" value="<?php echo $d['nama']; ?>" name="update_nama" required>
              </div>

              <div class="row">
                <div class="col-sm">
                  <div class="mb-3">
                    <label class="form-label">Jabatan</label>
                    <select class="form-select" aria-label="Default select example" name="update_jabatan" required>
                      <option selected>Open this select menu</option>
                      <option value="AdminWEB">AdminWeb</option>
                      <option value="HRD">HRD</option>
                      <option value="Manager">Manager</option>
                      <option value="Staff">Staff</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm">
                  <div class="mb-3">
                    <label class="form-label">Masa Kerja</label>
                    <input class="form-control" type="text" value="<?php echo $d['masa_kerja']; ?>" name="update_masa" required>
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-sm">
                  <div class="mb-3">
                    <label class="form-label">Jam Masuk</label>
                    <input class="form-control" type="time" value="<?php echo $d['jam_masuk']; ?>" name="update_jam" required>
                  </div>
                </div>
                <div class="col-sm">
                  <div class="mb-3">
                    <label class="form-label">AdminWEB</label>
                    <input class="form-control" type="text" value="<?php echo $d['adminweb']; ?>" name="update_admin" required>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
              <input type="submit" name="update" class="border-0 btn-customblue" value="Update">
            </div>
          </div>
        </div>
      </div>
      </form>
    <?php } ?>

  <?php } ?>
    </div>
  </div>

  <footer class="my-4">
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
