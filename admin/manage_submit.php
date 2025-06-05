<?php
session_start();
// Cek apakah user login dan berperan sebagai admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    echo '<script>alert("Silakan login sebagai admin terlebih dahulu."); location.href="/UKLSains/login/login.php";</script>';
    exit;
}


include '../config/koneksi_sains.php';

// Ambil data submissions
$sql = "SELECT s.id, s.file_path, s.submitted_at, u.nama, p.title 
        FROM submissions s
        JOIN tb_user u ON s.user_id = u.id_user
        JOIN projects p ON s.project_id = p.id";
$result = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manage Submit - ScienceLab</title>
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

    <div class="container">
        <h2>Data Submit Tugas</h2>

        <?php if (mysqli_num_rows($result) > 0): ?>
        <table class="user-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Siswa</th>
                    <th>Judul Proyek</th>
                    <th>File</th>
                    <th>Waktu Submit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($row['nama']) ?></td>
                    <td><?= htmlspecialchars($row['title']) ?></td>
                    <td><a href="../<?= $row['file_path'] ?>" target="_blank">Lihat File</a></td>
                    <td><?= $row['submitted_at'] ?></td>
                    <td>
                        <a class="action-link" href="delete_submit.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus tugas ini?')">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <?php else: ?>
            <p>Belum ada tugas yang dikumpulkan.</p>
        <?php endif; ?>
    </div>
</body>
</html>
