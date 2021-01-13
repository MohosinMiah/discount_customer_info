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

// Route::get('/', function () {
//     echo "<h1>Start .............   Hello Bangladesh</h1>";
// });



/*
|--------------------------------------------------------------------------
| Home Routes
|--------------------------------------------------------------------------
|
| Here contains All Home Routes File
|
*/

Route::get('/', 'HomeController@index')->name('home');;





/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here contains All Seller Routes File
|
*/

Route::group(['prefix'=>'admins','as'=>'admin.'], function(){

    Route::get('/login', ['as' => 'login', 'uses' => 'AdminController@login'])->name('admin_login');
    
    Route::post('/login/post', ['as' => 'login', 'uses' => 'AdminController@login_post'])->name('admin_login_post');

    Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'AdminController@dashboard'])->name('admin_dashboard');



    Route::get('/forgotten', ['as' => 'forgotten', 'uses' => 'AdminController@forgotten_password'])->name('admin_forgotten_password');

    Route::post('/send/otp', ['as' => 'otp', 'uses' => 'AdminController@send_otp'])->name('admin_send_otp');

    Route::get('/send/otp', ['as' => 'send_otp', 'uses' => 'AdminController@otp_updata'])->name('admin_otp');

    Route::post('/otp/check', ['as' => 'otp_check', 'uses' => 'AdminController@otp_check'])->name('admin_otp_check');

    Route::get('/password/reset', ['as' => 'pass_reset', 'uses' => 'AdminController@password_reset'])->name('admin_reset_pass');

    Route::post('/password/newpassword', ['as' => 'newpassword', 'uses' => 'AdminController@new_password'])->name('admin_new_pass');



    // Seller Settings Route    **********************

    Route::get('/seller/create', ['as' => 'seller_create', 'uses' => 'AdminController@create'])->name('admin_seller_create');

    Route::post('/seller/create/store', ['as' => 'seller_create_store', 'uses' => 'AdminController@store'])->name('admin_seller_create_store');
   
    Route::get('/sellers', ['as' => 'seller_all', 'uses' => 'AdminController@all'])->name('admin_seller_all');
    
    Route::get('/seller/edit/{id}', ['as' => 'seller_edit', 'uses' => 'AdminController@edit'])->name('admin_seller_edit');
    
    Route::post('/seller/update/{id}', ['as' => 'seller_update', 'uses' => 'AdminController@update'])->name('admin_seller_update');

    Route::get('/seller/view/{id}', ['as' => 'seller_view', 'uses' => 'AdminController@show'])->name('admin_seller_show');
    
    Route::get('/seller/delete/{id}', ['as' => 'seller_destroy', 'uses' => 'AdminController@destroy'])->name('admin_seller_destroy');


    
    // Admin Settings Route    **********************
    Route::get('/settings', ['as' => 'admin_settings', 'uses' => 'AdminController@admin_settings'])->name('admin_settings');
  
    Route::post('/settings/info', ['as' => 'admin_info', 'uses' => 'AdminController@info'])->name('admin_settings_info');
   
    Route::post('/settings/change_pass', ['as' => 'admin_change_pass', 'uses' => 'AdminController@change_pass'])->name('admin_change_pass');
    
    Route::post('/settings/change_phone', ['as' => 'admin_change_phone', 'uses' => 'AdminController@change_phone'])->name('admin_change_phone');

    



    

});



/*
|--------------------------------------------------------------------------
| Seller Routes
|--------------------------------------------------------------------------
|
| Here contains All Seller Routes File 
|
*/

Route::group(['prefix'=>'sellers','as'=>'seller.'], function(){


    Route::get('/login', ['as' => 'login', 'uses' => 'SellerController@login'])->name('seller_login');

    Route::post('/login/post', ['as' => 'login', 'uses' => 'SellerController@login_post'])->name('seller_login_post');
   
    Route::get('/forgotten', ['as' => 'forgotten', 'uses' => 'SellerController@forgotten_password'])->name('seller_forgotten_password');
   
    Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'AdminController@dashboard'])->name('seller_dashboard');


});
