<?php

use Core\Http\Request;

use Core\Http\Router;
use Core\Error\ErrorHandler;
use Core\Database\Connection;

// Load composer autoloader
require_once __DIR__ . '/../vendor/autoload.php';

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Initialize error handling
ErrorHandler::init();

// Set up the database connection
Connection::init(); // Initializes Capsule and sets it as global

// Initialize the router
Router::init(); // Ensure routes are initialized

// Create Router instance
$router = new Router();

// Define routes
require_once __DIR__ . '/../app/routes.php';

// Dispatch the request
$request = Request::createFromGlobals();
$response = $router->dispatch($request);
$response->send();
