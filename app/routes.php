<?php

use App\Controllers\HomeController;
use Core\Http\Request;
use Core\Http\Response;

$router->add('GET', '/', function (Request $request) {
    $controller = new HomeController($request, new Response());
    return $controller->index();
});