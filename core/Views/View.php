<?php

namespace Core\Views;

use Core\Http\Response;

class View {
    public static function render(string $view, array $data = [], string $layout = 'layouts/main'): Response {
        // Extract data to variables
        extract($data);

        // Capture the content of the view
        ob_start();
        include __DIR__.'/../../app/Views/'.$view.'.php';
        $content = ob_get_clean();

        // Render the layout with the view content
        ob_start();
        include __DIR__.'/../../app/Views/'.$layout.'.php';
        $output = ob_get_clean();

        return new Response($output);
    }
}