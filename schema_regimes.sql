-- Structure des régimes et activités pour Itokiana ETU004364
-- Extension du schéma existant

USE regime;

-- Table des types de régimes
CREATE TABLE regime_types (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table des régimes (remplace et étend la table diets existante)
CREATE TABLE regimes (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    regime_type_id BIGINT UNSIGNED NOT NULL,
    duration_days INT NOT NULL,
    base_price DECIMAL(10,2) NOT NULL,
    calories_per_day INT NOT NULL,
    protein_percentage DECIMAL(5,2) NOT NULL,
    carbs_percentage DECIMAL(5,2) NOT NULL,
    fat_percentage DECIMAL(5,2) NOT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY idx_regimes_type (regime_type_id),
    CONSTRAINT fk_regimes_type
        FOREIGN KEY (regime_type_id) REFERENCES regime_types(id)
        ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table des tarifications
CREATE TABLE pricing_plans (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    regime_id BIGINT UNSIGNED NOT NULL,
    duration_days INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    discount_percentage DECIMAL(5,2) DEFAULT 0,
    is_popular BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY idx_pricing_regime (regime_id),
    CONSTRAINT fk_pricing_regime
        FOREIGN KEY (regime_id) REFERENCES regimes(id)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table des activités sportives
CREATE TABLE activities (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    calories_burned_per_hour INT NOT NULL,
    intensity_level ENUM('low', 'moderate', 'high') NOT NULL,
    category VARCHAR(100) NOT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table des profils utilisateurs (étendue)
CREATE TABLE user_profiles (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id BIGINT UNSIGNED NOT NULL,
    height_cm DECIMAL(5,2) NOT NULL,
    weight_kg DECIMAL(5,2) NOT NULL,
    age INT NOT NULL,
    gender ENUM('male', 'female', 'other') NOT NULL,
    activity_level ENUM('sedentary', 'lightly_active', 'moderately_active', 'very_active', 'extremely_active') NOT NULL,
    objective ENUM('weight_loss', 'muscle_gain', 'maintenance', 'endurance') NOT NULL,
    target_weight_kg DECIMAL(5,2),
    medical_conditions TEXT,
    allergies TEXT,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY idx_user_profiles_user (user_id),
    CONSTRAINT fk_user_profiles_user
        FOREIGN KEY (user_id) REFERENCES users(id)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table des recommandations
CREATE TABLE recommendations (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id BIGINT UNSIGNED NOT NULL,
    regime_id BIGINT UNSIGNED NOT NULL,
    activity_id BIGINT UNSIGNED NOT NULL,
    bmi_value DECIMAL(5,2) NOT NULL,
    score DECIMAL(5,2) NOT NULL,
    recommendation_text TEXT NOT NULL,
    is_accepted BOOLEAN DEFAULT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY idx_recommendations_user (user_id),
    KEY idx_recommendations_regime (regime_id),
    KEY idx_recommendations_activity (activity_id),
    CONSTRAINT fk_recommendations_user
        FOREIGN KEY (user_id) REFERENCES users(id)
        ON DELETE CASCADE,
    CONSTRAINT fk_recommendations_regime
        FOREIGN KEY (regime_id) REFERENCES regimes(id)
        ON DELETE CASCADE,
    CONSTRAINT fk_recommendations_activity
        FOREIGN KEY (activity_id) REFERENCES activities(id)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table des abonnements utilisateurs
CREATE TABLE user_subscriptions (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id BIGINT UNSIGNED NOT NULL,
    regime_id BIGINT UNSIGNED NOT NULL,
    pricing_plan_id BIGINT UNSIGNED NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    status ENUM('active', 'expired', 'cancelled', 'pending') DEFAULT 'pending',
    total_price DECIMAL(10,2) NOT NULL,
    payment_status ENUM('pending', 'paid', 'failed', 'refunded') DEFAULT 'pending',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY idx_subscriptions_user (user_id),
    KEY idx_subscriptions_regime (regime_id),
    KEY idx_subscriptions_pricing (pricing_plan_id),
    CONSTRAINT fk_subscriptions_user
        FOREIGN KEY (user_id) REFERENCES users(id)
        ON DELETE CASCADE,
    CONSTRAINT fk_subscriptions_regime
        FOREIGN KEY (regime_id) REFERENCES regimes(id)
        ON DELETE CASCADE,
    CONSTRAINT fk_subscriptions_pricing
        FOREIGN KEY (pricing_plan_id) REFERENCES pricing_plans(id)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insertion des données initiales

-- Types de régimes
INSERT INTO regime_types (name, description) VALUES
('Cétogène', 'Régime riche en lipides et pauvre en glucides'),
('Méditerranéen', 'Diète basée sur la cuisine méditerranéenne traditionnelle'),
('Végétarien', 'Régime sans viande mais avec produits laitiers et œufs'),
('Vegan', 'Régime strictement végétal sans aucun produit animal'),
('Équilibré', 'Régime équilibré avec tous les groupes alimentaires');

-- Activités sportives
INSERT INTO activities (name, description, calories_burned_per_hour, intensity_level, category) VALUES
('Course à pied', 'Course modérée en extérieur ou sur tapis', 400, 'moderate', 'cardio'),
('Yoga', 'Yoga doux pour la flexibilité et le bien-être', 180, 'low', 'flexibility'),
('Musculation', 'Entraînement de force avec poids et machines', 300, 'moderate', 'strength'),
('Natation', 'Nage modérée en piscine', 350, 'moderate', 'cardio'),
('Cyclisme', 'Vélo d''intérieur ou d''extérieur', 450, 'moderate', 'cardio');

-- Régimes
INSERT INTO regimes (name, description, regime_type_id, duration_days, base_price, calories_per_day, protein_percentage, carbs_percentage, fat_percentage) VALUES
('Keto Premium', 'Régime cétogène personnalisé pour perte de poids rapide', 1, 30, 49.00, 1500, 25.00, 5.00, 70.00),
('Méditerranéen Classique', 'Diète méditerranéenne équilibrée pour la santé', 2, 30, 39.00, 1800, 18.00, 45.00, 37.00),
('Végétarien Proteïné', 'Régime végétarien riche en protéines végétales', 3, 30, 35.00, 1700, 20.00, 50.00, 30.00),
('Vegan Sportif', 'Régime vegan optimisé pour les sportifs', 4, 30, 38.00, 2000, 22.00, 48.00, 30.00),
('Balance Complet', 'Régime équilibré pour maintien et bien-être', 5, 30, 29.00, 1600, 17.00, 52.00, 31.00);

-- Plans de tarification
INSERT INTO pricing_plans (regime_id, duration_days, price, discount_percentage, is_popular) VALUES
(1, 30, 49.00, 0, FALSE),
(1, 60, 89.00, 9.18, FALSE),
(1, 90, 119.00, 18.97, TRUE),
(2, 30, 39.00, 0, FALSE),
(2, 60, 69.00, 11.54, FALSE),
(2, 90, 89.00, 23.93, TRUE),
(3, 30, 35.00, 0, FALSE),
(3, 60, 59.00, 15.71, FALSE),
(3, 90, 79.00, 24.76, TRUE),
(4, 30, 38.00, 0, FALSE),
(4, 60, 65.00, 14.47, FALSE),
(4, 90, 89.00, 21.93, TRUE),
(5, 30, 29.00, 0, FALSE),
(5, 60, 49.00, 15.52, FALSE),
(5, 90, 69.00, 20.69, TRUE);
