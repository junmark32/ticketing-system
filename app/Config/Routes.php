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

$routes->match(['post','get'],'/student/events', 'UserController::stud_displayEvents');
$routes->match(['post','get'],'/student/events/show-event-details/(:num)', 'UserController::showAvailableTickets/$1');
$routes->match(['post','get'],'/student/events/ticket/buy/(:num)', 'UserController::buyTicket/$1'); 
$routes->match(['post','get'],'/student/events/ticket/purchase/(:num)', 'UserController::purchaseTicket/$1');   


$routes->match(['post','get'],'/session', 'UserController::viewSessionData');
//admin
$routes->get('/admin/dashboard', 'AdminController::adminDB');
$routes->get('/admin/dashboard/add_event', 'AdminController::addEvent');
$routes->match(['post','get'],'/admin/insertEventWithTickets', 'AdminController::insertEventWithTickets');
$routes->match(['post','get'],'/admin/events', 'AdminController::displayEvents');
$routes->get('/admin/events/edit/(:num)', 'AdminController::updateEvent/$1');
$routes->post('/admin/events/update/(:num)', 'AdminController::updateEventWithTickets/$1');
$routes->get('/admin/avail-tickets', 'AdminController::showAvailTickets');
$routes->match(['post', 'get'], '/admin/avail-tickets/approved/(:num)', 'AdminController::approveTicket/$1');
$routes->match(['post', 'get'], '/admin/avail-tickets/declined/(:num)', 'AdminController::declineTicket/$1');

