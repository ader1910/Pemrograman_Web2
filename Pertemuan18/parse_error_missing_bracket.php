<?php
// CONTOH SALAH - Parse error: parse error, unexpected $end
// Penyebab: kurang tanda penutup kurung kurawal }

// if ($a > 1)
// {
//     echo "Nilai A lebih dari 1";
// <-- KURANG } di sini

// Solusi: Pastikan setiap { selalu ada pasangan }
$a = 5;
if ($a > 1)
{
    echo "Nilai A lebih dari 1";
}  // <-- Jangan lupa tutup kurung kurawal
?>
