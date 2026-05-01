<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>


<nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow-sm sticky-top">
  <div class="container">

    <a class="navbar-brand fw-bold" href="?page=home">
      <i class="bi bi-person-circle me-1"></i> MyProfile
    </a>

    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-center">

        <li class="nav-item">
          <a class="nav-link nav-hover" href="?page=home">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link nav-hover" href="?page=about">About</a>
        </li>

        <li class="nav-item">
          <a class="nav-link nav-hover" href="?page=contact">Contact</a>
        </li>

        <!-- Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle nav-hover" data-bs-toggle="dropdown">
            Studies
          </a>
          <ul class="dropdown-menu shadow">
            <li><a class="dropdown-item" href="?page=level">Level</a></li>
            <li><a class="dropdown-item" href="?page=studies">Studies</a></li>
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
              <li><span class="dropdown-item-text small text-muted">
                Role: <?= $_SESSION['role'] ?>
              </span></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item text-danger" href="?page=logout">Logout</a></li>
            </ul>
          </li>

        <?php } ?>

       

      </ul>
    </div>

  </div>
</nav>