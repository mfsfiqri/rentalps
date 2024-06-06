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

if (hapusOrder($id) > 0) {
  echo "<script>
            alert('data Orderan berhasil dihapus');
            document.location.href = 'order.php';
          </script>";
} else {
  echo "<script>
            alert('data Orderan gagal dihapus');
            document.location.href = 'order.php';
          </script>";
}
