<?php
include 'koneksi2.php';

$nama_lengkap   = $_POST['nama_lengkap'];
$nisn           = $_POST['nisn'];
$jenis_kelamin  = $_POST['jenis_kelamin'];
$tanggal_lahir  = $_POST['tanggal_lahir'];
$jurusan        = $_POST['jurusan'];
$alamat         = $_POST['alamat'];

$sql = "INSERT INTO pendaftaran (nama_lengkap, nisn, jenis_kelamin, tanggal_lahir, jurusan, alamat)
        VALUES ('$nama_lengkap', '$nisn', '$jenis_kelamin', '$tanggal_lahir', '$jurusan', '$alamat')";

if (mysqli_query($conn, $sql)) {
    echo "<h3>Pendaftaran Berhasil!</h3>";
    echo "<p>Data Anda telah tersimpan di database.</p>";
    echo "<a href='form_pendaftaran.html'>Kembali ke Form</a>";
} else {
    echo "Terjadi kesalahan: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
