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

// ambil data dari url
$id = $_GET['id'];
$ps = querySelect("SELECT * FROM playstation WHERE id = $id")[0];


// cek apakah tombol tambah sudah ditekan apa belum
if (isset($_POST['update'])) {
  // cek apakah data ps berhasil disimpan
  if (updatePS($_POST) > 0) {
    echo "<script>
            alert('data ps berhasil diubah');
            document.location.href = 'data-ps.php';
          </script>";
  } else {
    echo "<script>
            alert('data ps gagal diubah');
            document.location.href = 'data-ps.php';
          </script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Rental PS | Profile</title>
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
              <a class="nav-link" aria-current="page" href="./index-admin.php">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#">Profile</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Manajemen Sewa
              </a>
              <ul class="dropdown-menu dropdown-menu-dark">
                <li><a class="dropdown-item" href="daftar-client.php">Daftar Client</a></li>
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
                  <a class="dropdown-item active" href="data-ps.php">Data PS</a>
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

  <!-- Profile User -->
  <div class="container bottom-nav">
    <div class="row">
      <div class="col-md-6 mx-auto">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Update Data PS</h4>
          </div>
          <div class="card-body">
            <form action="" method="post" id="profileForm">
              <input type="hidden" name="id" value="<?php echo $ps["id"]; ?>">
              <div class="mb-3">
                <label for="nama_playstation" class="form-label">Nama PlayStation</label>
                <input type="text" class="form-control" id="nama_playstation" name="nama_playstation" value="<?php echo $ps["nama_playstation"]; ?>" required />
              </div>
              <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah PS</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?php echo $ps["jumlah"]; ?>" required />
              </div>
              <button type="submit" class="btn btn-primary" name="update">
                Update Data PS
              </button>
              <a href="./data-ps.php"><button type="button" class="btn btn-secondary">Kembali</button></a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>