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
    Route::get('/', function () {
        return view('welcome');
    });
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/article', 'ArticlesListController@index');
    Route::get('/article/create', 'ArticlesListController@create');
    Route::post('/article/create', 'ArticlesListController@save');

    Route::get('/archive', 'ArchiveController@archive');

    //Route::get('/home', 'HomeController@index');
    Route::get('/home', 'CalendarController@index');
    
    Route::get('/order/{id}/show', 'OrderController@show');
    Route::get('/order/{id}/edit', 'OrderController@edit');
    Route::post('/order/{id}/update', 'OrderController@update');
    // Route::post('/order/{id}/comment', 'OrderController@addComment');
    Route::post('/order/{id}/archive', 'OrderController@archive');
    Route::post('/order/{id}/return_order', 'OrderController@return_order');
    Route::get('/order/create', 'OrderController@create');
    Route::post('/order/create', 'OrderController@save');

    Route::get('/calendar/', 'CalendarController@index');
    Route::get('/calendar/events', 'CalendarController@events');

    Route::get('/customer/{id}/show', 'CustomerController@show');
    Route::get('/customer', 'CustomerController@home');
    Route::post('/customer/{id}/update', 'CustomerController@update');
    Route::get('/customer/create', 'CustomerController@create');
    Route::post('/customer/create', 'CustomerController@save');

    Route::get('/orderevent/{id}/edit', 'OrderEventController@edit');
    Route::post('/orderevent/{id}/update', 'OrderEventController@update');

    Route::get('/admin/create_user', 'UserController@create');
    Route::post('/admin/user/create', 'UserController@save');

    Route::get('/tire', 'TireController@tires');
    Route::post('/tire/file', 'TireController@file');

    //---------------------------------API----------------------------------------------------------------------
    Route::post('/orderevent/delete', 'OrderEventController@delete');
    Route::post('/order/delete', 'OrderController@delete');
    Route::get('/order/exists/{id}', 'OrderController@exists');
    Route::post('/order/comment', 'OrderController@comment');
    Route::get('/order/getNextOrderId', 'OrderController@getNextOrderId');

    Route::get('/customer/get/{id}', 'CustomerController@get');
    Route::post('/customer/get', 'CustomerController@getCustomer');
    Route::get('/customer/exists/{id}', 'CustomerController@exists');
    Route::get('/customer/getCustomers', 'CustomerController@getCustomers');
    Route::get('/customer/anyData', 'CustomerController@anyData');
    Route::post('/customer/saveAjax', 'CustomerController@saveAjax');
    Route::get('/customer/getNextId', 'CustomerController@getNextId');

    Route::get('/archive/getArchive', 'ArchiveController@getArchive');

    Route::get('/article/exists/{id}', 'ArticlesListController@exists');
    Route::post('/article/order/add', 'ArticleController@add');
    Route::post('/article/order/delete/', 'ArticleController@delete');

    Route::get('/calendar/getEvent/{id}', 'CalendarController@getEvent');

    Route::get('/admin/user/exists/{email}', 'UserController@exists');
});
