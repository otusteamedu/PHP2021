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

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->group(['prefix' => 'v1'], function () use ($router) {
        $router->group(['prefix' => 'queries'], function () use ($router) {
//            $router->get('create', function () use ($router) {
//
//                return $router->app->version();
//            });
            $router->post('create', function () use ($router) {
                return $router->app->version();
            });
        });
    });
});


