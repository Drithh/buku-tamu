<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'buku_tamu');

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE " . DB_NAME;
if ($conn->query($sql) === TRUE) {
    $sqlTable = "CREATE TABLE " . DB_NAME . ".data_tamu (
        id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
        nama VARCHAR(50) NOT NULL,
        email VARCHAR(50),
        tanggal DATETIME NOT NULL,
        komentar TEXT NOT NULL,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

    echo "<h2>Database berhasil dibuat</h2><br>";

    if ($conn->query($sqlTable) === TRUE) {
        echo "<h2>Table berhasil dibuat</h2><br>";
        echo '<button><a style="text-decoration: none; color=black" href="index.php">Kembali Ke Halaman Utama</a></button>';
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
