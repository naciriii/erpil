<?php

$router->get('/', function () use ($router) {
    return 'Integration Layer service';
});

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

//global Integration layer authentication thorugh auth middleware
$router->group(['middleware' => 'auth', 'prefix' => 'api'], function () use ($router) {
//Authentication with magento rest api route	
    $router->post('auth', 'AuthController@authenticate');

    $router->group(['middleware' => 'hastoken'], function () use ($router) {
        /*
        |--------------------------------------------------------------------------
        | Api Routes
        |--------------------------------------------------------------------------
        | Routes that communicates with Magento Rest Api here
        */
        $router->post('/categories', 'CategoryController@index');
        $router->post('/categories/store', 'CategoryController@store');

        $router->post('/products', 'ProductController@index');
        $router->post('/products/store', 'ProductController@store');
        $router->post('/products/{sku}', 'ProductController@show');
        $router->post('/products/update/{sku}', 'ProductController@update');
        $router->post('/products/delete/{sku}', 'ProductController@delete');
        $router->post('/customers','CustomerController@index');
    });
});
