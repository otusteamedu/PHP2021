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

    //Авторизация Passport
    Dusterio\LumenPassport\LumenPassport::routes($router->app, ['prefix' => 'oauth']);

    //Авторизация по email/password
    $router->post('login', 'AuthController@login');

    //Методы отчетов

    $router->group(['prefix' => 'report', 'middleware' => 'auth'], function () use ($router) {
        $router->post('', 'Api\ReportRequestController@store');
        $router->get('status/{id}', 'Api\ReportRequestController@getStatus');
        $router->get('{id}', 'Api\ReportRequestController@show');
    });

});

$router->get('/', function () use ($router) {
    return $router->app->version();
});
