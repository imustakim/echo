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

    /**
     * Retrieve input data from the request body.
     * Automatically decodes JSON if content type is application/json.
     *
     * @param string|null $key
     * @param mixed $default
     * @return mixed
     */
    public function input(string $key = null, $default = null) {
        if ($this->isJson()) {
            $data = json_decode($this->getContent(), true);
        } else {
            $data = array_merge($this->request->all(), $this->query->all()); // Merges GET and POST data
        }

        if ($key) {
            return $data[$key] ?? $default;
        }

        return $data;
    }

    /**
     * Check if the request is of type JSON.
     *
     * @return bool
     */
    public function isJson(): bool {
        return str_contains($this->headers->get('Content-Type'), 'application/json');
    }
}
