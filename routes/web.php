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

$router->get( '/{hash}', \ShortLinkController::class );
$router->post( '/{hash}', \ShortLinkController::class );
$router->put( '/{hash}', \ShortLinkController::class );
$router->patch( '/{hash}', \ShortLinkController::class );
$router->delete( '/{hash}', \ShortLinkController::class );
$router->head( '/{hash}', \ShortLinkController::class );
$router->options( '/{hash}', \ShortLinkController::class );

$router->get( '/', 'HomeController@index' );
$router->post( '/', 'HomeController@store' );


