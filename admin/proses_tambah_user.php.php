<?php
require '../config/koneksi_sains.php'; // Gunakan file koneksi yang sudah ada

// Ambil data dari form
$title = $_POST['title'];
$description = $_POST['description'];
$category = $_POST['category'];
$user = $_SESSION['user']; // Ambil user dari session

// Query untuk memasukkan data
$query = "INSERT INTO projects (title, description, category, uploaded_by)
          VALUES ('$title', '$description', '$category', '$user')";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "Proyek berhasil ditambahkan!";
} else {
    echo "Gagal menambahkan proyek: " . mysqli_error($koneksi);
}

// Tutup koneksi
mysqli_close($koneksi);
?>
