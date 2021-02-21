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


// generate app_key
// $router->get('/key', function() {
//     return Illuminate\Support\Str::random(36);
// });

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

        $router->get('users/all', 'AuthController@getAllUser');
        $router->get('users/One/{id}', 'AuthController@getOneUser');
        $router->get('users/Role/{id}', 'AuthController@getRoleUser'); //---->role ada  2
        $router->put('users/update/{id}', 'AuthController@update');
        
        $router->post('register/kasirs', 'AuthController@registerKasir');
        $router->post('login/kasirs', 'AuthController@loginKasir');

        $router->get('suppliers', 'SupplierController@index');
        $router->post('/suppliers/create', 'SupplierController@store');
        $router->put('/suppliers/update/{id}', 'SupplierController@update');
        $router->delete('/suppliers/delete/{id}', 'SupplierController@delete');

        $router->get('kategoris', 'KategoriController@index');
        $router->post('/kategoris/create', 'KategoriController@store');
        $router->put('/kategoris/update/{id}', 'KategoriController@update');
        $router->delete('/kategoris/delete/{id}', 'KategoriController@delete');
    });
});

