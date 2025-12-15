<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Input Data Mahasiswa</title>

  <style>
    :root{
      --bg: #0b1220;
      --card: rgba(255,255,255,.08);
      --card2: rgba(255,255,255,.06);
      --text: rgba(255,255,255,.92);
      --muted: rgba(255,255,255,.70);
      --border: rgba(255,255,255,.14);
      --shadow: 0 18px 50px rgba(0,0,0,.35);
      --radius: 18px;
      --radius-sm: 14px;
      --focus: 0 0 0 4px rgba(99,102,241,.28);
      --primary: #6366f1;   /* indigo */
      --primary2:#22c55e;   /* green */
      --danger:#ef4444;
    }

    *{ box-sizing:border-box; }
    html,body{ height:100%; }
    body{
      margin:0;
      color: var(--text);
      font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial, "Noto Sans", "Helvetica Neue", sans-serif;
      background:
        radial-gradient(1200px 600px at 10% 10%, rgba(99,102,241,.35), transparent 60%),
        radial-gradient(900px 500px at 90% 30%, rgba(34,197,94,.28), transparent 55%),
        radial-gradient(800px 500px at 50% 100%, rgba(59,130,246,.20), transparent 55%),
        linear-gradient(180deg, #050814, #0b1220 45%, #050814);
      display:flex;
      align-items:center;
      justify-content:center;
      padding: 28px 16px;
    }

    .wrap{
      width: min(980px, 100%);
      display:grid;
      grid-template-columns: 1.05fr .95fr;
      gap: 18px;
    }

    @media (max-width: 880px){
      .wrap{ grid-template-columns: 1fr; }
    }

    .hero, .card{
      background: linear-gradient(180deg, var(--card), var(--card2));
      border: 1px solid var(--border);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      overflow:hidden;
    }

    .hero{
      padding: 22px 22px 18px;
      position:relative;
      min-height: 240px;
    }

    .badge{
      display:inline-flex;
      align-items:center;
      gap:10px;
      padding: 8px 12px;
      border-radius: 999px;
      border: 1px solid var(--border);
      background: rgba(255,255,255,.06);
      font-size: 13px;
      color: var(--muted);
      width: fit-content;
    }

    .dot{
      width:10px;height:10px;border-radius:999px;
      background: radial-gradient(circle at 30% 30%, #fff, rgba(255,255,255,.1));
      box-shadow: 0 0 0 4px rgba(99,102,241,.20);
    }

    .hero h1{
      margin: 14px 0 10px;
      font-size: clamp(22px, 3vw, 30px);
      line-height: 1.15;
      letter-spacing: .2px;
    }

    .hero p{
      margin: 0 0 16px;
      color: var(--muted);
      line-height: 1.55;
      font-size: 14.5px;
    }

    .hero .stats{
      display:flex;
      gap: 10px;
      flex-wrap: wrap;
      margin-top: 14px;
    }

    .pill{
      border: 1px solid var(--border);
      background: rgba(255,255,255,.06);
      border-radius: 999px;
      padding: 10px 12px;
      font-size: 13px;
      color: var(--muted);
      display:flex;
      align-items:center;
      gap: 10px;
    }

    .pill b{ color: var(--text); font-weight: 600; }

    .card{
      padding: 18px 18px 16px;
    }

    .card-header{
      display:flex;
      justify-content:space-between;
      align-items:flex-start;
      gap: 12px;
      margin-bottom: 14px;
    }

    .card-header h2{
      margin: 0;
      font-size: 18px;
      letter-spacing:.2px;
    }

    .card-header small{
      color: var(--muted);
      display:block;
      margin-top: 4px;
      line-height: 1.4;
    }

    form{
      display:grid;
      gap: 12px;
    }

    .grid{
      display:grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px;
    }

    @media (max-width: 520px){
      .grid{ grid-template-columns: 1fr; }
    }

    .field{
      display:flex;
      flex-direction:column;
      gap: 6px;
    }

    label{
      font-size: 13px;
      color: var(--muted);
    }

    .req{
      color: rgba(255,255,255,.55);
      font-size: 12px;
      margin-left: 6px;
    }

    input, textarea{
      width:100%;
      padding: 12px 12px;
      border-radius: var(--radius-sm);
      border: 1px solid var(--border);
      background: rgba(10, 14, 28, .55);
      color: var(--text);
      outline: none;
      transition: box-shadow .15s ease, border-color .15s ease, transform .05s ease;
      font-size: 14px;
    }

    textarea{ resize: vertical; min-height: 108px; }

    input::placeholder, textarea::placeholder{
      color: rgba(255,255,255,.35);
    }

    input:focus, textarea:focus{
      border-color: rgba(99,102,241,.55);
      box-shadow: var(--focus);
    }

    .hint{
      font-size: 12px;
      color: rgba(255,255,255,.50);
      margin-top: 2px;
      line-height: 1.35;
    }

    .actions{
      display:flex;
      gap: 10px;
      align-items:center;
      justify-content:space-between;
      flex-wrap: wrap;
      margin-top: 6px;
    }

    .btn{
      appearance:none;
      border: none;
      cursor:pointer;
      padding: 12px 14px;
      border-radius: 14px;
      font-weight: 700;
      letter-spacing:.2px;
      color: #0b1220;
      background: linear-gradient(135deg, rgba(99,102,241,1), rgba(34,197,94,1));
      box-shadow: 0 12px 26px rgba(0,0,0,.28);
      transition: transform .08s ease, filter .12s ease;
      display:inline-flex;
      align-items:center;
      gap: 10px;
    }

    .btn:active{ transform: translateY(1px); }
    .btn:hover{ filter: brightness(1.05); }

    .subnote{
      color: var(--muted);
      font-size: 12.5px;
      line-height: 1.4;
      display:flex;
      align-items:center;
      gap: 10px;
    }

    .lock{
      width: 34px; height: 34px; border-radius: 12px;
      border:1px solid var(--border);
      background: rgba(255,255,255,.06);
      display:grid; place-items:center;
      flex: 0 0 auto;
    }

    .footer{
      margin-top: 14px;
      color: rgba(255,255,255,.45);
      font-size: 12px;
      line-height: 1.4;
    }

    /* Native validation feel nicer */
    input:invalid:focus, textarea:invalid:focus{
      border-color: rgba(239,68,68,.6);
      box-shadow: 0 0 0 4px rgba(239,68,68,.22);
    }

    /* Reduce motion for accessibility */
    @media (prefers-reduced-motion: reduce){
      *{ transition:none !important; }
    }
  </style>
</head>

<body>
  <div class="wrap">
    <!-- Left / Info -->
    <section class="hero">
      <div class="badge">
        <span class="dot"></span>
        <span>Form Input Data Mahasiswa • Tanpa Login</span>
      </div>

      <h1>Sistem Input Data Mahasiswa</h1>
      <p>
        Silakan isi data dengan lengkap. Setelah submit, sistem akan memproses data dan mengirimkannya melalui email
        sesuai konfigurasi.
      </p>

      <div class="stats">
        <div class="pill">📧 <b>Output:</b> Email otomatis</div>
        <div class="pill">🧾 <b>Opsional:</b> Arsip CSV</div>
        <div class="pill">⚡ <b>Responsif:</b> Mobile & Desktop</div>
      </div>

      <div class="footer">
        Tips: gunakan format NIM yang konsisten (misal: 2023xxxx) dan pastikan “Angkatan” sesuai tahun masuk.
      </div>
    </section>

    <!-- Right / Form -->
    <section class="card" aria-label="Form input mahasiswa">
      <div class="card-header">
        <div>
          <h2>Input Data</h2>
          <small>Field bertanda <b>*</b> wajib diisi. Tidak ada perubahan pada proses & pengiriman.</small>
        </div>
        <div class="lock" title="Aman & rapi">
          🔒
        </div>
      </div>

      <form method="post" action="process.php">
        <div class="grid">
          <div class="field">
            <label for="nim">NIM <span class="req">*</span></label>
            <input id="nim" type="text" name="nim" required maxlength="20" placeholder="Contoh: 20230001" />
            <div class="hint">Maks. 20 karakter.</div>
          </div>

          <div class="field">
            <label for="angkatan">Angkatan <span class="req">*</span></label>
            <input id="angkatan" type="number" name="angkatan" required min="2000" max="2100" placeholder="Contoh: 2023" />
            <div class="hint">Rentang 2000–2100.</div>
          </div>
        </div>

        <div class="field">
          <label for="nama">Nama <span class="req">*</span></label>
          <input id="nama" type="text" name="nama" required maxlength="100" placeholder="Nama lengkap mahasiswa" />
          <div class="hint">Maks. 100 karakter.</div>
        </div>

        <div class="field">
          <label for="prodi">Program Studi <span class="req">*</span></label>
          <input id="prodi" type="text" name="prodi" required maxlength="100" placeholder="Contoh: Informatika" />
          <div class="hint">Maks. 100 karakter.</div>
        </div>

        <div class="grid">
          <div class="field">
            <label for="email_mhs">Email Mahasiswa <span class="req">(opsional)</span></label>
            <input id="email_mhs" type="email" name="email_mhs" placeholder="contoh@domain.com" />
            <div class="hint">Jika diisi, bisa di-CC (sesuai logic yang sudah ada).</div>
          </div>

          <div class="field">
            <label for="catatan">Catatan <span class="req">(opsional)</span></label>
            <input id="catatan" type="text" name="catatan" maxlength="500" placeholder="Catatan singkat (opsional)" />
            <div class="hint">Maks. 500 karakter.</div>
          </div>
        </div>

        <div class="actions">
          <button class="btn" type="submit">
            <span>🚀</span>
            <span>Kirim Data via Email</span>
          </button>

          <div class="subnote">
            <span class="lock">✅</span>
            <span>Validasi dasar aktif, tampilan responsif.</span>
          </div>
        </div>
      </form>
    </section>
  </div>
</body>
</html>
