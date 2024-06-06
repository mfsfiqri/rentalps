<?php
session_start();

if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
  header('location:../index.php?message=silahkan login terlebih dahulu');
  exit;
}

if ($_SESSION['level_user'] == "admin") {
  header('location:index-admin.php');
}

require '../functions.php';
// dapatkan data orderan dari user yang bersangkutan
$username = $_SESSION['username'];
$orderan = querySelect("SELECT * FROM orderan WHERE username = '$username'");


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Rental PS | History Orderan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <style>
    .bottom-nav {
      margin-top: 100px;
    }
  </style>
</head>

<body>
  <!-- navigasi -->
  <nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Rental PS</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Halo, <?php echo $_SESSION['nama_lengkap']; ?>!</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="./index.php">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="profile-user.php">Profile</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="sewa-ps.php">Sewa PS</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#">History</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./logout.php">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <section>
    <div class="container bottom-nav">
      <div class="text-center mb-5">
        <h1 class="fw-bold text-body-emphasis">History Orderan</h1>
      </div>
    </div>
  </section>

  <!-- History -->
  <?php foreach ($orderan as $row) : ?>
    <section>
      <div class="container">
        <div class="row mb-3">
          <div class="col-md-8 mx-auto">
            <div class="card">
              <div class="card-header">
                History Orderan
              </div>
              <div class="card-body col-md-8 mx-auto">
                <table class="table table-bordered">
                  <tbody>
                    <tr>
                      <th scope="row">Kode Orderan</th>
                      <td scope="row">:</td>
                      <td scope="row"><?php echo $row["kode_orderan"]; ?></td>
                    </tr>
                    <tr>
                      <th scope="row">Username</th>
                      <td scope="row">:</td>
                      <td scope="row"><?php echo $row["username"]; ?></td>
                    </tr>
                    <tr>
                      <th scope="row">Nama PS</th>
                      <td scope="row">:</td>
                      <td scope="row"><?php echo $row["nama_playstation"]; ?></td>
                    </tr>
                    <tr>
                      <th scope="row">Estimasi</th>
                      <td scope="row">:</td>
                      <td scope="row"><?php echo $row["estimasi_jam"]; ?> Jam</td>
                    </tr>
                    <tr>
                      <th scope="row">Waktu Mulai</th>
                      <td scope="row">:</td>
                      <td scope="row"><?php echo $row["waktu_mulai"]; ?></td>
                    </tr>
                    <tr>
                      <th scope="row">Tanggal</th>
                      <td scope="row">:</td>
                      <td scope="row"><?php echo $row["tanggal"]; ?></td>
                    </tr>
                    <tr>
                      <th scope="row">Harga</th>
                      <td scope="row">:</td>
                      <td scope="row">Rp. <?php echo $row["harga"]; ?></td>
                    </tr>
                    <tr>
                      <th scope="row">Status</th>
                      <td scope="row">:</td>
                      <td scope="row"><?php echo $row["status"]; ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?php endforeach; ?>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>