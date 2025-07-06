<?php
require_once '../config.php';
session_start();
$pageTitle = 'Cari Praktikum';
$activePage = 'courses';
require_once 'templates/header_mahasiswa.php';

$result = $conn->query("SELECT * FROM praktikum");
?>
<h2 class="text-2xl font-bold mb-4">Daftar Mata Praktikum</h2>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
  <?php while($row = $result->fetch_assoc()): ?>
    <div class="bg-white p-4 rounded-lg shadow-md">
      <h3 class="text-lg font-semibold"><?= htmlspecialchars($row['nama']) ?></h3>
      <p><?= htmlspecialchars($row['deskripsi']) ?></p>
      <form method="post" action="praktikum_saya.php">
        <input type="hidden" name="praktikum_id" value="<?= $row['id'] ?>">
        <button class="mt-2 px-4 py-2 bg-blue-600 text-white rounded">Daftar</button>
      </form>
    </div>
  <?php endwhile; ?>
</div>
<?php require_once 'templates/footer_mahasiswa.php'; ?>