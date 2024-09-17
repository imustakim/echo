<?php

namespace Core\Http;

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class Router {
    private RouteCollection $routes;

    /**
     * Initializes the router.
     */
    public function __construct() {
        $this->routes = new RouteCollection();
    }

    /**
     * Adds a route to the router.
     *
     * @param string $method The HTTP method this route should respond to.
     * @param string $path The path this route should respond to.
     * @param callable $handler The handler to call when this route matches.
     */

    public function add(string $method, string $path, callable $handler): void {
        $route = new Route($path, ['_handler' => $handler]);
        $route->setMethods([$method]);
        $this->routes->add($path, $route);
    }

    /**
     * Dispatches a route with the given request.
     *
     * @param Request $request The request to dispatch.
     * @return Response The response from the route or a 404 response if the route was not found.
     * @throws RouteNotFoundException If the route was not found.
     */
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