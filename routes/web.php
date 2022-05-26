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
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function ($router) {
    $router->post('login', 'AuthController@login');
    $router->post('logout', 'AuthController@logout');

    // ROUTES WITH AUTH
    $router->group(['middleware' => 'auth:api'], function ($router) {
        $router->get('me', 'UserController@me');
        $router->get('users', 'UserController@getUsers');
        $router->post('refresh', 'AuthController@refresh');
    });
});
