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
        $this->routes->add($path, new Route($path, ['_method' => $method, '_handler' => $handler]));
    }

    public function dispatch(Request $request): Response {
        
        $path = $request->getPathInfo();
        $method = $request->getMethod();
        $handler = $this->routes->get($path)->getDefault('_handler');
        
        try {
            // Get the route and handler
            $route = $this->routes->get($path);
            $handler = $route->getDefault('_handler');
            
            // Check if the route exists and the method matches
            if($route === null || $route->getRequirement('_method') !== $method) {
                throw new RouteNotFoundException('Route not found');
            }
    
            // Call the handler and return the response
            $handler = $route->getDefault('_handler');
            return call_user_func($handler, $request);
        } catch (RouteNotFoundException $e) {
            // Return a 404 response if the route is not found
            return new Response('404 Not Found', 404);
        }
        
    }

}

