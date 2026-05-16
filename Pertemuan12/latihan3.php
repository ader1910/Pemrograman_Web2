<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "lat_dbase";

$connection = mysqli_connect($dbhost, $dbuser, $dbpass);
if (!$connection) {
    echo "Tidak dapat terhubung dengan database: " . mysqli_connect_error();
    exit;
}

$pilih_db = mysqli_select_db($connection, $dbname);
if (!$pilih_db) {
    echo "Tidak dapat memilih database";
    exit;
}

echo "Koneksi database pada latihan 3 berhasil berjalan! ✅";
?>
