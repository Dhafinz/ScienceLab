<?php
session_start();
include '../config/koneksi_sains.php';

// Cek apakah user login dan berperan sebagai admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    echo '<script>alert("Silakan login sebagai admin terlebih dahulu."); location.href="/UKLSains/login/login.php";</script>';
    exit;
}

$id = $_GET['id'];

$query = "DELETE FROM tb_user WHERE id_user = '$id'";
if (mysqli_query($koneksi, $query)) {
    echo "<script>alert('User berhasil dihapus'); window.location.href='manage_user.php';</script>";
} else {
    echo "Gagal menghapus user: " . mysqli_error($koneksi);
}
?>
