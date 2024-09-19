<?php

namespace Core\Views;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Twig {
    private static ?Environment $twig = null;

    /**
     * Initialize Twig.
     */
    public static function init(): void {
        if (self::$twig === null) {
            $loader = new FilesystemLoader(__DIR__ . '/../../app/Views');
            self::$twig = new Environment($loader, [
                'cache' => __DIR__ . '/../../cache/twig',
                'debug' => false, // Set to false in production
            ]);
        }
    }

    /**
     * Get the Twig environment.
     *
     * @return Environment
     */
    public static function getTwig(): Environment {
        if (self::$twig === null) {
            self::init();
        }
        return self::$twig;
    }
}