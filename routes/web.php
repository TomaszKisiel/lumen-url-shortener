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

$router->get('/c/{dec}', \ConverterController::class);

$router->get('/{hash}', \UrlController::class );
$router->post('/{hash}', \UrlController::class );
$router->put('/{hash}', \UrlController::class );
$router->patch('/{hash}', \UrlController::class );
$router->delete('/{hash}', \UrlController::class );
$router->head('/{hash}', \UrlController::class );
$router->options('/{hash}', \UrlController::class );

$router->get('/', 'HomeController@index' );
$router->post('/', 'HomeController@store' );

