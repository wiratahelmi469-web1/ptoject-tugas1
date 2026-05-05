<?php
$aksi = $_GET['aksi'] ?? '';

if (in_array($aksi, ['tambah','edit','hapus'])) {
  if (!isset($_SESSION['user'])) {
    echo "<script>alert('Harus login dulu');location='?page=login'</script>";
    exit;
  }
}
?>

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

  $level = mysqli_query($koneksi, "SELECT * FROM level");
?>

<form method="POST" enctype="multipart/form-data">

  <input type="text" name="nama" class="form-control mb-2" placeholder="Nama Sekolah" required>

  <select name="idlevel" class="form-control mb-2">
    <?php while($l = mysqli_fetch_assoc($level)) { ?>
      <option value="<?= $l['id'] ?>"><?= $l['nama'] ?></option>
    <?php } ?>
  </select>

  <textarea name="keterangan" class="form-control mb-2" placeholder="Keterangan"></textarea>

  <input type="number" name="tahun_lulus" class="form-control mb-2" placeholder="Tahun Lulus">

  <input type="file" name="foto" id="foto" class="form-control mb-2">

  <button name="simpan" class="btn btn-success">Simpan</button>
  <a href="?page=studies" class="btn btn-secondary">Kembali</a>

</form>

<?php
if (isset($_POST['simpan'])) {

  $nama = $_POST['nama'];
  $idlevel = $_POST['idlevel'];
  $ket = $_POST['keterangan'];
  $tahun = $_POST['tahun_lulus'];

  $foto = $_FILES['foto']['name'];

  if ($foto != "") {
    move_uploaded_file($_FILES['foto']['tmp_name'], "assets/img/".$foto);
  }

  mysqli_query($koneksi, "INSERT INTO studies(nama,idlevel,keterangan,tahun_lulus,foto_sekolah)
  VALUES('$nama','$idlevel','$ket','$tahun','$foto')");

  echo "<script>location='?page=studies'</script>";
}
?>

<?php
/* ===================== EDIT ===================== */
} elseif ($aksi == 'edit') {

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM studies WHERE id=$id"));
$level = mysqli_query($koneksi, "SELECT * FROM level");
?>

<form method="POST" enctype="multipart/form-data">

<input type="hidden" name="foto_lama" value="<?= $data['foto_sekolah'] ?>">

<input type="text" name="nama" value="<?= $data['nama'] ?>" class="form-control mb-2">

<select name="idlevel" class="form-control mb-2">
<?php while($l = mysqli_fetch_assoc($level)) { ?>
<option value="<?= $l['id'] ?>" <?= $l['id']==$data['idlevel']?'selected':'' ?>>
<?= $l['nama'] ?>
</option>
<?php } ?>
</select>

<textarea name="keterangan" class="form-control mb-2"><?= $data['keterangan'] ?></textarea>

<input type="number" name="tahun_lulus" value="<?= $data['tahun_lulus'] ?>" class="form-control mb-2">

<input type="file" name="foto" class="form-control mb-2">

<small class="text-muted">File: <?= $data['foto_sekolah'] ?></small>

<br><br>

<button name="update" class="btn btn-success">Update</button>
<a href="?page=studies" class="btn btn-secondary">Kembali</a>

</form>

<?php
if (isset($_POST['update'])) {

  $nama = $_POST['nama'];
  $idlevel = $_POST['idlevel'];
  $ket = $_POST['keterangan'];
  $tahun = $_POST['tahun_lulus'];
  $foto_lama = $_POST['foto_lama'];

  if (!empty($_FILES['foto']['name'])) {
    $foto = $_FILES['foto']['name'];
    move_uploaded_file($_FILES['foto']['tmp_name'], "assets/img/".$foto);
  } else {
    $foto = $foto_lama;
  }

  mysqli_query($koneksi, "
  UPDATE studies SET
  nama='$nama',
  idlevel='$idlevel',
  keterangan='$ket',
  tahun_lulus='$tahun',
  foto_sekolah='$foto'
  WHERE id=$id
  ");

  echo "<script>location='?page=studies'</script>";
}
?>

<?php
/* ===================== LIST ===================== */
} else {

$query = mysqli_query($koneksi, "
SELECT studies.*, level.nama as level_nama 
FROM studies 
JOIN level ON studies.idlevel = level.id
");
?>

<table class="table table-bordered">
<tr>
<th>No</th><th>Nama</th><th>Level</th><th>Tahun</th><th>Foto</th><th>Aksi</th>
</tr>

<?php $no=1; while($row = mysqli_fetch_assoc($query)) { ?>
<tr>

<td><?= $no++ ?></td>
<td><?= $row['nama'] ?></td>
<td><?= $row['level_nama'] ?></td>
<td><?= $row['tahun_lulus'] ?></td>
<td><img src="assets/img/<?= $row['foto_sekolah'] ?>" width="80"></td>

<td>
<div style="display:flex; gap:5px; justify-content:center;">

<!-- DETAIL MODAL -->
<a href="#" class="btn btn-info btn-sm"
   data-bs-toggle="modal"
   data-bs-target="#modal<?= $row['id'] ?>">
  <i class="bi bi-eye"></i>
</a>

<a href="?page=studies&aksi=edit&id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">
  <i class="bi bi-pencil"></i>
</a>

<a href="?page=studies&aksi=hapus&id=<?= $row['id'] ?>"
   class="btn btn-danger btn-sm"
   onclick="return confirm('Yakin?')">
  <i class="bi bi-trash"></i>
</a>

</div>

<!-- MODAL -->
<div class="modal fade" id="modal<?= $row['id'] ?>" tabindex="-1">
  <div class="modal-dialog" style="max-width:500px;">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title"><?= $row['nama'] ?></h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <div style="display:flex; justify-content:center;">
            <img src="assets/img/<?= $row['foto_sekolah'] ?>"
             style="width:100%; max-width:400px; height:200px; object-fit:cover; border-radius:10px;">
        </div>

        <div class="d-flex justify-content-center gap-3 mb-3 text-muted small">
          <span class="me-3">
            <i class="bi bi-mortarboard"></i> <?= $row['level_nama'] ?>
          </span>

          <span>
            <i class="bi bi-calendar"></i> <?= $row['tahun_lulus'] ?>
          </span>
        </div>

        <p style="text-align:justify;">
          <?= $row['keterangan'] ?>
        </p>

      </div>

    </div>
  </div>
</div>

</td>

</tr>
<?php } ?>

</table>

<?php if ($aksi == '') { ?>
  <div class="text-center mt-4">
    <a href="?page=studies&aksi=tambah" class="btn btn-primary px-4">
      <i class="bi bi-plus-circle me-1"></i> Tambah Studies
    </a>
  </div>
<?php } ?>

<?php
}

/* ===================== HAPUS ===================== */
if ($aksi == 'hapus') {
mysqli_query($koneksi, "DELETE FROM studies WHERE id=".$_GET['id']);
echo "<script>location='?page=studies'</script>";
}
?>

