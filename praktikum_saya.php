<?php
require_once '../config.php';
session_start();
$pageTitle = 'Praktikum Saya';
$activePage = 'my_courses';
require_once 'templates/header_mahasiswa.php';

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['praktikum_id'])) {
    $praktikum_id = intval($_POST['praktikum_id']);
    $stmt = $conn->prepare("INSERT IGNORE INTO pendaftaran_praktikum (user_id, praktikum_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $praktikum_id);
    $stmt->execute();
}

$sql = "SELECT p.* FROM praktikum p
        JOIN pendaftaran_praktikum pp ON p.id = pp.praktikum_id
        WHERE pp.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<h2 class="text-2xl font-bold mb-4">Praktikum yang Anda Ikuti</h2>
<ul class="space-y-4">
  <?php while($row = $result->fetch_assoc()): ?>
    <li class="bg-white p-4 rounded shadow">
      <a href="detail_praktikum.php?id=<?= $row['id'] ?>" class="text-blue-600 font-semibold hover:underline">
        <?= htmlspecialchars($row['nama']) ?>
      </a>
    </li>
  <?php endwhile; ?>
</ul>
<?php require_once 'templates/footer_mahasiswa.php';