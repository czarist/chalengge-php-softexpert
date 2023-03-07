<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/controllers/ProductController.php';
require_once __DIR__ . '/controllers/CategoryController.php';
require_once __DIR__ . '/controllers/TaxController.php';

use FastRoute\RouteCollector;

// Instancia o objeto da classe RouteCollector do FastRoute
$dispatcher = FastRoute\simpleDispatcher(function (RouteCollector $r) {
    // products
    $r->addRoute('GET', '/api/products', 'ProductController@index');
    $r->addRoute('GET', '/api/products/{id:\d+}', 'ProductController@show');
    $r->addRoute('POST', '/api/products', 'ProductController@store');
    $r->addRoute('POST', '/api/products/{id:\d+}', 'ProductController@update');
    $r->addRoute('DELETE', '/api/products/{id:\d+}', 'ProductController@destroy');

    // categories
    $r->addRoute('GET', '/api/categories', 'CategoryController@index');
    $r->addRoute('GET', '/api/categories/{id:\d+}', 'CategoryController@show');
    $r->addRoute('POST', '/api/categories', 'CategoryController@store');
    $r->addRoute('POST', '/api/categories/{id:\d+}', 'CategoryController@update');
    $r->addRoute('DELETE', '/api/categories/{id:\d+}', 'CategoryController@destroy');

    // taxes
    $r->addRoute('GET', '/api/taxes', 'TaxController@index');
    $r->addRoute('GET', '/api/taxes/{id:\d+}', 'TaxController@show');
    $r->addRoute('POST', '/api/taxes', 'TaxController@store');
    $r->addRoute('POST', '/api/taxes/{id:\d+}', 'TaxController@update');
    $r->addRoute('DELETE', '/api/taxes/{id:\d+}', 'TaxController@destroy');
});

// Define a URL atual a ser processada
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Remove a query string e os caracteres finais "/" da URI, se houverem
if (($pos = strpos($uri, '?')) !== false) {
    $uri = substr($uri, 0, $pos);
}
$uri = rtrim($uri, '/');

// Processa a rota e chama o respectivo controller e método, se encontrados
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // Página não encontrada
        header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
        echo '404 Not Found';
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        // Método HTTP não permitido para essa rota
        header($_SERVER["SERVER_PROTOCOL"] . " 405 Method Not Allowed");
        echo '405 Method Not Allowed';
        break;
    case FastRoute\Dispatcher::FOUND:
        // Rota encontrada: chama o controller e método correspondentes
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        [$controllerName, $methodName] = explode('@', $handler);
        $controllerClass = '\\controllers\\' . $controllerName;
        $controller = new $controllerClass();
        $controller->$methodName($vars);
        break;
}
