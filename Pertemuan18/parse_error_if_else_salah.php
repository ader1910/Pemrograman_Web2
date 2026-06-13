<?php
// CONTOH SALAH - Parse error: syntax error, unexpected T_ELSE
// Setiap akhir statement tidak ada titik koma (;)
// dan pada bagian else ($a < 0) kurang IF

$a = 5;
// if ($a > 0) $status = "A lebih besar dari 0"     // <-- kurang ;
// else ($a < 0) $status = "A lebih kecil dari 0"   // <-- kurang IF dan ;
// else $status = "A sama dengan 0"                  // <-- kurang ;
?>
