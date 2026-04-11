<?php
$brush_price = 5;
$counter = 10;

echo "<h3>Latihan 1</h3>";
echo "<table border='1' cellpadding='5'>";
echo "<tr><th>Quantity</th><th>Price</th></tr>";

while ($counter <= 100) {
    echo "<tr>";
    echo "<td>$counter</td>";
    echo "<td>" . ($brush_price * $counter) . "</td>";
    echo "</tr>";
    $counter += 10;
}

echo "</table><br>";
//Project 4.1 ADE RAHMAN - 221011450370
?>