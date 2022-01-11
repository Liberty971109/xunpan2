<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    // $router->get('ask', 'AskController@index');
    $router->resource('ask',AskController::class);
    // $router->get('ask', 'AskController@index');
    $router->get('web', 'WebController@index');
    $router->get('web/create', 'WebController@create');
    $router->post('web', 'WebController@store');
    // $router->get('ask/{id}/edit', 'AskController@edit');
    // $router->post('ask/{id}', 'AskController@update');

    // $router->resource('auth/users', 'AdminUserController');

});
