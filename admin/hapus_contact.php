<?php
session_start();
require '../config/koneksi_sains.php';

// Cek login
if (!isset($_SESSION['user'])) {
    echo '<script>alert("Silakan login terlebih dahulu"); location.href="/UKLSains/login/login.php";</script>';
    exit;
}

// Hapus data
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "DELETE FROM contacts WHERE id=$id";
    $result = mysqli_query($koneksi, $query);
    if ($result) {
        echo '<script>alert("Pesan berhasil dihapus."); location.href="manage_contact.php";</script>';
    } else {
        echo '<script>alert("Gagal menghapus pesan."); location.href="manage_contact.php";</script>';
    }
} else {
    header('Location: manage_contact.php');
    exit;
}
?>