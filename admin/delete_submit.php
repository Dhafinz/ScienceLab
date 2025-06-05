<?php
session_start();
require '../config/koneksi_sains.php';

// Cek apakah user login dan berperan sebagai admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    echo '<script>alert("Silakan login sebagai admin terlebih dahulu."); location.href="/UKLSains/login/login.php";</script>';
    exit;
}

// Pastikan ada ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo '<script>alert("ID tidak valid."); location.href="manage_submit.php";</script>';
    exit;
}

$id = $_GET['id'];

// Ambil file_path sebelum menghapus, untuk menghapus file fisik
$query = "SELECT file_path FROM submissions WHERE id = ?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

if ($data) {
    $file_path = '../' . $data['file_path']; // Pastikan path relatif

    // Hapus data dari database
    $delete = "DELETE FROM submissions WHERE id = ?";
    $stmt = mysqli_prepare($koneksi, $delete);
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        // Hapus file fisik jika ada
        if (file_exists($file_path)) {
            unlink($file_path);
        }
        echo '<script>alert("Tugas berhasil dihapus."); location.href="manage_submit.php";</script>';
    } else {
        echo '<script>alert("Gagal menghapus tugas: ' . mysqli_error($koneksi) . '"); location.href="manage_submit.php";</script>';
    }
} else {
    echo '<script>alert("Tugas tidak ditemukan."); location.href="manage_submit.php";</script>';
}
?>
