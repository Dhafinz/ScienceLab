<?php
include '../config/koneksi_sains.php';
$id = $_GET['id'];

$query = "DELETE FROM tb_user WHERE id_user = '$id'";
if (mysqli_query($koneksi, $query)) {
    echo "<script>alert('User berhasil dihapus'); window.location.href='manage_user.php';</script>";
} else {
    echo "Gagal menghapus user: " . mysqli_error($koneksi);
}
?>
