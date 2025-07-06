<?php
require_once '../config.php';
session_start();
$pageTitle = 'Kelola Mata Praktikum';
$activePage = 'dashboard';
require_once 'templates/header.php';

// Tambah Praktikum
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nama'])) {
  $stmt = $conn->prepare("INSERT INTO praktikum (nama, deskripsi, created_by) VALUES (?, ?, ?)");
  $stmt->bind_param("ssi", $_POST['nama'], $_POST['deskripsi'], $_SESSION['user_id']);
  $stmt->execute();
}
$result = $conn->query("SELECT * FROM praktikum");
?>
<h2 class="text-2xl font-bold mb-4">Kelola Mata Praktikum</h2>
<form method="post" class="mb-6">
  <input type="text" name="nama" placeholder="Nama Praktikum" required>
  <textarea name="deskripsi" placeholder="Deskripsi" required></textarea>
  <button class="bg-blue-600 text-white px-4 py-2">Tambah</button>
</form>
<table class="w-full">
  <tr><th>Nama</th><th>Deskripsi</th></tr>
  <?php while($row = $result->fetch_assoc()): ?>
    <tr><td><?= $row['nama'] ?></td><td><?= $row['deskripsi'] ?></td></tr>
  <?php endwhile; ?>
</table>
<?php require_once 'templates/footer.php'; ?>