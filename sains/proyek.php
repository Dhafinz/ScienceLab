<?php
session_start();
require '../config/koneksi_sains.php';
$conn = $koneksi;

// Cek login
if (!isset($_SESSION['user'])) {
    echo '<script>alert("Silakan login terlebih dahulu"); location.href="/UKLSains/login/login.php";</script>';
    exit;
}

// Ambil data penemuan dari tabel penemuan
$query_penemuan = "SELECT penemuan.*, tb_user.nama AS nama_lengkap FROM penemuan 
                   LEFT JOIN tb_user ON penemuan.uploaded_by = tb_user.id_user
                   ORDER BY created_at DESC";

// Ambil proyek siswa dan join untuk ambil nama pengunggah
$query_siswa = "SELECT projects.*, tb_user.nama AS nama_pengunggah 
                FROM projects 
                LEFT JOIN tb_user ON projects.uploaded_by = tb_user.id_user 
                WHERE projects.category='siswa' 
                ORDER BY projects.created_at DESC";

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
            <div class="video-grid">
                <?php while ($row = mysqli_fetch_assoc($result_penemuan)): ?>
                    <div class="video-card">
                        <?php if (!empty($row['youtube_link'])): ?>
                            <?php
                            // Konversi link YouTube ke format embed
                            $youtube_url = $row['youtube_link'];
                            $embed_url = '';

                            if (preg_match('/youtu\.be\/([^\?&]+)/', $youtube_url, $matches)) {
                                $embed_url = 'https://www.youtube.com/embed/' . $matches[1];
                            } elseif (preg_match('/youtube\.com\/watch\?v=([^\?&]+)/', $youtube_url, $matches)) {
                                $embed_url = 'https://www.youtube.com/embed/' . $matches[1];
                            } elseif (preg_match('/youtube\.com\/embed\/([^\?&]+)/', $youtube_url, $matches)) {
                                $embed_url = $youtube_url;
                            }
                            ?>
                            <iframe width="100%" height="200" src="<?= htmlspecialchars($embed_url); ?>" frameborder="0" allowfullscreen></iframe>
                        <?php else: ?>
                            <div class="no-video">Belum ada video</div>
                        <?php endif; ?>
                        <h4><?= htmlspecialchars($row['title']); ?></h4>
                        <p><?= htmlspecialchars($row['description']); ?></p>
                        <small>Ditambahkan oleh: <?= htmlspecialchars($row['nama_lengkap']); ?></small>
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
                    <small>Ditambahkan oleh: <?= htmlspecialchars($row['nama_pengunggah']); ?></small>

                    <!-- Tombol Submit tugas -->
                    <form action="submit_tugas.php" method="get">
                        <input type="hidden" name="project_id" value="<?= $row['id']; ?>">
                        <button type="submit" class="submit-btn">Submit Tugas</button>
                    </form>
                </div>
            <?php endwhile; ?>
        </section>

        <footer>
            <p>&copy; 2025 ScienceLab.</p>
        </footer>
</body>

</html>
