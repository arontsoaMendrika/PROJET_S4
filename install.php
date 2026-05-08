<?php
// Script d'installation rapide pour RégimeVIP
// Développé par Itokiana ETU004364

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Installation - RégimeVIP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; }
        .install-container { max-width: 600px; margin: 50px auto; }
        .card { border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.2); }
        .card-header { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border-radius: 15px 15px 0 0; }
        .btn-primary { background: linear-gradient(135deg, #6B46C1 0%, #EC4899 100%); border: none; }
    </style>
</head>
<body>
    <div class="install-container">
        <div class="card">
            <div class="card-header text-white text-center p-4">
                <h2><i class="fas fa-crown me-2"></i>RégimeVIP</h2>
                <p class="mb-0">Installation Rapide</p>
            </div>
            <div class="card-body p-4">
                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $db_host = $_POST['db_host'] ?? 'localhost';
                    $db_name = $_POST['db_name'] ?? 'regime';
                    $db_user = $_POST['db_user'] ?? 'root';
                    $db_pass = $_POST['db_pass'] ?? '';
                    
                    try {
                        // Test de connexion
                        $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        
                        // Création de la base si elle n'existe pas
                        $pdo->exec("CREATE DATABASE IF NOT EXISTS $db_name CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
                        $pdo->exec("USE $db_name");
                        
                        // Import du schéma
                        $sql = file_get_contents('schema_regimes.sql');
                        $pdo->exec($sql);
                        
                        echo '<div class="alert alert-success">';
                        echo '<i class="fas fa-check-circle me-2"></i>';
                        echo '<strong>Installation réussie !</strong><br>';
                        echo 'La base de données a été créée et les tables ont été importées.';
                        echo '</div>';
                        
                        echo '<div class="text-center mt-4">';
                        echo '<a href="app/Views/welcome_message.php" class="btn btn-primary btn-lg">';
                        echo '<i class="fas fa-rocket me-2"></i>Accéder à l\'application';
                        echo '</a>';
                        echo '</div>';
                        
                    } catch(PDOException $e) {
                        echo '<div class="alert alert-danger">';
                        echo '<i class="fas fa-exclamation-triangle me-2"></i>';
                        echo '<strong>Erreur de connexion :</strong><br>';
                        echo htmlspecialchars($e->getMessage());
                        echo '</div>';
                    }
                } else {
                ?>
                <form method="POST">
                    <h4 class="mb-4">Configuration de la base de données</h4>
                    
                    <div class="mb-3">
                        <label class="form-label">Hôte MySQL</label>
                        <input type="text" name="db_host" class="form-control" value="localhost" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Nom de la base</label>
                        <input type="text" name="db_name" class="form-control" value="regime" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Utilisateur MySQL</label>
                        <input type="text" name="db_user" class="form-control" value="root" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">Mot de passe MySQL</label>
                        <input type="password" name="db_pass" class="form-control">
                        <small class="text-muted">Laisser vide si pas de mot de passe</small>
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-database me-2"></i>
                            Installer la base de données
                        </button>
                        <a href="app/Views/welcome_message.php" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-right me-2"></i>
                            Passer l'installation
                        </a>
                    </div>
                </form>
                <?php } ?>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
