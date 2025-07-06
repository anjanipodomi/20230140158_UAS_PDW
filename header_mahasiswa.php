<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'mahasiswa') {
    header("Location: " . BASE_URL . "login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Panel Mahasiswa - <?= $pageTitle ?? 'Dashboard'; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <nav class="bg-blue-600 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <span class="text-white text-2xl font-bold">SIMPRAK</span>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            <?php 
                                $activeClass = 'bg-blue-700 text-white';
                                $inactiveClass = 'text-gray-200 hover:bg-blue-700 hover:text-white';
                            ?>
                            <a href="<?= BASE_URL ?>mahasiswa/dashboard.php" class="<?= ($activePage == 'dashboard') ? $activeClass : $inactiveClass; ?> px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                            <a href="<?= BASE_URL ?>mahasiswa/praktikum_saya.php" class="<?= ($activePage == 'my_courses') ? $activeClass : $inactiveClass; ?> px-3 py-2 rounded-md text-sm font-medium">Praktikum Saya</a>
                            <a href="<?= BASE_URL ?>mahasiswa/mata_praktikum.php" class="<?= ($activePage == 'courses') ? $activeClass : $inactiveClass; ?> px-3 py-2 rounded-md text-sm font-medium">Cari Praktikum</a>
                        </div>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="ml-4 flex items-center md:ml-6">
                    <a href="<?= BASE_URL ?>logout.php"
                    class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg">
                      Logout
                    </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="container mx-auto p-6 lg:p-8">