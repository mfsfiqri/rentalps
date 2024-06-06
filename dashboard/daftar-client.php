<?php
session_start();

if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
  header('location:../index.php?message=silahkan login terlebih dahulu');
  exit;
}

if ($_SESSION['level_user'] == "user") {
  header('location:index.php');
}

require '../functions.php';
// ambil data user
$users = querySelect("SELECT * FROM users WHERE level_user = 'user'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Rental PS | Daftar Client</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <style>
    .bottom-nav {
      margin-top: 100px;
    }
  </style>
</head>

<body>
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
              <a class="nav-link" aria-current="page" href="index-admin.php">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="profile-admin.php">Profile</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Manajemen Sewa
              </a>
              <ul class="dropdown-menu dropdown-menu-dark">
                <li><a class="dropdown-item active" href="#">Daftar Client</a></li>
                <li>
                  <hr class="dropdown-divider" />
                </li>
                <li>
                  <a class="dropdown-item" href="order.php">Order</a>
                </li>
                <li>
                  <hr class="dropdown-divider" />
                </li>
                <li>
                  <a class="dropdown-item" href="data-ps.php">Data PS</a>
                </li>
                <li>
                  <hr class="dropdown-divider" />
                </li>
                <li>
                  <a class="dropdown-item" href="laporan.php">Laporan</a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./logout.php">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <!-- Tabel data user -->
  <section>
    <div class="container bottom-nav">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header text-white bg-secondary">
              Data Client
            </div>
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Username</th>
                    <th scope="col">Nama</th>
                    <th scope="col">No Telepon</th>
                    <th scope="col">Alamat</th>
                  </tr>
                </thead>
                <tbody class="table-group-divider">
                  <?php $i = 1; ?>
                  <?php foreach ($users as $row) : ?>
                    <tr>
                      <th scope="row"><?php echo $i; ?></th>
                      <td scope="row"><?php echo $row["username"]; ?></td>
                      <td scope="row"><?php echo $row["nama_lengkap"]; ?></td>
                      <td scope="row"><?php echo $row["no_telp"]; ?></td>
                      <td scope="row"><?php echo $row["alamat"]; ?></td>
                    </tr>
                    <?php $i++; ?>
                  <?php endforeach; ?>
                </tbody>
              </table>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>