<?php

namespace Core\Views;

use Core\Http\Response;
use Core\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class View {
    /**
     * Render a view using Twig.
     *
     * @param string $template The name of the Twig template file (without the .twig extension).
     * @param array $data Data to be passed to the view.
     * @param string|null $layout Optional layout template to wrap the view content.
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public static function render(string $template, array $data = [], ?string $layout = 'layouts/main'): Response {
        $twig = Twig::getTwig(); // Get the Twig environment

        // Render the view's content
        try {
            $content = $twig->render($template . '.twig', $data);
        } catch (LoaderError | RuntimeError | SyntaxError $e) {
            // Handle potential rendering errors and log if necessary
            return new Response("Error rendering template: " . $e->getMessage(), 500);
        }

        // If a layout is provided, render the layout and inject the content
        if ($layout) {
            try {
                $content = $twig->render($layout . '.twig', array_merge($data, ['content' => $content]));
            } catch (LoaderError | RuntimeError | SyntaxError $e) {
                return new Response("Error rendering layout: " . $e->getMessage(), 500);
            }
        }
        return new Response($content);
    }
}
