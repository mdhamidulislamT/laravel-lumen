<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return "<h1>I am laravel lumen api, Phone book </h1>";
});

$router->post('/registration', 'RegistrationController@registration');
$router->post('/login', 'LoginController@login');
// phone book management
$router->post('/store', ['middleware'=>'auth', 'uses'=>'PhoneBookController@store']);
$router->post('/update/{id}', ['middleware'=>'auth', 'uses'=>'PhoneBookController@update']);
$router->post('/select', ['middleware'=>'auth', 'uses'=>'PhoneBookController@onSelect']);
$router->post('/delete', ['middleware'=>'auth', 'uses'=>'PhoneBookController@onDelete']);
