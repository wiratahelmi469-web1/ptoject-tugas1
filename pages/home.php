<div class="card mb-4 border-1">
  <div class="row g-0 align-items-center">

    <!-- FOTO -->
    <div class="col-md-4 text-center p-3">
      <img src="assets/img/profile.jpeg" 
           class="img-fluid rounded-circle shadow"
           style="width:150px; height:150px; object-fit:cover;">
    </div>

    <!-- TEXT -->
    <div class="col-md-8">
      <div class="card-body">

        <h4 class="fw-bold mb-2">HELMI WIRATA</h4>

        <p class="text-muted mb-2">
          Mahasiswa • Web Developer • UI/UX Enthusiast
        </p>

        <p class="card-text">
          Saya adalah seorang mahasiswa yang tertarik pada bidang UI/UX dan pengembangan web.
          Saya senang membangun tampilan yang user-friendly dan modern.
        </p>

        <!-- BUTTON -->
        <a href="?page=contact" class="btn btn-primary btn-sm mt-2">
          Contact Me
        </a>

      </div>
    </div>

  </div>
</div>

<?php
include 'config/koneksi.php';

$query = mysqli_query($koneksi, "
SELECT studies.*, level.nama as level_nama 
FROM studies 
JOIN level ON studies.idlevel = level.id
ORDER BY id DESC
");
?>

<h4 class="mt-4 mb-3">My Studies</h4>

<div class="row">

<?php while($row = mysqli_fetch_assoc($query)) { ?>

  <div class="col-md-4 mb-3">

    <div class="card shadow-sm border-0 h-100">

      <!-- FOTO -->
      <img src="assets/img/<?= $row['foto_sekolah'] ?>" 
           class="card-img-top"
           style="height:180px; object-fit:cover;">

      <!-- ISI -->
      <div class="card-body">

        <h5 class="fw-bold"><?= $row['nama'] ?></h5>

        <p class="text-muted mb-1">
          <?= $row['level_nama'] ?> • <?= $row['tahun_lulus'] ?>
        </p>

        <p class="card-text small">
          <?= substr($row['keterangan'], 0, 60) ?>...
        </p>

        <!-- BUTTON DETAIL -->
        <a href="?page=studies&aksi=detail&id=<?= $row['id'] ?>&from=home" 
           class="btn btn-primary btn-sm">
           Detail
        </a>

      </div>

    </div>

  </div>

<?php } ?>

</div>