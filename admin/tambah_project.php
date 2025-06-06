<?php
session_start();
require '../config/koneksi_sains.php';
$conn = $koneksi;

// Cek apakah user login dan berperan sebagai admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    echo '<script>alert("Silakan login sebagai admin terlebih dahulu."); location.href="/UKLSains/login/login.php";</script>';
    exit;
}

// Ambil data guru/admin dari tb_user untuk select option
$users_query = "SELECT id_user, nama FROM tb_user WHERE role IN ('guru', 'admin') ORDER BY nama ASC";
$users_result = mysqli_query($conn, $users_query);

// Handle saat form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $uploaded_by = $_POST['uploaded_by'];

    $query = "INSERT INTO projects (title, description, uploaded_by, category, created_at) VALUES (?, ?, ?, 'siswa', NOW())";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssi", $title, $description, $uploaded_by);

    if (mysqli_stmt_execute($stmt)) {
        echo '<script>alert("Proyek berhasil ditambahkan."); location.href="manage_project.php";</script>';
    } else {
        echo '<script>alert("Gagal menambahkan proyek: ' . mysqli_error($conn) . '");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Proyek Siswa</title>
    <link rel="stylesheet" href="../css/layout_admin.css">
</head>
<body>
    <nav>...</nav> <!-- Ganti sesuai navigasi admin kamu -->

    <div class="container">
        <h1>Tambah Proyek Siswa</h1>
        <form method="POST">
            <label>Judul:</label><br>
            <input type="text" name="title" required><br><br>

            <label>Deskripsi:</label><br>
            <textarea name="description" required></textarea><br><br>

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
