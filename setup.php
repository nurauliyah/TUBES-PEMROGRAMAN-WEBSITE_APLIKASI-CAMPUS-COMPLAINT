<?php
require 'db.php';

$conn->exec("
CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT,
    email TEXT UNIQUE,
    password TEXT,
    role TEXT DEFAULT 'user'
);
");

$conn->exec("
CREATE TABLE IF NOT EXISTS complaints (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER,
    title TEXT,
    location TEXT,
    description TEXT,
    image TEXT,
    status TEXT DEFAULT 'Pending',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
");

$check = $conn->query("SELECT COUNT(*) FROM users WHERE role='admin'")->fetchColumn();

if ($check == 0) {
    $conn->exec("
        INSERT INTO users (name, email, password, role)
        VALUES (
            'Admin Kampus',
            'admin@campus.com',
            '" . password_hash('admin123', PASSWORD_DEFAULT) . "',
            'admin'
        );
    ");
}

echo "Database siap! Admin = admin@campus.com / admin123";
?>
