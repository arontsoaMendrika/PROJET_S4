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
