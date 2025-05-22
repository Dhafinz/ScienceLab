<?php
// Memulai session
session_start();
// Menghubungkan ke database
include "../config/koneksi_sains.php";


// Mengecek apakah form dikirim (method POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['username']) && !empty($_POST['password'])) {
    // Mengamankan input username agar tidak terkena SQL Injection
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];

    // Mempersiapkan query untuk mencari user berdasarkan username
    $query = mysqli_prepare($koneksi, "SELECT * FROM tb_user WHERE username=?");
    mysqli_stmt_bind_param($query, "s", $username);
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);

    // Mengecek apakah user ditemukan
    if ($data = mysqli_fetch_assoc($result)) {
        // Memeriksa apakah password cocok dengan hash di database
        if (password_verify($password, $data['password'])) {
            // Jika cocok, simpan data user ke dalam session
            $_SESSION['user'] = $data;

            // Cek role-nya
            if ($data['role'] === 'admin') {
                echo '<script>alert("Selamat Datang, Admin ' . $data['nama'] . '"); location.href="../admin/dashboard.php";</script>';
            } else {
                echo '<script>alert("Selamat Datang, ' . $data['nama'] . '"); location.href="../sains/home.php";</script>';
            }
        } else {
            // Jika password salah, tampilkan pesan error
            echo '<script>alert("Password salah.");</script>';
        }
    } else {
        // Jika username tidak ditemukan, tampilkan pesan error
        echo '<script>alert("Username tidak ditemukan.");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <title>Login</title>
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>
    <div class="login-container">
        <h3>Login</h3>
        <form method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
            <a href="daftar.php">Belum punya akun? Daftar</a>
        </form>
    </div>
</body>

</html>