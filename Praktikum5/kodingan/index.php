<?php
require_once 'koneksi.php';
$res = $mysqli->query("SELECT * FROM mahasiswa ORDER BY created_at DESC");
$rows = $res->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Manajemen Data Mahasiswa</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body { padding-top: 70px; }
.table-wrap { overflow-x:auto; }
</style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
  <div class="container">
    <a class="navbar-brand" href="#">Aplikasi Data Mahasiswa</a>
  </div>
</nav>

<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Data Mahasiswa</h2>
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAdd">+ Tambah</button>
  </div>

  <?php if(isset($_GET['msg'])): ?>
    <div class="alert alert-success">
      <?php 
        if($_GET['msg']=='added') echo '✅ Data berhasil ditambahkan!';
        elseif($_GET['msg']=='updated') echo '✏️ Data berhasil diperbarui!';
        elseif($_GET['msg']=='deleted') echo '🗑️ Data berhasil dihapus!';
      ?>
    </div>
  <?php elseif(isset($_GET['err'])): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($_GET['err']); ?></div>
  <?php endif; ?>

  <div class="card">
    <div class="card-body table-wrap">
      <table class="table table-striped table-hover">
        <thead class="table-primary">
          <tr>
            <th>#</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if(empty($rows)): ?>
            <tr><td colspan="5" class="text-center">Belum ada data</td></tr>
          <?php else: $i=1; foreach($rows as $r): ?>
            <tr>
              <td><?= $i++ ?></td>
              <td><?= htmlspecialchars($r['nim']) ?></td>
              <td><?= htmlspecialchars($r['nama']) ?></td>
              <td><?= htmlspecialchars($r['alamat']) ?></td>
              <td>
                <button class="btn btn-sm btn-info text-white btnEdit"
                        data-nim="<?= $r['nim'] ?>"
                        data-nama="<?= $r['nama'] ?>"
                        data-alamat="<?= $r['alamat'] ?>">Edit</button>
                <button class="btn btn-sm btn-danger btnDelete" data-nim="<?= $r['nim'] ?>">Hapus</button>
              </td>
            </tr>
          <?php endforeach; endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalAdd" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content" method="post" action="handler.php">
      <input type="hidden" name="action" value="add">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label>NIM*</label>
          <input type="text" name="nim" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Nama*</label>
          <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Alamat</label>
          <input type="text" name="alamat" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success">Simpan</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content" method="post" action="handler.php">
      <input type="hidden" name="action" value="edit">
      <input type="hidden" name="old_nim" id="old_nim">
      <div class="modal-header">
        <h5 class="modal-title">Edit Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label>NIM*</label>
          <input type="text" name="nim" id="edit_nim" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Nama*</label>
          <input type="text" name="nama" id="edit_nama" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Alamat</label>
          <input type="text" name="alamat" id="edit_alamat" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary">Simpan Perubahan</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="modalDelete" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content" method="post" action="handler.php">
      <input type="hidden" name="action" value="delete">
      <input type="hidden" name="nim" id="delete_nim">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">Hapus Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        Yakin ingin menghapus data NIM <b id="delete_nim_text"></b>?
      </div>
      <div class="modal-footer">
        <button class="btn btn-light" type="button" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-danger">Hapus</button>
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.querySelectorAll('.btnEdit').forEach(btn=>{
  btn.addEventListener('click',()=>{
    document.getElementById('old_nim').value = btn.dataset.nim;
    document.getElementById('edit_nim').value = btn.dataset.nim;
    document.getElementById('edit_nama').value = btn.dataset.nama;
    document.getElementById('edit_alamat').value = btn.dataset.alamat;
    new bootstrap.Modal(document.getElementById('modalEdit')).show();
  });
});

document.querySelectorAll('.btnDelete').forEach(btn=>{
  btn.addEventListener('click',()=>{
    document.getElementById('delete_nim').value = btn.dataset.nim;
    document.getElementById('delete_nim_text').textContent = btn.dataset.nim;
    new bootstrap.Modal(document.getElementById('modalDelete')).show();
  });
});
</script>

</body>
</html>
