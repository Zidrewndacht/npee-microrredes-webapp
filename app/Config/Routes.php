<?php
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/prefill', 'Home::prefillDB');
$routes->get('api/collections', 'DataController::getCollections'); // More specific route
$routes->get('api/data/(:any)/(:num)', 'DataController::getData/$1/$2'); // More generic route
$routes->get('api/data/(:any)', 'DataController::getData/$1/1'); // Default to 1 record if limit is not provided

service('auth')->routes($routes);