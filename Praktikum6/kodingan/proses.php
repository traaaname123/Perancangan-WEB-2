<?php
session_start();

// Menyimpan data dari form ke session
$_SESSION["nama"] = $_POST["nama"];
$_SESSION["umur"] = $_POST["umur"];
$_SESSION["email"] = $_POST["email"];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Tersimpan</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0096c7, #48cae4);
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
        h1 {
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
        <h1>Halo, <?= $_SESSION["nama"]; ?> 👋</h1>
        <p>Data Anda berhasil disimpan dalam session.</p>
        <p><b>Umur:</b> <?= $_SESSION["umur"]; ?> tahun</p>
        <p><b>Email:</b> <?= $_SESSION["email"]; ?></p>
        <br>
        <a href="next.php">Lanjut ke Halaman Berikutnya</a>
    </div>
</body>
</html>