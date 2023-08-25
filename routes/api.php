<?php

$router->group(
    [
        'prefix' => 'api',
        'middleware' => ['localization']
    ],
    function () use ($router) {
        $router->post('register', ['uses' => 'Auth\RegisterController@index']);
        $router->post('login', ['uses' => 'Auth\LoginController@index']);
        $router->post('logout', ['uses' => 'Auth\LogoutController@index']);

        $router->group(['prefix' => 'product'], function () use ($router) {
            $router->post('list', ['uses' => 'Product\ProductController@index']);
            $router->post('detail/{id}', ['uses' => 'Product\ProductController@show']);
        });
    }
);