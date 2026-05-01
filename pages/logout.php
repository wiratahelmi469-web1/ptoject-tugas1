<?php
// pastikan session aktif (tanpa error)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// hapus semua data session
$_SESSION = [];

// hancurkan session
session_destroy();

// redirect ke login
header("Location: ?page=login");
exit;