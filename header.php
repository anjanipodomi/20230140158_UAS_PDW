<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'asisten') {
    header("Location: " . BASE_URL . "login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Panel Asisten - <?= $pageTitle ?? 'Dashboard'; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<div class="flex h-screen">
    <aside class="w-64 bg-gray-800 text-white flex flex-col">
        <div class="p-6 text-center border-b border-gray-700">
            <h3 class="text-xl font-bold">Panel Asisten</h3>
            <p class="text-sm text-gray-400 mt-1"><?= htmlspecialchars($_SESSION['nama']) ?></p>
        </div>
        <nav class="flex-grow">
            <ul class="space-y-2 p-4">
                <?php 
                    $activeClass = 'bg-gray-900 text-white';
                    $inactiveClass = 'text-gray-300 hover:bg-gray-700 hover:text-white';
                ?>
                <li>
                    <a href="<?= BASE_URL ?>asisten/dashboard.php" class="<?= ($activePage == 'dashboard') ? $activeClass : $inactiveClass; ?> flex items-center px-4 py-3 rounded-md">
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="<?= BASE_URL ?>asisten/kelola_mata_praktikum.php" class="<?= ($activePage == 'mata_praktikum') ? $activeClass : $inactiveClass; ?> flex items-center px-4 py-3 rounded-md">
                        <span>Mata Praktikum</span>
                    </a>
                </li>
                <li>
                    <a href="<?= BASE_URL ?>asisten/kelola_modul.php" class="<?= ($activePage == 'modul') ? $activeClass : $inactiveClass; ?> flex items-center px-4 py-3 rounded-md">
                        <span>Manajemen Modul</span>
                    </a>
                </li>
                <li>
                    <a href="<?= BASE_URL ?>asisten/kelola_pengguna.php" class="<?= ($activePage == 'pengguna') ? $activeClass : $inactiveClass; ?> flex items-center px-4 py-3 rounded-md">
                        <span>Kelola Pengguna</span>
                    </a>
                </li>
                <li>
                    <a href="<?= BASE_URL ?>asisten/laporan_masuk.php" class="<?= ($activePage == 'laporan') ? $activeClass : $inactiveClass; ?> flex items-center px-4 py-3 rounded-md">
                        <span>Laporan Masuk</span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>
    <main class="flex-1 p-6 lg:p-10">
        <header class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-gray-800"><?= $pageTitle ?? 'Dashboard'; ?></h1>
            <a href="<?= BASE_URL ?>logout.php"
            class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg">
            Logout
        </a>
        </header>
