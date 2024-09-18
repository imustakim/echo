<?php

namespace App\Controllers;

use Core\Http\Request;
use Core\Http\Response;
use Core\Views\View;

class HomeController {

    /**
     * Handle the homepage request and render the view.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response {
        // Render the 'home' view inside the 'layouts/main' layout
        return View::render('home', ['title' => 'Home']);
    }
}