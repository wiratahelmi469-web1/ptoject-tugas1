<?php
session_start();

/* ================= AMBIL PAGE ================= */
$page = $_GET['page'] ?? 'home';

/* ================= DAFTAR HALAMAN ================= */
$allowed_pages = ['home','about','contact','login','level','studies','logout'];

/* ================= VALIDASI PAGE ================= */
if (!in_array($page, $allowed_pages)) {
    $page = 'home';
}

/* ================= LOGOUT ================= */
if ($page === 'logout') {
    $_SESSION = [];
    session_destroy();
    header("Location: ?page=home"); // 🔥 balik ke home, bukan login
    exit;
}

/* ================= REDIRECT LOGIN ================= */
/* kalau sudah login tidak boleh ke login lagi */
if (isset($_SESSION['user']) && $page === 'login') {
    header("Location: ?page=home");
    exit;
}
?>

<!-- ================= HEADER ================= -->
<?php include 'layout/header.php'; ?>

<?php if ($page !== 'login') { ?>

  <!-- HERO -->
  <?php include 'layout/header_content.php'; ?>

  <!-- MENU -->
  <?php include 'layout/menu.php'; ?>

<?php } ?>

<?php if ($page === 'login') { ?>

  <!-- ================= LOGIN MODE ================= -->
  <div class="container mt-5">
    <?php include 'layout/main.php'; ?>
  </div>

<?php } else { ?>

  <!-- ================= APP MODE ================= -->
  <div class="container mt-4">
    <div class="row">

      <!-- SIDEBAR -->
      <div class="col-md-3">
        <?php include 'layout/sidebar.php'; ?>
      </div>

      <!-- MAIN CONTENT -->
      <div class="col-md-9">
        <?php include 'layout/main.php'; ?>
      </div>

    </div>
  </div>

<?php } ?>

<!-- ================= FOOTER ================= -->
<?php include 'layout/footer.php'; ?>