<?php
// Fonctions pour l'application de régimes - Itokiana ETU004364

// Connexion à la base de données - Utilise la configuration de CodeIgniter
function getDBConnection()
{
    try {
        // Paramètres de connexion pour XAMPP MySQL
        $host = '127.0.0.1';
        $port = '3306';
        $database = 'regime';
        $username = 'root';
        $password = '';
        $charset = 'utf8mb4';

        // Créer la connexion avec TCP/IP pour XAMPP
        $dsn = "mysql:host={$host};port={$port};dbname={$database};charset={$charset}";

        $pdo = new PDO($dsn, $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES {$charset}"
        ]);

        return $pdo;
    } catch (PDOException $e) {
        die("Erreur de connexion: " . $e->getMessage());
    }
}

// Fonctions CRUD pour les régimes
function getAllRegimes()
{
    $pdo = getDBConnection();
    $stmt = $pdo->query("
        SELECT r.*, rt.name as type_name, 
               (SELECT COUNT(*) FROM pricing_plans pp WHERE pp.regime_id = r.id) as pricing_count
        FROM regimes r 
        JOIN regime_types rt ON r.regime_type_id = rt.id 
        WHERE r.is_active = 1 
        ORDER BY r.name
    ");
    return $stmt->fetchAll();
}

function getRegimeById($id)
{
    $pdo = getDBConnection();
    $stmt = $pdo->prepare("
        SELECT r.*, rt.name as type_name 
        FROM regimes r 
        JOIN regime_types rt ON r.regime_type_id = rt.id 
        WHERE r.id = ?
    ");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function createRegime($data)
{
    $pdo = getDBConnection();
    $stmt = $pdo->prepare("
        INSERT INTO regimes (name, description, regime_type_id, duration_days, base_price, 
                           calories_per_day, protein_percentage, carbs_percentage, fat_percentage)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    return $stmt->execute([
        $data['name'],
        $data['description'],
        $data['regime_type_id'],
        $data['duration_days'],
        $data['base_price'],
        $data['calories_per_day'],
        $data['protein_percentage'],
        $data['carbs_percentage'],
        $data['fat_percentage']
    ]);
}

function updateRegime($id, $data)
{
    $pdo = getDBConnection();
    $stmt = $pdo->prepare("
        UPDATE regimes 
        SET name = ?, description = ?, regime_type_id = ?, duration_days = ?, 
            base_price = ?, calories_per_day = ?, protein_percentage = ?, 
            carbs_percentage = ?, fat_percentage = ?, updated_at = CURRENT_TIMESTAMP
        WHERE id = ?
    ");

    return $stmt->execute([
        $data['name'],
        $data['description'],
        $data['regime_type_id'],
        $data['duration_days'],
        $data['base_price'],
        $data['calories_per_day'],
        $data['protein_percentage'],
        $data['carbs_percentage'],
        $data['fat_percentage'],
        $id
    ]);
}

function deleteRegime($id)
{
    $pdo = getDBConnection();
    $stmt = $pdo->prepare("UPDATE regimes SET is_active = 0 WHERE id = ?");
    return $stmt->execute([$id]);
}

// Fonctions pour les types de régimes
function getAllRegimeTypes()
{
    $pdo = getDBConnection();
    $stmt = $pdo->query("SELECT * FROM regime_types ORDER BY name");
    return $stmt->fetchAll();
}

// Fonctions pour les tarifications
function getPricingPlansByRegime($regimeId)
{
    $pdo = getDBConnection();
    $stmt = $pdo->prepare("
        SELECT * FROM pricing_plans 
        WHERE regime_id = ? 
        ORDER BY duration_days
    ");
    $stmt->execute([$regimeId]);
    return $stmt->fetchAll();
}

function createPricingPlan($data)
{
    $pdo = getDBConnection();
    $stmt = $pdo->prepare("
        INSERT INTO pricing_plans (regime_id, duration_days, price, discount_percentage, is_popular)
        VALUES (?, ?, ?, ?, ?)
    ");

    return $stmt->execute([
        $data['regime_id'],
        $data['duration_days'],
        $data['price'],
        $data['discount_percentage'],
        $data['is_popular'] ?? false
    ]);
}

// Fonctions pour les activités
function getAllActivities()
{
    $pdo = getDBConnection();
    $stmt = $pdo->query("SELECT * FROM activities WHERE is_active = 1 ORDER BY name");
    return $stmt->fetchAll();
}

function getActivityById($id)
{
    $pdo = getDBConnection();
    $stmt = $pdo->prepare("SELECT * FROM activities WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

// Fonctions pour les profils utilisateurs
function getUserProfile($userId)
{
    $pdo = getDBConnection();
    $stmt = $pdo->prepare("SELECT * FROM user_profiles WHERE user_id = ?");
    $stmt->execute([$userId]);
    return $stmt->fetch();
}

function createUserProfile($data)
{
    $pdo = getDBConnection();
    $stmt = $pdo->prepare("
        INSERT INTO user_profiles (user_id, height_cm, weight_kg, age, gender, 
                                  activity_level, objective, target_weight_kg, 
                                  medical_conditions, allergies)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    return $stmt->execute([
        $data['user_id'],
        $data['height_cm'],
        $data['weight_kg'],
        $data['age'],
        $data['gender'],
        $data['activity_level'],
        $data['objective'],
        $data['target_weight_kg'],
        $data['medical_conditions'],
        $data['allergies']
    ]);
}

// Fonctions de calcul IMC
function calculateBMI($weightKg, $heightCm)
{
    $heightM = $heightCm / 100;
    return round($weightKg / ($heightM * $heightM), 2);
}

function getBMICategory($bmi)
{
    if ($bmi < 18.5)
        return 'Insuffisance pondérale';
    if ($bmi < 25)
        return 'Poids normal';
    if ($bmi < 30)
        return 'Surpoids';
    return 'Obésité';
}

// Moteur de recommandation
function generateRecommendation($userId)
{
    $pdo = getDBConnection();

    // Récupérer le profil utilisateur
    $profile = getUserProfile($userId);
    if (!$profile) {
        return ['error' => 'Profil utilisateur non trouvé'];
    }

    // Calculer l'IMC
    $bmi = calculateBMI($profile['weight_kg'], $profile['height_cm']);

    // Récupérer tous les régimes actifs
    $regimes = getAllRegimes();

    $recommendations = [];

    foreach ($regimes as $regime) {
        $score = calculateRecommendationScore($profile, $bmi, $regime);
        if ($score > 0) {
            $recommendations[] = [
                'regime' => $regime,
                'score' => $score,
                'bmi' => $bmi,
                'recommendation_text' => generateRecommendationText($profile, $bmi, $regime, $score)
            ];
        }
    }

    // Trier par score décroissant
    usort($recommendations, function ($a, $b) {
        return $b['score'] <=> $a['score'];
    });

    return array_slice($recommendations, 0, 3); // Top 3 recommandations
}

function calculateRecommendationScore($profile, $bmi, $regime)
{
    $score = 0;

    // Score basé sur l'objectif
    switch ($profile['objective']) {
        case 'weight_loss':
            if ($bmi > 25 && $regime['calories_per_day'] < 1800)
                $score += 40;
            if (strpos(strtolower($regime['name']), 'keto') !== false)
                $score += 20;
            break;
        case 'muscle_gain':
            if ($regime['protein_percentage'] > 20)
                $score += 40;
            if ($regime['calories_per_day'] > 1800)
                $score += 20;
            break;
        case 'maintenance':
            if (abs($regime['calories_per_day'] - 1800) < 200)
                $score += 40;
            break;
        case 'endurance':
            if ($regime['carbs_percentage'] > 45)
                $score += 40;
            break;
    }

    // Score basé sur l'IMC
    if ($bmi > 30 && $regime['calories_per_day'] < 1600)
        $score += 20;
    elseif ($bmi < 18.5 && $regime['calories_per_day'] > 1800)
        $score += 20;
    elseif ($bmi >= 18.5 && $bmi < 25 && abs($regime['calories_per_day'] - 1800) < 300)
        $score += 20;

    // Score basé sur le niveau d'activité
    if ($profile['activity_level'] === 'very_active' && $regime['calories_per_day'] > 1800)
        $score += 15;
    elseif ($profile['activity_level'] === 'sedentary' && $regime['calories_per_day'] < 1600)
        $score += 15;

    return min($score, 100); // Score maximum de 100
}

function generateRecommendationText($profile, $bmi, $regime, $score)
{
    $objectiveText = [
        'weight_loss' => 'perte de poids',
        'muscle_gain' => 'prise de masse musculaire',
        'maintenance' => 'maintien de poids',
        'endurance' => 'amélioration de l\'endurance'
    ];

    $text = "Ce régime {$regime['type_name']} est recommandé pour votre objectif de {$objectiveText[$profile['objective']]}";

    if ($score > 80) {
        $text .= ". Il correspond parfaitement à votre profil IMC de " . number_format($bmi, 1);
    } elseif ($score > 60) {
        $text .= ". Il offre un bon équilibre pour votre métabolisme";
    } else {
        $text .= ". Il peut être adapté à vos besoins spécifiques";
    }

    return $text;
}

// Fonctions pour sauvegarder les recommandations
function saveRecommendation($userId, $regimeId, $activityId, $bmiValue, $score, $text)
{
    $pdo = getDBConnection();
    $stmt = $pdo->prepare("
        INSERT INTO recommendations (user_id, regime_id, activity_id, bmi_value, score, recommendation_text)
        VALUES (?, ?, ?, ?, ?, ?)
    ");

    return $stmt->execute([$userId, $regimeId, $activityId, $bmiValue, $score, $text]);
}

// Fonctions AJAX
function searchRegimes($query)
{
    $pdo = getDBConnection();
    $stmt = $pdo->prepare("
        SELECT r.*, rt.name as type_name 
        FROM regimes r 
        JOIN regime_types rt ON r.regime_type_id = rt.id 
        WHERE r.is_active = 1 AND (r.name LIKE ? OR r.description LIKE ?)
        ORDER BY r.name
    ");
    $searchTerm = "%$query%";
    $stmt->execute([$searchTerm, $searchTerm]);
    return $stmt->fetchAll();
}

function filterRegimes($filters)
{
    $pdo = getDBConnection();
    $sql = "
        SELECT r.*, rt.name as type_name 
        FROM regimes r 
        JOIN regime_types rt ON r.regime_type_id = rt.id 
        WHERE r.is_active = 1
    ";
    $params = [];

    if (!empty($filters['query'])) {
        $sql .= " AND (r.name LIKE ? OR r.description LIKE ?)";
        $params[] = '%' . $filters['query'] . '%';
        $params[] = '%' . $filters['query'] . '%';
    }

    if (!empty($filters['type'])) {
        $sql .= " AND r.regime_type_id = ?";
        $params[] = $filters['type'];
    }

    if (!empty($filters['max_price'])) {
        $sql .= " AND r.base_price <= ?";
        $params[] = $filters['max_price'];
    }

    if (!empty($filters['max_calories'])) {
        $sql .= " AND r.calories_per_day <= ?";
        $params[] = $filters['max_calories'];
    }

    $sql .= " ORDER BY r.name";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

// Fonctions utilitaires
function sanitizeInput($data)
{
    return htmlspecialchars(strip_tags(trim($data)));
}

function validateEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function jsonResponse($data, $statusCode = 200)
{
    http_response_code($statusCode);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

function validerEtAppliquerCode($userId, $codeValue)
{
    $pdo = getDBConnection();

    // 1. On vérifie si le code existe et n'est pas utilisé
    $stmt = $pdo->prepare("SELECT amount FROM recharge_codes WHERE code_value = ? AND is_used = FALSE");
    $stmt->execute([$codeValue]);
    $code = $stmt->fetch();

    if ($code) {
        $montant = $code['amount'];

        // 2. On ajoute l'argent au portefeuille
        $updateWallet = $pdo->prepare("UPDATE user_wallet SET balance = balance + ? WHERE user_id = ?");
        $updateWallet->execute([$montant, $userId]);

        // 3. On marque le code comme utilisé
        $updateCode = $pdo->prepare("UPDATE recharge_codes SET is_used = TRUE WHERE code_value = ?");
        $updateCode->execute([$codeValue]);

        return "SUCCES";
    }

    return "CODE_INVALIDE";
}


function getPrixGold($userId, $prixBase)
{
    $pdo = getDBConnection();

    $stmt = $pdo->prepare("SELECT fn_calculer_prix_regime(?, ?) AS prix_final");
    $stmt->execute([$userId, $prixBase]);
    $result = $stmt->fetch();

    return $result['prix_final'];
}

function getInfoPortefeuille($userId)
{
    $pdo = getDBConnection();

    $stmt = $pdo->prepare("SELECT balance, is_gold FROM user_wallet WHERE user_id = ?");
    $stmt->execute([$userId]);

    return $stmt->fetch();
}

/**
 * Permet à l'utilisateur de passer en mode GOLD
 */
function activerAbonnementGold($userId)
{
    $pdo = getDBConnection();
    $prixGold = 20.00; // Le tarif pour devenir membre VIP

    try {
        $pdo->beginTransaction();

        // 1. Vérifier le solde
        $stmt = $pdo->prepare("SELECT balance FROM user_wallet WHERE user_id = ?");
        $stmt->execute([$userId]);
        $wallet = $stmt->fetch();

        if ($wallet['balance'] < $prixGold) {
            return "SOLDE_INSUFFISANT";
        }

        // 2. Déduire l'argent et passer en Gold
        $update = $pdo->prepare("UPDATE user_wallet SET balance = balance - ?, is_gold = 1 WHERE user_id = ?");
        $update->execute([$prixGold, $userId]);

        $pdo->commit();
        return "SUCCES";
    } catch (Exception $e) {
        $pdo->rollBack();
        return "ERREUR_TECHNIQUE";
    }
}
?>