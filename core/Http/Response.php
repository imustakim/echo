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

    /**
     * Add cache headers to the response.
     *
     * @param int $minutes
     * @return $this
     */
    public function withCache(int $minutes): self {
        $this->headers->addCacheControlDirective('public', true);
        $this->headers->addCacheControlDirective('max-age', $minutes * 60);
        $this->headers->set('Expires', gmdate('D, d M Y H:i:s', time() + ($minutes * 60)) . ' GMT');
        return $this;
    }
}
