<?php


use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->resource('produk', ['controller' => 'ProdukController']);
$routes->resource('register', ['controller' => 'MemberController']);
$routes->resource('login', ['controller' => 'MemberTokenController::login']);
