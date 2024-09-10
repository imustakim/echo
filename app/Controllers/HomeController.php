<?php

namespace App\Controllers;

use Core\Http\Request;
use Core\Http\Response;
use Core\Views\View;

class HomeController {

    public function __construct(private Request $request, private Response $response) {}

    public function index(): Response {
        return View::render('home', ['title'=>'Home']);
    }
}