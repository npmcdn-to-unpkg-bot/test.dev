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


Route::get('/','FrontController@index');
Route::get('/about','FrontController@about');
Route::get('/news','FrontController@news');
Route::get('/contacts','FrontController@contacts');

Route::get('/products','ProductController@index');



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

/*Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::group(['middleware' => ['web']], function () {
    //
});*/

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/dashboard','Back\DashboardController@index');
    Route::get('/dashboard/products','Back\DashboardController@products')->name('products.manage');
    Route::get('/dashboard/categories','Back\DashboardController@categories')->name('categories.manage');


    Route::get('/dashboard/products/create','Back\ProductsController@create')->name('product.create');


    Route::group(['prefix'=>'api'],function(){
        Route::resource('products','Back\ProductsController',
            ['only' => [
                'index', 'store','destroy'
            ]]);

        Route::resource('categories','Back\CategoriesController',
            ['only' => [
                'index','create', 'store','destroy'
            ]]);
    });




    //Route::get('/home', 'HomeController@index');
});




