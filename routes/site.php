<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'Admin', 'middleware' =>'auth:admin', 'prefix' => 'admin'], function (){

    Route::get('index','DashboardController@index')->name('admin.dashboard');
    Route::get('logout','LoginController@logout')->name('admin.logout');

});

Route::group(['namespace' => 'Admin', 'middleware' => 'guest:admin', 'prefix' => 'admin'], function(){
    Route::get('/login','LoginController@login')->name('admin.login.page');
    Route::post('/check-login','LoginController@checkLogin')->name('check.admin.login');
});
