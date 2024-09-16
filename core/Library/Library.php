<?php

namespace Core\Library;

class Library {
    private const LIBRARY_DIRECTORY = __DIR__ . '/../../../app/Libraries/';

    /**
     * Loads a library file if it exists.
     *
     * @param string $library Name of the library to load (without .php extension).
     * @throws \RuntimeException If the library file is not found.
     */
    public static function load(string $library): void {
        $file = self::LIBRARY_DIRECTORY . $library . '.php';

        if (!file_exists($file)) {
            throw new \RuntimeException("Library file not found: " . $file);
        }

        require_once $file;
    }
}