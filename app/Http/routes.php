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
    return view('home');
});

Route::get('/book', 'BookController@getAllBooks');
Route::post('/book/add', 'BookController@addBook');
Route::post('/book/update', 'BookController@updateBook');
Route::post('/book/delete', 'BookController@deleteBook');

Route::get('/order', 'OrderController@getAllOrders');

Route::get('/user', 'UserController@getAllUsers');
Route::post('/user/add', 'UserController@addUser');
Route::post('/user/update', 'UserController@updateUser');
Route::post('/user/delete', 'UserController@deleteUser');

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

/*Route::group(['middleware' => ['web']], function () {
    
});*/
