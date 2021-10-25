<?php
session_start();
include './../koneksi.php';
if (($_SESSION["u_login"]) == false) {
  header("location: ./../login/");
  exit;
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
    <title>JAS Airport Services | Dashboard</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg fixed-top bg-white navbar-light" id="navbar">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="./../assets/img/logo.png" width="130px">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="bi bi-grid"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">DASHBOARD</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./ahp/">AHP</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./topsis/">TOPSIS</a>
          </li>

          <?php if ($_SESSION['u_level'] == "superuser") { ?>
            <li class="nav-item">
              <a class="nav-link" href="./adduser/">ADD USER</a>
            </li>
          <?php } ?>

        </ul>
        <div class="d-flex">
          <a href="./../dashboard/logout.php" class="btn-customblue w-100 text-center">LOG OUT</a>
        </div>
      </div>
    </div>
  </nav>

  <div class="container">
    <div class="mt-5 pt-5 pb-4">
      <div class="row d-flex justify-content-end">
        <div class="col-sm-4">
          <div class="alert alert-primary">
            Hi, Welcome <b><?php echo $_SESSION['u_name']; ?>!</b>
          </div>
        </div>
      </div>
    </div>
    <h3 class="mb-4"><b>History Of JAS Airport Services</b></h3>
    <div class="row d-flex justify-content-center">
      <div class="col-sm-4">
        <img src="./../assets/img/logo.png" class="mt-4 mb-5 w-100" />
      </div>
      <div class="col-sm">
        <p class="pt-1" style="text-indent: 10%;">
          PT JASA ANGKASA SEMESTA, Tbk didirikan pada tanggal 8 Juni 1984. PT JASA ANGKASA SEMESTA, Tbk memulai kegiatan operasional pada tahun 1985 di bandara Soekarno Hatta Jakarta, dengan melayani Cathay Pacific, Malaysian Airlines, Lufthansa, and Singapore Airlines selaku klien pertamanya. Pada 1989, Perusahaan memperluas jaringan operasinya ke beberapa bandar udara di kotakota besar di Indonesia: Bali, Surabaya, Manado, Makassar dan Medan. Di tahun 2000 PT JASA ANGKASA SEMESTA, Tbk memulai layanan cargo handling dan warehousing setelah PT Cardig Air menyerahkan bisnis tersebut tersebut kepada PT JASA ANGKASA SEMESTA, Tbk.
        </p>
      </div>
    </div>
    <p style="text-indent: 10%;">
      Perluasan bisnis ini mendukung Perusahaan dalam melayani lebih dari 25 maskapai di seluruh Indonesia, sehingga menjadikan PT JASA ANGKASA SEMESTA, Tbk sebagai perusahaan ground handling pertama di Indonesia yang menawarkan layanan dalam ‘satu atap’ untuk pelanggannya. Seiring dengan perkembangan bisnis yang pesat, PT JASA ANGKASA SEMESTA, Tbk. menjadi perusahaan publik dengan mencatatkan sahamnya di Bursa Efek Surabaya (BES) 15 Juli 2002. Status perusahaan publik secara hukum diperoleh dengan pengesahan Menteri Kehakiman dan Hak Asasi Manusia yang diumumkan dalam Berita Negara Republik Indonesia No.57 tanggal 16 Juli 2002, Tambahan Berita Negara No.6923. 
    </p>
    <p style="text-indent: 10%;">
      Melihat kebutuhan untuk mengangkat bisnis setara dengan standar internasional, bulan Februari 2004 PT JASA ANGKASA SEMESTA, Tbk memilih Singapore Airport Terminal Services Limited (SATS) sebagai mitra strategis. SATS kemudian memiliki 49,79% saham PT JASA ANGKASA SEMESTA, Tbk. Pada tahun yang sama, Devro Group Limited menjual kepemilikan sahamnya di PT JASA ANGKASA SEMESTA, Tbk. kepada PT Cardig International (CI). Langkah ini diikuti dengan divestasi kepemilikan PT JASA ANGKASA SEMESTA, Tbk. di anak perusahaannya, yaitu PT Jasapura Angkasa Boga (JAB), PT Purantara Mitra Angkasa Dua (PMAD), PT Cardig Express Nusantara (CEN), PT UPS Cardig International (UCI), PT GoTrans Interna Express (GoTrans) dan PT JAS Aero-Engineering Services (JAE) kepada CI.
    </p>
    <p style="text-indent: 10%;">
      Divestasi termasuk pelepasan dan transfer hak sewa gudang milik perusahaan di Halim Perdanakusuma kepada CI. Sejak saat itu, CI menjadi perusahaan induk PT JASA ANGKASA SEMESTA, Tbk dengan kepemilikan 50,1%. Pada tanggal 20 Agustus 2009, PT Cardig International melepas kepemilikan sahamnya atas PT JASA ANGKASA SEMESTA, Tbk kepada PT Cardig Air Services sebesar 50.10%. Saat ini, PT JASA ANGKASA SEMESTA, Tbk melayani kurang lebih 30 maskapai penerbangan dengan jaringan sebanyak 10 stasiun di Indonesia. 
    </p>
  </div>
  <footer class="my-4 mt-5 pt-5">
    <p class="text-center">Copyright (c) Yatcode 2021</p>
  </footer>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="./../assets/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
