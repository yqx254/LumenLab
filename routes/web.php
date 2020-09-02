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

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->post('/user/show[case]','UserController@show');

$router->get('/user/log','UserController@log');

$router->get('/user/except','UserController@except1');

$router->get('/user[/{id}]', ['as'  => 'detail' ,'uses'    =>'UserController@index']);

$router->get('/main', function(){
    return redirect()->route('detail');
});

$router->get('/show1', ['uses'  => 'UserController@show1']);

$router->get('/show2', ['uses'  => 'UserController@show2']);

$router->get('/collection', ['uses'  => 'UserController@caseCollections']);

$router->group(['middleware'    => ['mid'], 'prefix'   => 'filter', 'namespace'    => 'Filter'], function() use($router){
    $router->get('/profile',['uses'  => 'ProfileController@index']);
    $router->post('/edit',['uses'  => 'ProfileController@edit']);
});