<?php

namespace Core\Http;

use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class Request extends SymfonyRequest {

    /**
     * Create a new request instance from the PHP superglobals.
     *
     * @return static
     */
    public static function createFromGlobals(): static {
        return new static(
            $_GET,
            $_POST,
            [],
            $_COOKIE,
            $_FILES,
            $_SERVER,
            file_get_contents('php://input')
        );
    }
}