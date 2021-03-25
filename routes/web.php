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

// API route group
$router->group(['prefix' => 'api'], function () use ($router) {
    // Matches "/api/register
    $router->post('register', 'AuthController@register');

    // Matches "/api/login
    $router->post('login', 'AuthController@login');

    $router->group(['middleware' => 'auth.jwt'], function () use ($router) {

        // $router->get('users/one', 'AuthController@getOneUser');
        // $router->get('users/role/{id}', 'AuthController@getRoleUser'); //---->role ada  2
        $router->put('users/update/{id}', 'AuthController@update');


        $router->get('projects', 'ProjectController@index');
        $router->post('/projects/create', 'ProjectController@store');
        $router->put('/projects/update/{id}', 'ProjectController@update');
        $router->delete('/projects/delete/{id}', 'ProjectController@delete');
    });
});

// generate app_key
// $router->get('/key', function() {
//     return Illuminate\Support\Str::random(36);
// });
