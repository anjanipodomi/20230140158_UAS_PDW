<?php
require_once __DIR__ . '/../config.php';
session_start();
$pageTitle = 'Laporan Masuk';
$activePage = 'laporan';
require_once 'templates/header.php';

$result = $conn->query("SELECT l.*, u.nama, m.judul FROM laporan l
    JOIN users u ON l.user_id = u.id
    JOIN modul m ON l.modul_id = m.id");
?>
<h2 class="text-2xl font-bold mb-4">Laporan Masuk</h2>
<table class="w-full">
  <tr><th>Mahasiswa</th><th>Modul</th><th>File</th><th>Nilai</th><th>Aksi</th></tr>
  <?php while($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= $row['nama'] ?></td>
      <td><?= $row['judul'] ?></td>
      <td><a href="../uploads/<?= $row['file_laporan'] ?>" class="text-blue-600">Unduh</a></td>
      <td><?= $row['nilai'] ?? '-' ?></td>
      <td>
        <form method="post" action="beri_nilai.php">
          <input type="hidden" name="laporan_id" value="<?= $row['id'] ?>">
          <input type="number" name="nilai" placeholder="Nilai" required>
          <input type="text" name="feedback" placeholder="Feedback" required>
          <button class="bg-green-500 text-white px-2 py-1">Simpan</button>
        </form>
      </td>
    </tr>
  <?php endwhile; ?>
</table>
<?php require_once 'templates/footer.php'; ?>
