<?php
session_start();
require '../config/koneksi_sains.php';
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
