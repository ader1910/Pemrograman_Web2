<?php
$link = mysqli_connect("localhost", "root", "");

if (!$link) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$dbname = "lat_dbase";
$cek = mysqli_query($link, "CREATE DATABASE $dbname") or die("Couldn't Create Database: $dbname");

if ($cek) {
    echo "Database $dbname berhasil dibuat";
}
?>