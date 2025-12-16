<?php
// koneksi.php

$host = "localhost";
$db   = "db_app";   // GANTI sesuai nama database kamu
$user = "root";     // default XAMPP
$pass = "";         // default XAMPP kosong
$charset = "utf8mb4";

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // tampilkan error PDO
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // hasil array asosiatif
    PDO::ATTR_EMULATE_PREPARES   => false,                  // prepared statement asli
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}
