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

Route::group(['namespace' => 'Site', 'middleware' =>'auth:vendor', 'prefix' => 'vendor'], function (){

    Route::get('soon','SoonController@soon')->name('vendor.soon');

});

Route::group(['namespace' => 'Site', 'middleware' => 'guest:vendor', 'prefix' => 'vendor'], function(){
    Route::get('/register','VendorRegisterationController@register')->name('vendor.register.page');
    Route::post('/register-vendor','VendorRegisterationController@registerVendor')->name('vendor.register');
    Route::get('/login','VendorRegisterationController@login')->name('vendor.login.page');
    Route::post('/check-login-vendor','VendorRegisterationController@checkLoginVendor')->name('check.vendor.login');
});
