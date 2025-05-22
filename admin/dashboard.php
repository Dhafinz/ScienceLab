<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    echo '<script>alert("Akses ditolak. Admin saja yang boleh ke sini."); location.href="../sains/home.php";</script>';
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - ScienceLab</title>
    <link rel="stylesheet" href="../css/layout_admin.css">
    <link rel="stylesheet" href="../css/dashboard.css">
</head>

<body>
    <header>
        <nav>
            <ul class="nav-links">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="../sains/home.php">Home</a></li>
                <li><a href="manage_user.php">Manage User</a></li>
                <li><a href="manage_contact.php">Manage Contact</a></li>
                <li><a href="manage_project.php">Manage project</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <!-- Main container -->
    <div class="container">
        <div class="welcome-message">
            <h1>Selamat datang, Admin <?= htmlspecialchars($_SESSION['user']['nama']) ?>!</h1>
            <p>Ini adalah dashboard utama Anda, tempat Anda dapat mengelola berbagai fitur dalam sistem.</p>
        </div>

        <div class="action-buttons">
            <a href="manage_user.php" class="action-link">Kelola User</a>
            <a href="manage_contact.php" class="action-link">Kelola Contact</a>
        </div>
    </div>

</body>

</html>