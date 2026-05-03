<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$currentPage = $_GET['page'] ?? 'home';
$isStudies = in_array($currentPage, ['level','studies']);

/* 🔥 dropdown title dinamis */
$dropdownTitle = 'Studies';
if ($currentPage == 'level') {
    $dropdownTitle = 'Level';
} elseif ($currentPage == 'studies') {
    $dropdownTitle = 'Studies';
}
?>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow-sm sticky-top">
  <div class="container">

    <!-- BRAND -->
    <a class="navbar-brand fw-bold" href="?page=home">
      <i class="bi bi-person-circle me-1"></i> MyProfile
    </a>

    <!-- TOGGLER -->
    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- MENU -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-center">

        <!-- HOME -->
        <li class="nav-item">
          <a class="nav-link nav-hover <?= $currentPage=='home' ? 'active' : '' ?>" href="?page=home">
            Home
          </a>
        </li>

        <!-- ABOUT -->
        <li class="nav-item">
          <a class="nav-link nav-hover <?= $currentPage=='about' ? 'active' : '' ?>" href="?page=about">
            About
          </a>
        </li>

        <!-- CONTACT -->
        <li class="nav-item">
          <a class="nav-link nav-hover <?= $currentPage=='contact' ? 'active' : '' ?>" href="?page=contact">
            Contact
          </a>
        </li>

        <!-- STUDIES DROPDOWN -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle nav-hover <?= $isStudies ? 'active' : '' ?>" data-bs-toggle="dropdown">
            <?= $dropdownTitle ?>
          </a>

          <ul class="dropdown-menu shadow">

            <li>
              <a class="dropdown-item <?= $currentPage=='level' ? 'active' : '' ?>" href="?page=level">
                Level
              </a>
            </li>

            <li>
              <a class="dropdown-item <?= $currentPage=='studies' ? 'active' : '' ?>" href="?page=studies">
                Studies
              </a>
            </li>

          </ul>
        </li>

        <!-- LOGIN / USER -->
        <?php if (!isset($_SESSION['user'])) { ?>

          <li class="nav-item ms-2">
            <a class="btn btn-outline-light btn-sm px-3" href="?page=login">
              Login
            </a>
          </li>

        <?php } else { ?>

          <li class="nav-item dropdown ms-2">
            <a class="nav-link dropdown-toggle user-pill" data-bs-toggle="dropdown">
              <i class="bi bi-person-circle me-1"></i>
              <?= ucfirst($_SESSION['user']) ?>
            </a>

            <ul class="dropdown-menu dropdown-menu-end shadow">
              <li>
                <span class="dropdown-item-text small text-muted">
                  Role: <?= $_SESSION['role'] ?>
                </span>
              </li>

              <li><hr class="dropdown-divider"></li>

              <li>
                <a class="dropdown-item text-danger" href="?page=logout">
                  Logout
                </a>
              </li>
            </ul>
          </li>

        <?php } ?>

      </ul>
    </div>

  </div>
</nav>