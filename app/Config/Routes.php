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

$routes->get('usuario', 'Usuario::index');
$routes->get('usuario/nuevo', 'Usuario::nuevo');
$routes->post('usuario/agregar', 'Usuario::agregar');
$routes->get('usuario/editar/(:num)', 'Usuario::editar/$1');
$routes->post('usuario/actualizar', 'Usuario::actualizar');
$routes->get('usuario/desactivar/(:num)', 'Usuario::desactivar/$1');
$routes->get('usuario/activar/(:num)', 'Usuario::activar/$1');
$routes->get('usuario/exportarExcel', 'Usuario::exportarExcel');











