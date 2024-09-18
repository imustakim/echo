<?php

namespace Core\Http;

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class Router {
    private static ?RouteCollection $routes = null; // Ensures it starts as null

    /**
     * Initializes the route collection if it hasn't been initialized yet.
     */
    public static function init(): void {
        if (self::$routes === null) {
            self::$routes = new RouteCollection();
        }
    }

    /**
     * Add a GET route.
     *
     * @param string $path
     * @param string $controllerAction
     */
    public static function get(string $path, string $controllerAction): void {
        self::init(); // Ensure initialization before adding a route
        self::addRoute('GET', $path, $controllerAction);
    }

    /**
     * Add a POST route.
     *
     * @param string $path
     * @param string $controllerAction
     */
    public static function post(string $path, string $controllerAction): void {
        self::init(); // Ensure initialization before adding a route
        self::addRoute('POST', $path, $controllerAction);
    }

    /**
     * Internal method to add a route.
     *
     * @param string $method
     * @param string $path
     * @param string $controllerAction
     */
    private static function addRoute(string $method, string $path, string $controllerAction): void {
        $route = new Route($path, ['_controllerAction' => $controllerAction]);
        $route->setMethods([$method]);
        self::$routes->add($path, $route);
    }

    /**
     * Dispatches the request to the appropriate controller and method.
     *
     * @param Request $request
     * @return Response
     */
    public static function dispatch(Request $request): Response {
        $path = $request->getPathInfo();
        $method = $request->getMethod();

        try {
            $route = self::$routes->get($path);

            if (!$route || !in_array($method, $route->getMethods(), true)) {
                throw new RouteNotFoundException('Route not found');
            }

            [$controller, $method] = explode('@', $route->getDefault('_controllerAction'));
            $controller = "App\\Controllers\\$controller";

            if (!class_exists($controller) || !method_exists($controller, $method)) {
                throw new RouteNotFoundException('Controller or method not found');
            }

            $controllerInstance = new $controller();
            return call_user_func([$controllerInstance, $method], $request);
        } catch (RouteNotFoundException $e) {
            return new Response('404 Not Found', 404);
        }
    }
}