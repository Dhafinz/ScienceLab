<?php
require '../config/koneksi_sains.php';
$conn = $koneksi;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subjek = htmlspecialchars($_POST['subject']);
    $pesan = htmlspecialchars($_POST['message']);

    $query = "INSERT INTO contacts (nama, email, subjek, pesan) VALUES ('$nama', '$email', '$subjek', '$pesan')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo '<script>alert("Pesan berhasil dikirim!"); location.href="contact.php";</script>';
    } else {
        echo '<script>alert("Gagal mengirim pesan."); location.href="contact.php";</script>';
    }
} else {
    header('Location: contact.php');
    exit;
}
