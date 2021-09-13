<?php

/** @var Router $router */

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

use Laravel\Lumen\Routing\Router;

$router->group(
    ['prefix' => 'api'],
    function () use ($router) {
        $router->post('report_task', 'ReportTaskController@store');
        $router->get(
            'report_task/{reportTaskId:[0-9]+}',
            [
                'as' => 'report_task',
                'uses' => 'ReportTaskController@show'
            ]

        );
    }
);


