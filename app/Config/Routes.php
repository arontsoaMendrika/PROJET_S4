<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Auth / Front Office routes
$routes->get('register', 'Auth::register');
$routes->get('register-health', 'Auth::registerHealth');
$routes->get('login', 'Auth::login');
$routes->get('forgot-password', 'Auth::forgotPassword');
$routes->get('profile', 'Auth::profile');
// POST handlers
$routes->post('register', 'Auth::register');
$routes->post('register-health', 'Auth::registerHealth');
$routes->post('login', 'Auth::login');
$routes->post('forgot-password', 'Auth::forgotPassword');

// Recommandation routes
$routes->get('recommandation', 'RecommandationController::index');
$routes->post('recommandation/calculer', 'RecommandationController::calculer');

// Routes pour les régimes (CRUD complet)
$routes->get('regimes', 'RegimeController::index');
$routes->get('regimes/create', 'RegimeController::create');
$routes->post('regimes/store', 'RegimeController::store');
$routes->get('regimes/show/(:num)', 'RegimeController::show/$1');
$routes->get('regimes/edit/(:num)', 'RegimeController::edit/$1');
$routes->post('regimes/update/(:num)', 'RegimeController::update/$1');
$routes->get('regimes/delete/(:num)', 'RegimeController::delete/$1');
$routes->post('regimes/delete/(:num)', 'RegimeController::delete/$1');

// Routes pour les recommandations
$routes->get('recommandations', 'RecommandationController::index');
$routes->get('recommandations/form', 'RecommandationController::form');
$routes->post('recommandations/calculer', 'RecommandationController::calculer');

// Routes pour les profils utilisateurs
$routes->get('profiles', 'ProfileController::index');
$routes->get('profiles/form/(:num)', 'ProfileController::form/$1');
$routes->get('profiles/show/(:num)', 'ProfileController::show/$1');
$routes->post('profiles/save', 'ProfileController::save');

// Routes API pour AJAX (à implémenter plus tard)
// $routes->get('api/stats', 'ApiController::stats');
// $routes->get('api/search', 'ApiController::search');
// $routes->post('api/filter', 'ApiController::filter');
// $routes->post('api/like', 'ApiController::like');
// $routes->post('api/autosave', 'ApiController::autosave');
// $routes->get('api/recent_recommendations', 'ApiController::recentRecommendations');

// Route pour gérer les paramètres query string (?page=regimes)
$routes->get('home', 'StaticController::home');

$routes->get('wallet', 'Wallet::index');
$routes->post('wallet/recharger', 'Wallet::recharger');
$routes->get('wallet/devenirGold', 'Wallet::devenirGold');

// Routes pour le Back-Office (Mendrika)
$routes->get('admin', 'Admin::index');

$routes->post('admin/generateCodes', 'Admin::generateCodes');
