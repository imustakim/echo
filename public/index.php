<?php

use Core\Http\Request;
use Core\Http\Response;
use Core\Http\Router;
use Core\Error\ErrorHandler;
use Core\Database\Database;

// Load composer autoloader
require "../vendor/autoload.php";

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Initialize error handling
ErrorHandler::init();

// Set up the database connection
Database::init();

// Create Router instance
$router = new Router();

// Define routes
require '../app/routes.php';

// Dispatch the request
$request = Request::createFromGlobals();
$response = $router->dispatch($request);
$response->send();