<?php

namespace Core\Session;

Class Session {

    /**
     * Start the session if it hasn't been started yet.
     *
     * @return void
     */
    public static function start() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Set a value in the session.
     *
     * @param string $key The key to set.
     * @param mixed $value The value to set.
     * @return void
     */
    public static function set(string $key, $value) { 
        $_SESSION[$key] = $value;
    }

    /**
     * Get a value from the session.
     *
     * @param string $key The key to retrieve.
     * @return mixed The value stored in the session, or null if it doesn't exist.
     */
    public static function get(string $key) {        
        return $_SESSION[$key] ?? null;
    }

    /**
     * Remove a value from the session.
     *
     * @param string $key The key to remove.
     * @return void
     */
    public static function remove(string $key) {
        unset($_SESSION[$key]);
    }

    /**
     * Destroy the session. This will remove all session variables and destroy the session.
     *
     * @return void
     */
    public static function destroy() { 
        session_destroy();
    }
}