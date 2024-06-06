<?php
session_start();
if (isset($_SESSION['status']) && $_SESSION['status'] == 'login') {
  header("location:dashboard/index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login | Rental PS</title>
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
            <h4 class="card-title text-center">Login | Rental PS</h4>
          </div>
          <div class="card-body">
            <form action="login.php" method="post">
              <!-- notifikasi -->
              <?php
              if (isset($_GET['message'])) {
                $msg = $_GET['message'];
                echo "<div class='alert alert-danger text-center' role='alert'>
                $msg
              </div>";
              }
              ?>
              <!-- akhir notifikasi -->
              <div class="form-group mb-3">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" required />
              </div>
              <div class="form-group mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required />
              </div>
              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary" name="login">Login</button>
              </div>
            </form>
            <div class="text-center mt-3">
              <p>Belum punya akun? daftar <a href="registrasi.php">disini</a></p>
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