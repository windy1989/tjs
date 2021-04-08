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

        Route::prefix('division')->group(function() {
            Route::get('/', 'DivisionController@index');
            Route::post('datatable', 'DivisionController@datatable');
            Route::post('create', 'DivisionController@create');
            Route::post('show', 'DivisionController@show');
            Route::post('update/{id}', 'DivisionController@update');
            Route::post('destroy', 'DivisionController@destroy');
        });

        Route::prefix('country')->group(function() {
            Route::get('/', 'CountryController@index');
            Route::post('datatable', 'CountryController@datatable');
            Route::post('create', 'CountryController@create');
            Route::post('show', 'CountryController@show');
            Route::post('update/{id}', 'CountryController@update');
            Route::post('destroy', 'CountryController@destroy');
        });

        Route::prefix('currency')->group(function() {
            Route::get('/', 'CurrencyController@index');
            Route::post('datatable', 'CurrencyController@datatable');
            Route::post('create', 'CurrencyController@create');
            Route::post('show', 'CurrencyController@show');
            Route::post('update/{id}', 'CurrencyController@update');
            Route::post('destroy', 'CurrencyController@destroy');
        });

        Route::prefix('supplier')->group(function() {
            Route::get('/', 'SupplierController@index');
            Route::post('datatable', 'SupplierController@datatable');
            Route::post('row_detail', 'SupplierController@rowDetail');
            Route::post('create', 'SupplierController@create');
            Route::post('show', 'SupplierController@show');
            Route::post('update/{id}', 'SupplierController@update');
            Route::post('destroy', 'SupplierController@destroy');
        });
    });
});