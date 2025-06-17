<?php


use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->resource('register', ['controller' => 'MemberController']);
$routes->resource('login', ['controller' => 'MemberTokenController::login']);
$routes->resource('produk', ['controller' => 'ProdukController']);

$routes->options('(:any)', 'CorsController::options');