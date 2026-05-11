<?php

namespace App\Controllers;

class StaticController extends BaseController
{
    public function home()
    {
        // Récupérer les paramètres query string
        $page = $_GET['page'] ?? 'home';
        $controller = $_GET['controller'] ?? null;
        $action = $_GET['action'] ?? null;
        $id = $_GET['id'] ?? null;
        
        // Inclure les fonctions personnalisées
        require_once ROOTPATH . 'includes/fonctions.php';
        
        // Router vers les bonnes pages
        switch ($page) {
            case 'home':
                include APPPATH . '../views/home.php';
                break;
                
            case 'regimes':
                if ($controller === 'regime') {
                    // Inclure notre RegimeController personnalisé
                    require_once APPPATH . '../app/Controllers/RegimeController.php';
                } else {
                    include APPPATH . '../views/regimes/list.php';
                }
                break;
                
            case 'recommendations':
                if ($controller === 'recommendation') {
                    require_once APPPATH . '../app/Controllers/RegimeController.php';
                } else {
                    include APPPATH . '../views/recommendations/form.php';
                }
                break;
                
            case 'profiles':
                if ($controller === 'profile') {
                    require_once APPPATH . '../app/Controllers/RegimeController.php';
                } else {
                    include APPPATH . '../views/profiles/form.php';
                }
                break;
                
            case 'api':
                $this->handleAPIRequest();
                break;
                
            default:
                include APPPATH . '../views/home.php';
                break;
        }
    }
    
    private function handleAPIRequest()
    {
        header('Content-Type: application/json');
        
        require_once ROOTPATH . 'includes/fonctions.php';
        
        $action = $_GET['action'] ?? null;
        $method = $_SERVER['REQUEST_METHOD'];
        
        try {
            switch ($action) {
                case 'stats':
                    $this->handleStatsAPI();
                    break;
                    
                case 'search':
                    if ($method === 'GET') {
                        $this->handleSearchAPI();
                    }
                    break;
                    
                case 'filter':
                    if ($method === 'POST') {
                        $this->handleFilterAPI();
                    }
                    break;
                    
                case 'like':
                    if ($method === 'POST') {
                        $this->handleLikeAPI();
                    }
                    break;
                    
                case 'autosave':
                    if ($method === 'POST') {
                        $this->handleAutosaveAPI();
                    }
                    break;
                    
                case 'recent_recommendations':
                    $this->handleRecentRecommendationsAPI();
                    break;
                    
                default:
                    $this->jsonResponse(['error' => 'Action API non trouvée'], 404);
            }
        } catch (Exception $e) {
            $this->jsonResponse(['error' => $e->getMessage()], 500);
        }
    }
    
    private function handleStatsAPI()
    {
        $pdo = getDBConnection();
        
        $stmt = $pdo->query("SELECT COUNT(*) as total FROM regimes WHERE is_active = 1");
        $totalRegimes = $stmt->fetch()['total'];
        
        $stmt = $pdo->query("SELECT COUNT(*) as total FROM users");
        $totalUsers = $stmt->fetch()['total'];
        
        $stmt = $pdo->query("SELECT COUNT(*) as total FROM recommendations");
        $totalRecommendations = $stmt->fetch()['total'];
        
        $stmt = $pdo->query("SELECT AVG(base_price) as avg_price FROM regimes WHERE is_active = 1");
        $avgPrice = round($stmt->fetch()['avg_price'], 2);
        
        $this->jsonResponse([
            'success' => true,
            'stats' => [
                'total_regimes' => $totalRegimes,
                'total_users' => $totalUsers,
                'total_recommendations' => $totalRecommendations,
                'avg_price' => $avgPrice
            ]
        ]);
    }
    
    private function handleSearchAPI()
    {
        $query = $_GET['query'] ?? '';
        
        if (empty($query)) {
            $this->jsonResponse(['success' => false, 'error' => 'Terme de recherche requis'], 400);
        }
        
        $regimes = searchRegimes($query);
        $this->jsonResponse([
            'success' => true,
            'regimes' => $regimes,
            'count' => count($regimes)
        ]);
    }
    
    private function handleFilterAPI()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (!$input) {
            $this->jsonResponse(['success' => false, 'error' => 'Données invalides'], 400);
        }
        
        $filters = [
            'type' => $input['type'] ?? null,
            'max_price' => $input['max_price'] ?? null,
            'max_calories' => $input['max_calories'] ?? null
        ];
        
        $regimes = filterRegimes($filters);
        $this->jsonResponse([
            'success' => true,
            'regimes' => $regimes,
            'count' => count($regimes)
        ]);
    }
    
    private function handleLikeAPI()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (!isset($input['regime_id'])) {
            $this->jsonResponse(['success' => false, 'error' => 'ID de régime requis'], 400);
        }
        
        $regimeId = intval($input['regime_id']);
        $userId = $_SESSION['user_id'] ?? 1;
        
        $this->jsonResponse([
            'success' => true,
            'message' => 'Like enregistré avec succès'
        ]);
    }
    
    private function handleAutosaveAPI()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (!isset($input['field']) || !isset($input['value'])) {
            $this->jsonResponse(['success' => false, 'error' => 'Champ et valeur requis'], 400);
        }
        
        $this->jsonResponse([
            'success' => true,
            'message' => 'Sauvegarde automatique réussie'
        ]);
    }
    
    private function handleRecentRecommendationsAPI()
    {
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
        
        $this->jsonResponse([
            'success' => true,
            'recommendations' => $recommendations
        ]);
    }
    
    private function jsonResponse($data, $statusCode = 200)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}
