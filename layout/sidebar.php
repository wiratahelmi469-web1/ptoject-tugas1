<div class="sidebar-card p-3 shadow-sm">

  <h6 class="fw-bold mb-3 text-center">Menu</h6>

  <div class="list-group list-group-flush">

    <a href="?page=home" 
       class="list-group-item list-group-item-action sidebar-link <?= ($_GET['page'] ?? 'home') == 'home' ? 'active' : '' ?>">
       <i class="bi bi-house-door me-2"></i> Home
    </a>

    <a href="?page=about" 
       class="list-group-item list-group-item-action sidebar-link <?= ($_GET['page'] ?? '') == 'about' ? 'active' : '' ?>">
       <i class="bi bi-person me-2"></i> About Me
    </a>

    <a href="?page=contact" 
       class="list-group-item list-group-item-action sidebar-link <?= ($_GET['page'] ?? '') == 'contact' ? 'active' : '' ?>">
       <i class="bi bi-envelope me-2"></i> Contact
    </a>

  </div>

</div>