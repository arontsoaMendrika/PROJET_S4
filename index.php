<?php
// Point d'entrée principal de l'application RégimeVIP
// Développé par Itokiana ETU004364

// Démarrage de la session
session_start();

// Configuration des erreurs
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Configuration du fuseau horaire
date_default_timezone_set('Europe/Paris');

// Inclusion des fichiers nécessaires
require_once 'includes/fonctions.php';

// Routage principal
$page = $_GET['page'] ?? 'home';
$controller = $_GET['controller'] ?? null;
$action = $_GET['action'] ?? null;

try {
    // Routes principales
    switch ($page) {
        case 'home':
            require_once 'views/home.php';
            break;
            
        case 'regimes':
            if ($controller === 'regime') {
                require_once 'app/Controllers/RegimeController.php';
            } else {
                // Redirection vers le contrôleur par défaut
                header('Location: index.php?controller=regime&action=index');
                exit;
            }
            break;
            
        case 'recommendations':
            if ($controller === 'recommendation') {
                require_once 'app/Controllers/RegimeController.php';
            } else {
                require_once 'views/recommendations/form.php';
            }
            break;
            
        case 'profiles':
            if ($controller === 'profile') {
                require_once 'app/Controllers/RegimeController.php';
            } else {
                require_once 'views/profiles/form.php';
            }
            break;
            
        case 'api':
            // Routes API pour les requêtes AJAX
            handleAPIRequest();
            break;
            
        default:
            // Route par défaut - page d'accueil
            require_once 'views/home.php';
            break;
    }
    
} catch (Exception $e) {
    // Gestion des erreurs
    error_log("Erreur dans index.php: " . $e->getMessage());
    
    // Afficher une page d'erreur en production
    if (defined('ENVIRONMENT') && ENVIRONMENT === 'production') {
        http_response_code(500);
        require_once 'views/errors/500.php';
    } else {
        // Afficher l'erreur en développement
        echo '<div style="padding: 20px; background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 4px; margin: 20px;">';
        echo '<h2>Erreur</h2>';
        echo '<p><strong>Message:</strong> ' . htmlspecialchars($e->getMessage()) . '</p>';
        echo '<p><strong>Fichier:</strong> ' . htmlspecialchars($e->getFile()) . '</p>';
        echo '<p><strong>Ligne:</strong> ' . $e->getLine() . '</p>';
        echo '</div>';
    }
}

/**
 * Gère les requêtes API/AJAX
 */
function handleAPIRequest() {
    header('Content-Type: application/json');
    
    $action = $_GET['action'] ?? null;
    $method = $_SERVER['REQUEST_METHOD'];
    
    try {
        switch ($action) {
            case 'stats':
                handleStatsAPI();
                break;
                
            case 'search':
                if ($method === 'GET') {
                    handleSearchAPI();
                }
                break;
                
            case 'filter':
                if ($method === 'POST') {
                    handleFilterAPI();
                }
                break;
                
            case 'like':
                if ($method === 'POST') {
                    handleLikeAPI();
                }
                break;
                
            case 'autosave':
                if ($method === 'POST') {
                    handleAutosaveAPI();
                }
                break;
                
            case 'recent_recommendations':
                handleRecentRecommendationsAPI();
                break;
                
            default:
                jsonResponse(['error' => 'Action API non trouvée'], 404);
        }
    } catch (Exception $e) {
        jsonResponse(['error' => $e->getMessage()], 500);
    }
}

/**
 * API pour les statistiques
 */
function handleStatsAPI() {
    $pdo = getDBConnection();
    
    // Compter les régimes actifs
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM regimes WHERE is_active = 1");
    $totalRegimes = $stmt->fetch()['total'];
    
    // Compter les utilisateurs
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM users");
    $totalUsers = $stmt->fetch()['total'];
    
    // Compter les recommandations
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM recommendations");
    $totalRecommendations = $stmt->fetch()['total'];
    
    // Prix moyen
    $stmt = $pdo->query("SELECT AVG(base_price) as avg_price FROM regimes WHERE is_active = 1");
    $avgPrice = round($stmt->fetch()['avg_price'], 2);
    
    jsonResponse([
        'success' => true,
        'stats' => [
            'total_regimes' => $totalRegimes,
            'total_users' => $totalUsers,
            'total_recommendations' => $totalRecommendations,
            'avg_price' => $avgPrice
        ]
    ]);
}

/**
 * API pour la recherche
 */
function handleSearchAPI() {
    $query = $_GET['query'] ?? '';
    
    if (empty($query)) {
        jsonResponse(['success' => false, 'error' => 'Terme de recherche requis'], 400);
    }
    
    $regimes = searchRegimes($query);
    jsonResponse([
        'success' => true,
        'regimes' => $regimes,
        'count' => count($regimes)
    ]);
}

/**
 * API pour le filtrage
 */
function handleFilterAPI() {
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!$input) {
        jsonResponse(['success' => false, 'error' => 'Données invalides'], 400);
    }
    
    $filters = [
        'type' => $input['type'] ?? null,
        'max_price' => $input['max_price'] ?? null,
        'max_calories' => $input['max_calories'] ?? null
    ];
    
    $regimes = filterRegimes($filters);
    jsonResponse([
        'success' => true,
        'regimes' => $regimes,
        'count' => count($regimes)
    ]);
}

/**
 * API pour les "j'aime"
 */
function handleLikeAPI() {
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($input['regime_id'])) {
        jsonResponse(['success' => false, 'error' => 'ID de régime requis'], 400);
    }
    
    $regimeId = intval($input['regime_id']);
    $userId = $_SESSION['user_id'] ?? 1; // ID par défaut pour la démo
    
    // Simuler la sauvegarde du like
    // En réalité, on sauvegarderait dans une table likes
    
    jsonResponse([
        'success' => true,
        'message' => 'Like enregistré avec succès'
    ]);
}

/**
 * API pour la sauvegarde automatique
 */
function handleAutosaveAPI() {
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($input['field']) || !isset($input['value'])) {
        jsonResponse(['success' => false, 'error' => 'Champ et valeur requis'], 400);
    }
    
    // Simuler la sauvegarde automatique
    // En réalité, on sauvegarderait dans la base de données
    
    jsonResponse([
        'success' => true,
        'message' => 'Sauvegarde automatique réussie'
    ]);
}

/**
 * API pour les recommandations récentes
 */
function handleRecentRecommendationsAPI() {
    $pdo = getDBConnection();
    
    $stmt = $pdo->query("
        SELECT r.*, u.full_name as user_name, reg.name as regime_name
        FROM recommendations r
        JOIN users u ON r.user_id = u.id
        JOIN regimes reg ON r.regime_id = reg.id
        ORDER BY r.created_at DESC
        LIMIT 5
    ");
    
    $recommendations = $stmt->fetchAll();
    
    jsonResponse([
        'success' => true,
        'recommendations' => $recommendations
    ]);
}

/**
 * Fonction utilitaire pour les réponses JSON
 */
function jsonResponse($data, $statusCode = 200) {
    http_response_code($statusCode);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}
?>
