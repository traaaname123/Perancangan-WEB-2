<?php
include("conn.php"); // Memasukkan file koneksi

// 1. Hitung total baris: dari tabel `anggota`
$query = mysqli_query($conn, "select count(anggotaid) from `anggota`"); // Menghitung total anggota
$row = mysqli_fetch_row($query);
$rows = $row[0]; // Total data

// 2. Tentukan variabel pagination (tidak ada perubahan di sini)
$page_rows = 10;
$last = ceil($rows / $page_rows);

if ($last < 1) {
    $last = 1;
}

// 3. Tentukan halaman saat ini (tidak ada perubahan di sini)
$pagenum = 1; 
if (isset($_GET['pn'])) {
    $pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
}
if ($pagenum < 1) {
    $pagenum = 1;
} else if ($pagenum > $last) {
    $pagenum = $last;
}

// 4. Buat klausa LIMIT (tidak ada perubahan di sini)
$limit = 'LIMIT ' . ($pagenum - 1) * $page_rows . ',' . $page_rows;

// 5. Ambil data untuk halaman ini: dari tabel `anggota`
$nquery = mysqli_query($conn, "select * from `anggota` $limit"); // Query data dari tabel anggota

// 6. Buat kontrol pagination (tidak ada perubahan di sini)
$paginationCtrls = ''; 
// ... (Logika pembuatan tombol Previous/Next/Nomor halaman) ...
if ($last != 1) { 
    if ($pagenum > 1) {
        $previous = $pagenum - 1;
        $paginationCtrls .= '<a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $previous . '" class="btn btn-default">Previous</a> &nbsp; &nbsp; '; 
        
        for ($i = $pagenum - 4; $i < $pagenum; $i++) {
            if ($i > 0) {
                $paginationCtrls .= '<a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $i . '" class="btn btn-default">' . $i . '</a> &nbsp; ';
            }
        }
    }
    
    $paginationCtrls .= "$pagenum &nbsp; ";
    
    for ($i = $pagenum + 1; $i <= $last; $i++) {
        $paginationCtrls .= '<a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $i . '" class="btn btn-default">' . $i . '</a> &nbsp; ';
        if ($i >= $pagenum + 4) { 
            break;
        }
    }
    
    if ($pagenum != $last) {
        $next = $pagenum + 1;
        $paginationCtrls .= ' &nbsp; &nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $next . '" class="btn btn-default">Next</a>';
    }
}
?>