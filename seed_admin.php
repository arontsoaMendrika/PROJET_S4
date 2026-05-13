<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=regime', 'root', '');
    $pwd = password_hash('admin2026', PASSWORD_DEFAULT);
    $stmt = $pdo->prepare('INSERT INTO users (email, password_hash, full_name, role) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE password_hash=VALUES(password_hash), role=VALUES(role)');
    $stmt->execute(['admin', $pwd, 'Administrateur', 'admin']);
    echo 'Admin seeded.';
} catch(Exception $e) {
    echo 'Error: ' . $e->getMessage();
}