<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#">MyProfile</a>

    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">

        <li class="nav-item"><a class="nav-link" href="?page=home">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="?page=about">About Me</a></li>
        <li class="nav-item"><a class="nav-link" href="?page=contact">Contact Me</a></li>

        <!-- My Studies -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">My Studies</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="?page=level">Level</a></li>
            <li><a class="dropdown-item" href="?page=studies">Studies</a></li>
          </ul>
        </li>

        <!-- LOGIN / USER -->
        <?php if (!isset($_SESSION['user'])) { ?>

          <li class="nav-item">
            <a class="nav-link" href="?page=login">Login</a>
          </li>

        <?php } else { ?>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
              <?= $_SESSION['user'] ?> (<?= $_SESSION['role'] ?>)
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="?page=logout">Logout</a></li>
            </ul>
          </li>

        <?php } ?>

      </ul>
    </div>
  </div>
</nav>