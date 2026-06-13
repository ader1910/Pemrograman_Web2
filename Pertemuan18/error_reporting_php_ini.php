<?php
// Solusi Notice: Undefined index / Undefined variable
// Cara 1: Atur langsung di dalam script (sementara)
error_reporting(E_ALL & ~E_NOTICE);

// Cara 2: Ubah di php.ini (permanen)
// Cari parameter: error_reporting = ...
// Ubah menjadi: error_reporting = E_ALL & ~E_NOTICE
// Lalu restart Apache

// Setelah diatur, Notice tidak akan muncul lagi
$a = 10;
if ($a > 0)
{
    echo "Berhasil tanpa Notice!";
}
?>
