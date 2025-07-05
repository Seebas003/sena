<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/registro', 'Registro::index');
$routes->post('/registro/guardar', 'Registro::guardar');
$routes->get('/registro/exito', 'Registro::exito');

$routes->get('/login', 'Login::index');
$routes->post('/login/acceder', 'Login::acceder');  
$routes->get('/logout', 'Login::salir');            

$routes->get('/dashboard', 'Empleados::dashboard');
$routes->get('/dashboardAprendiz', 'Empleados::dashboardAprendiz');
$routes->get('/empleados/exportar', 'Empleados::exportarExcel');

// 👉 Agrega estas rutas nuevas si estás usando el controlador que te dejé
$routes->post('/login/autenticar', 'Login::autenticar'); // alternativo a acceder
$routes->get('/panel', function () {
    return view('panel');
});
