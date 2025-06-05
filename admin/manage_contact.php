<?php
session_start();
require '../config/koneksi_sains.php';

// Cek apakah user login dan berperan sebagai admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    echo '<script>alert("Silakan login sebagai admin terlebih dahulu."); location.href="/UKLSains/login/login.php";</script>';
    exit;
}


// Ambil semua pesan
$query = "SELECT * FROM contacts ORDER BY tanggal DESC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kelola Pesan - ScienceLab</title>
    <link rel="stylesheet" href="../css/layout_admin.css">
</head>

<body>
    <header>
        <nav>
            <ul class="nav-links">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="../sains/home.php">Home</a></li>
                <li><a href="manage_user.php">Manage User</a></li>
                <li><a href="manage_contact.php">Manage Contact</a></li>
                <li><a href="manage_project.php">Manage Project</a></li>
                <li><a href="manage_penemuan.php">Manage Penemuan</a></li>
                <li><a href="manage_submit.php">Manage Submit</a></li>
                <li><a href="../sains/logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
        <h2>Daftar Pesan Masuk</h2>
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Subjek</th>
                    <th>Pesan</th>
                    <th>Dikirim pada</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['nama']); ?></td>
                        <td><?= htmlspecialchars($row['email']); ?></td>
                        <td><?= htmlspecialchars($row['subjek']); ?></td>
                        <td><?= htmlspecialchars($row['pesan']); ?></td>
                        <td><?= htmlspecialchars($row['tanggal']); ?></td>
                        <td><a href="hapus_contact.php?id=<?= $row['id']; ?>"
                                onclick="return confirm('Yakin hapus pesan ini?')">Hapus</a></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>

</body>

</html>