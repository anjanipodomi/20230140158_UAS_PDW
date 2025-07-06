<?php
require_once __DIR__ . '/../config.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'asisten') {
    header("Location: " . BASE_URL . "login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $laporan_id = $_POST['laporan_id'];
    $nilai = $_POST['nilai'];

    $stmt = $conn->prepare("UPDATE laporan SET nilai = ? WHERE id = ?");
    $stmt->bind_param("ii", $nilai, $laporan_id);
    $stmt->execute();
}

header("Location: laporan_masuk.php");
exit;
