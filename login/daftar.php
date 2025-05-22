<?php
session_start();
require '../config/koneksi_sains.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $nama = $_POST['nama'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $no_telp = $_POST['no_telp'];
  $alamat = $_POST['alamat'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $role = 'user';

  // Cek apakah username sudah digunakan
  $cek_username = mysqli_prepare($koneksi, "SELECT id_user FROM tb_user WHERE username = ?");
  mysqli_stmt_bind_param($cek_username, "s", $username);
  mysqli_stmt_execute($cek_username);
  mysqli_stmt_store_result($cek_username);

  if (mysqli_stmt_num_rows($cek_username) > 0) {
    echo '<script>alert("Username sudah digunakan. Silakan pilih username lain.");</script>';
  } else {
    // Insert data jika username belum digunakan
    $query = mysqli_prepare($koneksi, "INSERT INTO tb_user(nama, username, email, no_telp, password, alamat, role) VALUES (?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($query, "sssssss", $nama, $username, $email, $no_telp, $password, $alamat, $role);
    $result = mysqli_stmt_execute($query);

    if ($result) {
      echo '<script>alert("Pendaftaran berhasil! Silakan login."); location.href="login.php";</script>';
    } else {
      echo '<script>alert("Pendaftaran gagal: ' . mysqli_error($koneksi) . '");</script>';
    }
  }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daftar</title>
  <link rel="stylesheet" href="../css/daftar.css">
</head>

<body>
  <div class="container">
    <form method="POST">
      <h2>Daftar</h2>

      <label>Nama</label>
      <input type="text" name="nama" required>

      <label>Username</label>
      <input type="text" name="username" required>

      <label>Email</label>
      <input type="email" name="email" required>

      <label>Nomor Telp</label>
      <input type="text" name="no_telp" required>

      <label>Password</label>
      <input type="password" name="password" required>

      <label>Alamat</label>
      <textarea name="alamat" rows="3" required></textarea>

      <button type="submit">Daftar</button>

      <p class="login-link">Sudah punya akun? <a href="login.php">Login</a></p>
    </form>
  </div>
</body>

</html>