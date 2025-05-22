<?php
session_start();
require '../config/koneksi_sains.php';
$conn = $koneksi;

$id = $_GET['id'];
$query = "SELECT * FROM projects WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$project = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];

    $update = "UPDATE projects SET title=?, description=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $update);
    mysqli_stmt_bind_param($stmt, "ssi", $title, $description, $id);
    mysqli_stmt_execute($stmt);

    header("Location: manage_project.php");
    exit;
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
            <button type="submit" class="action-link">Update</button>
        </form>
    </div>
</body>
</html>
