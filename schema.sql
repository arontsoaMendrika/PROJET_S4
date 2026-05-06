CREATE DATABASE regime;
USE regime;


-- Users
CREATE TABLE users (
  id SERIAL PRIMARY KEY,
  email TEXT UNIQUE NOT NULL,
  password_hash TEXT NOT NULL,
  full_name TEXT,
  role TEXT DEFAULT 'user',
  created_at TIMESTAMP WITH TIME ZONE DEFAULT now(),
  updated_at TIMESTAMP WITH TIME ZONE DEFAULT now()
);

-- Diets (régimes/plans)
CREATE TABLE diets (
  id SERIAL PRIMARY KEY,
  user_id INT REFERENCES users(id) ON DELETE CASCADE,
  name TEXT NOT NULL,
  description TEXT,
  start_date DATE,
  end_date DATE,
  created_at TIMESTAMP WITH TIME ZONE DEFAULT now()
);

-- Meals
CREATE TABLE meals (
  id SERIAL PRIMARY KEY,
  diet_id INT REFERENCES diets(id) ON DELETE CASCADE,
  name TEXT NOT NULL,
  scheduled_date TIMESTAMP WITH TIME ZONE,
  notes TEXT
);

-- Recipes
CREATE TABLE recipes (
  id SERIAL PRIMARY KEY,
  title TEXT NOT NULL,
  instructions TEXT,
  image_url TEXT,
  created_by INT REFERENCES users(id),
  created_at TIMESTAMP WITH TIME ZONE DEFAULT now()
);

-- Ingredients
CREATE TABLE ingredients (
  id SERIAL PRIMARY KEY,
  name TEXT NOT NULL
);

-- Recipe <-> Ingredient
CREATE TABLE recipe_ingredients (
  recipe_id INT REFERENCES recipes(id) ON DELETE CASCADE,
  ingredient_id INT REFERENCES ingredients(id),
  quantity TEXT,
  PRIMARY KEY (recipe_id, ingredient_id)
);

-- Meal items linking meals to recipes
CREATE TABLE meal_items (
  id SERIAL PRIMARY KEY,
  meal_id INT REFERENCES meals(id) ON DELETE CASCADE,
  recipe_id INT REFERENCES recipes(id),
  portion REAL DEFAULT 1
);

-- Measurements (poids, tour de taille, etc.)
CREATE TABLE measurements (
  id SERIAL PRIMARY KEY,
  user_id INT REFERENCES users(id) ON DELETE CASCADE,
  measured_at TIMESTAMP WITH TIME ZONE DEFAULT now(),
  weight_kg REAL,
  waist_cm REAL,
  notes TEXT
);

-- Progress logs / journaux
CREATE TABLE progress_logs (
  id SERIAL PRIMARY KEY,
  user_id INT REFERENCES users(id),
  created_at TIMESTAMP WITH TIME ZONE DEFAULT now(),
  entry TEXT
);

-- Audit logs
CREATE TABLE audit_logs (
  id BIGSERIAL PRIMARY KEY,
  user_id INT,
  action TEXT NOT NULL,
  table_name TEXT,
  row_id TEXT,
  details JSONB,
  created_at TIMESTAMP WITH TIME ZONE DEFAULT now()
);




