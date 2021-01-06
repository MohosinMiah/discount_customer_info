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

    Route::get('/forgotten', ['as' => 'forgotten', 'uses' => 'AdminController@forgotten_password'])->name('admin_forgotten_password');


});