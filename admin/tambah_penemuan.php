<?php
session_start();
require '../config/koneksi_sains.php';

// Cek apakah user login dan berperan sebagai admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    echo '<script>alert("Silakan login sebagai admin terlebih dahulu."); location.href="/UKLSains/login/login.php";</script>';
    exit;
}

// Ambil data guru/admin dari tb_user untuk select option
$users_query = "SELECT id_user, nama FROM tb_user WHERE role IN ('guru', 'admin') ORDER BY nama ASC";
$users_result = mysqli_query($koneksi, $users_query);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $youtube_link = $_POST['youtube_link'] ?? '';  // jika ada field youtube_link
    $uploaded_by = $_POST['uploaded_by'];

    $query = "INSERT INTO penemuan (title, description, youtube_link, uploaded_by) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "sssi", $title, $description, $youtube_link, $uploaded_by);

    if (mysqli_stmt_execute($stmt)) {
        echo '<script>alert("Penemuan berhasil ditambahkan."); location.href="manage_penemuan.php";</script>';
        exit;
    } else {
        echo '<script>alert("Gagal menambahkan penemuan: ' . mysqli_error($koneksi) . '");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Penemuan</title>
    <link rel="stylesheet" href="../css/layout_admin.css">
</head>
<body>
    <div class="container">
        <h1>Tambah Penemuan</h1>
        <form method="POST">
            <label>Judul:</label><br>
            <input type="text" name="title" required><br><br>

            <label>Deskripsi:</label><br>
            <textarea name="description" required></textarea><br><br>

            <label>Link YouTube (opsional):</label><br>
            <input type="text" name="youtube_link"><br><br>

            <label>Nama Pengunggah (Guru/Admin):</label><br>
            <select name="uploaded_by" required>
                <option value="">-- Pilih Guru/Admin --</option>
                <?php while ($user = mysqli_fetch_assoc($users_result)): ?>
                    <option value="<?= $user['id_user'] ?>"><?= htmlspecialchars($user['nama']) ?></option>
                <?php endwhile; ?>
            </select><br><br>

            <button type="submit" class="action-link">Simpan</button>
        </form>
    </div>
</body>
</html>
