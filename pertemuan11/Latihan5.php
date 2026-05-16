<?php
mysqli_connect("localhost","root","");
// mysqli_select_db("lat_dbase");
$hasil=mysqli_db_query("lat_dbase”,"select * from tbl_mhs");
While($data=mysqli_fetch_row($hasil))
{
echo "$data[0] $data[1] $data[2]<br>";
}
?>