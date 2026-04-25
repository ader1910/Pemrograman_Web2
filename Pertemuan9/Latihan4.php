<HTML>
<HEAD>
<TITLE> Tanggal & Jam </TITLE>
</HEAD>
<BODY>

<font size="5px">
<?php
// Set timezone ke Indonesia (WIB)
date_default_timezone_set('Asia/Jakarta');

echo "Sekarang tanggal: ";
echo date('d-F-Y');

echo "<br>Jam sekarang: ";
echo date('H:i:s');
?>
</font>

</BODY>
</HTML>