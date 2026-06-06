<?php
$conn = mysqli_connect("localhost", "root", "", "db_mahasiswa");

$query = "SELECT * FROM mahasiswa";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

while($data = mysqli_fetch_array($result)){
    echo $data['nama'];
}
?>