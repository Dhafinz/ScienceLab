<?php
session_start();
include "../config/koneksi_sains.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['username']) && !empty($_POST['password'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];

    $query = mysqli_prepare($koneksi, "SELECT * FROM tb_user WHERE username=?");
    mysqli_stmt_bind_param($query, "s", $username);
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);

    if ($data = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $data['password'])) {
            // Simpan data penting ke session
            $_SESSION['user'] = [
                'id' => $data['id_user'],
                'nama' => $data['nama'],
                'username' => $data['username'],
                'email' => $data['email'],
                'no_telp' => $data['no_telp'],
                'alamat' => $data['alamat'],
                'role' => $data['role']
            ];

            if ($data['role'] === 'admin') {
                echo '<script>alert("Selamat Datang, Admin ' . $data['nama'] . '"); location.href="../admin/dashboard.php";</script>';
            } else {
                echo '<script>alert("Selamat Datang, ' . $data['nama'] . '"); location.href="../sains/home.php";</script>';
            }
        } else {
            echo '<script>alert("Password salah.");</script>';
        }
    } else {
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