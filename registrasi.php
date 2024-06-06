<?php
require './functions.php';

if (isset($_POST['daftar'])) {
  if (daftar($_POST) > 0) {
    echo "<script>
            alert('user baru berhasil ditambahkan');
          </script>";
  } else {
    echo $db->error;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Registrasi | Rental PS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <style>
    .row {
      min-height: 100vh;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="row justify-content-center align-items-center">
      <div class="col-md-5">
        <div class="card mt-5">
          <div class="card-header">
            <h4 class="card-title text-center">Daftar Akun | Rental PS</h4>
          </div>
          <div class="card-body">
            <form action="" method="post" autocomplete="off">
              <div class="form-group mb-3">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Masukan username" required />
              </div>
              <div class="form-group mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="******" required />
              </div>
              <div class="form-group mb-3">
                <label for="password2">Konfirmasi Password</label>
                <input type="password" class="form-control" name="password2" id="password2" placeholder="******" required />
              </div>
              <div class="form-group mb-3">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Masukan nama lengkap" required />
              </div>
              <div class="form-group mb-3">
                <label for="no_telp">Nomor Telepon</label>
                <input type="number" class="form-control" name="no_telp" id="no_telp" placeholder="Masukkan nomor telepon" required />
              </div>
              <div class="form-group mb-3">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Masukkan alamat" required />
              </div>
              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary" name="daftar">Daftar</button>
              </div>
            </form>
            <div class="text-center mt-3">
              <p>Sudah punya akun? login <a href="index.php">disini</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>