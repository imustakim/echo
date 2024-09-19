<?php

namespace App\Controllers;

use Core\Http\Request;
use Core\Http\Response;
use Core\Views\View;

class AboutController { 
    
    /**
     * Render the twig template.
     *
     * @param Request $request The HTTP request.
     * @return Response The rendered view as a response.
     */
    public function index(Request $request): Response {
        $content = View::render('about', ['title' => 'About']);
        return new Response($content);
    }
}