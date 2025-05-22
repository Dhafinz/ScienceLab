<?php
session_start();
require '../config/koneksi_sains.php';
$conn = $koneksi;

// Cek login dan role admin/guru
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    echo '<script>alert("Akses ditolak."); location.href="/UKLSains/login/login.php";</script>';
    exit;
}

// Ambil data proyek siswa
$query = "SELECT * FROM projects WHERE category = 'siswa' ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin - Kelola Proyek Siswa</title>
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
                <li><a href="manage_project.php">Manage project</a></li>
                <li><a href="../sains/logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <h1>Kelola Proyek Siswa</h1>
        <div class="action-buttons">
            <a href="tambah_project.php" class="action-link">+ Tambah Proyek</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Ditambahkan oleh</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['title']) ?></td>
                        <td><?= htmlspecialchars($row['description']) ?></td>
                        <td><?= htmlspecialchars($row['uploaded_by']) ?></td>
                        <td>
                            <a href="edit_project.php?id=<?= $row['id'] ?>" class="action-link">Edit</a>
                            <a href="delete_project.php?id=<?= $row['id'] ?>" class="action-link" onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
