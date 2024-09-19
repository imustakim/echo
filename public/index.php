<?php

use Core\Http\Request;
use Core\Http\Router;
use Core\Error\ErrorHandler;
use Core\Database\Connection;
use Core\Session\Session;
use Core\Views\Twig;
// Load composer autoloader
require_once __DIR__ . '/../vendor/autoload.php';

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Start the session
Session::start();

// Initialize error handling
ErrorHandler::init();

// Set up the database connection
Connection::init();

// Initialize Twig
Twig::init();

// Initialize the router
Router::init(); // Ensure routes are initialized

// Create Router instance
$router = new Router();

// Define routes
require_once __DIR__ . '/../app/routes.php';

try {
    // Dispatch the request
    $request = Request::createFromGlobals();

    // Uncomment the following line to log the request data
    // ErrorHandler::logRequest($request);

    $response = $router->dispatch($request);
    $response->prepare($request);

    $response->send();
} catch (\Throwable $e) {
    // Catch any unhandled exceptions
    ErrorHandler::handleException($e);
}