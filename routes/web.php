<?php

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

    Route::group(['prefix' => 'steam'], function() 
    {
        Route::get('/', 'Admin\GeneralController@getHomepage');
        Route::get('home', 'Admin\GeneralController@getHomepage');
    });
