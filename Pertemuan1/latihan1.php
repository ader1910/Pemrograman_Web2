<?php
$A = 123; // variabel global

function Test() {
    $A = "Test"; // variabel lokal
    echo "Nilai A dalam fungsi = $A <br>";
}

Test();
echo "Nilai A luar fungsi = $A <br>";

//Project ADE RAHMAN - 221011450370
?>