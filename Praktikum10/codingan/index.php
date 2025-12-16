<?php
// index.php
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard Laporan | mPDF Project</title>
  <style>
    :root{
      --bg:#0b1220;
      --card:#111a2e;
      --card2:#0f172a;
      --text:#e6e9f2;
      --muted:#a7b0c3;
      --line:rgba(255,255,255,.10);
      --accent:#60a5fa;
      --accent2:#22c55e;
      --warn:#f59e0b;
      --shadow: 0 18px 50px rgba(0,0,0,.35);
      --radius: 16px;
    }
    *{ box-sizing:border-box; }
    body{
      margin:0;
      font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial;
      background: radial-gradient(1200px 800px at 10% 10%, rgba(96,165,250,.18), transparent 55%),
                  radial-gradient(900px 700px at 90% 20%, rgba(34,197,94,.14), transparent 55%),
                  var(--bg);
      color:var(--text);
      min-height:100vh;
    }
    .wrap{ max-width: 980px; margin: 40px auto; padding: 0 18px; }
    .topbar{
      display:flex; justify-content:space-between; align-items:flex-start; gap:16px;
      margin-bottom:18px;
    }
    .title h1{ margin:0; font-size: 26px; letter-spacing:.2px; }
    .title p{ margin:6px 0 0; color:var(--muted); }
    .badge{
      display:inline-flex; align-items:center; gap:8px;
      padding:10px 12px; border:1px solid var(--line); border-radius: 999px;
      background: rgba(255,255,255,.04);
      box-shadow: var(--shadow);
      color: var(--muted);
      font-size: 13px;
      white-space: nowrap;
    }
    .grid{
      display:grid;
      grid-template-columns: 1.2fr .8fr;
      gap:16px;
    }
    @media (max-width: 860px){
      .grid{ grid-template-columns: 1fr; }
      .badge{ width:100%; justify-content:center; }
    }
    .card{
      background: linear-gradient(180deg, rgba(255,255,255,.06), rgba(255,255,255,.03));
      border: 1px solid var(--line);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      overflow:hidden;
    }
    .card .head{
      padding:16px 16px 0;
    }
    .card .head h2{
      margin:0;
      font-size:16px;
      color: #dbe3f6;
      letter-spacing:.2px;
    }
    .card .head p{ margin:6px 0 0; color: var(--muted); font-size: 13px; }
    .card .body{ padding: 16px; }
    label{ display:block; margin: 12px 0 6px; color: var(--muted); font-size: 13px; }
    input{
      width:100%;
      padding:12px 12px;
      border:1px solid var(--line);
      border-radius: 12px;
      background: rgba(0,0,0,.18);
      color: var(--text);
      outline:none;
    }
    input:focus{ border-color: rgba(96,165,250,.55); box-shadow: 0 0 0 3px rgba(96,165,250,.15); }
    .row{ display:grid; grid-template-columns: 1fr 1fr; gap:12px; }
    @media (max-width: 520px){ .row{ grid-template-columns:1fr; } }

    .btnrow{ display:flex; gap:10px; flex-wrap:wrap; margin-top: 14px; }
    .btn{
      display:inline-flex; align-items:center; justify-content:center; gap:10px;
      padding:12px 14px;
      border-radius: 12px;
      border:1px solid var(--line);
      background: rgba(255,255,255,.04);
      color: var(--text);
      text-decoration:none;
      cursor:pointer;
      font-weight: 600;
      font-size: 14px;
      transition: transform .08s ease, background .12s ease, border-color .12s ease;
    }
    .btn:hover{ background: rgba(255,255,255,.07); border-color: rgba(255,255,255,.18); }
    .btn:active{ transform: translateY(1px); }
    .btn.primary{ border-color: rgba(96,165,250,.45); background: rgba(96,165,250,.14); }
    .btn.primary:hover{ background: rgba(96,165,250,.20); }
    .btn.success{ border-color: rgba(34,197,94,.45); background: rgba(34,197,94,.14); }
    .btn.success:hover{ background: rgba(34,197,94,.20); }
    .hint{ color: var(--muted); font-size: 12px; margin-top: 10px; line-height: 1.5; }

    .stats{
      display:grid; gap:12px;
    }
    .stat{
      padding:14px;
      border-radius: 16px;
      border:1px solid var(--line);
      background: rgba(0,0,0,.16);
    }
    .stat .k{ color: var(--muted); font-size: 13px; }
    .stat .v{ margin-top:6px; font-size: 20px; font-weight: 800; letter-spacing:.3px; }
    .footer{
      margin-top: 18px;
      color: rgba(167,176,195,.85);
      font-size: 12px;
      text-align:center;
    }
  </style>
</head>
<body>
  <div class="wrap">
    <div class="topbar">
      <div class="title">
        <h1>Dashboard Laporan</h1>
        <p>Preview laporan HTML dan generate PDF dengan mPDF.</p>
      </div>
      <div class="badge">
        <span>🟢</span>
        <span>Apache & MySQL harus Running (XAMPP)</span>
      </div>
    </div>

    <div class="grid">
      <div class="card">
        <div class="head">
          <h2>Generate Laporan</h2>
          <p>Pilih periode, lalu preview atau cetak PDF.</p>
        </div>
        <div class="body">
          <form action="laporan.php" method="get">
            <div class="row">
              <div>
                <label>Tanggal Awal</label>
                <input type="date" name="awal" value="<?= date('Y-m-01') ?>">
              </div>
              <div>
                <label>Tanggal Akhir</label>
                <input type="date" name="akhir" value="<?= date('Y-m-t') ?>">
              </div>
            </div>

            <div class="btnrow">
              <button class="btn primary" type="submit" name="mode" value="html">👁️ Preview HTML</button>
              <button class="btn success" type="submit" name="mode" value="pdf">📄 Generate PDF</button>
            </div>

            <div class="hint">
              Tips: gunakan <b>Preview HTML</b> untuk cek data & tampilan dulu, lalu cetak PDF.
            </div>
          </form>
        </div>
      </div>

      <div class="card">
        <div class="head">
          <h2>Ringkasan</h2>
          <p>Info cepat untuk tampilan profesional.</p>
        </div>
        <div class="body">
          <div class="stats">
            <div class="stat">
              <div class="k">Project</div>
              <div class="v">mPDF Report</div>
            </div>
            <div class="stat">
              <div class="k">Lokasi</div>
              <div class="v">/mpdf_project</div>
            </div>
            <div class="stat">
              <div class="k">Waktu</div>
              <div class="v"><?= date('d-m-Y H:i') ?></div>
            </div>
          </div>

          <div class="hint" style="margin-top:12px;">
            Jika halaman error, pastikan file <b>vendor/autoload.php</b> ada dan mPDF sudah terinstall.
          </div>
        </div>
      </div>
    </div>

    <div class="footer">
      © <?= date('Y') ?> mPDF Project — Laporan otomatis dari PHP ke PDF
    </div>
  </div>
</body>
</html>
