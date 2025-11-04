<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Formulir Data Pengguna</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #00b4d8, #0077b6);
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: white;
            padding: 30px 40px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            width: 400px;
        }
        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #0077b6;
        }
        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
        input[type="submit"] {
            width: 100%;
            background: #0077b6;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }
        input[type="submit"]:hover {
            background: #023e8a;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Formulir Identitas</h2>
        <form method="post" action="proses.php">
            <label>Nama Lengkap:</label>
            <input type="text" name="nama" placeholder="Masukkan nama anda" required>

            <label>Umur:</label>
            <input type="text" name="umur" placeholder="Masukkan umur anda" required>

            <label>Email:</label>
            <input type="email" name="email" placeholder="Masukkan email anda" required>

            <input type="submit" value="Kirim Data">
        </form>
    </div>
</body>
</html>
