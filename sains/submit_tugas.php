<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../config/koneksi_sains.php';
$conn = $koneksi;

// Pastikan user sudah login
if (!isset($_SESSION['user']) && !isset($_SESSION['id_user'])) {
    echo '<script>alert("Silakan login terlebih dahulu."); location.href="/UKLSains/login/login.php";</script>';
    exit;
}

// Ambil ID user dari session
$user_id = $_SESSION['user']['id'] ?? $_SESSION['id_user'] ?? null;
$project_id = $_GET['project_id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $project_id = $_POST['project_id'] ?? null;

    if (!$user_id || !$project_id) {
        echo "<script>alert('User atau project tidak valid'); history.back();</script>";
        exit;
    }

    if (isset($_FILES['tugas']) && $_FILES['tugas']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = "../uploads/tugas/";
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $tmp = $_FILES['tugas']['tmp_name'];
        $name = time() . '-' . basename($_FILES['tugas']['name']);
        $destination = $uploadDir . $name;

        if (move_uploaded_file($tmp, $destination)) {
            $file_path = "uploads/tugas/" . $name;
            $submitted_at = date('Y-m-d H:i:s');

            $stmt = $conn->prepare("INSERT INTO submissions (project_id, user_id, file_path, submitted_at) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("iiss", $project_id, $user_id, $file_path, $submitted_at);

            if ($stmt->execute()) {
                echo '<script>alert("Tugas berhasil dikumpulkan!"); location.href="proyek.php";</script>';
                exit;
            } else {
                echo "<p style='color:red;'>Gagal menyimpan ke database: " . htmlspecialchars($stmt->error) . "</p>";
            }
        } else {
            echo "<p style='color:red;'>Gagal memindahkan file ke direktori upload.</p>";
        }
    } else {
        echo "<p style='color:red;'>Upload error: " . $_FILES['tugas']['error'] . "</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Submit Tugas</title>
    <link rel="stylesheet" href="../css/submit_tugas.css">
</head>
<body>
    <h2>Kumpulkan Tugas</h2>

    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="project_id" value="<?= htmlspecialchars($project_id); ?>">

        <label for="tugas">Upload File Tugas:</label>
        <input type="file" name="tugas" required>

        <button type="submit">Kumpulkan</button>
    </form>
</body>
</html>
