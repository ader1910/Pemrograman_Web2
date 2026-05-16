<?php

include "Koneksi.PHP";

$keyword = "";
$result  = null;
$total   = 0;
$sudah_cari = false;

if (isset($_GET['cari'])) {
    $sudah_cari = true;
    $keyword    = mysqli_real_escape_string($koneksi, trim($_GET['keyword']));

    $sql = "SELECT * FROM buku_tamu
            WHERE nama    LIKE '%$keyword%'
               OR email   LIKE '%$keyword%'
               OR asal    LIKE '%$keyword%'
               OR pesan   LIKE '%$keyword%'
            ORDER BY tanggal DESC";

    $result = mysqli_query($koneksi, $sql);
    $total  = $result ? mysqli_num_rows($result) : 0;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cari Data Buku Tamu</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
body{background:#FAF6EF;font-family:'Lato',sans-serif;color:#3B2A1A;padding:30px 16px 60px}
.wrap{max-width:960px;margin:0 auto}
.page-hd{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:24px;padding-bottom:16px;border-bottom:2px solid rgba(59,42,26,.12)}
.page-title h1{font-family:'Playfair Display',serif;font-size:1.6rem}
.nav-btn{display:inline-flex;align-items:center;gap:6px;padding:9px 16px;border-radius:4px;font-family:'Lato',sans-serif;font-size:.78rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;text-decoration:none;transition:all .2s}
.btn-gold{background:linear-gradient(135deg,#C8953A,#E8B96A);color:#3B2A1A}
.btn-gold:hover{opacity:.85}
.btn-outline{background:transparent;border:1.5px solid #3B2A1A;color:#3B2A1A}
.btn-outline:hover{background:#3B2A1A;color:#fff}
.nav-row{display:flex;gap:8px;flex-wrap:wrap}

/* Search bar */
.search-box{background:#fff;border-radius:6px;padding:24px 28px;box-shadow:0 4px 20px rgba(59,42,26,.08);border:1px solid rgba(59,42,26,.1);margin-bottom:24px}
.search-box h2{font-size:1rem;font-weight:700;color:#7A4F2D;margin-bottom:14px}
.search-row{display:flex;gap:10px}
.search-row input{flex:1;padding:11px 15px;border:1.5px solid rgba(59,42,26,.2);border-radius:4px;background:#FAF6EF;font-family:'Lato',sans-serif;font-size:.9rem;color:#3B2A1A;outline:none;transition:border-color .2s}
.search-row input:focus{border-color:#C8953A;background:#fff}
.btn-cari{padding:11px 22px;border:none;border-radius:4px;background:linear-gradient(135deg,#C8953A,#E8B96A);color:#3B2A1A;font-family:'Lato',sans-serif;font-size:.85rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;cursor:pointer;white-space:nowrap;transition:opacity .2s}
.btn-cari:hover{opacity:.85}
.result-info{font-size:.82rem;color:#888;margin-top:10px}
.result-info strong{color:#C8953A}

/* Highlight keyword */
.hl{background:#fff3cd;color:#856404;border-radius:2px;padding:0 2px}

/* Table */
.tbl-wrap{background:#fff;border-radius:6px;box-shadow:0 4px 20px rgba(59,42,26,.1);overflow-x:auto;border:1px solid rgba(59,42,26,.1)}
table{width:100%;border-collapse:collapse;font-size:.82rem;min-width:700px}
thead{background:linear-gradient(135deg,#3B2A1A,#7A4F2D)}
thead th{padding:11px 13px;text-align:left;font-size:.68rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:#E8B96A}
tbody tr{border-bottom:1px solid rgba(59,42,26,.08);transition:background .15s}
tbody tr:last-child{border-bottom:none}
tbody tr:hover{background:#FAF6EF}
td{padding:11px 13px;vertical-align:top}
td.no{color:#aaa;text-align:center;font-size:.78rem;padding-top:13px}
.td-nama strong{display:block;font-weight:700}
.td-nama small{color:#888;font-size:.75rem}
.pill{display:inline-block;font-size:.68rem;font-weight:700;padding:2px 9px;border-radius:20px}
.pill-l{background:#ebf4ff;color:#1a5276}
.pill-p{background:#fce4ec;color:#880e4f}
.pill-x{background:#f5f5f5;color:#777}
.star-on{color:#C8953A}
.star-off{color:#ddd}
.td-pesan{max-width:200px;word-break:break-word;color:#555;line-height:1.5}
.td-tgl{white-space:nowrap;font-size:.76rem;color:#888;line-height:1.6}
.aksi-row{display:flex;gap:6px}
.btn-edit{font-size:.7rem;padding:4px 9px;border:1px solid #2980b9;border-radius:3px;color:#2980b9;background:transparent;text-decoration:none;transition:all .15s}
.btn-edit:hover{background:#2980b9;color:#fff}
.btn-del{font-size:.7rem;padding:4px 9px;border:1px solid #e53e3e;border-radius:3px;color:#e53e3e;background:transparent;text-decoration:none;transition:all .15s}
.btn-del:hover{background:#e53e3e;color:#fff}

.empty{text-align:center;padding:50px 20px;background:#fff;border-radius:6px;border:1px dashed rgba(59,42,26,.15)}
.empty span{font-size:2.5rem;display:block;margin-bottom:10px}
.empty p{color:#999;font-size:.88rem}

.footer-note{text-align:center;font-size:.75rem;color:#aaa;margin-top:28px}
.footer-note strong{color:#7A4F2D}
</style>
</head>
<body>
<div class="wrap">
  <div class="page-hd">
    <div class="page-title">
      <h1>🔍 Cari Data Buku Tamu</h1>
    </div>
    <div class="nav-row">
      <a href="Latihan1.php" class="nav-btn btn-gold">✏️ Tambah</a>
      <a href="Latihan2.php" class="nav-btn btn-outline">📋 Semua Data</a>
    </div>
  </div>

  <!-- Search Form -->
  <div class="search-box">
    <h2>🔎 Cari berdasarkan Nama, Email, Asal, atau Pesan</h2>
    <form method="GET" action="Latihan5.php">
      <div class="search-row">
        <input type="text" name="keyword" placeholder="Ketik kata kunci pencarian..."
               value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>">
        <input type="hidden" name="cari" value="1">
        <button type="submit" class="btn-cari">🔍 Cari</button>
      </div>
      <?php if ($sudah_cari): ?>
      <p class="result-info">
        Ditemukan <strong><?= $total ?> data</strong>
        <?= $keyword ? ' untuk kata kunci "<strong>' . htmlspecialchars($keyword) . '</strong>"' : '' ?>
      </p>
      <?php endif; ?>
    </form>
  </div>

  <!-- Hasil Pencarian -->
  <?php if ($sudah_cari): ?>
    <?php if ($total == 0): ?>
    <div class="empty">
      <span>🔍</span>
      <p>Tidak ada data yang cocok dengan kata kunci "<strong><?= htmlspecialchars($keyword) ?></strong>".<br>
      Coba dengan kata kunci lain.</p>
    </div>

    <?php else: ?>
    <div class="tbl-wrap">
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
          $tgl   = date("d M Y\nH:i", strtotime($row['tanggal']));

          // Highlight keyword
          function hl($text, $kw) {
              if (empty($kw)) return htmlspecialchars($text);
              return preg_replace('/(' . preg_quote(htmlspecialchars($kw), '/') . ')/i',
                                  '<span class="hl">$1</span>',
                                  htmlspecialchars($text));
          }
        ?>
          <tr>
            <td class="no"><?= $no++ ?></td>
            <td class="td-nama">
              <strong><?= hl($row['nama'], $keyword) ?></strong>
              <small><?= hl($row['email'], $keyword) ?></small>
            </td>
            <td><?= $row['telepon'] ?: '—' ?></td>
            <td><?= hl($row['asal'] ?: '—', $keyword) ?></td>
            <td><span class="pill <?= $klass ?>"><?= $label ?></span></td>
            <td>
              <?php for ($i=1;$i<=5;$i++) echo '<span class="'.($i<=$r?'star-on':'star-off').'">★</span>'; ?>
            </td>
            <td class="td-pesan"><?= nl2br(hl($row['pesan'], $keyword)) ?></td>
            <td class="td-tgl"><?= nl2br($tgl) ?></td>
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
  <?php endif; ?>

  <p class="footer-note">Pemrograman Web 2 &nbsp;|&nbsp; <strong>Buku Tamu Digital</strong></p>
</div>
<?php mysqli_close($koneksi); ?>
</body>
</html>
