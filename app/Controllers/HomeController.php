<?php

namespace App\Controllers;

use Core\Http\Request;
use Core\Http\Response;
use Core\Views\View;

class HomeController {

    /**
     * Render the twig template.
     *
     * @param Request $request The HTTP request.
     * @return Response The rendered view as a response.
     */
    public function index(Request $request): Response {
        $content = View::render('home', ['title' => 'Home']);
        return new Response($content);
    }
}