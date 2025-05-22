<?php
include '../config/koneksi_sains.php';
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE id_user = '$id'");
$data = mysqli_fetch_assoc($query);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $no_telp = $_POST['no_telp'];
    $alamat = $_POST['alamat'];
    $role = $_POST['role'];

    $sql = "UPDATE tb_user SET 
        username='$username', 
        nama='$nama', 
        email='$email', 
        no_telp='$no_telp',
        alamat='$alamat',
        role='$role' 
        WHERE id_user='$id'";
    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data berhasil diubah'); window.location.href='manage_user.php';</script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

<h2>Edit User</h2>
<form method="POST">
    Nama: <input type="text" name="nama" value="<?= $data['nama']; ?>" required><br><br>
    Username: <input type="text" name="username" value="<?= $data['username']; ?>" required><br><br>
    Email: <input type="email" name="email" value="<?= $data['email']; ?>" required><br><br>
    No. Telp: <input type="text" name="no_telp" value="<?= $data['no_telp']; ?>" required><br><br>
    Alamat: <textarea name="alamat" required><?= $data['alamat']; ?></textarea><br><br>
    Role:
    <select name="role" required>
        <option value="admin" <?= $data['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
        <option value="user" <?= $data['role'] == 'user' ? 'selected' : ''; ?>>User</option>
    </select><br><br>
    <button type="submit">Simpan</button>
</form>
<br>
<a href="manage_user.php">Kembali</a>