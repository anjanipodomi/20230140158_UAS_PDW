<?php
require_once '../config.php';
session_start();
$pageTitle = 'Kelola Pengguna';
$activePage = 'akun';
require_once 'templates/header.php';

$result = $conn->query("SELECT * FROM users");
?>
<h2 class="text-2xl font-bold mb-4">Akun Pengguna</h2>
<table class="w-full">
  <tr><th>Nama</th><th>Email</th><th>Role</th></tr>
  <?php while($row = $result->fetch_assoc()): ?>
    <tr><td><?= $row['nama'] ?></td><td><?= $row['email'] ?></td><td><?= $row['role'] ?></td></tr>
  <?php endwhile; ?>
</table>
<?php require_once 'templates/footer.php'; ?>
