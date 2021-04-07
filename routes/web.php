<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->namespace('Admin')->group(function() {
    Route::get('dashboard', 'DashboardController@index');

    Route::prefix('master_data')->group(function() {
        Route::prefix('company')->group(function() {
            Route::get('/', 'CompanyController@index');
            Route::post('datatable', 'CompanyController@datatable');
            Route::post('create', 'CompanyController@create');
            Route::post('show', 'CompanyController@show');
            Route::post('update/{id}', 'CompanyController@update');
            Route::post('destroy', 'CompanyController@destroy');
        });
    });
});