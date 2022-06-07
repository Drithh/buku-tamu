<?php

define('DB_HOST', 'us-cdbr-east-05.cleardb.net');
define('DB_USER', 'bc0d2641bc9fd0');
define('DB_PASS', '2574b9df');
define('DB_NAME', 'heroku_6af49f79215f3d1');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS);
if ($conn->connect_error) {
    die('Could not connect: ' . $conn->connect_error);
}

// Make my_db the current database
$query = 'SHOW DATABASES LIKE "' . DB_NAME . '"';
if ($conn->query($query)->num_rows === 1) {
    $conn->select_db(DB_NAME);
    $sqlTable = "CREATE TABLE " . DB_NAME . ".data_tamu (
        id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
        nama VARCHAR(50) NOT NULL,
        email VARCHAR(50),
        tanggal DATETIME NOT NULL,
        komentar TEXT NOT NULL,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";


    if ($conn->query($sqlTable) === TRUE) {
        echo "<h2>Table berhasil dibuat</h2><br>";
        echo '<button><a style="text-decoration: none; color=black" href="index.php">Kembali Ke Halaman Utama</a></button>';
    }
    if ($conn->connect_errno) {
        var_dump($conn);
        echo "Gagal Connect ke Database : (" . $conn->connect_errno . ") " . $conn->connect_error;
    }
} else { //Didn't find DB
    die('<h1>ERROR</h1><h2>Database Tidak Ditemukan</h2>
        <p>Buat Database dengan nama <b>' . DB_NAME . '</b> lalu coba lagi.</p>
        <button><a style="text-decoration: none; color=black" href="create-database.php">Create Database</a></button>');
}
