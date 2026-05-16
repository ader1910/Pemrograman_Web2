<?php


$host     = "localhost";
$username = "root";
$password = "";
$database = "db_bukutamu";

// Konek ke MySQL
$koneksi = mysqli_connect($host, $username, $password);

if (!$koneksi) {
    die("<div style='font-family:sans-serif;padding:30px;color:#c0392b;background:#fdf2f2;border-left:4px solid #e74c3c;margin:20px'>
        <strong>Koneksi MySQL Gagal!</strong><br>
        Pastikan XAMPP berjalan dan MySQL sudah <em>Start</em>.<br><br>
        Error: " . mysqli_connect_error() . "
    </div>");
}

mysqli_query($koneksi, "CREATE DATABASE IF NOT EXISTS `$database` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
mysqli_select_db($koneksi, $database);

mysqli_query($koneksi, "
CREATE TABLE IF NOT EXISTS buku_tamu (
    id            INT AUTO_INCREMENT PRIMARY KEY,
    nama          VARCHAR(100) NOT NULL,
    email         VARCHAR(100) NOT NULL,
    telepon       VARCHAR(20)  DEFAULT '',
    asal          VARCHAR(100) DEFAULT '',
    jenis_kelamin VARCHAR(20)  DEFAULT '',
    rating        TINYINT      DEFAULT 5,
    pesan         TEXT         NOT NULL,
    tanggal       DATETIME     DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
");

mysqli_set_charset($koneksi, "utf8mb4");
?>
