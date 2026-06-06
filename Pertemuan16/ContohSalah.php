<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$conn = mysqli_connect("localhost", "root", "", "db_mahasiswa");

$query = "SELECT * FROM mahasiswas"; // nama tabel salah
$result = mysqli_query($conn, $query);

while($data = mysqli_fetch_array($result)){
    echo $data['nama'];
}
?>