<?php
$con = mysqli_connect("localhost", "root", "");

if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}

mysqli_select_db($con, "lat_dbase");

mysqli_query($con, "DELETE FROM tbl_mhs WHERE LastName='Prabowo'");

mysqli_close($con);

echo "Data berhasil dihapus!";
?>