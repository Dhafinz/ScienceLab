<?php
session_start();
require '../config/koneksi_sains.php';

// Cek apakah user login dan berperan sebagai admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    echo '<script>alert("Silakan login sebagai admin terlebih dahulu."); location.href="/UKLSains/login/login.php";</script>';
    exit;
}

$conn = $koneksi;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM projects WHERE id=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
}

header("Location: manage_project.php");
exit;
?>
