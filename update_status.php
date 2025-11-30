<?php
require 'db.php';

$id = $_POST['id'];
$status = $_POST['status'];

$stmt = $conn->prepare("UPDATE complaints SET status=?, created_at=created_at WHERE id=?");
$stmt->execute([$status, $id]);

header("Location: admin.php");
?>
