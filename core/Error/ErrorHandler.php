<?php

namespace Core\Error;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class ErrorHandler { 

    /**
     * Initialize error handling.
     *
     * This method sets up Monolog and an exception handler to log and display errors
     * in a way that is safe for production. Errors are logged with a full stack trace,
     * and a generic error message is displayed to the user.
     *
     * You can uncomment the line with `nl2br(htmlspecialchars($exception->getMessage() . "\n" . $exception->getTraceAsString()))`
     * to display more information during development.
     */

    public static function init(): void {
        error_reporting(E_ALL);        
        ini_set('display_errors', '0');  // Ensure errors are not displayed on the screen in production

        $log = new Logger('app');
        $log->pushHandler(new StreamHandler(__DIR__ . '/../Logs/app.log', Logger::ERROR));

        set_exception_handler(function($exception) use ($log) {
            // Log full stack trace
            $log->error($exception->getMessage(), [
                'exception' => $exception,
                'trace' => $exception->getTraceAsString(),
            ]);

            // Display a generic message to the user
            http_response_code(500);
            echo "An error occurred. Please try again later.";

            // Optional: For development, you might want to display more information
            // Uncomment the following line if you need more details during development
            // echo nl2br(htmlspecialchars($exception->getMessage() . "\n" . $exception->getTraceAsString()));
        });

        set_error_handler(function ($severity, $message, $file, $line) use ($log) {
            // Check if the error should be reported
            if (!(error_reporting() & $severity)) {
                return;
            }

            // Log the error with a stack trace (this part is tricky, because standard PHP errors don't have stack traces)
            $log->error($message, [
                'file' => $file,
                'line' => $line,
                'severity' => $severity,
                'trace' => (new \Exception())->getTraceAsString(),
            ]);

            // Convert to an ErrorException to trigger the exception handler
            throw new \ErrorException($message, 0, $severity, $file, $line);
        });
    }
}