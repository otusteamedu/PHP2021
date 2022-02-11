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
use Illuminate\Support\Facades\Bus;

$router->group(['prefix' => 'v1'], function () use ($router) {
    $router->group(['prefix' => 'queries'], function () use ($router) {
        $router->post('create', 'QueryController@create');
        $router->patch('update', function (Request $request) {
            $this->validate($request, ['id' => 'string', 'text' => 'string']);
            $queryId = \Illuminate\Support\Str::uuid();
            dispatch(new \App\Jobs\QueryActionJob(\Illuminate\Support\Str::uuid(), $request->get('text')));
            return response($queryId);
        });
        $router->get('get', function (Request $request) {
            $connection = null;
            $default = 'default';

            // For the delayed jobs
            var_dump(
                \Queue::getRedis()
                    ->connection($connection)
                    ->zrange('queues:' . $default . ':delayed', 0, -1)
            );

            // For the reserved jobs
            var_dump(
                \Queue::getRedis()
                    ->connection($connection)
                    ->zrange('queues:' . $default . ':reserved', 0, -1)
            );
//            \Redis::lrange('queues:default', 0, -1);
//            dd(Bus::findBatch($request->get('id')));
            return response('OK');
        });
    });
});

