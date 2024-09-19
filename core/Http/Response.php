<?php

namespace Core\Http;

use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class Response extends SymfonyResponse {

    /**
     * Create a new response instance.
     *
     * @param string $content
     * @param int $status
     * @param array $headers
     */
    public function __construct(string $content = '', int $status = 200, array $headers = []) {
        parent::__construct($content, $status, $headers);
    }

    /**
     * Send a JSON response.
     *
     * @param array $data
     * @param int $status
     * @param array $headers
     * @return static
     */
    public static function json(array $data, int $status = 200, array $headers = []): static {
        $headers = array_merge($headers, ['Content-Type' => 'application/json']);
        return new static(json_encode($data), $status, $headers);
    }
}
