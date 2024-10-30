<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'Auth::index');

$routes->get('/dashboard', 'Home::index', ['filter' => 'auth']);
$routes->post('saveprofile', 'Home::saveProfile', ['filter' => 'auth']);
$routes->post('editprofile/(:num)', 'Home::editProfile/$1', ['filter' => 'auth']);

$routes->get('login', 'Auth::index');
$routes->post('deleteprofile', 'Home::deleteProfile');
$routes->post('auth/login', 'Auth::login');

// Logout user
$routes->get('logout', 'Auth::logout');

$routes->get('settings', 'Settings::index', ['filter' => 'auth']);
$routes->post('settings/updatePassword', 'Settings::updatePassword', ['filter' => 'auth']);
