<?php
session_start();

$page = $_GET['page'] ?? 'home';

// kalau belum login & bukan di halaman login
if (!isset($_SESSION['user']) && $page != 'login') {
    header("Location: ?page=login");
    exit;
}
?>

<?php include 'layout/header.php'; ?>
<?php include 'layout/menu.php'; ?>
<?php include 'layout/header_content.php'; ?>

<div class="container mt-4">
  <div class="row">

    <div class="col-md-3">
      <?php include 'layout/sidebar.php'; ?>
    </div>

    <div class="col-md-9">
      <?php include 'layout/main.php'; ?>
    </div>

  </div>
</div>

<?php include 'layout/footer.php'; ?>