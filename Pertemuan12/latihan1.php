<?php
$servername = 'localhost';

// username and password
$dbusername = 'root';
$dbpassword = '';

$link = mysqli_connect($servername, $dbusername, $dbpassword);

if (!$link) {
    die("Not able to connect to server: " . mysqli_connect_error());
} else {
    echo "ok....koneksi berhasil";
}
?>