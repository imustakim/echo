<?php

namespace Core\Views;

use Symfony\Component\HttpFoundation\Response;

class View {
    public static function render(string $view, array $data = []): Response {
        extract($data);
        ob_start();

        include __DIR__.'/../../app/Views/'.$view.'.php';

        $content = ob_get_clean();
        return new Response($content);
    }
}