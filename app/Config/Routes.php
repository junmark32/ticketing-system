<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/tickets/login', 'UserController::index');
$routes->match(['post','get'],'/fn_login', 'UserController::fn_login');
// $routes->get('/Admin/Dashboard', 'UserController::adminDashboard');
$routes->get('/Student/Register', 'UserController::studentRegister');
$routes->match(['post','get'],'/registerStudent', 'UserController::registerStudent');
$routes->get('/Alumni/Register', 'UserController::alumniRegister');
$routes->match(['post','get'],'/registerAlumni', 'UserController::registerAlumni');
$routes->get('/Outsider/Register', 'UserController::outsiderRegister');
$routes->match(['post','get'],'/registerOutsider', 'UserController::registerOutsider');

//admin
$routes->get('/admin/dashboard', 'AdminController::adminDB');
$routes->get('/admin/dashboard/add_event', 'AdminController::addEvent');
$routes->match(['post','get'],'/admin/insertEventWithTickets', 'AdminController::insertEventWithTickets');
$routes->match(['post','get'],'/admin/events', 'AdminController::displayEvents');
$routes->get('/admin/events/edit/(:num)', 'AdminController::updateEvent/$1');
$routes->post('/admin/events/update/(:num)', 'AdminController::updateEventWithTickets/$1');
