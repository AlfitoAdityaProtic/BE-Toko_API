<?php


use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->resource('produk', ['controller' => 'ProdukController']);
$routes->resource('member', ['controller' => 'MemberController']);
$routes->resource('memberToken', ['controller' => 'MemberTokenController']);
