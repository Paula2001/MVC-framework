<?php

//    Front controller
//    PHP version 5.4
//constants

//Routing
require '../Core/Router.php';
//Namespaces more like using namespace std ; in c++
use Core\Router;

$router = new Router();

// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id}/{action}');
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);

//Auto loader
spl_autoload_register(function ($class) {
    $root = dirname(__DIR__);   // get the parent directory
    $file = $root . '/' . str_replace('\\', '/', $class) . '.php';

    if (is_readable($file)) {
        require $root . '/' . str_replace('\\', '/', $class) . '.php';
    }
});
//dispatch the router mean convert the controllers into studly caps and actions into camel cases
$router->dispatch($_SERVER['QUERY_STRING']);


print_r( $router->getParams() );