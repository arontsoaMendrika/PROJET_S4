<?php
// Test de connexion à la base de données
echo "<h2>Test de Connexion à la Base de Données</h2>";

// Test 1: Vérifier si MySQL fonctionne
echo "<h3>1. Test du serveur MySQL</h3>";
try {
    $pdo = new PDO("mysql:host=localhost;dbname=regime", 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    echo "<p style='color: green;'>✅ Connexion MySQL réussie</p>";
    
    // Test des tables
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo "<p style='color: blue;'>📊 Tables trouvées : " . count($tables) . "</p>";
    echo "<ul>";
    foreach ($tables as $table) {
        echo "<li style='color: #666;'>• $table</li>";
    }
    echo "</ul>";
    
} catch(PDOException $e) {
    echo "<p style='color: red;'>❌ Erreur MySQL : " . $e->getMessage() . "</p>";
}

echo "<hr>";

// Test 2: Vérifier la configuration CodeIgniter
echo "<h3>2. Test de la configuration CodeIgniter</h3>";
try {
    if (file_exists('app/Config/Database.php')) {
        echo "<p style='color: green;'>✅ Fichier Database.php trouvé</p>";
        require_once 'app/Config/Database.php';
        $config = new \Config\Database();
        echo "<p style='color: blue;'>📋 Configuration trouvée :</p>";
        echo "<ul>";
        echo "<li>Hostname: " . ($config->default['hostname'] ?? 'Non défini') . "</li>";
        echo "<li>Database: " . ($config->default['database'] ?? 'Non défini') . "</li>";
        echo "<li>Username: " . ($config->default['username'] ?? 'Non défini') . "</li>";
        echo "<li>Driver: " . ($config->default['DBDriver'] ?? 'Non défini') . "</li>";
        echo "</ul>";
    } else {
        echo "<p style='color: red;'>❌ Fichier Database.php non trouvé</p>";
    }
} catch(Exception $e) {
    echo "<p style='color: red;'>❌ Erreur configuration : " . $e->getMessage() . "</p>";
}

echo "<hr>";

// Test 3: Vérifier les chemins
echo "<h3>3. Vérification des chemins</h3>";
echo "<p>Répertoire actuel : " . __DIR__ . "</p>";
echo "<p>Fichier fonctions.php : " . (file_exists('includes/fonctions.php') ? '✅ Existe' : '❌ Manquant') . "</p>";
echo "<p>Fichier Database.php : " . (file_exists('app/Config/Database.php') ? '✅ Existe' : '❌ Manquant') . "</p>";

echo "<hr>";
echo "<p><a href='install.php' style='background: #6B46C1; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>🔧 Réinstaller la base de données</a></p>";
echo "<p><a href='app/Views/welcome_message.php' style='background: #EC4899; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>🏠 Accéder à l'application</a></p>";
?>
