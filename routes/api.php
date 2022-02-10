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
use Illuminate\Support\Facades\Validator;

$router->group(['prefix' => 'v1'], function () use ($router) {
    $router->post('create', function (Request $request) {
        $this->validate($request, ['text' => 'required|string']);
        $queryId = \Illuminate\Support\Str::uuid();
        dispatch(new \App\Jobs\QueryActionJob(\Illuminate\Support\Str::uuid(), $request->get('text')));
        return response($queryId);
    });
    $router->patch('update', function (Request $request) {
        dispatch(new \App\Jobs\QueryActionJob(\Illuminate\Support\Str::uuid(), 'content'));
        return response('OK');
    });
    $router->get('get', function (Request $request) {
        dispatch(new \App\Jobs\QueryActionJob(\Illuminate\Support\Str::uuid(), 'content'));
        return response('OK');
    });
});

