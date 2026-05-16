<?php

include "Koneksi.PHP";

// Validasi ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: Latihan2.php");
    exit;
}

$id = (int) $_GET['id'];

// Ambil data lama
$res = mysqli_query($koneksi, "SELECT * FROM buku_tamu WHERE id = $id");
if (!$res || mysqli_num_rows($res) == 0) {
    die("<div style='font-family:sans-serif;padding:30px;color:red'>Data tidak ditemukan. <a href='Latihan2.php'>Kembali</a></div>");
}
$data = mysqli_fetch_assoc($res);

$pesan_alert = "";
$status      = "";

// Proses update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama    = mysqli_real_escape_string($koneksi, trim($_POST['nama']));
    $email   = mysqli_real_escape_string($koneksi, trim($_POST['email']));
    $telepon = mysqli_real_escape_string($koneksi, trim($_POST['telepon']));
    $asal    = mysqli_real_escape_string($koneksi, trim($_POST['asal']));
    $kelamin = mysqli_real_escape_string($koneksi, trim($_POST['kelamin']));
    $rating  = (int) $_POST['rating'];
    $pesan   = mysqli_real_escape_string($koneksi, trim($_POST['pesan']));

    if (empty($nama) || empty($email) || empty($pesan)) {
        $pesan_alert = "Nama, Email, dan Pesan wajib diisi!";
        $status      = "error";
    } else {
        $sql = "UPDATE buku_tamu SET
                    nama='$nama', email='$email', telepon='$telepon',
                    asal='$asal', jenis_kelamin='$kelamin',
                    rating='$rating', pesan='$pesan'
                WHERE id=$id";

        if (mysqli_query($koneksi, $sql)) {
            // Refresh data
            $res  = mysqli_query($koneksi, "SELECT * FROM buku_tamu WHERE id = $id");
            $data = mysqli_fetch_assoc($res);
            $pesan_alert = "Data berhasil diperbarui!";
            $status      = "success";
        } else {
            $pesan_alert = "Gagal update. Error: " . mysqli_error($koneksi);
            $status      = "error";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Data Buku Tamu</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
body{background:#FAF6EF;min-height:100vh;display:flex;align-items:center;justify-content:center;font-family:'Lato',sans-serif;padding:40px 16px}
.card{background:#fff;border-radius:6px;width:100%;max-width:580px;box-shadow:0 8px 40px rgba(59,42,26,.12);border-top:4px solid #2980b9;overflow:hidden}
.hd{background:linear-gradient(135deg,#1a4a7a,#2980b9);padding:28px 40px 22px;text-align:center}
.hd span{font-size:2rem;display:block;margin-bottom:8px}
.hd h1{font-family:'Playfair Display',serif;color:#fff;font-size:1.6rem}
.hd p{color:#aed6f1;font-size:.78rem;margin-top:5px;letter-spacing:.07em;text-transform:uppercase}
.bd{padding:30px 40px 34px}
.alert{padding:12px 16px;border-radius:4px;font-size:.875rem;margin-bottom:20px;border-left:3px solid}
.alert.success{background:#f0faf4;color:#276749;border-color:#38a169}
.alert.error{background:#fff5f5;color:#c53030;border-color:#e53e3e}
.fg{margin-bottom:16px}
label{display:block;font-size:.72rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:#1a4a7a;margin-bottom:6px}
label .req{color:#2980b9}
input,select,textarea{width:100%;padding:10px 13px;border:1.5px solid rgba(59,42,26,.15);border-radius:4px;background:#FAF6EF;font-family:'Lato',sans-serif;font-size:.9rem;color:#3B2A1A;outline:none;transition:border-color .2s,background .2s}
input:focus,select:focus,textarea:focus{border-color:#2980b9;background:#fff;box-shadow:0 0 0 3px rgba(41,128,185,.1)}
textarea{resize:vertical;min-height:100px;line-height:1.6}
select{appearance:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%232980b9' stroke-width='2' fill='none'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 13px center;background-color:#FAF6EF}
.row2{display:grid;grid-template-columns:1fr 1fr;gap:14px}
.stars{display:flex;gap:5px}
.stars input{display:none}
.stars label{font-size:1.5rem;cursor:pointer;color:#ddd;text-transform:none;letter-spacing:0;font-weight:400;padding:0;transition:color .15s}
.stars input:checked ~ label,.stars label:hover,.stars label:hover ~ label{color:#f39c12}
hr.dv{border:none;border-top:1px dashed rgba(59,42,26,.15);margin:18px 0}
.btn-row{display:flex;gap:10px;margin-top:22px}
.btn-update{flex:1;padding:12px;border:none;border-radius:4px;background:linear-gradient(135deg,#1a4a7a,#2980b9);color:#fff;font-family:'Lato',sans-serif;font-size:.85rem;font-weight:700;letter-spacing:.07em;text-transform:uppercase;cursor:pointer;transition:opacity .2s}
.btn-update:hover{opacity:.88}
.btn-batal{flex:1;padding:12px;border:1.5px solid #3B2A1A;border-radius:4px;background:transparent;color:#3B2A1A;font-family:'Lato',sans-serif;font-size:.85rem;font-weight:700;letter-spacing:.07em;text-transform:uppercase;cursor:pointer;text-align:center;text-decoration:none;display:flex;align-items:center;justify-content:center;gap:6px;transition:background .2s}
.btn-batal:hover{background:#3B2A1A;color:#fff}
@media(max-width:480px){.bd{padding:24px}.row2{grid-template-columns:1fr}.btn-row{flex-direction:column}}
</style>
</head>
<body>
<div class="card">
  <div class="hd">
    <span>✏️</span>
    <h1>Edit Data Tamu</h1>
    <p>Perbarui data buku tamu</p>
  </div>
  <div class="bd">

    <?php if (!empty($pesan_alert)): ?>
    <div class="alert <?= $status ?>">
      <?= $status === 'success' ? '✅' : '⚠️' ?> <?= $pesan_alert ?>
    </div>
    <?php endif; ?>

    <form method="POST" action="Latihan3.php?id=<?= $id ?>">

      <div class="fg">
        <label>Nama Lengkap <span class="req">*</span></label>
        <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required>
      </div>

      <div class="row2">
        <div class="fg">
          <label>Email <span class="req">*</span></label>
          <input type="email" name="email" value="<?= htmlspecialchars($data['email']) ?>" required>
        </div>
        <div class="fg">
          <label>No. Telepon</label>
          <input type="tel" name="telepon" value="<?= htmlspecialchars($data['telepon']) ?>">
        </div>
      </div>

      <div class="row2">
        <div class="fg">
          <label>Asal Kota</label>
          <input type="text" name="asal" value="<?= htmlspecialchars($data['asal']) ?>">
        </div>
        <div class="fg">
          <label>Jenis Kelamin</label>
          <select name="kelamin">
            <option value="">— Pilih —</option>
            <option value="Laki-laki"  <?= $data['jenis_kelamin']=='Laki-laki'  ? 'selected':'' ?>>Laki-laki</option>
            <option value="Perempuan"  <?= $data['jenis_kelamin']=='Perempuan'  ? 'selected':'' ?>>Perempuan</option>
          </select>
        </div>
      </div>

      <hr class="dv">

      <div class="fg">
        <label>Penilaian Kunjungan</label>
        <div class="stars">
          <?php for ($i = 5; $i >= 1; $i--): ?>
          <input type="radio" id="s<?= $i ?>" name="rating" value="<?= $i ?>"
                 <?= $data['rating'] == $i ? 'checked' : '' ?>>
          <label for="s<?= $i ?>">&#9733;</label>
          <?php endfor; ?>
        </div>
      </div>

      <div class="fg">
        <label>Pesan / Komentar <span class="req">*</span></label>
        <textarea name="pesan" required><?= htmlspecialchars($data['pesan']) ?></textarea>
      </div>

      <div class="btn-row">
        <button type="submit" class="btn-update">💾 Simpan Perubahan</button>
        <a href="Latihan2.php" class="btn-batal">↩️ Batal</a>
      </div>

    </form>
  </div>
</div>
<?php mysqli_close($koneksi); ?>
</body>
</html>
