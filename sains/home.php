<?php
session_start();

// Debug: Periksa session
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (isset($_GET['debug'])) {
    echo '<pre>';
    var_dump($_SESSION);
    echo '</pre>';
}

// Mengecek apakah user sudah login atau belum
if (!isset($_SESSION['user'])) {
    echo '<script>alert("Silakan login terlebih dahulu"); window.location.href="/UKLSains/login/login.php";</script>';
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ScienceLab - Home</title>
    <link rel="stylesheet" href="../css/layout.css" />
    <link rel="stylesheet" href="../css/home.css" />

</head>

<body>
    <header>
        <div class="logo">
            <h1>ScienceLab</h1>
        </div>
        <nav>
            <ul class="nav-links">
                <li><a href="home.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="proyek.php">Proyek</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="profil_user.php"><img src="../img/user_icon.jpg" alt=""></a></li>
            </ul>
        </nav>
    </header>

    <section class="hero">
        <h2>Welcome to ScienceLab</h2>
        <p>Web ini dapat membantu meningkatkan/mempelajari pemahaman science</p>
        <a href="about.php" class="btn">Learn More</a>
    </section>

    <footer>
        <p>&copy; 2024 ScienceLab</p>
    </footer>
</body>

</html>