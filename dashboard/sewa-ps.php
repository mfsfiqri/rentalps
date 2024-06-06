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
// dapatkan data game dari database
$games = querySelect("SELECT * FROM games");

// dapatkan data ps
$ps = querySelect("SELECT * FROM playstation");

// dapatkan data user dari database
$id = $_SESSION['id'];
$user = querySelect("SELECT * FROM users WHERE id = $id")[0];

// cek apakah tombol order sudah ditekan apa belum
if (isset($_POST['order'])) {
  // cek apakah data ps berhasil disimpan
  if (tambahOrder($_POST) > 0) {
    echo "<script>
            alert('berhasil order');
            document.location.href = 'history.php';
          </script>";
  } else {
    echo "<script>
            alert('gagal order');
            document.location.href = 'sewa-ps.php';
          </script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Rental PS | Sewa PS</title>
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
              <a class="nav-link active" href="#">Sewa PS</a>
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

  <!-- Sewa PS -->
  <section>
    <div class="container bottom-nav">
      <div class="row mb-3">
        <div class="col-md-8 mx-auto">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Sewa PS</h4>
            </div>
            <div class="card-body">
              <form action="" method="post" id="profileForm">
                <div class="mb-3">
                  <div class="row mb-3">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control bg-secondary text-white" id="username" name="username" value="<?php echo $user["username"]; ?>" readonly>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="PS" class="col-sm-2 col-form-label">Nama PS</label>
                    <div class="col-sm-10">
                      <select class="form-select form-select" name="nama_playstation" required>
                        <option selected>-- Pilih PS --</option>
                        <?php foreach ($ps as $play) : ?>
                          <option><?php echo $play["nama_playstation"]; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="PS" class="col-sm-2 col-form-label">Estimasi</label>
                    <div class="col-sm-10">
                      <select class="form-select form-select" name="estimasi_jam" required>
                        <option selected>-- Pilih Estimasi Main --</option>
                        <option value="1">1 Jam</option>
                        <option value="2">2 Jam</option>
                        <option value="3">3 Jam</option>
                      </select>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="waktu" class="col-sm-2 col-form-label">Waktu Mulai</label>
                    <div class="col-sm-10">
                      <input type="time" class="form-control" id="waktu" name="waktu_mulai" required>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="tgl" class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-10">
                      <input type="date" class="form-control" id="tgl" name="tanggal" required>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-9">
                      <button type="submit" class="btn btn-primary" name="order">
                        Order Pesanan
                      </button>
                    </div>
                    <div class="col-sm-3">
                      <p>Harga = Rp 15000 per jam</p>
                    </div>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Daftar Game -->
  <section>
    <div class="container">
      <div class="row mb-3">
        <div class="col-md-8 mx-auto">
          <div class="card">
            <div class="card-header text-white bg-secondary">
              Data Game yang Bisa Dimainkan
            </div>
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Game</th>
                    <th scope="col">Nama PS</th>
                  </tr>
                </thead>
                <tbody class="table-group-divider">
                  <?php $i = 1; ?>
                  <?php foreach ($games as $row) : ?>
                    <tr>
                      <th scope="row"><?php echo $i; ?></th>
                      <td scope="row"><?php echo $row["nama_game"]; ?></td>
                      <td scope="row"><?php echo $row["nama_playstation"]; ?></td>
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