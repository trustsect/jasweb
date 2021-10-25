<?php
session_start();
include './../../koneksi.php';

if (($_SESSION["u_login"]) == false) {
  header("location: ./../../login/");
  exit;
}

$success_log = "";
if(isset($_POST['send'])){
  $nama = $_POST['nama'];
  $masa_kerja = $_POST['masa_kerja'];
  $jabatan = $_POST['jabatan'];
  $jam_masuk = $_POST['jam_masuk'];
  $admin = $_SESSION['u_name'];
  mysqli_query($koneksi,"INSERT INTO ahp_db VALUES('','$nama','$jabatan','$masa_kerja', '$jam_masuk', '$admin')");
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
            <a class="nav-link active" aria-current="page" href="#">AHP</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./../topsis/">TOPSIS</a>
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
      <h3 class="mb-5" style="font-size: 1.5em;font-weight: 700;font-family: 'Montserrat', sans-serif;">Input 
        <div class="h-border">AHP</div>
      </h3>
    </div>

    <form class="w-100" method="post" action="">
      <div class="row">
        <div class="col-sm-3">
          <div class="mb-3">
            <label class="form-label">Nama Karyawan</label>
            <input type="text" class="form-control" name="nama" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Masa Kerja</label>
            <input type="text" class="form-control" name="masa_kerja" required>
          </div>
        </div>

        <div class="col-sm-3">
          <div class="mb-3">
            <label class="form-label">Jabatan</label>
            <select class="form-select" aria-label="Default select example" name="jabatan" required>
              <option selected>Open this select menu</option>
              <option value="AdminWEB">AdminWeb</option>
              <option value="HRD">HRD</option>
              <option value="Manager">Manager</option>
              <option value="Staff">Staff</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Jam Masuk</label>
            <input type="time" class="form-control" name="jam_masuk" required>
          </div>

          <div class="row">
            <div class="col-sm">
              <?php if ($_SESSION['u_level'] == "HRD" || $_SESSION['u_level'] == "manager") { ?>
                <input type="submit" class="btn-customblue w-100 text-center border-0 mb-5" value="KIRIM" onclick="notAllowed()" name="xxx">
              <?php } else { ?>
                <input type="submit" class="btn-customblue w-100 text-center border-0 mb-5" value="KIRIM" name="send">
              <?php } ?>
            </div>
          </div>
        </div>
        </form>

        <div class="col-sm-1"></div>

        <div class="col-sm-5">
          <table class="table table-borderless">
            <thead>
              <tr class="rounded-3">
                <th scope="col">Nama Karyawan</th>
                <th scope="col">OPSI</th>
              </tr>
            </thead>
            <tbody>

              <?php
                $data = mysqli_query($koneksi, "SELECT * FROM ahp_db LIMIT 0, 5");
                while($d = mysqli_fetch_array($data)){
              ?>
              <tr>
                <td><?php echo $d['nama']; ?></td>
                <td class="text-center">
                  <a class="bi bi-eye-fill fs-4"
                     style="color: #0b4e83;"
                     data-bs-toggle="modal"
                     data-bs-target="#modal<?php echo $d['id']; ?>"
                  ></a>
                </td>
              </tr>
              <?php } ?>

            </tbody>
          </table>

          <div class="mt-3 float-end">
            <a href="./../topsis/" class="text-center btn-customblue w-100">Show More</a>
          </div>
        </div>
      </div>


  <?php
    $data = mysqli_query($koneksi, "SELECT * FROM ahp_db LIMIT 0, 5");
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

  <footer class="my-4">
    <p class="text-center">Copyright (c) Yatcode 2021</p>
  </footer>

    <script type="text/javascript">
      function notAllowed(){
        swal({
            title: 'Gagal!',
            text: 'Akun Tidak Memiliki Hak Akses!',
            icon: 'error',
            button: 'Kembali',
          });
      }
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="./../../assets/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
