<?php include 'config/koneksi.php'; ?>

<div class="row align-items-stretch">

  <!-- ================= LEFT ================= -->
  <div class="col-md-7 d-flex flex-column">

    <!-- STATS -->
    <div class="card shadow-sm border-0 mb-2">
      <div class="card-body py-2">

        <div class="row text-center g-2">

          <div class="col-6 col-md-3">
            <i class="bi bi-mortarboard fs-5 text-primary"></i>
            <div class="fw-semibold" style="font-size:14px;">5</div>
            <small class="text-muted" style="font-size:11px;">Level</small>
          </div>

          <div class="col-6 col-md-3">
            <i class="bi bi-book fs-5 text-success"></i>
            <div class="fw-semibold" style="font-size:14px;">5</div>
            <small class="text-muted" style="font-size:11px;">Studies</small>
          </div>

          <div class="col-6 col-md-3">
            <i class="bi bi-code-slash fs-5 text-warning"></i>
            <div class="fw-semibold" style="font-size:14px;">10+</div>
            <small class="text-muted" style="font-size:11px;">Project</small>
          </div>

          <div class="col-6 col-md-3">
            <i class="bi bi-briefcase fs-5 text-danger"></i>
            <div class="fw-semibold" style="font-size:14px;">3</div>
            <small class="text-muted" style="font-size:11px;">Experience</small>
          </div>

        </div>

      </div>
    </div>

    <!-- ABOUT -->
    <div class="card shadow-sm border-0 mb-3">
      <div class="card-body">
        <h5 class="fw-bold mb-2">About Me</h5>
        <p class="small mb-0">
          Saya adalah mahasiswa yang berfokus pada Web Development dan UI/UX Design, 
          dengan ketertarikan dalam membangun tampilan website yang modern, responsif, 
          dan mudah digunakan menggunakan HTML, CSS, JavaScript, PHP, serta Figma.
        </p>
      </div>
    </div>

    <!-- LEVEL -->
    <div class="card shadow-sm border-0 flex-grow-1">
      <div class="card-body">

        <h5 class="fw-bold mb-2">Level Pendidikan</h5>

        <?php
        $level = mysqli_query($koneksi, "
        SELECT level.nama, MAX(studies.tahun_lulus) as tahun
        FROM level
        LEFT JOIN studies ON studies.idlevel = level.id
        GROUP BY level.id
        ORDER BY level.id ASC
        ");
        ?>

        <?php while($l = mysqli_fetch_assoc($level)) { ?>
          <div class="d-flex justify-content-between small mb-1">
            <span><?= $l['nama'] ?></span>
            <span class="text-muted"><?= $l['tahun'] ?></span>
          </div>
        <?php } ?>

      </div>
    </div>

  </div>

  <!-- ================= RIGHT ================= -->
  <div class="col-md-5 d-flex">

    <div class="card shadow-sm border-0 w-100 h-100">
      <div class="card-body d-flex flex-column">

        <h5 class="fw-bold mb-3">My Studies</h5>

        <div class="row flex-grow-1">

          <?php
          $query = mysqli_query($koneksi, "
          SELECT studies.*, level.nama as level_nama 
          FROM studies 
          JOIN level ON studies.idlevel = level.id
          ORDER BY id DESC
          LIMIT 4
          ");

          while($row = mysqli_fetch_assoc($query)) {
          ?>

            <div class="col-6 mb-3">
              <div class="card border-0 shadow-sm h-100">

                <img src="assets/img/<?= $row['foto_sekolah'] ?>"
                     class="card-img-top"
                     style="height:110px; object-fit:cover;">

                <div class="card-body p-2 text-center">
                  <small class="fw-bold d-block"><?= $row['nama'] ?></small>
                  <small class="text-muted"><?= $row['tahun_lulus'] ?></small>
                </div>

              </div>
            </div>

          <?php } ?>

        </div>

        <!-- VIEW MORE (POSISI BENAR DI BAWAH) -->
        <div class="text-center mt-auto">
          <a href="?page=studies" class="btn btn-outline-primary btn-sm px-3">
            View All
          </a>
        </div>

      </div>
    </div>

  </div>

</div>