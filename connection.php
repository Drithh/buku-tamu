<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = 'buku_tamu';

$conn = new mysqli($servername, $username, $password, $dbname);
// check connection
if ($conn->connect_error) {
    echo ("Connection Failed" . $conn->connect_error);
}
