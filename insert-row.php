<?php
require_once "connection.php";

$nama = $_POST['nama'];
$email = $_POST['email'];
$tanggal = $_POST['tanggal'];
$komentar = $_POST['komentar'];
if ($nama && $email && $tanggal) {
    $sql = "INSERT INTO data_tamu (nama, email, tanggal, komentar) VALUES ('$nama', '$email', '$tanggal', '$komentar');";
    if ($conn->query($sql) === true) {
        echo "Data Berhasil Ditambahkan";
        return;
    }
}
echo "Data Gagal Ditambahkan";
