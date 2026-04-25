<?php

if (!isset($_SESSION['user'])) {
  echo "<script>alert('Silakan login dulu');location='?page=login'</script>";
  exit;
}
?>

<?php include 'config/koneksi.php'; ?>

<h4>Data Studies</h4>
<a href="?page=studies&aksi=tambah" class="btn btn-primary mb-3">Tambah Studies</a>

<?php
$aksi = $_GET['aksi'] ?? '';

/* ===================== TAMBAH ===================== */
if ($aksi == 'tambah') {
  $level = mysqli_query($koneksi, "SELECT * FROM level");
?>

<form method="POST" enctype="multipart/form-data">
  <input type="text" name="nama" class="form-control mb-2" placeholder="Nama Sekolah" required>

  <select name="idlevel" class="form-control mb-2" required>
    <?php while($l = mysqli_fetch_assoc($level)) { ?>
      <option value="<?= $l['id'] ?>"><?= $l['nama'] ?></option>
    <?php } ?>
  </select>

  <textarea name="keterangan" class="form-control mb-2" placeholder="Keterangan"></textarea>

  <input type="number" name="tahun_lulus" class="form-control mb-2" placeholder="Tahun Lulus" min="1900" max="2099" required>

  <input type="file" name="foto" class="form-control mb-2">

  <button name="simpan" class="btn btn-success">Simpan</button>
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

  echo "<script>alert('Data berhasil ditambahkan');location='?page=studies'</script>";
}

/* ===================== EDIT ===================== */
} elseif ($aksi == 'edit') {

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM studies WHERE id=$id"));
$level = mysqli_query($koneksi, "SELECT * FROM level");
?>

<h4>Edit Studies</h4>

<form method="POST" enctype="multipart/form-data">

<input type="text" name="nama" id="nama"
value="<?= htmlspecialchars($data['nama']) ?>"
class="form-control mb-2" required>

<select name="idlevel" class="form-control mb-2">
<?php while($l = mysqli_fetch_assoc($level)) { ?>
<option value="<?= $l['id'] ?>" <?= $l['id']==$data['idlevel']?'selected':'' ?>>
<?= $l['nama'] ?>
</option>
<?php } ?>
</select>

<textarea name="keterangan" id="keterangan" class="form-control mb-2"><?= htmlspecialchars($data['keterangan']) ?></textarea>

<input type="number" name="tahun_lulus" id="tahun_lulus"
value="<?= $data['tahun_lulus'] ?>"
class="form-control mb-2" min="1900" max="2099">

<input type="file" name="foto" id="foto" class="form-control mb-2">

<p>Foto saat ini:</p>
<img src="assets/img/<?= $data['foto_sekolah'] ?>" id="preview-img" width="120" class="mb-2">

<div class="border p-3 rounded">
<h5>Preview</h5>
<p>Nama: <span id="prev-nama"><?= $data['nama'] ?></span></p>
<p>Keterangan: <span id="prev-ket"><?= $data['keterangan'] ?></span></p>
<p>Tahun: <span id="prev-tahun"><?= $data['tahun_lulus'] ?></span></p>
</div>

<button name="update" class="btn btn-success mt-3">Update</button>
</form>

<script>
document.getElementById('nama').oninput = e =>
document.getElementById('prev-nama').innerText = e.target.value;

document.getElementById('keterangan').oninput = e =>
document.getElementById('prev-ket').innerText = e.target.value;

document.getElementById('tahun_lulus').oninput = e =>
document.getElementById('prev-tahun').innerText = e.target.value;

document.getElementById('foto').onchange = function(e){
const file = e.target.files[0];
if(file){
const reader = new FileReader();
reader.onload = function(e){
document.getElementById('preview-img').src = e.target.result;
}
reader.readAsDataURL(file);
}
}
</script>

<?php
if (isset($_POST['update'])) {

$nama = $_POST['nama'];
$idlevel = $_POST['idlevel'];
$ket = $_POST['keterangan'];
$tahun = $_POST['tahun_lulus'];

$foto = $_FILES['foto']['name'];

if ($foto != "") {
move_uploaded_file($_FILES['foto']['tmp_name'], "assets/img/".$foto);

mysqli_query($koneksi, "UPDATE studies SET
nama='$nama',
idlevel='$idlevel',
keterangan='$ket',
tahun_lulus='$tahun',
foto_sekolah='$foto'
WHERE id=$id");
} else {
mysqli_query($koneksi, "UPDATE studies SET
nama='$nama',
idlevel='$idlevel',
keterangan='$ket',
tahun_lulus='$tahun'
WHERE id=$id");
}

echo "<script>alert('Data berhasil diupdate');location='?page=studies'</script>";
}

/* ===================== DETAIL ===================== */
} elseif ($aksi == 'detail') {

$id = $_GET['id'];

$data = mysqli_fetch_assoc(mysqli_query($koneksi, "
SELECT studies.*, level.nama as level_nama
FROM studies
JOIN level ON studies.idlevel = level.id
WHERE studies.id = $id
"));
?>

<div class="card shadow">
<div class="row g-0">

<div class="col-md-4 text-center p-3">
<img src="assets/img/<?= $data['foto_sekolah'] ?>" class="img-fluid rounded" style="max-height:250px;">
</div>

<div class="col-md-8">
<div class="card-body">

<h4><?= $data['nama'] ?></h4>

<p><strong>Level:</strong> <?= $data['level_nama'] ?></p>
<p><strong>Tahun:</strong> <?= $data['tahun_lulus'] ?></p>

<p><strong>Keterangan:</strong><br>
<?= nl2br($data['keterangan']) ?></p>

<a href="?page=studies" class="btn btn-secondary">Kembali</a>

</div>
</div>

</div>
</div>

<?php
/* ===================== TAMPIL DATA ===================== */
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
<a href="?page=studies&aksi=detail&id=<?= $row['id'] ?>" class="btn btn-info btn-sm">Detail</a>
<a href="?page=studies&aksi=edit&id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
<a href="?page=studies&aksi=hapus&id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Hapus</a>
</td>
</tr>
<?php } ?>

</table>

<?php
}

/* ===================== HAPUS ===================== */
if ($aksi == 'hapus') {
mysqli_query($koneksi, "DELETE FROM studies WHERE id=".$_GET['id']);
echo "<script>alert('Data dihapus');location='?page=studies'</script>";
}
?>