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

use Illuminate\Http\Request;

$router->group(['prefix' => 'v1'], function () use ($router) {
    $router->group(['prefix' => 'queries'], function () use ($router) {
        $router->post('/', 'QueryController@create');
        $router->patch('/', 'QueryController@update');
        $router->get('{id}/', 'QueryController@get');
    });
});

