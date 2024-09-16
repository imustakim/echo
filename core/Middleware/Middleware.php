<?php

namespace Core\Middleware;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Middleware {
    private array $middlewares = [];

    /**
     * Add a middleware to the stack.
     *
     * @param callable $middleware The middleware function.
     * @return void
     */
    public function add(callable $middleware): void {
        $this->middlewares[] = $middleware;
    }

    /**
     * Execute all middlewares with the request.
     *
     * @param Request $request The request to handle.
     * @return Response The response from the middleware or default response.
     */
    public function handle(Request $request): Response {
        foreach ($this->middlewares as $middleware) {
            $response = call_user_func($middleware, $request);
            if ($response instanceof Response) {
                return $response;
            }
        }
        return new Response('No middleware returned a response', 500);
    }
}
