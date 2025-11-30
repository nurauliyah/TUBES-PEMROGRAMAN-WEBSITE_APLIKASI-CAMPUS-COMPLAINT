<?php
session_start();
require 'db.php';

if ($_SESSION['user']['role'] !== 'admin') {
    die("Akses hanya untuk admin.");
}

$reports = $conn->query("
    SELECT complaints.*, users.name 
    FROM complaints 
    JOIN users ON users.id = complaints.user_id
    ORDER BY complaints.created_at DESC
")->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="style.css">
<script src="script.js"></script>

<div class="container">
    <h2>Admin Panel</h2>

    <?php foreach($reports as $r): ?>
        <div style="background:#f7f7f7;padding:10px;border-radius:8px;margin-bottom:10px;">
            <b><?= $r['title'] ?></b> (<?= $r['name'] ?>)<br>
            Lokasi: <i><?= $r['location'] ?></i><br>
            <p><?= $r['description'] ?></p>

            <?php if($r['image']): ?>
                <img src="uploads/<?= $r['image'] ?>" width="120">
            <?php endif; ?>

            <form action="update_status.php" method="POST" onsubmit="return confirmStatus()">
                <input type="hidden" name="id" value="<?= $r['id'] ?>">
                <select name="status">
                    <option <?= $r['status']=="Pending"?"selected":""?>>Pending</option>
                    <option <?= $r['status']=="In Progress"?"selected":""?>>In Progress</option>
                    <option <?= $r['status']=="Resolved"?"selected":""?>>Resolved</option>
                    <option <?= $r['status']=="Rejected"?"selected":""?>>Rejected</option>
                </select>
                <button type="submit">Update</button>
            </form>
        </div>
    <?php endforeach; ?>
</div>
