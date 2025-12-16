<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/koneksi.php';

$mode  = $_GET['mode'] ?? 'html';
$awal  = $_GET['awal'] ?? date('Y-m-01');
$akhir = $_GET['akhir'] ?? date('Y-m-t');

$sql = "SELECT id, tanggal, pelanggan, total
        FROM transaksi
        WHERE tanggal BETWEEN :awal AND :akhir
        ORDER BY tanggal ASC";

$stmt = $pdo->prepare($sql);
$stmt->execute([':awal' => $awal, ':akhir' => $akhir]);
$data = $stmt->fetchAll();

$jumlahTransaksi = count($data);
$grandTotal = 0;
foreach ($data as $row) $grandTotal += (float)$row['total'];

function rupiah($angka){
  return number_format((float)$angka, 0, ',', '.');
}

ob_start();
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Laporan Transaksi</title>
  <style>
    body { font-family: sans-serif; font-size: 11pt; margin: 0; color: #111; }
    .page { padding: 18px; }
    .top {
      display:flex; justify-content:space-between; align-items:flex-start;
      margin-bottom: 14px;
    }
    .brand h1 { margin:0; font-size: 16pt; }
    .brand .sub { margin-top:4px; font-size: 10pt; color:#555; }
    .meta { text-align:right; font-size: 10pt; color:#444; }
    .pill {
      display:inline-block; padding:6px 10px; border:1px solid #ddd;
      border-radius: 999px; font-size: 9.5pt; color:#333; margin-top: 8px;
    }
    .cards { display:grid; grid-template-columns: 1fr 1fr 1fr; gap:10px; margin: 12px 0 14px; }
    .card {
      border: 1px solid #e5e5e5; border-radius: 10px; padding: 10px;
      background: #fafafa;
    }
    .k { font-size: 9.5pt; color:#666; }
    .v { margin-top:4px; font-size: 12pt; font-weight:700; }
    table { width:100%; border-collapse: collapse; }
    th, td { border: 1px solid #333; padding: 7px; }
    th { background: #f2f2f2; font-size: 10pt; }
    td { font-size: 10.5pt; }
    .right { text-align:right; }
    .toolbar {
      margin: 0 0 14px;
      display:flex; gap:10px; flex-wrap:wrap;
    }
    .btn {
      display:inline-block; padding: 10px 12px;
      border:1px solid #333; border-radius: 8px;
      text-decoration:none; color:#111; background:#fff;
      font-weight:700; font-size: 10pt;
    }
    .btn:hover { background:#f2f2f2; }
    .note { font-size: 10pt; color:#666; }
  </style>
</head>
<body>
<div class="page">

  <?php if ($mode === 'html'): ?>
    <div class="toolbar">
      <a class="btn" href="index.php">← Dashboard</a>
      <a class="btn" href="laporan.php?mode=pdf&awal=<?= urlencode($awal) ?>&akhir=<?= urlencode($akhir) ?>">📄 Generate PDF</a>
      <span class="note">Preview HTML — cek tampilan sebelum cetak PDF.</span>
    </div>
  <?php endif; ?>

  <div class="top">
    <div class="brand">
      <h1>Laporan Transaksi</h1>
      <div class="sub">Sistem Laporan Otomatis (PHP + mPDF)</div>
      <div class="pill">Periode: <?= htmlspecialchars($awal) ?> s/d <?= htmlspecialchars($akhir) ?></div>
    </div>
    <div class="meta">
      Dicetak: <?= date('Y-m-d H:i') ?><br>
      Format: A4
    </div>
  </div>

  <div class="cards">
    <div class="card">
      <div class="k">Jumlah Transaksi</div>
      <div class="v"><?= $jumlahTransaksi ?></div>
    </div>
    <div class="card">
      <div class="k">Grand Total</div>
      <div class="v">Rp <?= rupiah($grandTotal) ?></div>
    </div>
    <div class="card">
      <div class="k">Status Data</div>
      <div class="v"><?= $jumlahTransaksi ? "Tersedia" : "Kosong" ?></div>
    </div>
  </div>

  <table>
    <thead>
      <tr>
        <th style="width:50px;">No</th>
        <th style="width:110px;">Tanggal</th>
        <th>Pelanggan</th>
        <th class="right" style="width:140px;">Total</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!$data): ?>
        <tr><td colspan="4">Tidak ada data pada periode ini.</td></tr>
      <?php else: ?>
        <?php foreach ($data as $i => $row): ?>
          <tr>
            <td><?= $i+1 ?></td>
            <td><?= htmlspecialchars($row['tanggal']) ?></td>
            <td><?= htmlspecialchars($row['pelanggan']) ?></td>
            <td class="right">Rp <?= rupiah($row['total']) ?></td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
    <tfoot>
      <tr>
        <th colspan="3" class="right">Grand Total</th>
        <th class="right">Rp <?= rupiah($grandTotal) ?></th>
      </tr>
    </tfoot>
  </table>

</div>
</body>
</html>
<?php
$html = ob_get_clean();

if ($mode === 'html') {
  echo $html;
  exit;
}

$mpdf = new \Mpdf\Mpdf([
  'mode' => 'utf-8',
  'format' => 'A4',
  'margin_top' => 18,
  'margin_bottom' => 16,
  'margin_left' => 12,
  'margin_right' => 12,
]);

$mpdf->SetTitle("Laporan Transaksi");
$mpdf->SetAuthor("mPDF Project");

// Header / Footer profesional
$mpdf->SetHeader("Laporan Transaksi|Periode: {$awal} s/d {$akhir}|Hal {PAGENO}/{nbpg}");
$mpdf->SetFooter("{DATE j-m-Y H:i}|Dicetak dari Sistem|© mPDF Project");

// Render ke PDF
$mpdf->WriteHTML($html);

$filename = "laporan_transaksi_{$awal}_{$akhir}.pdf";
$mpdf->Output($filename, "I");