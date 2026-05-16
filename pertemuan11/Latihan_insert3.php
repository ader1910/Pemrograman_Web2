<?php
$con = mysqli_connect("localhost","root","");
if (!$con)
{
die('Could not connect: ' . mysqli_error());
}
mysqli_select_db("lat_dbase", $con);
$sql="INSERT INTO tbl_mhs (FirstName, LastName, Age)
VALUES
('$_POST[firstname]','$_POST[lastname]','$_POST[age]')";
if (!mysqli_query($sql,$con))
{
die('Error: ' . mysqli_error());
}
echo "1 record added";
mysqli_close($con)
?>