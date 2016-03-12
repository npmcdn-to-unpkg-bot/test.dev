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
Route::get('/about/awards','AboutController@awards');
Route::get('/about/vacancies','AboutController@vacancies');
Route::get('/news','FrontController@news');
Route::get('/contacts','FrontController@contacts');
Route::get('/contacts/mail','ContactsController@mail');

Route::get('/catalog',['as'=>'catalog.all','uses'=>'CatalogController@index']);

Route::get('/catalog/search','CatalogController@search');
Route::get('/catalog/item/{id}','CatalogController@item',function($id){});
Route::get('/catalog/{category}',['as'=>'catalog.category','uses'=>'CatalogController@category',function(\App\Category $category){
}]);


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

Route::get('img/{model}/{template}/{name}',function($model,$template,$name){

    return $cached_image=Image::cache(function($image) use ($model,$template,$name){
        switch($template) {
            case 'small':
                return $image->make('uploads/' . $model . '/' . $name)->resize(80,113);
                break;
            case 'medium':
                return $image->make('uploads/' . $model . '/' . $name)->resize(160,226);
                break;
            case 'large':
                return $image->make('uploads/' . $model . '/' . $name)->resize(320,452);
                break;
            case 'x_large':
                return $image->make('uploads/' . $model . '/' . $name)->resize(470,678);
                break;
            default:
                return $image->make('uploads/'.$model.'/'.$name)->resize(160,226);
        }
        //return $image->make('uploads/'.$model.'/'.$name)->filter(new \Intervention\Image\Templates\Small());

    });

    /* return Response::make($cached_image, 200, array(
         'Content-Type'=> 'image/jpg'))->expire(\Carbon\Carbon::now()->addHour());*/

});


Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/dashboard','Back\DashboardController@index');
    Route::get('/dashboard/products','Back\DashboardController@products')->name('products.manage');
    Route::get('/dashboard/categories','Back\DashboardController@categories')->name('categories.manage');


    Route::get('/dashboard/products/create','Back\ProductsController@create')->name('product.create');
    Route::get('/dashboard/products/{id}/edit','Back\ProductsController@edit',function($id){});
    Route::post('/dashboard/products/{id}/publish','Back\ProductsController@publish',function($id){})->name('product.publish');
    Route::get('/dashboard/products/{product}/files','Back\ProductsController@files',function(\App\Product $product){});

    Route::group(['prefix'=>'api'],function(){
        Route::resource('products','Back\ProductsController',
            ['only' => [
                'index', 'store','update','destroy'
            ]]);

        Route::resource('categories','Back\CategoriesController',
            ['only' => [
                'index','create','store','destroy'
            ]]);
    });

    Route::post('/dashboard/image/upload','Back\ImageController@upload');

    Route::get('/dashboard/vacancies','Back\DashboardController@vacancies')->name('vacancies.manage');
    Route::get('/dashboard/vacancies/create','Back\VacanciesController@create')->name('vacancies.create');
    Route::post('/dashboard/vacancies/store','Back\VacanciesController@store');

    //Route::get('/home', 'HomeController@index');
});


/*Route::get('/views/{folder}/{page}',function($folder,$page){

 if(View::exists('back.'.$folder.'.'.$page)){
    return  View::make('back.'.$folder.'.'.$page);
 }
    else{

        abort(404,"Page not Found");
    }

});*/


