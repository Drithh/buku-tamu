<?php
require_once "connection.php";


$id = $_GET['id'];
// proses sql
$sql = "DELETE FROM data_tamu WHERE id='$id'";

// eksekusi perintah
if ($conn->query($sql) === true) {
    echo "Berhasil menghapus data";
} else {
    echo "Gagal menghapus data";
}
