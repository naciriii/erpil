<?php

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
$router->group(['middleware' => 'auth','prefix'=>'api'], function () use ($router) {
//Authentication with magento rest api route	
	$router->post('/auth','AuthController@authenticate');

	$router->group(['middleware' => 'hastoken'], function () use ($router) {
/*
|--------------------------------------------------------------------------
| Api Routes 
|--------------------------------------------------------------------------
| Routes that communicates with Magento Rest Api here
*/
	$router->post('/categories','CategoryController@index');


	});


});
$router->get('test','ExampleController@test');
$router->get('/', function () use ($router) {
    return $router->app->version();
});
$router->get('/users', ['middleware'=>'auth',function() {
	return "success";
}]);

/*
$router->get('/key', function() {
    return str_random(32);
});*/
