<?php
// process.php (tanpa composer) - tampilan diperbaiki, logika tetap

// =====================
// UI helper (tampilan)
// =====================
function renderPage($title, $subtitle, $status = 'info', $detailsHtml = '', $backLink = 'index.php') {
  // status: success | error | info
  $icon = 'ℹ️';
  $badgeText = 'Informasi';

  if ($status === 'success') { $icon = '✅'; $badgeText = 'Berhasil'; }
  if ($status === 'error')   { $icon = '❌'; $badgeText = 'Gagal'; }

  $year = date('Y');

  echo '<!doctype html>
  <html lang="id">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>'.htmlspecialchars($title).'</title>
    <style>
      :root{
        --bg:#0b1220;
        --card:rgba(255,255,255,.08);
        --card2:rgba(255,255,255,.06);
        --text:rgba(255,255,255,.92);
        --muted:rgba(255,255,255,.70);
        --border:rgba(255,255,255,.14);
        --shadow:0 18px 50px rgba(0,0,0,.35);
        --radius:18px;
        --radius-sm:14px;
        --focus:0 0 0 4px rgba(99,102,241,.28);
        --success:#22c55e;
        --danger:#ef4444;
        --info:#6366f1;
      }
      *{box-sizing:border-box}
      body{
        margin:0; min-height:100vh; display:grid; place-items:center;
        font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial, "Noto Sans", "Helvetica Neue", sans-serif;
        background:
          radial-gradient(1200px 600px at 10% 10%, rgba(99,102,241,.35), transparent 60%),
          radial-gradient(900px 500px at 90% 30%, rgba(34,197,94,.28), transparent 55%),
          radial-gradient(800px 500px at 50% 100%, rgba(59,130,246,.20), transparent 55%),
          linear-gradient(180deg, #050814, #0b1220 45%, #050814);
        color:var(--text);
        padding:28px 16px;
      }
      .wrap{ width:min(860px, 100%); }
      .card{
        background:linear-gradient(180deg,var(--card),var(--card2));
        border:1px solid var(--border);
        border-radius:var(--radius);
        box-shadow:var(--shadow);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        overflow:hidden;
      }
      .top{
        padding:18px 18px 0;
        display:flex; align-items:center; justify-content:space-between; gap:12px;
        flex-wrap:wrap;
      }
      .badge{
        display:inline-flex; align-items:center; gap:10px;
        padding:8px 12px; border-radius:999px;
        border:1px solid var(--border);
        background: rgba(255,255,255,.06);
        color:var(--muted);
        font-size:13px;
      }
      .dot{
        width:10px; height:10px; border-radius:999px;
        background: radial-gradient(circle at 30% 30%, #fff, rgba(255,255,255,.1));
        box-shadow: 0 0 0 4px rgba(99,102,241,.20);
      }
      .content{ padding:18px; }
      h1{ margin:10px 0 6px; font-size: clamp(20px, 3vw, 28px); line-height:1.15; }
      p{ margin:0; color:var(--muted); line-height:1.55; }
      .panel{
        margin-top:14px;
        border:1px solid var(--border);
        background:rgba(255,255,255,.05);
        border-radius: var(--radius-sm);
        padding:14px;
      }
      .row{
        display:flex; gap:10px; align-items:flex-start;
      }
      .icon{
        width:38px; height:38px; border-radius:14px;
        border:1px solid var(--border);
        background:rgba(255,255,255,.06);
        display:grid; place-items:center;
        flex:0 0 auto;
        font-size:18px;
      }
      .statusline{
        font-weight:700;
        margin-bottom:4px;
      }
      .statusbar{
        margin-top:14px; height:10px; border-radius:999px;
        background: rgba(255,255,255,.08);
        overflow:hidden;
        border:1px solid rgba(255,255,255,.10);
      }
      .fill{
        height:100%;
        width:100%;
        background: rgba(99,102,241,.65);
      }
      .fill.success{ background: rgba(34,197,94,.70); }
      .fill.error{ background: rgba(239,68,68,.70); }

      .actions{
        margin-top:14px;
        display:flex; align-items:center; justify-content:space-between;
        gap:10px; flex-wrap:wrap;
      }
      .btn{
        appearance:none; border:none; cursor:pointer;
        padding:12px 14px; border-radius:14px;
        font-weight:800; letter-spacing:.2px;
        background: rgba(255,255,255,.10);
        border:1px solid rgba(255,255,255,.16);
        color:var(--text);
        text-decoration:none;
        display:inline-flex; align-items:center; gap:10px;
        transition: transform .08s ease, filter .12s ease;
      }
      .btn:hover{ filter: brightness(1.05); }
      .btn:active{ transform: translateY(1px); }

      .note{
        font-size:12.5px; color: rgba(255,255,255,.55);
        line-height:1.45;
        display:flex; align-items:center; gap:10px;
      }

      .footer{
        margin-top:14px;
        font-size:12px;
        color: rgba(255,255,255,.45);
        line-height:1.4;
      }

      /* table styles if any */
      table{ width:100%; border-collapse:collapse; margin-top:10px; }
      td,th{ border:1px solid rgba(255,255,255,.14); padding:10px; text-align:left; }
      th{ background:rgba(255,255,255,.06); }

      @media (prefers-reduced-motion: reduce){
        *{ transition:none !important; }
      }
    </style>
  </head>
  <body>
    <div class="wrap">
      <div class="card">
        <div class="top">
          <div class="badge"><span class="dot"></span><span>'.$badgeText.' • Output Proses</span></div>
          <div class="badge">🕒 '.date('Y-m-d H:i:s').'</div>
        </div>

        <div class="content">
          <h1>'.htmlspecialchars($title).'</h1>
          <p>'.htmlspecialchars($subtitle).'</p>

          <div class="panel">
            <div class="row">
              <div class="icon">'.$icon.'</div>
              <div style="flex:1">
                <div class="statusline">'.htmlspecialchars($badgeText).'</div>
                '.$detailsHtml.'
              </div>
            </div>

            <div class="statusbar">
              <div class="fill '.($status === 'success' ? 'success' : ($status === 'error' ? 'error' : '')).'"></div>
            </div>

            <div class="actions">
              <a class="btn" href="'.htmlspecialchars($backLink).'">← Kembali ke Form</a>
              <div class="note">🔒 Tampilan saja yang diubah, proses tetap sama.</div>
            </div>
          </div>

          <div class="footer">© '.$year.' Sistem Data Mahasiswa</div>
        </div>
      </div>
    </div>
  </body>
  </html>';
  exit;
}

// =====================
// LOGIKA ASLI (tetap)
// =====================

// Import config
$config = require __DIR__ . '/config.php';

// Import file PHPMailer secara manual (tanpa composer)
require __DIR__ . '/PHPMailer/src/Exception.php';
require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function clean($v) {
  return trim(htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8'));
}

// Ambil input
$nim       = clean($_POST['nim'] ?? '');
$nama      = clean($_POST['nama'] ?? '');
$prodi     = clean($_POST['prodi'] ?? '');
$angkatan  = clean($_POST['angkatan'] ?? '');
$email_mhs = clean($_POST['email_mhs'] ?? '');
$catatan   = clean($_POST['catatan'] ?? '');

// Validasi minimal
if ($nim === '' || $nama === '' || $prodi === '' || $angkatan === '') {
  http_response_code(400);
  $details = '<p style="margin:0;color:rgba(255,255,255,.75)">Data wajib belum lengkap. Pastikan NIM, Nama, Prodi, dan Angkatan terisi.</p>';
  renderPage('Data belum lengkap', 'Silakan kembali dan lengkapi field wajib.', 'error', $details);
}

// (Opsional) simpan CSV (tetap sama)
$csvPath = __DIR__ . '/data_mahasiswa.csv';
$fp = fopen($csvPath, 'a');
if ($fp) {
  fputcsv($fp, [date('Y-m-d H:i:s'), $nim, $nama, $prodi, $angkatan, $email_mhs, $catatan]);
  fclose($fp);
}

// Siapkan email (tetap sama)
$subject = "DATA_MAHASISWA_" . date('Ymd_His') . "_INPUT";

$bodyHtml = "
  <h3>Data Mahasiswa Baru</h3>
  <table cellpadding='6' border='1' style='border-collapse:collapse'>
    <tr><td><b>NIM</b></td><td>{$nim}</td></tr>
    <tr><td><b>Nama</b></td><td>{$nama}</td></tr>
    <tr><td><b>Prodi</b></td><td>{$prodi}</td></tr>
    <tr><td><b>Angkatan</b></td><td>{$angkatan}</td></tr>
    <tr><td><b>Email Mahasiswa</b></td><td>".($email_mhs ?: '-')."</td></tr>
    <tr><td><b>Catatan</b></td><td>".($catatan ?: '-')."</td></tr>
  </table>
  <p>Dikirim pada: ".date('Y-m-d H:i:s')."</p>
";

$mail = new PHPMailer(true);

try {
  // SMTP (tetap sama)
  $mail->isSMTP();
  $mail->Host       = $config['smtp_host'];
  $mail->SMTPAuth   = true;
  $mail->Username   = $config['smtp_user'];
  $mail->Password   = $config['smtp_pass'];
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  $mail->Port       = (int)$config['smtp_port'];

  // Header email (tetap sama)
  $mail->setFrom($config['from_email'], $config['from_name']);
  $mail->addAddress($config['to_email'], $config['to_name']);

  // CC opsional (tetap sama)
  if ($email_mhs !== '' && filter_var($email_mhs, FILTER_VALIDATE_EMAIL)) {
    $mail->addCC($email_mhs, $nama);
  }

  // Konten (tetap sama)
  $mail->isHTML(true);
  $mail->Subject = $subject;
  $mail->Body    = $bodyHtml;
  $mail->AltBody = "Data Mahasiswa: NIM={$nim}, Nama={$nama}, Prodi={$prodi}, Angkatan={$angkatan}";

  $mail->send();

  // OUTPUT SUKSES (tampilan saja)
  $details = '
    <p style="margin:0;color:rgba(255,255,255,.78)">Data mahasiswa berhasil diproses dan email berhasil dikirim.</p>
    <table>
      <tr><th>Field</th><th>Nilai</th></tr>
      <tr><td>NIM</td><td>'.$nim.'</td></tr>
      <tr><td>Nama</td><td>'.$nama.'</td></tr>
      <tr><td>Prodi</td><td>'.$prodi.'</td></tr>
      <tr><td>Angkatan</td><td>'.$angkatan.'</td></tr>
      <tr><td>Email Mahasiswa</td><td>'.($email_mhs ?: '-').'</td></tr>
      <tr><td>Catatan</td><td>'.($catatan ?: '-').'</td></tr>
      <tr><td>Tujuan Email</td><td>'.htmlspecialchars($config['to_email'], ENT_QUOTES, 'UTF-8').'</td></tr>
      <tr><td>Subjek</td><td>'.htmlspecialchars($subject, ENT_QUOTES, 'UTF-8').'</td></tr>
    </table>
  ';
  renderPage('Berhasil mengirim data', 'Email sudah terkirim sesuai konfigurasi.', 'success', $details);

} catch (Exception $e) {
  http_response_code(500);

  // OUTPUT GAGAL (tampilan saja) - tetap menampilkan error info
  $details = '
    <p style="margin:0;color:rgba(255,255,255,.78)">Email gagal dikirim. Silakan cek konfigurasi SMTP/App Password dan koneksi.</p>
    <div style="margin-top:10px;padding:12px;border-radius:14px;border:1px solid rgba(255,255,255,.14);background:rgba(0,0,0,.18);">
      <div style="font-weight:700;margin-bottom:6px;">Detail Error</div>
      <div style="color:rgba(255,255,255,.75);word-break:break-word;">'.htmlspecialchars($mail->ErrorInfo, ENT_QUOTES, 'UTF-8').'</div>
    </div>
  ';
  renderPage('Gagal mengirim email', 'Terjadi kendala saat pengiriman email.', 'error', $details);
}
