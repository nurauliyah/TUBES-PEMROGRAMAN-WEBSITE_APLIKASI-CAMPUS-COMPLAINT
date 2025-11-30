<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user']['id'];

$reports = $conn->query("
    SELECT * FROM complaints WHERE user_id=$user_id ORDER BY created_at DESC
")->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="style.css">

<div class="container">
    <h2>Laporan Saya</h2>

    <?php foreach($reports as $r): ?>
        <div style="background:#f7f7f7;padding:10px;border-radius:8px;margin-bottom:10px;">
            <b><?= $r['title'] ?></b><br>
            <i><?= $r['location'] ?></i><br>
            Status: <b><?= $r['status'] ?></b><br>

            <?php if($r['image']): ?>
                <img src="uploads/<?= $r['image'] ?>" width="120">
            <?php endif; ?>

            <p><?= $r['description'] ?></p>
        </div>
    <?php endforeach; ?>
</div>
