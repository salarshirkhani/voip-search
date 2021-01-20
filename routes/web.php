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


Route::get('profile', 'FrontController@profile')->name('profile');


Auth::routes();

Route::prefix('dashboard')
    ->name('dashboard.')
    ->middleware('auth')
    ->namespace('Dashboard')
    ->group(function() {
        Route::get('', 'IndexController@get')->name('index');
        Route::prefix('admin')
            ->name('admin.')
            ->namespace('admin')
            ->group(function() {
                Route::get('', 'IndexController@get')->name('index');   
                
                Route::get('voip/create', 'PostController@GetCreatePost')->name('voip.create');
                Route::post('voip/create', 'PostController@CreatePost')->name('voip.create');

                Route::get('voip/manage', 'PostController@GetManagePost')->name('voip.manage');
               
            });

        Route::prefix('customer')
            ->name('customer.')
            ->namespace('Customer')
            ->group(function() {
                Route::get('', 'IndexController@get')->name('index');
                Route::get('search', 'SearchController@search')->name('search');

            });


    });
