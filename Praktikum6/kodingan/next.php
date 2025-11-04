<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Halaman Berikutnya</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #90e0ef, #48cae4);
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .box {
            background: white;
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            width: 420px;
            text-align: center;
        }
        h2 {
            color: #0077b6;
        }
        a {
            text-decoration: none;
            color: white;
            background: #0077b6;
            padding: 10px 20px;
            border-radius: 8px;
            transition: 0.3s;
        }
        a:hover {
            background: #023e8a;
        }
    </style>
</head>
<body>
    <div class="box">
        <h2>Selamat Datang Kembali 👋</h2>
        <p><b>Nama:</b> <?= $_SESSION["nama"]; ?></p>
        <p><b>Umur:</b> <?= $_SESSION["umur"]; ?> tahun</p>
        <p><b>Email:</b> <?= $_SESSION["email"]; ?></p>

        <br><br>
        <a href="data.php">Kembali ke Awal</a> |
        <a href="logout.php" style="background:#e63946;">Logout</a>
    </div>
</body>
</html>