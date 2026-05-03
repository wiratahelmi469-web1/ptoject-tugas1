<?php
// pastikan variabel $page tersedia
$page = $page ?? ($_GET['page'] ?? 'home');
?>

<div class="sidebar-card shadow">

  <!-- PROFILE -->
  <div class="text-center p-3 border-bottom">

    <img src="assets/img/profile.jpeg"
         class="rounded-circle mb-2"
         style="width:80px; height:80px; object-fit:cover;">

    <h6 class="fw-bold mb-0">Helmi Wirata</h6>
    <span class="badge bg-success mt-1">Online</span>

  </div>

  <!-- INFO -->
  <div class="p-3 small ">

    <p class="mb-1"><i class="bi bi-geo-alt"></i> Bogor, Indonesia</p>
    <p class="mb-1"><i class="bi bi-mortarboard"></i> Sistem Informasi</p>
    <p class="mb-1"><i class="bi bi-building"></i> STT Nurul Fikri</p>
    <div class="d-flex align-items-center mb-2">
        <i class="bi bi-envelope me-2"></i>
        <span>wiratahelmi469@gmail.com</span>
      </div>

    <div class="mt-2 fst-italic">
      "Code is like humor. When you have to explain it, it's bad."
    </div>

  </div>

  <!-- MENU -->
  <div class="list-group list-group-flush">

    <a href="?page=home"
       class="list-group-item list-group-item-action <?= ($page == 'home') ? 'active' : '' ?>">
       <i class="bi bi-house-door me-2"></i> Home
    </a>

    <a href="?page=about"
       class="list-group-item list-group-item-action <?= ($page == 'about') ? 'active' : '' ?>">
       <i class="bi bi-person me-2"></i> About
    </a>

    <a href="?page=studies"
       class="list-group-item list-group-item-action <?= ($page == 'studies') ? 'active' : '' ?>">
       <i class="bi bi-book me-2"></i> Studies
    </a>

    <a href="?page=contact"
       class="list-group-item list-group-item-action <?= ($page == 'contact') ? 'active' : '' ?>">
       <i class="bi bi-envelope me-2"></i> Contact
    </a>

  </div>

</div>