<?php
// Notice: Undefined index
// CONTOH SALAH: langsung pakai $_GET tanpa cek dulu
// if ($_GET['test'] == 0) { .... }  // <-- Notice: Undefined index: test

// SOLUSI: Cek dulu apakah index ada
if (isset($_GET['test']))
{
    if ($_GET['test'] == 0)
    {
        echo "Nilai test adalah 0";
    }
}
else
{
    echo "Parameter 'test' tidak ditemukan";
}
?>
