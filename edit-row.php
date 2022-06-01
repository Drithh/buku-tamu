<?php
require_once "connection.php";
$id = $_POST['id'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$tanggal = $_POST['tanggal'];
$komentar = $_POST['komentar'];
if ($nama && $email && $tanggal) {
    $sql = "UPDATE data_tamu SET nama='$nama', email='$email', tanggal='$tanggal', komentar='$komentar' WHERE id='$id';";
    if ($conn->query($sql) === true) {
        echo "Data Berhasil Diubah";
        return;
    }
}
echo "Data Gagal Diubah";
