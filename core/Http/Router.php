<?php

namespace Core\Http;

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class Router {
    private RouteCollection $routes;

    public function __construct() {
        $this->routes = new RouteCollection();
    }

    public function add(string $method, string $path, callable $handler): void {
        $route = new Route($path, ['_handler' => $handler]);
        $route->setMethods([$method]);
        $this->routes->add($path, $route);
    }

    public function dispatch(Request $request): Response {
        $path = $request->getPathInfo();
        $method = $request->getMethod();
        
        try {
            $route = $this->routes->get($path);

            if (!$route || !in_array($method, $route->getMethods(), true)) {
                throw new RouteNotFoundException('Route not found');
            }

            $handler = $route->getDefault('_handler');
            return call_user_func($handler, $request);
        } catch (RouteNotFoundException $e) {
            return new Response('404 Not Found', 404);
        }
    }
}