<?php
require_once '../config.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'mahasiswa') {
    header("Location: " . BASE_URL . "login.php");
    exit();
}

$laporan_id = intval($_GET['id']);
$user_id = $_SESSION['user_id'];

// Ambil data laporan dan cek kepemilikan
$query = "SELECT l.*, m.praktikum_id FROM laporan l
          JOIN modul m ON l.modul_id = m.id
          WHERE l.id = ? AND l.user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $laporan_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$laporan = $result->fetch_assoc();

if (!$laporan) {
    echo "Laporan tidak ditemukan atau bukan milik Anda.";
    exit;
}

// Hapus file dari folder uploads
$filePath = '../uploads/' . $laporan['file_laporan'];
if (file_exists($filePath)) {
    unlink($filePath);
}

// Hapus data dari database
$stmt = $conn->prepare("DELETE FROM laporan WHERE id = ?");
$stmt->bind_param("i", $laporan_id);
$stmt->execute();

// Redirect kembali ke halaman detail praktikum
header("Location: detail_praktikum.php?id=" . $laporan['praktikum_id']);
exit;
