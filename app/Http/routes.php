<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
    Route::get('/order/{id}/show', 'OrderController@show');
    Route::post('/order/{id}/edit', 'OrderController@addComment');
    Route::post('/order/{id}/archive', 'OrderController@archive');
    Route::post('/order/{id}/return_order', 'OrderController@return_order');
    Route::get('/order/create', 'OrderController@create');
    Route::post('/order/create', 'OrderController@save');

    Route::get('/customer/{id}', 'CustomerController@show');
    Route::get('/customer', 'CustomerController@home');
    Route::post('/customer/{id}', 'CustomerController@update');
});
