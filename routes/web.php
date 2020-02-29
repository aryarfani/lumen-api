<?php

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
    $router->get('/kucing', 'KucingController@index');
    $router->get('/kucing/{id}', 'KucingController@show');
    $router->post('/kucing', 'KucingController@create');
    $router->post('/kucing/{id}', 'KucingController@update');
    $router->delete('/kucing/{id}', 'KucingController@destroy');
});
