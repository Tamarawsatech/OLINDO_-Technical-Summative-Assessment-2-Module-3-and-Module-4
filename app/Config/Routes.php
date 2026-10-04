<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('/tasks', 'Tasks::index');
$routes->get('/profile', 'Profile::index');
$routes->get('/about', 'About::index');
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::attemptLogin', ['filter' => 'csrf']);
$routes->get('/logout', 'Auth::logout');

$routes->get('/tasks/new', 'Tasks::newTask', ['filter' => 'auth']);
$routes->post('/tasks/create', 'Tasks::create', ['filter' => ['auth', 'csrf']]);
$routes->get('/tasks/edit/(:num)', 'Tasks::edit/$1', ['filter' => 'auth']);
$routes->post('/tasks/update/(:num)', 'Tasks::update/$1', ['filter' => ['auth', 'csrf']]);
$routes->post('/tasks/archive/(:num)', 'Tasks::archive/$1', ['filter' => ['auth', 'csrf']]);
