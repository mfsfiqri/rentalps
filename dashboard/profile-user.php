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
// dapatkan data user dari database
$id = $_SESSION['id'];
$user = querySelect("SELECT * FROM users WHERE id = $id")[0];

// cek apakah tombol simpan sudah ditekan apa belum
if (isset($_POST['simpan'])) {
  // cek apakah data berhasil disimpan
  if (updateProfile($_POST) > 0) {
    echo "<script>
            alert('data berhasil diubah');
            document.location.href = 'profile-user.php';
          </script>";
  } else {
    echo "<script>
            alert('data gagal diubah');
            document.location.href = 'profile-user.php';
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
              <a class="nav-link" aria-current="page" href="./index.php">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#">Profile</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="sewa-ps.php">Sewa PS</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="history.php">History</a>
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
            <h4 class="card-title">User Profile</h4>
          </div>
          <div class="card-body">
            <form action="" method="post" id="profileForm">
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $user["username"]; ?>" required />
              </div>
              <div class="mb-3">
                <label for="nama_lengkap" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?php echo $user["nama_lengkap"]; ?>" required />
              </div>
              <div class="mb-3">
                <label for="no_telp" class="form-label">No Telepon</label>
                <input type="number" class="form-control" id="no_telp" name="no_telp" value="<?php echo $user["no_telp"]; ?>" required />
              </div>
              <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $user["alamat"]; ?>" required />
              </div>
              <button type="submit" class="btn btn-primary" name="simpan">
                Simpan
              </button>
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