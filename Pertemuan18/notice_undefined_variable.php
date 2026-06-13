<?php
// Notice: Undefined variable
// CONTOH SALAH: variabel $a langsung dipakai tanpa didefinisikan
// if ($a > 0) { .... }  // <-- Notice: Undefined variable: a

// SOLUSI: Definisikan variabel terlebih dahulu
$a = 10;
if ($a > 0)
{
    echo "Nilai A lebih dari 0";
}
?>
