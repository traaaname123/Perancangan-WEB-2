<?php
include 'koneksi.php';

$nama    = $_POST['nama'];
$nisn    = $_POST['nisn'];
$jurusan = $_POST['jurusan'];
$alamat  = $_POST['alamat'];

$sql = "INSERT INTO siswa (nama, nisn, jurusan, alamat) 
        VALUES ('$nama', '$nisn', '$jurusan', '$alamat')";

if (mysqli_query($conn, $sql)) {
    echo "<h3>Data berhasil disimpan!</h3>";
    echo "<a href='form_siswa.html'>Kembali ke Form</a>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
