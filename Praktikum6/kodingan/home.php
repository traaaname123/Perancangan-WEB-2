<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Beranda Pengguna</title>
<style>
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #90e0ef, #48cae4);
    display: flex; justify-content: center; align-items: center;
    height: 100vh;
}
.box {
    background: white; padding: 40px; border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    text-align: center; width: 420px;
}
h2 { color: #0077b6; }
a {
    text-decoration: none; background: #0077b6;
    color: white; padding: 10px 20px; border-radius: 8px;
    transition: 0.3s;
}
a:hover { background: #023e8a; }
</style>
</head>
<body>
    <div class="box">
        <h2>Selamat Datang, <?= $_SESSION['username']; ?> 🎉</h2>
        <p>Kamu berhasil login ke sistem autentikasi PHP.</p>
        <br>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
