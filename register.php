<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $pass  = password_hash($_POST['password'], PASSWORD_DEFAULT);

    try {
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?,?,?)");
        $stmt->execute([$name, $email, $pass]);
        header("Location: login.php");
        exit;
    } catch (Exception $e) {
        $msg = "Email sudah digunakan!";
    }
}
?>
<link rel="stylesheet" href="style.css">

<div class="container">
    <h2>Register</h2>

    <form method="POST">
        <input type="text" name="name" placeholder="Nama lengkap" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Daftar</button>
    </form>

    <p style="text-align:center;margin-top:10px;">
        Sudah punya akun? <a href="login.php">Login</a>
    </p>

    <?php if(!empty($msg)) echo "<p style='color:red;'>$msg</p>"; ?>
</div>
