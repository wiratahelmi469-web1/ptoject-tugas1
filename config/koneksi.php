<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_pemweb");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}