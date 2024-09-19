<?php

namespace Core\Error;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class ErrorHandler { 
    private static Logger $log;

    /**
     * Initialize error handling.
     *
     * This method sets up Monolog and an exception handler to log and display errors
     * in a way that is safe for production. Errors are logged with a full stack trace,
     * and a generic error message is displayed to the user.
     */
    public static function init(): void {
        error_reporting(E_ALL);        
        ini_set('display_errors', '0');  // Ensure errors are not displayed on the screen in production

        self::$log = new Logger('app');
        self::$log->pushHandler(new StreamHandler(__DIR__ . '/../../logs/app.log', \Monolog\Level::Debug)); // Log everything in debug mode

        set_exception_handler(function($exception) {
            self::handleException($exception);
        });

        set_error_handler(function ($severity, $message, $file, $line) {
            self::handleError($severity, $message, $file, $line);
        });
    }

    /**
     * Handle an exception by logging the full stack trace and displaying a generic error message to the user.
     *
     * @param \Throwable $exception The exception to handle.
     */
    public static function handleException($exception): void {
        // Log full stack trace
        self::$log->error($exception->getMessage(), [
            'exception' => $exception,
            'trace' => $exception->getTraceAsString(),
            'request' => self::getRequestData(), // Log request data
        ]);

        // Display a generic message to the user
        http_response_code(500);
        echo "An error occurred. Please try again later.";
    }

    /**
     * Handle an error by logging the full error message and converting it to an ErrorException
     * to trigger the exception handler.
     *
     * @param int $severity The error level
     * @param string $message The error message
     * @param string $file The file where the error occurred
     * @param int $line The line where the error occurred
     */
    private static function handleError($severity, $message, $file, $line): void {
        // Check if the error should be reported
        if (!(error_reporting() & $severity)) {
            return;
        }

        // Log the error
        self::$log->error($message, [
            'file' => $file,
            'line' => $line,
            'severity' => $severity,
            'trace' => (new \Exception())->getTraceAsString(),
            'request' => self::getRequestData(), // Log request data
        ]);

        // Convert to an ErrorException to trigger the exception handler
        throw new \ErrorException($message, 0, $severity, $file, $line);
    }

    /**
     * Gather request data for logging (you can customize this based on what you need).
     *
     * @return array Request data with keys: method, uri, headers, body
     */
    private static function getRequestData(): array {
        // Gather request data for logging (you can customize this based on what you need)
        return [
            'method' => $_SERVER['REQUEST_METHOD'] ?? 'N/A',
            'uri' => $_SERVER['REQUEST_URI'] ?? 'N/A',
            'headers' => getallheaders(),
            'body' => file_get_contents('php://input'),
        ];
    }


    /**
     * Log an incoming request for debugging purposes.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     */
    public static function logRequest($request): void {
        self::$log->info('Incoming Request', [
            'method' => $request->getMethod(),
            'uri' => $request->getRequestUri(),
            'headers' => $request->headers->all(),
            'ip' => $request->getClientIp(),
            'timestamp' => date('Y-m-d H:i:s'),
        ]);
    }
}