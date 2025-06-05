<?php
session_start();
require '../config/koneksi_sains.php';

// Cek apakah user login dan berperan sebagai admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    echo '<script>alert("Silakan login sebagai admin terlebih dahulu."); location.href="/UKLSains/login/login.php";</script>';
    exit;
}

$id = $_GET['id'] ?? null;
if (!$id) {
    echo '<script>alert("ID tidak ditemukan."); location.href="manage_penemuan.php";</script>';
    exit;
}

$query = "SELECT * FROM penemuan WHERE id = ?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo '<script>alert("Data tidak ditemukan."); location.href="manage_penemuan.php";</script>';
    exit;
}

// Ambil data guru/admin untuk dropdown uploaded_by
$users_query = "SELECT id_user, nama FROM tb_user WHERE role IN ('guru','admin') ORDER BY nama ASC";
$users_result = mysqli_query($koneksi, $users_query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $youtube_link = $_POST['youtube_link'];
    $uploaded_by = $_POST['uploaded_by'];

    $update = "UPDATE penemuan SET title=?, description=?, youtube_link=?, uploaded_by=? WHERE id=?";
    $stmt = mysqli_prepare($koneksi, $update);
    mysqli_stmt_bind_param($stmt, 'sssii', $title, $description, $youtube_link, $uploaded_by, $id);
    mysqli_stmt_execute($stmt);

    echo '<script>alert("Data berhasil diperbarui."); location.href="manage_penemuan.php";</script>';
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Penemuan</title>
    <link rel="stylesheet" href="../css/layout_admin.css">
</head>
<body>
    <!-- Hapus include sidebar_admin.php kalau file itu tidak ada -->
    <div class="container">
        <h2>Edit Penemuan</h2>
        <form method="POST">
            <label>Judul:</label><br>
            <input type="text" name="title" value="<?= htmlspecialchars($data['title']); ?>" required><br><br>

            <label>Deskripsi:</label><br>
            <textarea name="description" required><?= htmlspecialchars($data['description']); ?></textarea><br><br>

            <label>Link YouTube:</label><br>
            <input type="text" name="youtube_link" value="<?= htmlspecialchars($data['youtube_link']); ?>"><br><br>

            <label>Pengunggah (Guru/Admin):</label><br>
            <select name="uploaded_by" required>
                <option value="">-- Pilih Pengunggah --</option>
                <?php while ($user = mysqli_fetch_assoc($users_result)): ?>
                    <option value="<?= $user['id_user'] ?>" <?= $data['uploaded_by'] == $user['id_user'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($user['nama']) ?>
                    </option>
                <?php endwhile; ?>
            </select><br><br>

            <button type="submit" class="admin-btn">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>
