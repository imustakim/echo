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

}