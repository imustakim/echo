<?php

namespace Core\Middleware;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Middleware {

    private array $middlewares = [];

    public function add(callable $middleware) {
        $this->middlewares[] = $middleware;
    }

    public function handle(Request $request): Response {
        foreach ($this->middlewares as $middleware) {
            $response = call_user_func($middleware, $request);
            if ($response instanceof Response) {
                return $response;
            }
        }
        return new Response('No middleware returned a response');
    }
}