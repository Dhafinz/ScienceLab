<?php
session_start();
if ($_SESSION['user']['role'] !== 'admin') {
    header("Location: ../sains/home.php");
    exit();
}

include_once('../config/koneksi_sains.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $no_telp = $_POST['no_telp'];
    $alamat = $_POST['alamat'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // hash password
    $role = $_POST['role'];

    $sql = "INSERT INTO tb_user (nama, username, email, no_telp, alamat, password, role)
            VALUES ('$nama', '$username', '$email', '$no_telp', '$alamat', '$password', '$role')";

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('User berhasil ditambahkan'); window.location.href='manage_user.php';</script>";
    } else {
        echo "Error saat insert: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Siswa</title>
</head>
<body>
    <h2>Tambah Data Siswa</h2>
    <form method="POST" action="tambah_user.php">
        Nama: <input type="text" name="nama" required><br><br>
        Username: <input type="text" name="username" required><br><br>
        Email: <input type="email" name="email" required><br><br>
        No. Telp: <input type="text" name="no_telp" required><br><br>
        Alamat: <textarea name="alamat" required></textarea><br><br>
        Password: <input type="password" name="password" required><br><br>
        Role: 
        <select name="role" required>
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select><br><br>
        <button type="submit">Simpan</button>
    </form>
    <br>
    <a href="manage_user.php">Kembali</a>
</body>
</html>
