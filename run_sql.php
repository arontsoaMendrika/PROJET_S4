<?php
try {
    $pdo = new PDO('mysql:host=localhost;port=3306', 'root', '');
    $sql = file_get_contents('schema_regimes_wallet.sql');
    $pdo->exec($sql);
    echo 'SQL Execute: OK';
} catch (Exception $e) {
    echo 'SQL Execute Error: ' . $e->getMessage();
}