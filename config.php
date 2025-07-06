<?php
// Pengaturan Koneksi Database
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'sistempengumpulantugas'); // Pastikan nama database ini benar dan sudah ada di phpMyAdmin
define('DB_PORT', 3307); // Ganti jika XAMPP kamu pakai port lain

// Base URL (digunakan untuk redirect)
if (!defined('BASE_URL')) {
    define('BASE_URL', '/SistemPengumpulanTugas/');
}

// Buat koneksi ke database
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}
?>
