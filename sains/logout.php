<?php
session_start(); // Memulai session
session_destroy(); // Menghapus semua session yang aktif
session_unset(); // Menghapus semua variabel session

// Menampilkan alert dan mengarahkan kembali ke halaman login
echo '<script>alert("Anda berhasil logout."); location.href="/UKLSains/login/login.php";</script>';
exit();
?>