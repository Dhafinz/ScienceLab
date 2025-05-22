<?php
// Memulai session
session_start();

// Mengecek apakah ada session user yang aktif
if (!isset($_SESSION['user'])) {
    header('location:login.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="id">

<head>
    <title>Halaman Administrator</title>
</head>

<body style="text-align:center">
    <h1>Halaman Administrator</h1>
    <a href="..sains/index.php">Home</a>
    <a href="..sains/logout.php">Logout</a>
    <hr>
    <h3>Selamat Datang, <?php echo htmlspecialchars($_SESSION['user']['nama']); ?></h3>
    <p>Halaman ini akan tampil setelah user login.</p>
</body>

</html>