<?php
$link = mysqli_connect("localhost", "root", "");

if (!$link) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
mysqli_select_db($link, "lat_dbase");
$hasil = mysqli_query($link, "SELECT * FROM tbl_mhs");
while($data = mysqli_fetch_array($hasil))
{
    echo $data['FirstName'] . " " . $data['LastName'] . " " . $data['Age'] . "<br>";
}
mysqli_close($link);
?>