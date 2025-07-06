<?php
require_once '../config.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'mahasiswa') {
    header("Location: " . BASE_URL . "login.php");
    exit();
}

$laporan_id = intval($_GET['id']);
$user_id = $_SESSION['user_id'];

// Cek apakah laporan milik user ini
$stmt = $conn->prepare("SELECT * FROM laporan WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $laporan_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$laporan = $result->fetch_assoc();

if (!$laporan) {
    echo "Laporan tidak ditemukan atau Anda tidak memiliki izin.";
    exit;
}

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['laporan'])) {
    $fileName = $_FILES['laporan']['name'];
    $tmpName = $_FILES['laporan']['tmp_name'];
    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
    $newFileName = 'laporan_' . time() . '.' . $ext;

    move_uploaded_file($tmpName, '../uploads/' . $newFileName);

    // Update file laporan
    $stmt = $conn->prepare("UPDATE laporan SET file_laporan = ? WHERE id = ?");
    $stmt->bind_param("si", $newFileName, $laporan_id);
    $stmt->execute();

    header("Location: detail_praktikum.php?id=" . $laporan['praktikum_id']);
    exit;
}

$pageTitle = 'Edit Laporan';
require_once 'templates/header_mahasiswa.php';
?>

<h2 class="text-2xl font-bold mb-4">Edit Laporan</h2>
<form method="post" enctype="multipart/form-data" class="space-y-4 bg-white p-6 rounded shadow-md w-full max-w-xl">
    <div>
        <label class="block mb-2">Laporan Baru (replace):</label>
        <input type="file" name="laporan" required class="border p-2 rounded w-full">
    </div>
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Perubahan</button>
</form>

<?php require_once 'templates/footer_mahasiswa.php'; ?>
