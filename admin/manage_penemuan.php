<?php
session_start();
require '../config/koneksi_sains.php';
$conn = $koneksi;

// Cek apakah user login dan berperan sebagai admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    echo '<script>alert("Silakan login sebagai admin terlebih dahulu."); location.href="/UKLSains/login/login.php";</script>';
    exit;
}


// Ambil data penemuan dari database
$query = "SELECT p.id, p.title, p.description, p.youtube_link, u.nama AS nama_lengkap, p.created_at 
          FROM penemuan p
          LEFT JOIN tb_user u ON p.uploaded_by = u.id_user
          ORDER BY p.created_at DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Penemuan - Admin</title>
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
        <h1>Kelola Penemuan</h1>

        <div class="action-buttons">
            <a href="tambah_penemuan.php" class="add-contact-btn">+ Tambah Penemuan</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Video</th>
                    <th>Ditambahkan Oleh</th>
                    <th>Waktu</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['title']); ?></td>
                    <td><?= htmlspecialchars($row['description']); ?></td>
                    <td>
                        <?php if (!empty($row['youtube_link'])): ?>
                            <a href="<?= htmlspecialchars($row['youtube_link']); ?>" target="_blank">Tonton</a>
                        <?php else: ?>
                            Tidak ada
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($row['nama_lengkap'] ?? 'Admin'); ?></td>
                    <td><?= $row['created_at']; ?></td>
                    <td>
                        <a class="action-link" href="edit_penemuan.php?id=<?= $row['id']; ?>">Edit</a>
                        <a class="action-link" href="delete_penemuan.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
