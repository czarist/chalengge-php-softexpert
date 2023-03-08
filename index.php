<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/controllers/ProductController.php';
require_once __DIR__ . '/controllers/CategoryController.php';
require_once __DIR__ . '/controllers/TaxController.php';
require_once __DIR__ . '/config/routes.php';

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (($pos = strpos($uri, '?')) !== false) {
    $uri = substr($uri, 0, $pos);
}
$uri = rtrim($uri, '/');

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
        echo '404 Not Found';
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        header($_SERVER["SERVER_PROTOCOL"] . " 405 Method Not Allowed");
        echo '405 Method Not Allowed';
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        [$controllerName, $methodName] = explode('@', $handler);
        $controllerClass = '\\controllers\\' . $controllerName;
        $controller = new $controllerClass();
        $controller->$methodName($vars);
        break;
}
