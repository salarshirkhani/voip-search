<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'FrontController@index')->name('/');
Route::get('search', 'FrontController@search')->name('search');
Route::get('cart', 'FrontController@cart')->name('cart');
Route::get('pay', 'FrontController@payment')->name('pay');
Route::post('pay', 'FrontController@pay')->name('pay');

Auth::routes();

Route::prefix('dashboard')
    ->name('dashboard.')
    ->middleware('auth')
    ->namespace('Dashboard')
    ->group(function() {
        Route::get('/', 'IndexController@get')->name('index');   
        Route::prefix('admin')
            ->name('admin.')
            ->namespace('admin')
            ->group(function() {
                Route::get('/', 'IndexController@get')->name('index');   
                
                Route::get('voip/create','PostController@GetCreatePost')->name('voip.create');
                Route::post('voip/create','PostController@CreatePost')->name('voip.create');

                Route::get('voip/manage', 'PostController@GetManagePost')->name('voip.manage');
                Route::get('deletepost/{id}','PostController@DeletePost')->name('voip.deletepost');  
                Route::get('updatepost/{id}','PostController@GetEditPost')->name('voip.updatepost');
                Route::post('updatepost/{id}','PostController@UpdatePost')->name('voip.updatepost');

                //Users
                Route::get('users/index', 'UserController@GetUsers')->name('users.index'); 
                Route::get('deleteuser/{id}','UserController@DeleteUser')->name('users.deleteuser');  
                Route::get('users/single/{id}','UserController@SingleUsers')->name('users.single');  
                Route::post('users/single/{id}','UserController@UpdateUsers')->name('users.single');  

            });

        Route::prefix('customer')
            ->name('customer.')
            ->namespace('Customer')
            ->group(function() {
                Route::get('', 'IndexController@get')->name('index');
                Route::get('search', 'SearchController@search')->name('search');

            });


    });
