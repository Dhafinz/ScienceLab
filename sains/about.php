<?php
session_start();

// Cek apakah user sudah login
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
    <title>Tentang Kami - ScienceLab</title>
    <link rel="stylesheet" href="../css/layout.css"> <!-- Style utama -->
    <link rel="stylesheet" href="../css/about.css"> <!-- Khusus untuk halaman About -->
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

    <main class="about-container">
        <section class="about-section">
            <h2>Tentang ScienceLab</h2>
            <p>ScienceLab adalah platform edukasi berbasis web yang dirancang untuk mendukung proses pembelajaran sains
                secara lebih modern dan efisien. Kami percaya bahwa sains adalah kunci untuk memahami dunia dan
                menciptakan masa depan yang lebih baik. Oleh karena itu, kami menyediakan berbagai sumber belajar,
                proyek inovatif, dan ruang eksplorasi untuk siswa, guru, dan masyarakat.</p>
        </section>

        <section class="about-section">
            <h3>Misi Kami</h3>
            <p>Misi kami adalah memberikan akses mudah ke pembelajaran sains yang interaktif dan menarik. Dengan
                memanfaatkan teknologi, kami ingin menciptakan lingkungan belajar yang mendukung kreativitas dan
                pemahaman mendalam dalam sains.</p>
        </section>

        <section class="about-section">
            <h3>Fitur ScienceLab</h3>
            <ul>
                <li><strong>Penemuan Terbaru:</strong> Informasi terkini tentang inovasi dan kemajuan sains.</li>
                <li><strong>Proyek Siswa:</strong> Inspirasi dan panduan untuk proyek-proyek sains kreatif.</li>
                <li><strong>Materi Belajar:</strong> Sumber belajar yang mudah diakses untuk semua kalangan.</li>
                <li><strong>Komunitas:</strong> Ruang untuk berdiskusi dan berbagi ide di antara siswa dan guru.</li>
            </ul>
        </section>

        <section class="about-section">
            <h3>Kenapa Memilih ScienceLab?</h3>
            <p>ScienceLab dirancang untuk mempermudah akses pembelajaran sains dengan pendekatan yang relevan dan
                menarik. Kami berkomitmen untuk memberikan pengalaman belajar yang dapat diakses oleh semua orang, kapan
                saja, dan di mana saja.</p>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 ScienceLab.</p>
    </footer>
</body>

</html>