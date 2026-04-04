<?php
echo "<h3>Latihan 4</h3>";

for ($i = 1; $i < 11; $i++) {
    if ($i % 2 == 0) {
        continue;
    }
    echo $i . " ";
}

echo "<br><br>";
?>