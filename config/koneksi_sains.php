<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "science_lab"; // Database untuk proyek ScienceLab

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi database proyek gagal: " . mysqli_connect_error());
}

mysqli_set_charset($koneksi, "utf8");
?>