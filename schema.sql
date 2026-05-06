DROP DATABASE IF EXISTS regime;
CREATE DATABASE regime CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE regime;

-- Users
CREATE TABLE users (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  email VARCHAR(255) NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  full_name VARCHAR(255) DEFAULT NULL,
  role VARCHAR(50) NOT NULL DEFAULT 'user',
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uq_users_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Diets (régimes/plans)
CREATE TABLE diets (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  user_id BIGINT UNSIGNED NOT NULL,
  name VARCHAR(255) NOT NULL,
  description TEXT DEFAULT NULL,
  start_date DATE DEFAULT NULL,
  end_date DATE DEFAULT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  KEY idx_diets_user_id (user_id),
  CONSTRAINT fk_diets_user
    FOREIGN KEY (user_id) REFERENCES users(id)
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Meals
CREATE TABLE meals (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  diet_id BIGINT UNSIGNED NOT NULL,
  name VARCHAR(255) NOT NULL,
  scheduled_date DATETIME DEFAULT NULL,
  notes TEXT DEFAULT NULL,
  PRIMARY KEY (id),
  KEY idx_meals_diet_id (diet_id),
  CONSTRAINT fk_meals_diet
    FOREIGN KEY (diet_id) REFERENCES diets(id)
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Recipes
CREATE TABLE recipes (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) NOT NULL,
  instructions LONGTEXT DEFAULT NULL,
  image_url VARCHAR(500) DEFAULT NULL,
  created_by BIGINT UNSIGNED DEFAULT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  KEY idx_recipes_created_by (created_by),
  FULLTEXT KEY ft_recipes_title_instructions (title, instructions),
  CONSTRAINT fk_recipes_user
    FOREIGN KEY (created_by) REFERENCES users(id)
    ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Ingredients
CREATE TABLE ingredients (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY uq_ingredients_name (name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Recipe <-> Ingredient
CREATE TABLE recipe_ingredients (
  recipe_id BIGINT UNSIGNED NOT NULL,
  ingredient_id BIGINT UNSIGNED NOT NULL,
  quantity VARCHAR(100) DEFAULT NULL,
  PRIMARY KEY (recipe_id, ingredient_id),
  KEY idx_recipe_ingredients_ingredient_id (ingredient_id),
  CONSTRAINT fk_recipe_ingredients_recipe
    FOREIGN KEY (recipe_id) REFERENCES recipes(id)
    ON DELETE CASCADE,
  CONSTRAINT fk_recipe_ingredients_ingredient
    FOREIGN KEY (ingredient_id) REFERENCES ingredients(id)
    ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Meal items linking meals to recipes
CREATE TABLE meal_items (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  meal_id BIGINT UNSIGNED NOT NULL,
  recipe_id BIGINT UNSIGNED NOT NULL,
  portion DECIMAL(10,2) NOT NULL DEFAULT 1.00,
  PRIMARY KEY (id),
  KEY idx_meal_items_meal_id (meal_id),
  KEY idx_meal_items_recipe_id (recipe_id),
  CONSTRAINT fk_meal_items_meal
    FOREIGN KEY (meal_id) REFERENCES meals(id)
    ON DELETE CASCADE,
  CONSTRAINT fk_meal_items_recipe
    FOREIGN KEY (recipe_id) REFERENCES recipes(id)
    ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Measurements (poids, tour de taille, etc.)
CREATE TABLE measurements (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  user_id BIGINT UNSIGNED NOT NULL,
  measured_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  weight_kg DECIMAL(6,2) DEFAULT NULL,
  waist_cm DECIMAL(6,2) DEFAULT NULL,
  notes TEXT DEFAULT NULL,
  PRIMARY KEY (id),
  KEY idx_measurements_user_time (user_id, measured_at),
  CONSTRAINT fk_measurements_user
    FOREIGN KEY (user_id) REFERENCES users(id)
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Progress logs / journaux
CREATE TABLE progress_logs (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  user_id BIGINT UNSIGNED NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  entry TEXT NOT NULL,
  PRIMARY KEY (id),
  KEY idx_progress_logs_user_id (user_id),
  CONSTRAINT fk_progress_logs_user
    FOREIGN KEY (user_id) REFERENCES users(id)
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Audit logs
CREATE TABLE audit_logs (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  user_id BIGINT UNSIGNED DEFAULT NULL,
  action VARCHAR(100) NOT NULL,
  table_name VARCHAR(100) DEFAULT NULL,
  row_id VARCHAR(100) DEFAULT NULL,
  details JSON DEFAULT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  KEY idx_audit_logs_user_id (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




