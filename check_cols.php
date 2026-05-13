<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=regime', 'root', '');
    $stmt = $pdo->query("DESCRIBE users");
    print_r($stmt->fetchAll(PDO::FETCH_ASSOC));
} catch(Exception $e) {
    echo 'Error: ' . $e->getMessage();
}