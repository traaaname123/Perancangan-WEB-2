<?php
include "koneksi.php";

$id = $_GET['id'];

$data = mysqli_query($koneksi, "SELECT foto FROM namasiswa WHERE id=$id");
$row = mysqli_fetch_assoc($data);

unlink("uploads/" . $row['foto']);

mysqli_query($koneksi, "DELETE FROM namasiswa WHERE id=$id");

header("Location: index.php");
exit;
?>
