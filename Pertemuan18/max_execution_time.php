<?php
// Fatal error: Maximum execution time of ... seconds exceeded
// Default XAMPP/AppServ = 30 detik

// SOLUSI 1: Atur langsung di dalam script
set_time_limit(9999);  // set waktu maksimum 9999 detik

// SOLUSI 2: Ubah di php.ini
// Cari parameter: max_execution_time = 30
// Ubah menjadi: max_execution_time = 9999
// Lalu restart Apache

// Contoh script yang butuh waktu lama:
echo "Script berjalan...";
// (proses panjang di sini)
echo "Selesai!";
?>
