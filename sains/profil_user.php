<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['user'])) {
    echo '<script>alert("Silakan login terlebih dahulu"); window.location.href="/UKLSains/login/login.php";</script>';
    exit;
}

$user = $_SESSION['user'];
$isAdmin = $user['role'] === 'admin';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna - ScienceLab</title>
    <link rel="stylesheet" href="../css/layout_profil.css">
</head>

<body>
    <div class="sidebar">
        <a href="profil_user.php" class="active">Profil Informasi</a>
        <a href="home.php">Home</a>
        <?php if ($isAdmin): ?>
            <a href="../admin/dashboard.php">Dashboard</a>
        <?php endif; ?>
        <a href="logout.php">Logout</a>
    </div>

    <div class="profile-content">
        <h2>Profil Anda</h2>

        <div class="profile-card">
            <strong>Nama</strong>
            <?= htmlspecialchars($user['nama']) ?>
        </div>

        <div class="profile-card">
            <strong>Username</strong>
            <?= htmlspecialchars($user['username']) ?>
        </div>

        <div class="profile-card">
            <strong>Email</strong>
            <?= htmlspecialchars($user['email']) ?>
        </div>

        <div class="profile-card">
            <strong>Nomor Telp</strong>
            <?= htmlspecialchars($user['no_telp']) ?>
        </div>

        <div class="profile-card">
            <strong>Alamat</strong>
            <?= htmlspecialchars($user['alamat']) ?>
        </div>
    </div>
</body>

</html>