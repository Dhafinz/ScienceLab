<?php
session_start();
require '../config/koneksi_sains.php';
$conn = $koneksi;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $uploaded_by = $_SESSION['user']['name'];

    $query = "INSERT INTO projects (title, description, uploaded_by, category, created_at) VALUES (?, ?, ?, 'siswa', NOW())";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sss", $title, $description, $uploaded_by);
    mysqli_stmt_execute($stmt);

    header("Location: manage_project.php");
    exit;
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
    <nav>...</nav> <!-- Sama seperti file sebelumnya -->

    <div class="container">
        <h1>Tambah Proyek Siswa</h1>
        <form method="POST">
            <label>Judul:</label><br>
            <input type="text" name="title" required><br><br>
            <label>Deskripsi:</label><br>
            <textarea name="description" required></textarea><br><br>
            <button type="submit" class="action-link">Simpan</button>
        </form>
    </div>
</body>
</html>
