<?php
require_once 'includes/fonctions.php';
try {
    $pdo = getDBConnection();
    echo 'Connection OK!';
} catch(Exception $e) {
    echo 'Error: ' . $e->getMessage();
}