<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');        // Ganti sesuai user MySQL 
define('DB_PASS', '');            // Ganti sesuai password MySQL 
define('DB_NAME', 'db_mahasiswa');
define('DB_CHARSET', 'utf8mb4');

function getConnection(): mysqli {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        die(json_encode([
            'status' => 'error',
            'message' => 'Koneksi database gagal: ' . $conn->connect_error
        ]));
    }

    $conn->set_charset(DB_CHARSET);
    return $conn;
}
