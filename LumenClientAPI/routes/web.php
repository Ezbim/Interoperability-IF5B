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


$router->get('/getRequestJson', 'PostsController@getRequestJson');

$router->get('/createRequestJson', 'PostsController@createRequestJson');
$router->get('/changeRequestJson','PostsController@changeRequestJson');
$router->post('/postRequestJson','PostsController@postRequestJson');
$router->get('/updateRequestJson/{id}','PostsController@updateRequestJson');
$router->put('/changeRequestJson', 'PostsController@changeRequestJson');
$router->get('/deleteRequestJson/{id}','PostsController@deleteRequestJson');