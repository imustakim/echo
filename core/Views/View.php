<?php

namespace Core\Views;

use Core\Http\Response;
use Core\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class View {

    /**
     * Renders a view template and returns the rendered HTML.
     *
     * @param string $template The name of the template file to render, without the extension.
     * @param array $data An array of data to pass to the template.
     * @param string $layout The name of the layout template to use, or null to not use a layout.
     * @return string  The rendered HTML.
     */
    public static function render(string $template, array $data = [], ?string $layout = 'layouts/main'): string {
        $twig = Twig::getTwig(); // Get the Twig environment
        $content = '';

        // Attempt to render the view's content
        try {
            $content = $twig->render($template . '.twig', $data);
        } catch (LoaderError | RuntimeError | SyntaxError $e) {
            return self::handleRenderingError("Error rendering template: " . $e->getMessage());
        }

        // Render the layout if provided
        if ($layout) {
            try {
                $content = $twig->render($layout . '.twig', array_merge($data, ['content' => $content]));
            } catch (LoaderError | RuntimeError | SyntaxError $e) {
                return self::handleRenderingError("Error rendering layout: " . $e->getMessage());
            }
        }
        return $content;
    }

    /**
     * Handle rendering errors.
     *
     * @param string $message
     * @return Response
     */
    private static function handleRenderingError(string $message): Response {
        return new Response($message, 500);
    }
}
