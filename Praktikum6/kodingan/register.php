<?php
include "koneksi.php";

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];

    $cek = mysqli_query($conn, "SELECT * FROM login WHERE username='$username'");
    if (mysqli_num_rows($cek) > 0) {
        $error = "Username sudah terdaftar!";
    } else {
        mysqli_query($conn, "INSERT INTO login VALUES('$username','$password','$gender')");
        $success = "User berhasil terdaftar! Silakan login.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Daftar Akun Baru</title>
<style>
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #00b4d8, #0077b6);
    color: #333;
    display: flex; justify-content: center; align-items: center;
    height: 100vh;
}
.container {
    background: white; padding: 40px; border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    width: 400px;
}
h2 { text-align: center; color: #0077b6; margin-bottom: 25px; }
input, select {
    width: 100%; padding: 10px; margin: 8px 0;
    border-radius: 8px; border: 1px solid #ccc;
}
button {
    width: 100%; background: #0077b6; color: white;
    padding: 10px; border: none; border-radius: 8px;
    cursor: pointer; transition: 0.3s;
}
button:hover { background: #023e8a; }
.message { text-align: center; margin-top: 10px; }
.success { color: green; }
.error { color: red; }
a { text-decoration: none; color: #0077b6; }
</style>
</head>
<body>
<div class="container">
    <h2>Form Pendaftaran</h2>
    <form method="post">
        <label>Username:</label>
        <input type="text" name="username" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <label>Gender:</label>
        <select name="gender">
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select>

        <button type="submit" name="submit">Daftar</button>
    </form>
    <div class="message">
        <?php 
        if(isset($success)) echo "<p class='success'>$success</p>";
        if(isset($error)) echo "<p class='error'>$error</p>";
        ?>
        <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
    </div>
</div>
</body>
</html>
