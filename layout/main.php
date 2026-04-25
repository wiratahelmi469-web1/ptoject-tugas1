<?php
$page = $_GET['page'] ?? 'home';

switch ($page) {

    case 'home':
        include 'pages/home.php';
        break;

    case 'about':
        include 'pages/about.php';
        break;

    case 'contact':
        include 'pages/contact.php';
        break;

    case 'login':
        include 'pages/login.php';
        break;

    case 'logout':
        include 'pages/logout.php';
        break;

    case 'level':
        include 'pages/studies/level.php';
        break;

    case 'studies':
        include 'pages/studies/studies.php';
        break;

    default:
        include 'pages/home.php';
}
?>