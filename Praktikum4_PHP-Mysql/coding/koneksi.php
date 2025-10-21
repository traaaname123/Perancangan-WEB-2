<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "sekolahsmk"; // nama database diganti jadi data_siswa

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
