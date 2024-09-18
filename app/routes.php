<?php

use Core\Http\Router;

Router::get('/', 'HomeController@index');
Router::get('/about', 'HomeController@about');
Router::post('/contact', 'ContactController@submit');