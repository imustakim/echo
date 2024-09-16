<?php

namespace Core\Database;

use Illuminate\Database\Capsule\Manager as Capsule;
use Exception;

class Database {

    /**
     * Initialize the database connection.
     *
     * @return void
     * @throws Exception If any required environment variable is missing.
     */
    public static function init(): void {
        $capsule = new Capsule;

        // Retrieve database configuration from environment variables
        $dbConfig = self::getDatabaseConfig();

        // Add the database connection
        $capsule->addConnection($dbConfig);

        // Set the Capsule instance as global and boot Eloquent
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }

    /**
     * Get database configuration from environment variables.
     *
     * @return array
     * @throws Exception If any required environment variable is missing.
     */
    private static function getDatabaseConfig(): array {
        $requiredEnvVars = [
            'DB_DRIVER', 'DB_HOST', 'DB_DATABASE', 'DB_USERNAME', 
            'DB_PASSWORD', 'DB_CHARSET', 'DB_COLLATION', 'DB_PREFIX'
        ];

        foreach ($requiredEnvVars as $var) {
            if (empty($_ENV[$var])) {
                throw new Exception("Missing environment variable: $var");
            }
        }

        return [
            'driver'    => $_ENV['DB_DRIVER'],
            'host'      => $_ENV['DB_HOST'],
            'database'  => $_ENV['DB_DATABASE'],
            'username'  => $_ENV['DB_USERNAME'],
            'password'  => $_ENV['DB_PASSWORD'],
            'charset'   => $_ENV['DB_CHARSET'],
            'collation' => $_ENV['DB_COLLATION'],
            'prefix'    => $_ENV['DB_PREFIX'],
        ];
    }
}
