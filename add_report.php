<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $_POST['title'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $user_id = $_SESSION['user']['id'];

    $imgName = null;

    if (!empty($_FILES['image']['name'])) {
        $imgName = time() . "_" . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $imgName);
    }

    $stmt = $conn->prepare("
        INSERT INTO complaints (user_id, title, location, description, image)
        VALUES (?,?,?,?,?)
    ");

    $stmt->execute([$user_id, $title, $location, $description, $imgName]);

    header("Location: my_reports.php");
    exit;
}
?>

<link rel="stylesheet" href="style.css">

<div class="container">
    <h2>Buat Laporan Baru</h2>

    <form method="POST" enctype="multipart/form-data">
        <input name="title" placeholder="Judul laporan" required>
        <input name="location" placeholder="Lokasi" required>
        <textarea name="description" placeholder="Deskripsi" required></textarea>
        <input type="file" name="image">
        <button type="submit">Kirim</button>
    </form>
</div>
