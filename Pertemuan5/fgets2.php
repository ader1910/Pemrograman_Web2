<?php
$file = fopen("test1.txt","r");
while(! feof($file))
{
echo fgets($file). "<br />";
}
fclose($file);
?>

// ADE RAHMAN - 221011450370