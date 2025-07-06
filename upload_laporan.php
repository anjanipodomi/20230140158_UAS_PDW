<?php
require_once __DIR__ . '/../config.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'mahasiswa') {
    header("Location: " . BASE_URL . "login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $modul_id = $_POST['modul_id'];
    $user_id = $_SESSION['user_id'];

    if (isset($_FILES['file_laporan']) && $_FILES['file_laporan']['error'] === UPLOAD_ERR_OK) {
        $fileName = $_FILES['file_laporan']['name'];
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        $newName = 'laporan_' . time() . '.' . $ext;

        move_uploaded_file($_FILES['file_laporan']['tmp_name'], '../../uploads/' . $newName);

        $stmt = $conn->prepare("INSERT INTO laporan (user_id, modul_id, file_laporan) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $user_id, $modul_id, $newName);
        $stmt->execute();
    }
}

header("Location: detail_praktikum.php?id=" . $_POST['praktikum_id']);
exit;
