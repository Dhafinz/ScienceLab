<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../sains/home.php");
    exit();
}

include_once('../config/koneksi_sains.php');

$sql = "SELECT id_user, nama, username, email, no_telp, alamat, password, role FROM tb_user";
$result = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Manage User - ScienceLab</title>
    <link rel="stylesheet" href="../css/layout_admin.css">
    <link rel="stylesheet" href="../css/manage_user.css">
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

    <!-- Main container -->
    <div class="container">
        <h2>Data Siswa</h2>

        <!-- Links to add data or return to dashboard -->
        <div class="action-links">
            <a href="tambah_user.php" class="action-link">+ Tambah Data</a>
        </div>

        <?php
        if (mysqli_num_rows($result) > 0) {
            echo '<table class="user-table">';
            echo '<tr>
        <th>No.</th>
        <th>ID User</th>
        <th>Nama</th>
        <th>Username</th>
        <th>Email</th>
        <th>No. Telp</th>
        <th>Alamat</th>
        <th>Password</th>
        <th>Role</th>
        <th>Aksi</th>
        </tr>';

            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $no++ . '</td>';
                echo '<td>' . htmlspecialchars($row['id_user']) . '</td>';
                echo '<td>' . htmlspecialchars($row['nama']) . '</td>';
                echo '<td>' . htmlspecialchars($row['username']) . '</td>';
                echo '<td>' . htmlspecialchars($row['email']) . '</td>';
                echo '<td>' . htmlspecialchars($row['no_telp']) . '</td>';
                echo '<td>' . htmlspecialchars($row['alamat']) . '</td>';
                echo '<td>' . htmlspecialchars($row['password']) . '</td>';
                echo '<td>' . htmlspecialchars($row['role']) . '</td>';
                echo '<td>';
                echo '<a class="action-link" href="edit_user.php?id=' . $row['id_user'] . '">Edit | </a>';
                echo '<a class="action-link" href="delete_user.php?id=' . $row['id_user'] . '" onclick="return confirm(\'Apakah Anda yakin ingin menghapus user ini?\')">Delete</a>';
                echo '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo '<p>Tidak ada data siswa yang ditemukan.</p>';
        }
        ?>
    </div>

</body>

</html>