<?php

$router->group(
    [
        'prefix' => 'api', 
        'middleware' => ['localization']
    ],
    function () use ($router) 
    {
        $router->post('register', ['uses' => 'Auth\RegisterController@index']);
        $router->post('login', ['uses' => 'Auth\LoginController@index']);
        $router->post('logout', ['uses' => 'Auth\LogoutController@index']);
    }
);