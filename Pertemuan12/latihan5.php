<?php
$link = mysqli_connect("localhost", "root", "");

if (!$link) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

mysqli_select_db($link, "lat_dbase");
$hasil = mysqli_query($link, "SELECT * FROM tbl_mhs");
while($data = mysqli_fetch_row($hasil))
{
    echo "$data[0] $data[1] $data[2]<br>";
}
mysqli_close($link);
?>