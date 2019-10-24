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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function () {

    Route::get('/', 'AdminController@index')->name('get-admin-view');


    Route::group(['prefix' => 'user'], function () {
        Route::resource('user','UserController');
        Route::get('destroy/{id}', 'UserController@destroy')->name('get-user-destroy');
        Route::get('edit/{id}', 'UserController@edit')->name('get-user-edit');
        Route::post('update/{id}', 'UserController@update')->name('post-user-update');

        
    });
    
    Route::group(['prefix' => 'location'], function () {
        Route::resource('location','LocationController');
        Route::get('destroy/{id}', 'LocationController@destroy')->name('get-location-destroy');
        Route::get('edit/{id}', 'LocationController@edit')->name('get-location-edit');
        Route::post('update/{id}', 'LocationController@update')->name('post-location-update');
    });

    //Route::delete('user/{id}', 'UserController@destroy');

    // Route::group(['prefix' => 'profile'], function () {
    //     Route::get('/', 'AdminController@profile')->name('get-admin-profile-view');
    // });
   // Route::get('/', 'AdminController@user')->name('get-user-view');
   
});
