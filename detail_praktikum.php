<?php
require_once '../config.php';
session_start();
$pageTitle = 'Detail Praktikum';
$activePage = '';
require_once 'templates/header_mahasiswa.php';

$praktikum_id = intval($_GET['id']);
$user_id = $_SESSION['user_id'];

// Ambil daftar modul
$stmt = $conn->prepare("SELECT * FROM modul WHERE praktikum_id = ?");
$stmt->bind_param("i", $praktikum_id);
$stmt->execute();
$moduls = $stmt->get_result();
?>
<h2 class="text-2xl font-bold mb-4">Modul Praktikum</h2>
<table class="w-full bg-white shadow rounded">
  <tr class="bg-gray-200">
    <th class="p-2">Modul</th>
    <th class="p-2">Materi</th>
    <th class="p-2">Upload Laporan</th>
    <th class="p-2">Status</th>
  </tr>
  <?php while($modul = $moduls->fetch_assoc()): ?>
  <tr>
    <td class="p-2"><?= htmlspecialchars($modul['judul']) ?></td>
    <td class="p-2">
      <a href="../uploads/<?= htmlspecialchars($modul['file_materi']) ?>" class="text-blue-600" download>Download</a>
    </td>
    <td class="p-2">
      <?php
        // Cek apakah user sudah mengupload laporan untuk modul ini
        $stmt2 = $conn->prepare("SELECT * FROM laporan WHERE modul_id = ? AND user_id = ?");
        $stmt2->bind_param("ii", $modul['id'], $user_id);
        $stmt2->execute();
        $laporan = $stmt2->get_result()->fetch_assoc();
      ?>
      <?php if ($laporan): ?>
        <a href="../uploads/<?= htmlspecialchars($laporan['file_laporan']) ?>" class="text-blue-500 underline">Lihat</a>
        | <a href="edit_laporan.php?id=<?= $laporan['id'] ?>" class="text-yellow-500">Edit</a>
        | <a href="hapus_laporan.php?id=<?= $laporan['id'] ?>" class="text-red-500" onclick="return confirm('Yakin ingin hapus laporan ini?')">Hapus</a>
      <?php else: ?>
        <form action="upload_laporan.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="modul_id" value="<?= $modul['id'] ?>">
          <input type="hidden" name="praktikum_id" value="<?= $praktikum_id ?>">
          <input type="file" name="laporan" required>
          <button type="submit" class="bg-green-500 text-white px-4 py-1 rounded">Upload</button>
        </form>
      <?php endif; ?>
    </td>
    <td class="p-2">
      <?= isset($laporan['nilai']) && $laporan['nilai'] !== null ? htmlspecialchars($laporan['nilai']) : '-' ?>
    </td>
  </tr>
  <?php endwhile; ?>
</table>
<?php require_once 'templates/footer_mahasiswa.php'; ?>
