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

    // ROUTES WITH AUTH
    $router->group(['middleware' => 'auth:api'], function ($router) {
        $router->post('logout', 'AuthController@logout');
        $router->get('me', 'UserController@me');
        $router->post('refresh', 'AuthController@refresh');

        $router->group(['prefix' => 'users'], function ($router) {
            $router->get('/', 'UserController@all');
            $router->post('/', 'UserController@store');
            $router->put('/{id}', 'UserController@update');
            $router->delete('/{id}', 'UserController@store');
        });

        $router->group(['prefix' => 'students'], function ($router) {
            $router->get('/', 'StudentController@all');
            $router->get('/courses/{id}', 'StudentController@courses');
            $router->post('/activities', 'StudentController@publishActivity');
            $router->get('/activities/{id}', 'StudentController@courses');
        });

        $router->group(['prefix' => 'teachers'], function ($router) {
            $router->get('/courses/{id}', 'TeacherController@courses');
        });

        $router->group(['prefix' => 'activities'], function ($router) {
            $router->get('/', 'ActivityController@all');
            $router->post('/', 'ActivityController@store');
            $router->put('/{id}', 'ActivityController@update');
            $router->delete('/{id}', 'ActivityController@store');
        });

        $router->group(['prefix' => 'courses'], function ($router) {
            $router->get('/', 'CourseController@all');
            $router->post('/', 'CourseController@store');
            $router->get('/activities/{id}', 'CourseController@activities');
            $router->put('/{id}', 'CourseController@update');
            $router->delete('/{id}', 'CourseController@store');
        });
    });
});
