<?php
require_once 'koneksi.php';

$action = $_POST['action'] ?? $_GET['action'] ?? '';

if ($action === 'add') {
    $nim = trim($_POST['nim']);
    $nama = trim($_POST['nama']);
    $alamat = trim($_POST['alamat']);

    if ($nim == '' || $nama == '') {
        header("Location: index.php?err=NIM dan Nama wajib diisi");
        exit;
    }

    $stmt = $mysqli->prepare("INSERT INTO mahasiswa (nim, nama, alamat) VALUES (?, ?, ?)");
    $stmt->bind_param('sss', $nim, $nama, $alamat);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php?msg=added");
    exit;
}

if ($action === 'edit') {
    $old_nim = $_POST['old_nim'];
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];

    $stmt = $mysqli->prepare("UPDATE mahasiswa SET nim=?, nama=?, alamat=? WHERE nim=?");
    $stmt->bind_param('ssss', $nim, $nama, $alamat, $old_nim);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php?msg=updated");
    exit;
}

if ($action === 'delete') {
    $nim = $_POST['nim'];

    $stmt = $mysqli->prepare("DELETE FROM mahasiswa WHERE nim=?");
    $stmt->bind_param('s', $nim);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php?msg=deleted");
    exit;
}
?>
