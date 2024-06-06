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
$nama_ps = $ps["nama_playstation"];

// cek jumlah ps
$jml_ps = querySelect("SELECT * FROM playstation WHERE nama_playstation = '$nama_ps'")[0];
$jumlah_ps = $jml_ps["jumlah"];

if ($jumlah_ps <= 0) {
  echo "<script>
            alert('data Orderan gagal dikonfirmasi');
            alert('jumlah PS Kosong');
            document.location.href = 'order.php';
          </script>";
} else {
  if (konfirmasiOrder($id) > 0) {
    if (kurangJumlahPS($ps) > 0) {
      echo "<script>
              alert('data Orderan berhasil dikonfirmasi');
              alert('jumlah PS berkurang');
              document.location.href = 'order.php';
            </script>";
    }
  } else {
    echo "<script>
              alert('data Orderan gagal dikonfirmasi');
              document.location.href = 'order.php';
            </script>";
  }
}
