<?php

namespace Core\Session;

Class Session {
    public static function start() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function set(string $key, $value) { 
        $_SESSION[$key] = $value;
    }

    public static function get(string $key) {        
        return $_SESSION[$key] ?? null;
    }

    public static function remove(string $key) {
        unset($_SESSION[$key]);
    }

    public static function destroy() { 
        session_destroy();
    }
}