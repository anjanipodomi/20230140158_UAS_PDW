<?php
require_once __DIR__ . '/../config.php';
session_start();
$pageTitle = 'Kelola Modul';
$activePage = 'modul';
require_once 'templates/header.php';

$praktikum = $conn->query("SELECT * FROM praktikum");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['judul'], $_POST['praktikum_id'])) {
    $file = $_FILES['file_materi']['name'];
    $ext = pathinfo($file, PATHINFO_EXTENSION);
    $filename = 'materi_' . time() . '.' . $ext;
    move_uploaded_file($_FILES['file_materi']['tmp_name'], '../uploads/' . $filename);

    $stmt = $conn->prepare("INSERT INTO modul (praktikum_id, judul, file_materi) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $_POST['praktikum_id'], $_POST['judul'], $filename);
    $stmt->execute();
}

$result = $conn->query("SELECT m.*, p.nama AS praktikum FROM modul m JOIN praktikum p ON m.praktikum_id = p.id");
?>
<h2 class="text-2xl font-bold mb-4">Kelola Modul</h2>
<form method="post" enctype="multipart/form-data" class="mb-6">
  <select name="praktikum_id" required>
    <?php while($p = $praktikum->fetch_assoc()): ?>
      <option value="<?= $p['id'] ?>"><?= $p['nama'] ?></option>
    <?php endwhile; ?>
  </select>
  <input type="text" name="judul" placeholder="Judul Modul" required>
  <input type="file" name="file_materi" required>
  <button class="bg-blue-600 text-white px-4 py-2">Tambah Modul</button>
</form>
<table class="w-full">
  <tr><th>Praktikum</th><th>Judul</th><th>Materi</th></tr>
  <?php while($m = $result->fetch_assoc()): ?>
    <tr><td><?= $m['praktikum'] ?></td><td><?= $m['judul'] ?></td><td><?= $m['file_materi'] ?></td></tr>
  <?php endwhile; ?>
</table>
<?php require_once 'templates/footer.php'; ?>