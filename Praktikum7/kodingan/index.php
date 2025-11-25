<?php include "koneksi.php"; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Galeri Foto Mahasiswa</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root {
            --bg: #f4f4f4;
            --card: white;
            --text: #333;
            --primary: #007bff;
            --danger: #dc3545;
        }

        body.dark {
            --bg: #121212;
            --card: #1f1f1f;
            --text: #f8f8f8;
        }

        body {
            margin: 0;
            font-family: Arial;
            background: var(--bg);
            color: var(--text);
        }

        header {
            padding: 18px;
            text-align: center;
            background: var(--primary);
            color: white;
            font-size: 22px;
            box-shadow: 0px 3px 8px rgba(0,0,0,0.3);
        }

        .toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            background: var(--card);
            padding: 10px 14px;
            border-radius: 50px;
            cursor: pointer;
            box-shadow: 0px 3px 8px rgba(0,0,0,0.3);
        }

        .container {
            width: 90%;
            margin: 25px auto;
        }

        .card {
            background: var(--card);
            padding: 15px;
            border-radius: 12px;
            box-shadow: 0px 3px 8px rgba(0,0,0,0.15);
            margin-bottom: 25px;
        }

        input[type="text"], input[type="file"] {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-top: 8px;
        }

        button {
            background: var(--primary);
            color: white;
            padding: 10px 15px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            border: none;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 15px;
        }

        .item {
            background: var(--card);
            padding: 10px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0px 3px 8px rgba(0,0,0,0.1);
        }

        .item img {
            width: 100%;
            height: 140px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid #eee;
            cursor: pointer;
        }

        .delete-btn {
            display: inline-block;
            margin-top: 8px;
            padding: 6px 10px;
            background: var(--danger);
            color: white;
            border-radius: 6px;
            text-decoration: none;
        }

        /* LIGHTBOX PREVIEW */
        .lightbox {
            display: none;
            position: fixed;
            top: 0; 
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.85);
            justify-content: center;
            align-items: center;
            z-index: 999;
        }

        .lightbox img {
            max-width: 90%;
            max-height: 85%;
            border-radius: 12px;
            box-shadow: 0px 3px 10px rgba(255,255,255,0.3);
        }

        .close-btn {
            position: absolute;
            top: 35px;
            right: 40px;
            font-size: 32px;
            color: white;
            cursor: pointer;
        }

    </style>
</head>

<body>

<header> GALERI FOTO MAHASISWA </header>

<div class="toggle" onclick="toggleDark()">
    <i class="fas fa-moon"></i>
</div>

<div class="container">

    <div class="card">
        <h3><i class="fa fa-upload"></i> Upload Foto</h3>

        <form action="" method="POST" enctype="multipart/form-data">
            Nama:
            <input type="text" name="nama" required>

            Pilih Foto:
            <input type="file" name="foto" required>

            <button type="submit" name="upload">
                <i class="fa fa-paper-plane"></i> Upload
            </button>
        </form>
    </div>

    <?php
    if (isset($_POST['upload'])) {
        $nama = $_POST['nama'];
        $foto = $_FILES['foto']['name'];
        $tmp  = $_FILES['foto']['tmp_name'];

        $extAllow = ['jpg','jpeg','png','gif'];
        $ext = strtolower(pathinfo($foto, PATHINFO_EXTENSION));

        if (!in_array($ext, $extAllow)) {
            echo "<script>alert('Format tidak didukung');</script>";
        } else {
            $namaBaru = time() . "-" . $foto;
            move_uploaded_file($tmp, "uploads/" . $namaBaru);

            mysqli_query($koneksi, 
                "INSERT INTO namasiswa (nama, foto)
                 VALUES ('$nama', '$namaBaru')");

            echo "<script>alert('Upload berhasil!');</script>";
        }
    }
    ?>

    <h3><i class="fa fa-images"></i> Galeri Foto</h3>

    <div class="grid">
        <?php
        $data = mysqli_query($koneksi, "SELECT * FROM namasiswa ORDER BY id DESC");
        while ($row = mysqli_fetch_assoc($data)) {
        ?>
            <div class="item">
                <img src="uploads/<?= $row['foto'] ?>" 
                     onclick="openLightbox('uploads/<?= $row['foto'] ?>')">

                <div style="margin-top:6px; font-weight:bold;">
                    <?= $row['nama'] ?>
                </div>

                <a class="delete-btn" 
                   href="delete.php?id=<?= $row['id'] ?>">
                   <i class="fa fa-trash"></i> Hapus
                </a>
            </div>
        <?php } ?>
    </div>

</div>

<!-- LIGHTBOX / PREVIEW -->
<div class="lightbox" id="lightbox">
    <span class="close-btn" onclick="closeLightbox()">&times;</span>
    <img id="previewImg">
</div>

<script>
function toggleDark() {
    document.body.classList.toggle("dark");
}

function openLightbox(src) {
    document.getElementById("lightbox").style.display = "flex";
    document.getElementById("previewImg").src = src;
}

function closeLightbox() {
    document.getElementById("lightbox").style.display = "none";
}
</script>

</body>
</html>
