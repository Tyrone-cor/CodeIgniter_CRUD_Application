<?php

use App\Filters\AuthFilter;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//  $routes->get('/', 'Home::index');

 

//students
$routes->get('/', 'Home::index');

$routes->get('students', 'StudentsController::index');
$routes->get('students/create', 'StudentsController::create');
$routes->post('students/store', 'StudentsController::store');
$routes->get('students/edit/(:num)', 'StudentsController::edit/$1');
$routes->post('students/update/(:num)', 'StudentsController::update/$1');
$routes->get('students/delete/(:num)', 'StudentsController::delete/$1');
$routes->get('students/show/(:num)', 'StudentsController::show/$1');
$routes->get('students/search', 'StudentsController::search');