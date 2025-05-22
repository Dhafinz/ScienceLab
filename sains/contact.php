<?php
session_start();

// Cek login
if (!isset($_SESSION['user'])) {
    echo '<script>alert("Silakan login terlebih dahulu"); location.href="/UKLSains/login/login.php";</script>';
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ScienceLab - Kontak</title>
    <link rel="stylesheet" href="../css/layout.css">
    <link rel="stylesheet" href="../css/contact.css"> <!-- Pindahin styling ke file contact.css -->
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

    <main class="contact-container">
        <section class="contact-info">
            <h2>Hubungi Kami</h2>
            <p>Jika ada yang ingin ditanyakan, silakan hubungi kami melalui:</p>
            <p><strong>Nomor Telepon:</strong> +62 851-4117-2944</p>
        </section>

        <section class="contact-form">
            <form action="kirim_pesan.php" method="post">
                <input type="text" name="name" placeholder="Nama Anda" required>
                <input type="email" name="email" placeholder="Email Anda" required>
                <input type="text" name="subject" placeholder="Subjek">
                <textarea name="message" placeholder="Pesan Anda..." required></textarea>
                <button type="submit">Kirim Pesan</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 ScienceLab.</p>
    </footer>
</body>

</html>