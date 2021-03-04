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

Route::group(['namespace' => 'Site', 'middleware' =>'auth:customer', 'prefix' => 'customer'], function (){

    Route::get('soon','SoonController@soon')->name('customer.soon');

});

Route::group(['namespace' => 'Site', 'middleware' => 'guest:customer', 'prefix' => 'customer'], function(){
    Route::get('/register','CustomerRegisterationController@register')->name('customer.register.page');
    Route::post('/register-customer','CustomerRegisterationController@registerVendor')->name('customer.register');
    Route::get('/login','CustomerRegisterationController@login')->name('customer.login.page');
    Route::post('/check-login-customer','CustomerRegisterationController@checkLoginCustomer')->name('check.customer.login');

    Route::get('/redirect/{service}', 'SocialController@redirect')->name('service');

    Route::get('/callback/{service}', 'SocialController@callback');
});

Route::group(['namespace' => 'Auth', 'prefix' => 'customer'], function(){

    Route::get('/redirect/{service}', 'LoginController@redirect')->name('service');

    Route::get('/callback/{service}', 'LoginController@callback');
});
