<?php

use Core\Http\Router;

Router::get('/', 'HomeController@index');
Router::get('/about', 'AboutController@index');