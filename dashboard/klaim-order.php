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
$id = $_GET['id'];

// ambil nama ps berdasarkan id orderan
$ps = querySelect("SELECT * FROM orderan WHERE id = $id")[0];


if (suksesOrder($id) > 0) {
  if (tambahJumlahPS($ps) > 0) {
    echo "<script>
              alert('data Orderan berhasil diklaim');
              alert('jumlah PS bertambah');
              document.location.href = 'order.php';
            </script>";
  }
} else {
  echo "<script>
            alert('data Orderan gagal diklaim');
            document.location.href = 'order.php';
          </script>";
}
