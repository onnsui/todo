<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/** @var Illuminate\Routing\Router $router */
$router = app('Illuminate\Routing\Router');

$router->group(['middleware' => ['guest:api']], function () use ($router) {
    $router->post('/login', 'AuthController@login')->name('auth-login');
});
$router->group(['middleware' => ['auth:api']], function () use ($router) {
    $router->get('/me', 'AuthController@me')->name('auth-me');
});

$router->group(['prefix' => 'task'], function () use ($router) {
    $router->get('', 'TaskController@index')->name('task-index');
    $router->post('', 'TaskController@store')->name('task-store');
    $router->put('{taskId}', 'TaskController@update')->name('task-update');
    $router->delete('{taskId}', 'TaskController@delete')->name('task-delete');
});

$router->group(['prefix' => 'category'], function () use ($router) {
    $router->get('', 'CategoryController@index')->name('category-index');
    $router->post('', 'CategoryController@store')->name('category-store');
    $router->put('{categoryId}', 'CategoryController@update')->name('category-update');
    $router->delete('{categoryId}', 'CategoryController@delete')->name('category-delete');
});
