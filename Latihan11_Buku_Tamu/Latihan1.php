<?php

$pesan_alert = "";
$status      = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "Koneksi.PHP";

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
        $sql = "INSERT INTO buku_tamu (nama, email, telepon, asal, jenis_kelamin, rating, pesan)
                VALUES ('$nama','$email','$telepon','$asal','$kelamin','$rating','$pesan')";

        if (mysqli_query($koneksi, $sql)) {
            $pesan_alert = "Terima kasih, <strong>$nama</strong>! Pesan Anda berhasil disimpan.";
            $status      = "success";
        } else {
            $pesan_alert = "Gagal menyimpan data. Error: " . mysqli_error($koneksi);
            $status      = "error";
        }
    }
    mysqli_close($koneksi);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Form Buku Tamu</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
body{background:#FAF6EF;min-height:100vh;display:flex;align-items:center;justify-content:center;font-family:'Lato',sans-serif;padding:40px 16px}
.card{background:#fff;border-radius:6px;width:100%;max-width:580px;box-shadow:0 8px 40px rgba(59,42,26,.12);border-top:4px solid #C8953A;overflow:hidden}
.hd{background:linear-gradient(135deg,#3B2A1A,#7A4F2D);padding:32px 40px 26px;text-align:center}
.hd span{font-size:2.2rem;display:block;margin-bottom:8px}
.hd h1{font-family:'Playfair Display',serif;color:#fff;font-size:1.8rem}
.hd p{color:#E8B96A;font-size:.78rem;margin-top:5px;letter-spacing:.07em;text-transform:uppercase}
.bd{padding:32px 40px 36px}
.alert{padding:12px 16px;border-radius:4px;font-size:.875rem;margin-bottom:22px;border-left:3px solid;display:flex;align-items:center;gap:8px}
.alert.success{background:#f0faf4;color:#276749;border-color:#38a169}
.alert.error{background:#fff5f5;color:#c53030;border-color:#e53e3e}
.fg{margin-bottom:18px}
label{display:block;font-size:.72rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:#7A4F2D;margin-bottom:6px}
label .req{color:#C8953A}
input,select,textarea{width:100%;padding:10px 13px;border:1.5px solid rgba(59,42,26,.15);border-radius:4px;background:#FAF6EF;font-family:'Lato',sans-serif;font-size:.9rem;color:#3B2A1A;outline:none;transition:border-color .2s,background .2s}
input:focus,select:focus,textarea:focus{border-color:#C8953A;background:#fff;box-shadow:0 0 0 3px rgba(200,149,58,.1)}
textarea{resize:vertical;min-height:105px;line-height:1.6}
select{appearance:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%23C8953A' stroke-width='2' fill='none'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 13px center;background-color:#FAF6EF;cursor:pointer}
.row2{display:grid;grid-template-columns:1fr 1fr;gap:14px}
.stars{display:flex;gap:5px}
.stars input{display:none}
.stars label{font-size:1.5rem;cursor:pointer;color:#ddd;text-transform:none;letter-spacing:0;font-weight:400;padding:0;transition:color .15s,transform .15s}
.stars input:checked ~ label,.stars label:hover,.stars label:hover ~ label{color:#C8953A}
.stars label:hover{transform:scale(1.15)}
hr.dv{border:none;border-top:1px dashed rgba(59,42,26,.15);margin:20px 0}
.btn-row{display:flex;gap:10px;margin-top:24px}
.btn-primary{flex:1;padding:12px;border:none;border-radius:4px;background:linear-gradient(135deg,#C8953A,#E8B96A);color:#3B2A1A;font-family:'Lato',sans-serif;font-size:.85rem;font-weight:700;letter-spacing:.07em;text-transform:uppercase;cursor:pointer;transition:opacity .2s,transform .1s}
.btn-primary:hover{opacity:.88;transform:translateY(-1px)}
.btn-sec{flex:1;padding:12px;border:1.5px solid #3B2A1A;border-radius:4px;background:transparent;color:#3B2A1A;font-family:'Lato',sans-serif;font-size:.85rem;font-weight:700;letter-spacing:.07em;text-transform:uppercase;cursor:pointer;text-align:center;text-decoration:none;display:flex;align-items:center;justify-content:center;gap:6px;transition:background .2s,color .2s}
.btn-sec:hover{background:#3B2A1A;color:#fff}
.nav{text-align:center;margin-top:18px;font-size:.78rem;color:#999}
.nav a{color:#7A4F2D;text-decoration:none;font-weight:700;margin:0 8px}
.nav a:hover{text-decoration:underline}
@media(max-width:480px){.bd{padding:24px}.row2{grid-template-columns:1fr}.btn-row{flex-direction:column}}
</style>
</head>
<body>
<div class="card">
  <div class="hd">
    <span>📖</span>
    <h1>Buku Tamu</h1>
    <p>Silakan tinggalkan pesan Anda</p>
  </div>
  <div class="bd">

    <?php if (!empty($pesan_alert)): ?>
    <div class="alert <?= $status ?>">
      <?= $status === 'success' ? '✅' : '⚠️' ?> <?= $pesan_alert ?>
    </div>
    <?php endif; ?>

    <form method="POST" action="Latihan1.php">

      <div class="fg">
        <label>Nama Lengkap <span class="req">*</span></label>
        <input type="text" name="nama" placeholder="Masukkan nama lengkap"
               value="<?= ($status=='error' && isset($_POST['nama'])) ? htmlspecialchars($_POST['nama']) : '' ?>" required>
      </div>

      <div class="row2">
        <div class="fg">
          <label>Email <span class="req">*</span></label>
          <input type="email" name="email" placeholder="contoh@email.com"
                 value="<?= ($status=='error' && isset($_POST['email'])) ? htmlspecialchars($_POST['email']) : '' ?>" required>
        </div>
        <div class="fg">
          <label>No. Telepon</label>
          <input type="tel" name="telepon" placeholder="08xxxxxxxxxx"
                 value="<?= ($status=='error' && isset($_POST['telepon'])) ? htmlspecialchars($_POST['telepon']) : '' ?>">
        </div>
      </div>

      <div class="row2">
        <div class="fg">
          <label>Asal Kota</label>
          <input type="text" name="asal" placeholder="Jakarta, Depok, dll."
                 value="<?= ($status=='error' && isset($_POST['asal'])) ? htmlspecialchars($_POST['asal']) : '' ?>">
        </div>
        <div class="fg">
          <label>Jenis Kelamin</label>
          <select name="kelamin">
            <option value="">— Pilih —</option>
            <option value="Laki-laki"  <?= (isset($_POST['kelamin']) && $_POST['kelamin']=='Laki-laki')  ? 'selected':'' ?>>Laki-laki</option>
            <option value="Perempuan"  <?= (isset($_POST['kelamin']) && $_POST['kelamin']=='Perempuan')  ? 'selected':'' ?>>Perempuan</option>
          </select>
        </div>
      </div>

      <hr class="dv">

      <div class="fg">
        <label>Penilaian Kunjungan</label>
        <div class="stars">
          <?php for ($i = 5; $i >= 1; $i--): ?>
          <input type="radio" id="s<?= $i ?>" name="rating" value="<?= $i ?>"
                 <?= (!isset($_POST['rating']) && $i==5) || (isset($_POST['rating']) && $_POST['rating']==$i) ? 'checked' : '' ?>>
          <label for="s<?= $i ?>">&#9733;</label>
          <?php endfor; ?>
        </div>
      </div>

      <div class="fg">
        <label>Pesan / Komentar <span class="req">*</span></label>
        <textarea name="pesan" placeholder="Tuliskan kesan, saran, atau pesan Anda..." required><?= ($status=='error' && isset($_POST['pesan'])) ? htmlspecialchars($_POST['pesan']) : '' ?></textarea>
      </div>

      <div class="btn-row">
        <button type="submit" class="btn-primary">✉️ Kirim Pesan</button>
        <a href="Latihan2.php" class="btn-sec">📋 Lihat Data</a>
      </div>

    </form>

    <div class="nav">
      <a href="Latihan2.php">📋 Data</a> |
      <a href="Latihan5.php">🔍 Cari</a>
    </div>
  </div>
</div>
</body>
</html>
