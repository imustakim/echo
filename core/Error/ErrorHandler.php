<?php

namespace Core\Error;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class ErrorHandler { 

    public static function init(): void {

        error_reporting(E_ALL);        
        ini_set('display_errors', '0');

        $log = new Logger('app');
        $log->pushHandler(new StreamHandler(__DIR__ . '/../Logs/app.log', Logger::ERROR));

        set_exception_handler(function($exception) use ($log) {
            $log->error($exception->getMessage(), ['exception' => $exception]);
            http_response_code(500);
            echo "An error occurred: {$exception->getMessage()}";
        });

        set_error_handler(function ($severity, $message, $file, $line) use ($log) {
            if(!(error_reporting() & $severity)) {
                return;
            }
            $log->error($message, ['file' => $file, 'line' => $line]);
            throw new \ErrorException($message, 0, $severity, $file, $line);
        });
    }
}