<?php
$host = "localhost";
$user = "Ader Rahmfan";      // Disengaja salah untuk memicu error Access Denied
$password = "123"; // Disengaja salah

// Mencoba menyambungkan ke MySQL database
$koneksi = mysqli_connect($host, $user, $password);

// Memeriksa apakah koneksi gagal
if (!$koneksi) {
    // Jika gagal, tampilkan pesan errornya
    die("Koneksi Gagal: " . mysqli_connect_error());
} else {
    echo "Koneksi Berhasil!";
}
?>