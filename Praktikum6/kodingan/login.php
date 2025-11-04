<?php
session_start();
include "koneksi.php";

if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM login WHERE username='$user' AND password='$pass'");
    if (mysqli_num_rows($query) == 1) {
        $_SESSION['username'] = $user;
        header("Location: home.php");
        exit;
    } else {
        $error = "Login gagal! Username atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login Pengguna</title>
<style>
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #48cae4, #0096c7);
    display: flex; justify-content: center; align-items: center;
    height: 100vh;
}
.container {
    background: white; padding: 40px; border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    width: 380px;
}
h2 { text-align: center; color: #0077b6; margin-bottom: 25px; }
input {
    width: 100%; padding: 10px; margin: 8px 0;
    border: 1px solid #ccc; border-radius: 8px;
}
button {
    width: 100%; background: #0077b6; color: white;
    border: none; padding: 10px; border-radius: 8px;
    cursor: pointer; transition: 0.3s;
}
button:hover { background: #023e8a; }
.error { color: red; text-align: center; }
a { text-decoration: none; color: #0077b6; }
</style>
</head>
<body>
<div class="container">
    <h2>Login Akun</h2>
    <form method="post">
        <label>Username:</label>
        <input type="text" name="username" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <button type="submit" name="login">Masuk</button>
    </form>
    <p class="error"><?php if(isset($error)) echo $error; ?></p>
    <p style="text-align:center;">Belum punya akun? <a href="register.php">Daftar di sini</a></p>
</div>
</body>
</html>
