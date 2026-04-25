<?php
session_start();

if (!isset($_SESSION['user'])) {
  echo "<script>alert('Silakan login dulu');location='?page=login'</script>";
  exit;
}
?>

<?php include 'config/koneksi.php'; ?>

<h4>Data Level</h4>

<a href="?page=level&aksi=tambah" class="btn btn-primary mb-2">Tambah Level</a>

<?php
$aksi = $_GET['aksi'] ?? '';

if ($aksi == 'tambah') {
?>
  <form method="POST">
    <input type="text" name="nama" class="form-control mb-2" placeholder="Nama Level (TK, SD, SMP...)">
    <button name="simpan" class="btn btn-success">Simpan</button>
  </form>
<?php
  if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    mysqli_query($koneksi, "INSERT INTO level(nama) VALUES('$nama')");
    echo "<script>location='?page=level'</script>";
  }

} elseif ($aksi == 'edit') {
  $id = $_GET['id'];
  $data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM level WHERE id=$id"));
?>
  <form method="POST">
    <input type="text" name="nama" value="<?= $data['nama'] ?>" class="form-control mb-2">
    <button name="update" class="btn btn-warning">Update</button>
  </form>
<?php
  if (isset($_POST['update'])) {
    mysqli_query($koneksi, "UPDATE level SET nama='$_POST[nama]' WHERE id=$id");
    echo "<script>location='?page=level'</script>";
  }

} else {
  $query = mysqli_query($koneksi, "SELECT * FROM level");
?>
  <table class="table table-bordered">
    <tr><th>No</th><th>Nama</th><th>Aksi</th></tr>
    <?php $no=1; while($row = mysqli_fetch_assoc($query)) { ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= $row['nama'] ?></td>
        <td>
          <a href="?page=level&aksi=edit&id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
          <a href="?page=level&aksi=hapus&id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Hapus</a>
        </td>
      </tr>
    <?php } ?>
  </table>
<?php
}

if ($aksi == 'hapus') {
  $id = $_GET['id'];
  mysqli_query($koneksi, "DELETE FROM level WHERE id=$id");
  echo "<script>location='?page=level'</script>";
}
?>