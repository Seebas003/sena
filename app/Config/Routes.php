<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Login::index');
$routes->post('/login/acceder', 'Login::acceder');
$routes->get('/logout', 'Login::salir');
$routes->get('/dashboard', 'Dashboard::index');

$routes->get('/registro', 'Registro::index');
$routes->post('/registro/guardar', 'Registro::guardar');
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/dashboard/aprendiz', 'Dashboard::aprendiz');
$routes->get('/dashboard/instructor', 'Dashboard::instructor');






