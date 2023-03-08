<?php

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

