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
//用户登录
$router->post('/u/l','User\UserController@login');
//个人中心
//$router->get('/u/c','User\UserController@center');
//防刷
//$router->get('/u/order','User\UserController@order');
$router->get('/u/c', [
    'middleware' => 'user',
    'as' => '/u/c', 'uses' => 'User\UserController@center'
]);