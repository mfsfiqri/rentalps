<?php
//koneksi
$host = "localhost";
$username = "root";
$password = "";
$db_name = "rentalps";

$db = new mysqli($host, $username, $password, $db_name);

if ($db->connect_error) {
  echo "koneksi gagal";
}
