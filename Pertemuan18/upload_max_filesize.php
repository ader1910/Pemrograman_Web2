<?php
// Kegagalan Upload File - File terlalu besar
// SOLUSI: Ubah di php.ini
// Cari dan ubah parameter berikut:
//   upload_max_filesize = 80M
//   post_max_size = 80M
// Lalu restart Apache

// Contoh form upload file
?>
<!DOCTYPE html>
<html>
<head><title>Upload File</title></head>
<body>
<form action="" method="post" enctype="multipart/form-data">
    <label>Pilih File:</label>
    <input type="file" name="file_upload">
    <br><br>
    <input type="submit" value="Upload">
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file_upload']))
{
    $file = $_FILES['file_upload'];

    if ($file['error'] === UPLOAD_ERR_OK)
    {
        $upload_dir = "uploads/";
        if (!is_dir($upload_dir)) mkdir($upload_dir);

        $destination = $upload_dir . basename($file['name']);
        if (move_uploaded_file($file['tmp_name'], $destination))
        {
            echo "<p>File berhasil diupload: " . htmlspecialchars($file['name']) . "</p>";
        }
        else
        {
            echo "<p>Gagal memindahkan file.</p>";
        }
    }
    else
    {
        echo "<p>Error upload: kode " . $file['error'] . " (kemungkinan file terlalu besar)</p>";
    }
}
?>
</body>
</html>
