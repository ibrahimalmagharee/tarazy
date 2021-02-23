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

Route::group(['namespace' => 'Dashboard', 'middleware' =>'auth:admin'], function (){

    Route::get('index','DashboardController@index')->name('admin.dashboard');
    Route::get('logout','LoginController@logout')->name('admin.logout');

    ######################### Edit Profile Routes ############################################################

    Route::group(['prefix' => 'profile'], function (){
        Route::get('edit', 'ProfileController@edit')->name('edit.profile');
        Route::put('update', 'ProfileController@update')->name('update.profile');
    });

    ######################### End Edit Profile Routes ########################################################


    ######################### Vendor Routes ########################################################

    Route::group(['prefix' => 'vendor'], function (){
        Route::get('/show-vendors', 'VendorController@index')->name('index.vendors');
        Route::post('save', 'VendorController@store')->name('save.vendor');
        Route::get('edit/{id}', 'VendorController@edit')->name('edit.vendor');
        Route::post('update/{id}', 'VendorController@update')->name('update.vendor');
        Route::get('delete/{id}', 'VendorController@destroy')->name('delete.vendor');
    });
    ######################### End Vendor Routes ########################################################

    ######################### Customer Routes ########################################################

    Route::group(['prefix' => 'customer'], function (){
        Route::get('/show-customers', 'CustomerController@index')->name('index.customers');
        Route::post('save', 'CustomerController@store')->name('save.customer');
        Route::get('edit/{id}', 'CustomerController@edit')->name('edit.customer');
        Route::post('update/{id}', 'CustomerController@update')->name('update.customer');
        Route::get('delete/{id}', 'CustomerController@destroy')->name('delete.customer');
    });
    ######################### End Customer Routes ########################################################

    ##################  Category Routes #############################################################

    Route::group(['prefix' => 'category'], function (){
        Route::get('/show-categories', 'CategoryController@index')->name('index.categories');
        Route::post('save', 'CategoryController@store')->name('save.category');
        Route::get('edit/{id}', 'CategoryController@edit')->name('edit.category');
        Route::post('update/{id}', 'CategoryController@update')->name('update.category');
        Route::get('delete/{id}', 'CategoryController@destroy')->name('delete.category');
    });
    ######################### End Category Routes ############################################################

    ##################  Type Routes #############################################################

    Route::group(['prefix' => 'type'], function (){
        Route::get('/show-types', 'TypeController@index')->name('index.types');
        Route::post('save', 'TypeController@store')->name('save.type');
        Route::get('edit/{id}', 'TypeController@edit')->name('edit.type');
        Route::post('update/{id}', 'TypeController@update')->name('update.type');
        Route::get('delete/{id}', 'TypeController@destroy')->name('delete.type');
    });
    ######################### End Type Routes ############################################################

    ##################  Color Routes #############################################################

    Route::group(['prefix' => 'color'], function (){
        Route::get('/show-colors', 'ColorController@index')->name('index.colors');
        Route::post('save', 'ColorController@store')->name('save.color');
        Route::get('edit/{id}', 'ColorController@edit')->name('edit.color');
        Route::post('update/{id}', 'ColorController@update')->name('update.color');
        Route::get('delete/{id}', 'ColorController@destroy')->name('delete.color');
    });
    ######################### End Color Routes ############################################################

    ##################  Offer Routes #############################################################

    Route::group(['prefix' => 'offer'], function (){
        Route::get('/show-offers', 'OfferController@index')->name('index.offers');
        Route::post('save', 'OfferController@store')->name('save.offer');
        Route::get('edit/{id}', 'OfferController@edit')->name('edit.offer');
        Route::post('update/{id}', 'OfferController@update')->name('update.offer');
        Route::get('delete/{id}', 'OfferController@destroy')->name('delete.offer');
    });
    ######################### End Offer Routes ############################################################

    ##################  Product Routes #############################################################

    Route::group(['prefix' => 'product'], function (){
        Route::group(['prefix' => 'design'], function (){
            Route::get('/show-designs', 'DesignController@index')->name('index.designs');
            Route::post('save', 'DesignController@store')->name('save.design');
            Route::get('edit/{id}', 'DesignController@edit')->name('edit.design');
            Route::post('update/{id}', 'DesignController@update')->name('update.design');
            Route::get('delete/{id}', 'DesignController@destroy')->name('delete.design');
        });

        Route::group(['prefix' => 'fabric'], function (){
            Route::get('/show-fabrics', 'FabricController@index')->name('index.fabrics');
            Route::post('save', 'FabricController@store')->name('save.fabric');
            Route::get('edit/{id}', 'FabricController@edit')->name('edit.fabric');
            Route::post('update/{id}', 'FabricController@update')->name('update.fabric');
            Route::get('delete/{id}', 'FabricController@destroy')->name('delete.fabric');
        });
    });
    ######################### End Product Routes ############################################################

});

Route::group(['namespace' => 'Dashboard', 'middleware' => 'guest:admin'], function(){
    Route::get('/login','LoginController@login')->name('admin.login.page');
    Route::post('/check-login','LoginController@checkLogin')->name('check.admin.login');
});
