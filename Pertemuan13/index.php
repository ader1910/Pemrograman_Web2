<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Form Input Data Mahasiswa</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #fff;
      color: #333;
    }
    .wrapper {
      width: 700px;
      margin: 40px auto;
    }
    h2 {
      text-align: center;
      color: #e6a817;
      font-size: 20px;
      margin-bottom: 30px;
    }
    table { width: 100%; border-collapse: collapse; }
    td { padding: 10px 8px; vertical-align: middle; }
    td:first-child { width: 200px; font-size: 14px; }
    input[type="text"], input[type="tel"], select {
      padding: 6px 8px;
      font-size: 14px;
      border: 1px solid #aaa;
      background: #f9f9f9;
      outline: none;
    }
    input[type="text"]:focus, input[type="tel"]:focus, select:focus {
      border-color: #888;
      background: #fff;
    }
    #nim    { width: 340px; }
    #nama   { width: 500px; }
    #alamat { width: 500px; }
    #notelp { width: 220px; }
    select  { width: 220px; }
    .btn-row { text-align: center; margin-top: 20px; }
    input[type="submit"], input[type="reset"] {
      padding: 5px 20px;
      font-size: 13px;
      margin: 0 4px;
      cursor: pointer;
      border: 1px solid #aaa;
      background: #f0f0f0;
    }
    input[type="submit"]:hover, input[type="reset"]:hover { background: #e0e0e0; }
    .msg { text-align: center; margin-bottom: 16px; font-size: 14px; padding: 8px; }
    .sukses { color: green; background: #efffef; border: 1px solid #b2d8b2; }
    .error  { color: red;   background: #fff0f0; border: 1px solid #f5b8b8; }
  </style>
</head>
<body>
<?php
require_once 'config/database.php';

$msg = $kelas = '';
$nim = $nama = $alamat = $notelp = '';
$jurusan = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
  $nim     = trim($_POST['nim']     ?? '');
  $nama    = trim($_POST['nama']    ?? '');
  $jurusan = (int)($_POST['jurusan'] ?? 0);
  $alamat  = trim($_POST['alamat']  ?? '');
  $notelp  = trim($_POST['notelp']  ?? '');

  if (!$nim || !$nama || !$jurusan || !$alamat || !$notelp) {
    $msg = 'Semua field wajib diisi!'; $kelas = 'error';
  } else {
    $conn = getConnection();
    $cek  = $conn->prepare("SELECT id FROM mahasiswa WHERE nim = ?");
    $cek->bind_param('s', $nim); $cek->execute();
    if ($cek->get_result()->num_rows > 0) {
      $msg = 'NIM sudah terdaftar!'; $kelas = 'error';
    } else {
      $stmt = $conn->prepare("INSERT INTO mahasiswa (nim, nama, id_jurusan, alamat, no_telp) VALUES (?, ?, ?, ?, ?)");
      $stmt->bind_param('ssiss', $nim, $nama, $jurusan, $alamat, $notelp);
      if ($stmt->execute()) {
        $msg = 'Data berhasil disimpan!'; $kelas = 'sukses';
        $nim = $nama = $alamat = $notelp = ''; $jurusan = 0;
      } else {
        $msg = 'Gagal menyimpan data.'; $kelas = 'error';
      }
      $stmt->close();
    }
    $conn->close();
  }
}

$conn2 = getConnection();
$jResult = $conn2->query("SELECT * FROM jurusan ORDER BY nama_jurusan");
$jurusanList = [];
while ($r = $jResult->fetch_assoc()) $jurusanList[] = $r;
$conn2->close();
?>
<div class="wrapper">
  <h2>Form Input Data Mahasiswa</h2>
  <?php if ($msg): ?>
    <div class="msg <?= $kelas ?>"><?= htmlspecialchars($msg) ?></div>
  <?php endif; ?>
  <form method="POST">
    <table>
      <tr>
        <td>ID Mahasiswa / NIM</td>
        <td><input type="text" id="nim" name="nim" value="<?= htmlspecialchars($nim) ?>"></td>
      </tr>
      <tr>
        <td>Nama</td>
        <td><input type="text" id="nama" name="nama" value="<?= htmlspecialchars($nama) ?>"></td>
      </tr>
      <tr>
        <td>Jurusan</td>
        <td>
          <select name="jurusan">
            <option value="">- Pilih Jurusan -</option>
            <?php foreach ($jurusanList as $j): ?>
              <option value="<?= $j['id_jurusan'] ?>" <?= $jurusan == $j['id_jurusan'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($j['nama_jurusan']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </td>
      </tr>
      <tr>
        <td>Alamat</td>
        <td><input type="text" id="alamat" name="alamat" value="<?= htmlspecialchars($alamat) ?>"></td>
      </tr>
      <tr>
        <td>No. Telp</td>
        <td><input type="tel" id="notelp" name="notelp" value="<?= htmlspecialchars($notelp) ?>"></td>
      </tr>
    </table>
    <div class="btn-row">
      <input type="submit" name="submit" value="Submit">
      <input type="reset" value="Cancel">
    </div>
  </form>
</div>
</body>
</html>
