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

$router->get('/', 'ContactListController@index');
$router->get('/contact/{contactList}', 'ContactListController@show');
$router->post('/add', 'ContactListController@store');
$router->put('/contact/update/{contactList}', 'ContactListController@update');
$router->delete('/contact/delete/{contactList}', 'ContactListController@destroy');
