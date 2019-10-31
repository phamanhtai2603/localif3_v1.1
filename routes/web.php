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

Route::group(['namespace' => 'Auth'], function () {
    Route::get('admin/login', 'LoginController@getAdminLogin');
    Route::post('admin/login', 'LoginController@postAdminLogin')->name('post-admin-login');

    Route::get('admin/logout', 'LoginController@logout')->name('get-admin-logout');
});

Route::group(['prefix' => 'admin', 'middleware' => 'adminLogin'], function () {

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

    Route::group(['prefix' => 'tour'], function () {
        Route::resource('tour','TourController');
        Route::get('destroy/{id}', 'TourController@destroy')->name('get-tour-destroy');
        Route::get('edit/{id}', 'TourController@edit')->name('get-tour-edit');
        Route::post('update/{id}', 'TourController@update')->name('post-tour-update');
    });

    Route::group(['prefix' => 'bookedtour'], function () {
        Route::resource('bookedtour','BookedtourController');
        Route::get('destroy/{id}', 'BookedtourController@destroy')->name('get-bookedtour-destroy');
        Route::get('edit/{id}', 'BookedtourController@edit')->name('get-bookedtour-edit');
        Route::post('update/{id}', 'BookedtourController@update')->name('post-bookedtour-update');
    });

    Route::group(['prefix' => 'ajax'], function () {
        Route::get('bookedtour/{idTour}', 'AjaxController@getTour');
        Route::get('bookedtourguide/{idTour}', 'AjaxController@getTourguide');
        Route::get('bookedtourguideUnav/{idTour}', 'AjaxController@getTourguideUnav');
    });

    //Route::delete('user/{id}', 'UserController@destroy');

    // Route::group(['prefix' => 'profile'], function () {
    //     Route::get('/', 'AdminController@profile')->name('get-admin-profile-view');
    // });
   // Route::get('/', 'AdminController@user')->name('get-user-view');
   
});
