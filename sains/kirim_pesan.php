<?php
require '../config/koneksi_sains.php';
$conn = $koneksi;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    $query = "INSERT INTO contacts (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";
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
?>