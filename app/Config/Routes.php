<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Routes pour la partie d'Itokiana (Recommandations et Régimes)
$routes->get('recommandation', 'RecommandationController::index');
$routes->post('recommandation/calculer', 'RecommandationController::calculer');
