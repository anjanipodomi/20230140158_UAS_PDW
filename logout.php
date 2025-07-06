<?php
session_start();

// Hapus semua variabel session
$_SESSION = array();

// Hancurkan session
session_destroy();

// Redirect ke halaman login dengan BASE_URL
require_once __DIR__ . '/config.php';
header("Location: " . BASE_URL . "login.php");
exit;
?>
