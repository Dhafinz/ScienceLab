<?php
session_start();
require '../config/koneksi_sains.php';
$conn = $koneksi;

// Cek apakah user login dan berperan sebagai admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    echo '<script>alert("Silakan login sebagai admin terlebih dahulu."); location.href="/UKLSains/login/login.php";</script>';
    exit;
}

// Ambil ID proyek dari URL
$id = $_GET['id'];

// Ambil data proyek
$query = "SELECT * FROM projects WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$project = mysqli_fetch_assoc($result);

// Ambil semua guru/admin dari tb_user
$users_query = "SELECT id_user, nama FROM tb_user WHERE role IN ('guru', 'admin')";
$users_result = mysqli_query($conn, $users_query);

// Proses update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $uploaded_by = $_POST['uploaded_by'];

    $update = "UPDATE projects SET title=?, description=?, uploaded_by=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $update);
    mysqli_stmt_bind_param($stmt, "sssi", $title, $description, $uploaded_by, $id);

    if (mysqli_stmt_execute($stmt)) {
        echo '<script>alert("Proyek berhasil diperbarui."); location.href="manage_project.php";</script>';
    } else {
        echo '<script>alert("Gagal memperbarui proyek: ' . mysqli_error($conn) . '");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Proyek</title>
    <link rel="stylesheet" href="../css/layout_admin.css">
</head>
<body>
    <nav>...</nav>

    <div class="container">
        <h1>Edit Proyek Siswa</h1>
        <form method="POST">
            <label>Judul:</label><br>
            <input type="text" name="title" value="<?= htmlspecialchars($project['title']) ?>" required><br><br>

            <label>Deskripsi:</label><br>
            <textarea name="description" required><?= htmlspecialchars($project['description']) ?></textarea><br><br>

            <label>Ditambahkan Oleh (Guru/Admin):</label><br>
            <select name="uploaded_by" required>
                <?php while ($user = mysqli_fetch_assoc($users_result)): ?>
                    <option value="<?= $user['id_user'] ?>" <?= $user['id_user'] == $project['uploaded_by'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($user['nama']) ?>
                    </option>
                <?php endwhile; ?>
            </select><br><br>

            <button type="submit" class="action-link">Update</button>
        </form>
    </div>
</body>
</html>
