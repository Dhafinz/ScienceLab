<?php
session_start();
require '../config/koneksi_sains.php';
$conn = $koneksi;

if (!isset($_SESSION['user'])) {
    echo '<script>alert("Silakan login terlebih dahulu."); location.href="/UKLSains/login/login.php";</script>';
    exit;
}

$project_id = $_GET['project_id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user']['id'];
    $project_id = $_POST['project_id'];

    // Upload file tugas
    if ($_FILES['tugas']['error'] === UPLOAD_ERR_OK) {
        $tmp = $_FILES['tugas']['tmp_name'];
        $name = basename($_FILES['tugas']['name']);
        $destination = "../uploads/tugas/$name";
        move_uploaded_file($tmp, $destination);

        // Simpan ke database
        $stmt = $conn->prepare("INSERT INTO submissions (project_id, user_id, file_path) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $project_id, $user_id, $destination);
        $stmt->execute();

        echo '<script>alert("Tugas berhasil dikumpulkan!"); location.href="proyek.php";</script>';
        exit;
    } else {
        $error = "Gagal mengupload file.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Submit Tugas</title>
</head>
<body>
    <h2>Kumpulkan Tugas</h2>
    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="project_id" value="<?= htmlspecialchars($project_id); ?>">

        <label for="tugas">Upload File Tugas:</label>
        <input type="file" name="tugas" required>

        <button type="submit">Kumpulkan</button>
    </form>
</body>
</html>
