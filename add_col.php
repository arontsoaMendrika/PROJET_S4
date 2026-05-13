<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=regime', 'root', '');
    $pdo->exec("ALTER TABLE users ADD COLUMN profile_pic VARCHAR(255) DEFAULT 'default_avatar.jpg'");
    echo 'Column added.';
} catch(Exception $e) {
    if ($e->getCode() == '42S21' || strpos($e->getMessage(), 'Duplicate column') !== false) {
        echo 'Column already exists.';
    } else {
        echo 'Error: ' . $e->getMessage();
    }
}