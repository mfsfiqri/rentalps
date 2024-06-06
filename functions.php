<?php
require 'config.php';

function querySelect($query)
{
  global $db;
  $result = $db->query($query);
  $rows = [];
  while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
  }
  return $rows;
}

function daftar($data)
{
  global $db;

  // tampung form
  $username = strtolower(stripslashes($data['username']));
  $password = $db->real_escape_string($data['password']);
  $password2 = $db->real_escape_string($data['password2']);
  $nama = $db->real_escape_string($data['nama_lengkap']);
  $no_telp = $db->real_escape_string($data['no_telp']);
  $alamat = $db->real_escape_string($data['alamat']);

  // cek username sudah ada atau belum
  $sqlUsername = "SELECT username FROM users WHERE username = '$username'";
  $result = $db->query($sqlUsername);

  if ($result->fetch_assoc()) {
    echo "<script>
            alert('username tidak tersedia! coba username lain');
          </script>";
    return false;
  }

  // cek konfirmasi password
  if ($password !== $password2) {
    echo "<script>
            alert('konfirmasi password tidak sesuai!');
          </script>";
    return false;
  }

  // enkripsi password
  $password = password_hash($password, PASSWORD_DEFAULT);

  // tambahkan user baru ke database
  $sql = "INSERT INTO users (username, password, nama_lengkap, no_telp, alamat, level_user) VALUES ('$username', '$password', '$nama', '$no_telp', '$alamat', 'user')";
  $db->query($sql);

  return $db->affected_rows;
}

function login($data)
{
  global $db;

  // tampung form
  $username = $db->real_escape_string($data['username']);
  $password = $db->real_escape_string($data['password']);

  // querry
  $sql = "SELECT * FROM users WHERE username = '$username'";
  $result = $db->query($sql);

  // cek username
  if ($result->num_rows === 1) {
    // cek password
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
      // set session
      $_SESSION['status'] = "login";
      $_SESSION['id'] = $row['id'];
      $_SESSION['username'] = $row['username'];
      $_SESSION['nama_lengkap'] = $row['nama_lengkap'];
      $_SESSION['level_user'] = $row['level_user'];

      // multi level
      if ($_SESSION['level_user'] === 'user') {
        header("location:dashboard/index.php");
      }
      if ($_SESSION['level_user'] === 'admin') {
        header("location:dashboard/index-admin.php");
      }
    } else {
      header("location:index.php?message= username atau password salah");
    }
  } else {
    header("location:index.php?message= username atau password salah");
  }
}

function updateProfile($data)
{
  global $db;

  // ambil data dari form
  $id = $_SESSION['id'];
  $username = htmlspecialchars($data["username"]);
  $nama = htmlspecialchars($data["nama_lengkap"]);
  $no_telp = htmlspecialchars($data["no_telp"]);
  $alamat = htmlspecialchars($data["alamat"]);

  // query update data user
  $sql = "UPDATE users SET username = '$username', nama_lengkap = '$nama', no_telp = '$no_telp', alamat = '$alamat' WHERE id = $id";
  $db->query($sql);

  return $db->affected_rows;
}

function hapusPS($id)
{
  global $db;

  $db->query("DELETE FROM playstation where id = $id");

  return $db->affected_rows;
}

function tambahPS($data)
{
  global $db;

  // ambil data dari form
  $nama_playstation = htmlspecialchars($data["nama_playstation"]);
  $jumlah = htmlspecialchars($data["jumlah"]);

  // query TAMBAH data PS
  $sql = "INSERT INTO playstation (nama_playstation, jumlah) VALUES ('$nama_playstation', $jumlah)";
  $db->query($sql);

  return $db->affected_rows;
}

function updatePS($data)
{
  global $db;

  //ambil data dari form
  $id = $data['id'];
  $nama_playstation = htmlspecialchars($data["nama_playstation"]);
  $jumlah = htmlspecialchars($data["jumlah"]);

  $sql = "UPDATE playstation SET nama_playstation = '$nama_playstation', jumlah = '$jumlah' WHERE id = $id";
  $db->query($sql);

  return $db->affected_rows;
}

function kurangJumlahPS($data)
{
  global $db;

  // ambil data nama ps dari tabel orderan
  $nama_playstation = $data["nama_playstation"];

  $sql = "UPDATE playstation SET jumlah = jumlah - 1 WHERE nama_playstation = '$nama_playstation'";
  $db->query($sql);

  return $db->affected_rows;
}

function tambahJumlahPS($data)
{
  global $db;

  // ambil data nama ps dari tabel orderan
  $nama_playstation = $data["nama_playstation"];

  $sql = "UPDATE playstation SET jumlah = jumlah + 1 WHERE nama_playstation = '$nama_playstation'";
  $db->query($sql);

  return $db->affected_rows;
}

function tambahOrder($data)
{
  global $db;

  //ambil data dari form
  $kode_orderan = substr(uniqid(), 7, 6);
  $username = htmlspecialchars($data["username"]);
  $nama_playstation = $data["nama_playstation"];
  $estimasi_jam = $data["estimasi_jam"];
  $waktu_mulai = $data["waktu_mulai"];
  $tanggal = $data["tanggal"];
  $harga = 15000 * $data["estimasi_jam"];
  $status_awal = "pending";

  // query tambah order
  $sql = "INSERT INTO orderan (kode_orderan, username, nama_playstation, estimasi_jam, waktu_mulai, tanggal, harga, status) VALUES ('$kode_orderan', '$username', '$nama_playstation', $estimasi_jam, '$waktu_mulai', '$tanggal', '$harga', '$status_awal')";

  $db->query($sql);

  return $db->affected_rows;
}

function hapusOrder($id)
{
  global $db;

  $db->query("DELETE FROM orderan WHERE id = $id");

  return $db->affected_rows;
}

function konfirmasiOrder($id)
{
  global $db;

  $db->query("UPDATE orderan SET status = 'disewakan' WHERE id = $id");

  return $db->affected_rows;
}

function suksesOrder($id)
{
  global $db;

  $db->query("UPDATE orderan SET status = 'sukses' WHERE id = $id");

  return $db->affected_rows;
}
