<?php

include "Koneksi.PHP";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: Latihan2.php");
    exit;
}

$id = (int) $_GET['id'];

// Ambil nama dulu untuk konfirmasi
$res  = mysqli_query($koneksi, "SELECT nama FROM buku_tamu WHERE id = $id");
$data = mysqli_fetch_assoc($res);

if (!$data) {
    header("Location: Latihan2.php?hapus=ok");
    exit;
}

// Eksekusi hapus
$del = mysqli_query($koneksi, "DELETE FROM buku_tamu WHERE id = $id");
mysqli_close($koneksi);

if ($del) {
    header("Location: Latihan2.php?hapus=ok");
} else {
    header("Location: Latihan2.php?hapus=gagal");
}
exit;
?>
