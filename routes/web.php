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

$router->get( '/{link}', \ShortLinkController::class );
$router->post( '/{link}', \ShortLinkController::class );
$router->put( '/{link}', \ShortLinkController::class );
$router->patch( '/{link}', \ShortLinkController::class );
$router->delete( '/{link}', \ShortLinkController::class );
$router->head( '/{link}', \ShortLinkController::class );
$router->options( '/{link}', \ShortLinkController::class );

$router->get( '/', 'DashboardController@index' );
$router->post( '/', 'DashboardController@store' );



