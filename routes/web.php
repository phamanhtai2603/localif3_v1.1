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
    return view('page.index');
});

Route::group(['namespace' => 'Auth','middleware' =>'checkLogout'], function () {
    Route::get('admin/login', 'LoginController@getAdminLogin');
    Route::post('admin/login', 'LoginController@postAdminLogin')->name('post-admin-login');

});
Route::get('admin/logout', 'Auth\LoginController@logout')->name('get-admin-logout');

Route::group(['prefix' => 'admin', 'middleware' => 'adminLogin'], function () {

    Route::get('/', 'AdminController@index')->name('get-admin-view');
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', 'AdminController@profile')->name('get-admin-profile-view');  
        Route::post('edit/{id}', 'AdminController@update')->name('post-admin-profile-update');
        Route::post('updatepassword/{id}','AdminController@updatepassword')->name('post-admin-password-update');
    });

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

    Route::group(['prefix' => 'comment'], function () {
        Route::resource('comment','CommentController');
        Route::get('destroy/{id}', 'CommentController@destroy')->name('get-comment-destroy');
        Route::get('index/{id}', 'CommentController@indexview')->name('get-comment-index');
        Route::get('hide/{id}', 'CommentController@hide')->name('get-comment-hide');
        // Route::get('edit/{id}', 'CommentController@edit')->name('get-comment-edit');
        // Route::post('update/{id}', 'CommentController@update')->name('post-comment-update');
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

//PAGE

Route::group(['prefix' => '/'], function () {
    
    Route::get('/', 'PageController@view')->name('get-page-view');
  //  Route::post('/search', 'PageController@search')->name('post-page-search');

    Route::get('login', 'PageLoginController@getLogin')->name('get-login')->middleware('checkuserLogout');
    Route::post('login', 'PageLoginController@postLogin')->name('post-login');
    Route::get('logout', 'PageLoginController@getLogout')->name('get-logout')->middleware('userLogin');
});


Route::group(['prefix' => '/'], function () {
    // Chưa đăng nhập mới đc sử dụng
     Route::group(['prefix' => 'register', 'middleware' => 'checkuserLogout'], function () {

        Route::get('/', 'PageRegisterController@view')->name('get-page-registration-view');
        Route::post('/', 'PageRegisterController@store')->name('post-page-registration-store');
        Route::get('/verify/{code}', 'PageRegisterController@verify')->name('get-page-verify');
    });
    //Xử lí liên quan đến 1 tour, book tour
    Route::group(['prefix' => 'tour'], function () {
        Route::get('/detail/{id}', 'PageTourController@view')->name('get-page-tourdetail-view');
        Route::post('/booktour/{id}', 'PageTourController@booktour')->name('post-page-booktour');
        Route::get('/thanks/{id}', 'PageTourController@thanks')->name('thanks');
    });
});

Route::group(['prefix' => 'user', 'middleware' => 'userLogin'], function () {
    //Những thứ cần login mới thực hiện
    Route::get('profile', 'PageUserController@view')->name('get-page-profile-view');
    Route::post('profile/update', 'PageUserController@update')->name('post-page-profile-update'); 

    //Role=2, tourguide mới làm đc
    Route::group(['prefix' => 'tourguide', 'middleware' => 'tourguideLogin'], function () {
        Route::resource('tourmanage','PageTourManageController');
    });

    Route::group(['prefix' => 'customer', 'middleware' => 'customerLogin'], function () {
        Route::resource('customerbooked','PageCustomerBookedTourController');
        Route::get('bookedtour/delete/{id}','PageCustomerBookedTourController@cancel')->name('get-page-customerbooked-cancel');
    });
});

//Trang tour: alltours - tours theo location
Route::get('tours', 'PageTourController@viewall')->name('get-page-alltours-view');
Route::get('location-tours/{id}', 'PageTourController@locationview')->name('get-page-location-tours-view');

//Xem profile người khác
Route::get('user-profile/{id}', 'PageUserController@userprofileview')->name('get-page-otheruser-profile-view');






Route::get('privateprofile', function () {
    return view('page.main.profile.private_profile');
});