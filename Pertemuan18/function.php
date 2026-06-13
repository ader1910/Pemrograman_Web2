<?php
// FILE FUNCTION TERPISAH
// Fatal error: Call to undefined function
// Solusi: pisahkan function ke file ini, lalu include di script utama

function jumlah($a, $b)
{
    return $a + $b;
}
?>
