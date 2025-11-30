<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
$user = $_SESSION['user'];
?>
<link rel="stylesheet" href="style.css">
<div class="navbar">
    <a href="index.php">Home</a>
    <a href="add_report.php">Buat Laporan</a>
    <a href="my_reports.php">Laporanku</a>

    <?php if($user['role'] == 'admin'): ?>
        <a href="admin.php">Admin Panel</a>
    <?php endif; ?>

    <a href="logout.php">Logout</a>
</div>

<div class="container">
    <h2>Halo, <?= $user['name'] ?>!</h2>
    <p>Selamat datang di aplikasi pengaduan fasilitas kampus.</p>
</div>
