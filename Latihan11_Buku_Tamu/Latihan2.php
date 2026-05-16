<?php

include "Koneksi.PHP";

$result = mysqli_query($koneksi, "SELECT * FROM buku_tamu ORDER BY tanggal DESC");

if (!$result) {
    die("<div style='font-family:sans-serif;padding:30px;color:red'>
        Query Error: " . mysqli_error($koneksi) . "
    </div>");
}

$total = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Data Buku Tamu</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
body{background:#FAF6EF;font-family:'Lato',sans-serif;color:#3B2A1A;padding:30px 20px 60px}
.wrap{max-width:100%;margin:0 auto}

.page-hd{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:24px;padding-bottom:16px;border-bottom:2px solid rgba(59,42,26,.12)}
.page-title{display:flex;align-items:center;gap:10px;flex-wrap:wrap}
.page-title h1{font-family:'Playfair Display',serif;font-size:1.5rem}
.badge{background:#C8953A;color:#3B2A1A;font-size:.7rem;font-weight:700;padding:3px 10px;border-radius:20px;white-space:nowrap}

.nav-row{display:flex;gap:8px;flex-wrap:wrap}
.nav-btn{display:inline-flex;align-items:center;gap:5px;padding:8px 14px;border-radius:4px;font-family:'Lato',sans-serif;font-size:.78rem;font-weight:700;letter-spacing:.05em;text-transform:uppercase;text-decoration:none;cursor:pointer;transition:all .2s;border:none;white-space:nowrap}
.btn-gold{background:linear-gradient(135deg,#C8953A,#E8B96A);color:#3B2A1A}
.btn-gold:hover{opacity:.85}
.btn-outline{background:transparent;border:1.5px solid #3B2A1A;color:#3B2A1A}
.btn-outline:hover{background:#3B2A1A;color:#fff}

.alert-ok{background:#f0faf4;color:#276749;border:1px solid #38a169;border-radius:4px;padding:11px 16px;margin-bottom:18px;font-size:.875rem}
.alert-err{background:#fff5f5;color:#c53030;border:1px solid #e53e3e;border-radius:4px;padding:11px 16px;margin-bottom:18px;font-size:.875rem}

/* Tabel dengan scroll horizontal di layar kecil */
.tbl-outer{background:#fff;border-radius:6px;box-shadow:0 4px 24px rgba(59,42,26,.1);border:1px solid rgba(59,42,26,.1);overflow-x:auto;-webkit-overflow-scrolling:touch}

table{width:100%;border-collapse:collapse;font-size:.82rem}
thead{background:linear-gradient(135deg,#3B2A1A,#7A4F2D)}
thead th{padding:12px 14px;text-align:left;font-size:.69rem;font-weight:700;letter-spacing:.07em;text-transform:uppercase;color:#E8B96A;white-space:nowrap}
tbody tr{border-bottom:1px solid rgba(59,42,26,.08);transition:background .15s}
tbody tr:last-child{border-bottom:none}
tbody tr:hover{background:#FAF6EF}
td{padding:11px 14px;vertical-align:middle}

td.no{color:#aaa;text-align:center;font-size:.78rem;width:40px}
.td-nama strong{display:block;font-weight:700;white-space:nowrap}
.td-nama small{color:#888;font-size:.74rem}
.td-tel{white-space:nowrap;font-size:.82rem}
.td-asal{white-space:nowrap;font-size:.82rem}

.pill{display:inline-block;font-size:.67rem;font-weight:700;padding:2px 9px;border-radius:20px;white-space:nowrap}
.pill-l{background:#dbeafe;color:#1e40af}
.pill-p{background:#fce7f3;color:#9d174d}
.pill-x{background:#f3f4f6;color:#6b7280}

.stars{white-space:nowrap;font-size:.9rem}
.star-on{color:#C8953A}
.star-off{color:#ddd}

.td-pesan{font-size:.80rem;color:#555;line-height:1.45;max-width:200px;word-break:break-word}
.td-tgl{white-space:nowrap;font-size:.75rem;color:#888;line-height:1.6}

.aksi-row{display:flex;gap:6px;align-items:center;white-space:nowrap}
.btn-edit{font-size:.71rem;padding:5px 10px;border:1px solid #2980b9;border-radius:3px;color:#2980b9;background:transparent;cursor:pointer;text-decoration:none;transition:all .15s;white-space:nowrap}
.btn-edit:hover{background:#2980b9;color:#fff}
.btn-del{font-size:.71rem;padding:5px 10px;border:1px solid #e53e3e;border-radius:3px;color:#e53e3e;background:transparent;cursor:pointer;text-decoration:none;transition:all .15s;white-space:nowrap}
.btn-del:hover{background:#e53e3e;color:#fff}

.empty{text-align:center;padding:60px 20px;background:#fff;border-radius:6px;border:1px dashed rgba(59,42,26,.15)}
.empty span{font-size:3rem;display:block;margin-bottom:12px}
.empty p{color:#999;font-size:.9rem}

.footer-note{text-align:center;font-size:.75rem;color:#aaa;margin-top:28px}
.footer-note strong{color:#7A4F2D}
</style>
</head>
<body>
<div class="wrap">

  <div class="page-hd">
    <div class="page-title">
      <h1>📋 Data Buku Tamu</h1>
      <span class="badge"><?= $total ?> Tamu</span>
    </div>
    <div class="nav-row">
      <a href="Latihan1.php" class="nav-btn btn-gold">✏️ Tambah Pesan</a>
      <a href="Latihan5.php" class="nav-btn btn-outline">🔍 Cari Data</a>
    </div>
  </div>

  <?php if (isset($_GET['hapus']) && $_GET['hapus'] == 'ok'): ?>
  <div class="alert-ok">✅ Data berhasil dihapus.</div>
  <?php elseif (isset($_GET['hapus']) && $_GET['hapus'] == 'gagal'): ?>
  <div class="alert-err">❌ Gagal menghapus data.</div>
  <?php endif; ?>

  <?php if ($total == 0): ?>
  <div class="empty">
    <span>📭</span>
    <p>Belum ada tamu yang mengisi buku tamu.<br>
    <a href="Latihan1.php" style="color:#C8953A;font-weight:700">Jadilah yang pertama!</a></p>
  </div>

  <?php else: ?>
  <div class="tbl-outer">
    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Nama / Email</th>
          <th>Telepon</th>
          <th>Asal</th>
          <th>Kelamin</th>
          <th>Rating</th>
          <th>Pesan</th>
          <th>Tanggal</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
      <?php
      $no = 1;
      while ($row = mysqli_fetch_assoc($result)):
          $kel   = $row['jenis_kelamin'];
          $klass = ($kel == 'Laki-laki') ? 'pill-l' : (($kel == 'Perempuan') ? 'pill-p' : 'pill-x');
          $label = $kel ?: '—';
          $r     = (int) $row['rating'];
          $tgl   = date("d M Y", strtotime($row['tanggal'])) . '<br>' . date("H:i", strtotime($row['tanggal']));
      ?>
        <tr>
          <td class="no"><?= $no++ ?></td>
          <td class="td-nama">
            <strong><?= htmlspecialchars($row['nama']) ?></strong>
            <small><?= htmlspecialchars($row['email']) ?></small>
          </td>
          <td class="td-tel"><?= htmlspecialchars($row['telepon']) ?: '—' ?></td>
          <td class="td-asal"><?= htmlspecialchars($row['asal']) ?: '—' ?></td>
          <td><span class="pill <?= $klass ?>"><?= $label ?></span></td>
          <td class="stars">
            <?php for ($i = 1; $i <= 5; $i++): ?>
            <span class="<?= $i <= $r ? 'star-on' : 'star-off' ?>">★</span>
            <?php endfor; ?>
          </td>
          <td class="td-pesan"><?= nl2br(htmlspecialchars($row['pesan'])) ?></td>
          <td class="td-tgl"><?= $tgl ?></td>
          <td>
            <div class="aksi-row">
              <a href="Latihan3.php?id=<?= $row['id'] ?>" class="btn-edit">✏️ Edit</a>
              <a href="Latihan4.php?id=<?= $row['id'] ?>"
                 class="btn-del"
                 onclick="return confirm('Hapus data <?= addslashes(htmlspecialchars($row['nama'])) ?>?')">🗑 Hapus</a>
            </div>
          </td>
        </tr>
      <?php endwhile; ?>
      </tbody>
    </table>
  </div>
  <?php endif; ?>

  <p class="footer-note">Pemrograman Web 2 &nbsp;|&nbsp; <strong>Buku Tamu Digital</strong></p>

</div>
<?php mysqli_close($koneksi); ?>
</body>
</html>