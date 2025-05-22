<?php
session_start();
require '../config/koneksi_sains.php';
$conn = $koneksi;

// Cek login
if (!isset($_SESSION['user'])) {
    echo '<script>alert("Silakan login terlebih dahulu"); location.href="/UKLSains/login/login.php";</script>';
    exit;
}

// Ambil data proyek berdasarkan kategori
$query_penemuan = "SELECT * FROM projects WHERE category='penemuan' ORDER BY created_at DESC";
$query_siswa = "SELECT * FROM projects WHERE category='siswa' ORDER BY created_at DESC";

$result_penemuan = mysqli_query($conn, $query_penemuan);
$result_siswa = mysqli_query($conn, $query_siswa);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ScienceLab - Proyek</title>
    <link rel="stylesheet" href="../css/layout.css">
    <link rel="stylesheet" href="../css/proyek.css"> <!-- Tambahan CSS khusus proyek -->
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

    <main class="proyek-container">
        <section class="intro-section">
            <h2>Proyek ScienceLab</h2>
            <p>ScienceLab menampilkan inovasi terbaru dan proyek siswa yang kreatif untuk memperluas wawasan dalam sains
                dan teknologi.</p>
        </section>

        <section class="proyek-section">
            <h3>Penemuan Terbaru</h3>
            <div class="proyek-grid">
                <?php while ($row = mysqli_fetch_assoc($result_penemuan)): ?>
                    <div class="proyek-card">
                        <h4><?= htmlspecialchars($row['title']); ?></h4>
                        <p><?= htmlspecialchars($row['description']); ?></p>
                        <small>Ditambahkan oleh: <?= htmlspecialchars($row['uploaded_by']); ?></small>
                    </div>
                <?php endwhile; ?>
            </div>
        </section>

        <section class="proyek-section">
            <h3>Proyek Siswa</h3>
            <?php while ($row = mysqli_fetch_assoc($result_siswa)): ?>
                <div class="proyek-card">
                    <h4><?= htmlspecialchars($row['title']); ?></h4>
                    <p><?= htmlspecialchars($row['description']); ?></p>
                    <small>Ditambahkan oleh: <?= htmlspecialchars($row['uploaded_by']); ?></small>

                    <!-- Tombol Submit tugas -->
                    <form action="submit_tugas.php" method="get">
                        <input type="hidden" name="project_id" value="<?= $row['id']; ?>">
                        <button type="submit" class="submit-btn">Submit Tugas</button>
                    </form>
                </div>
            <?php endwhile; ?>
            </div>
        </section>


        <footer>
            <p>&copy; 2025 ScienceLab.</p>
        </footer>
</body>

</html>