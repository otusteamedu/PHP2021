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

$router->get('/', function() use ($router) {
    return $router->app->version();
});

//Events
$router->group(['prefix' => 'events'], function () use ($router) {
    $router->post('', 'EventController@add');
    $router->delete('', 'EventController@deleteAll');
    $router->get('', 'EventController@get');
    $router->get('all_conditions', 'EventController@getAllConditions');
    $router->get('all', 'EventController@getAllEvents');
});





