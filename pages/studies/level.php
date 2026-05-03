<?php
if (!isset($_SESSION['user'])) {
  echo "<script>alert('Silakan login dulu');location='?page=login'</script>";
  exit;
}

include 'config/koneksi.php';

$aksi = $_GET['aksi'] ?? '';
?>


<?php
/* ===================== TAMBAH ===================== */
if ($aksi == 'tambah') {
?>

<form method="POST">

  <input type="text" name="nama" class="form-control mb-2" placeholder="Nama Level (TK, SD, SMP...)" required>

  <button name="simpan" class="btn btn-success">Simpan</button>
  <a href="?page=level" class="btn btn-secondary">Kembali</a>

</form>

<?php
if (isset($_POST['simpan'])) {
  $nama = $_POST['nama'];

  mysqli_query($koneksi, "INSERT INTO level(nama) VALUES('$nama')");

  echo "<script>alert('Data berhasil ditambahkan');location='?page=level'</script>";
}


/* ===================== EDIT ===================== */
} elseif ($aksi == 'edit') {

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM level WHERE id=$id"));
?>

<form method="POST">

<input type="text" name="nama" value="<?= $data['nama'] ?>" class="form-control mb-2" required>

<button name="update" class="btn btn-warning">Update</button>
<a href="?page=level" class="btn btn-secondary">Kembali</a>

</form>

<?php
if (isset($_POST['update'])) {
  $nama = $_POST['nama'];

  mysqli_query($koneksi, "UPDATE level SET nama='$nama' WHERE id=$id");

  echo "<script>alert('Data berhasil diupdate');location='?page=level'</script>";
}


/* ===================== TAMPIL DATA ===================== */
} else {

$query = mysqli_query($koneksi, "SELECT * FROM level");
?>
<div class="table-wrapper">
    
  <table class="table table-bordered">
  <tr>
  <th>No</th>
  <th>Nama</th>
  <th>Aksi</th>
  </tr>

  <?php $no=1; while($row = mysqli_fetch_assoc($query)) { ?>
  <tr>

  <td><?= $no++ ?></td>
  <td><?= $row['nama'] ?></td>

  <td style="text-align:center;">
  <div style="display:flex; justify-content:center; gap:6px;">

  <a href="?page=level&aksi=edit&id=<?= $row['id'] ?>"
    class="btn btn-warning"
    style="width:36px;height:36px;display:flex;align-items:center;justify-content:center;padding:0;"
    title="Edit">
    <i class="bi bi-pencil"></i>
  </a>

  <a href="?page=level&aksi=hapus&id=<?= $row['id'] ?>"
    class="btn btn-danger"
    style="width:36px;height:36px;display:flex;align-items:center;justify-content:center;padding:0;"
    onclick="return confirm('Yakin ingin hapus?')"
    title="Hapus">
    <i class="bi bi-trash"></i>
  </a>

  </div>
  </td>

  </tr>
  <?php } ?>

  </table>
</div>

<!-- 🔥 TOMBOL TAMBAH DI BAWAH -->
<div class="text-center mt-4">
  <a href="?page=level&aksi=tambah" class="btn btn-primary px-4">
    <i class="bi bi-plus-circle me-1"></i> Tambah Level
  </a>
</div>

<?php
}

/* ===================== HAPUS ===================== */
if ($aksi == 'hapus') {
$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM level WHERE id=$id");

echo "<script>alert('Data berhasil dihapus');location='?page=level'</script>";
}
?>