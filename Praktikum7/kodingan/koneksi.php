<?php
$koneksi = mysqli_connect("localhost", "root", "", "foto");

if (!$koneksi) {
    die("Gagal koneksi: " . mysqli_connect_error());
}
?>
