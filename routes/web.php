<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->namespace('Admin')->group(function() {
    Route::get('dashboard', 'DashboardController@index');

    Route::prefix('select2')->group(function() {
        Route::post('type', 'Select2Controller@type');
    });

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
            Route::post('create', 'SupplierController@create');
            Route::post('show', 'SupplierController@show');
            Route::post('update/{id}', 'SupplierController@update');
            Route::post('destroy', 'SupplierController@destroy');
        });

        Route::prefix('banner')->group(function() {
            Route::get('/', 'BannerController@index');
            Route::post('datatable', 'BannerController@datatable');
            Route::post('create', 'BannerController@create');
            Route::post('show', 'BannerController@show');
            Route::post('update/{id}', 'BannerController@update');
            Route::post('destroy', 'BannerController@destroy');
        });

        Route::prefix('brand')->group(function() {
            Route::get('/', 'BrandController@index');
            Route::post('datatable', 'BrandController@datatable');
            Route::post('create', 'BrandController@create');
            Route::post('show', 'BrandController@show');
            Route::post('update/{id}', 'BrandController@update');
            Route::post('destroy', 'BrandController@destroy');
        });

        Route::prefix('category')->group(function() {
            Route::get('/', 'CategoryController@index');
            Route::post('datatable', 'CategoryController@datatable');
            Route::post('create', 'CategoryController@create');
            Route::post('show', 'CategoryController@show');
            Route::post('update/{id}', 'CategoryController@update');
            Route::post('destroy', 'CategoryController@destroy');
        });

        Route::prefix('surface')->group(function() {
            Route::get('/', 'SurfaceController@index');
            Route::post('datatable', 'SurfaceController@datatable');
            Route::post('create', 'SurfaceController@create');
            Route::post('show', 'SurfaceController@show');
            Route::post('update/{id}', 'SurfaceController@update');
            Route::post('destroy', 'SurfaceController@destroy');
        });

        Route::prefix('color')->group(function() {
            Route::get('/', 'ColorController@index');
            Route::post('datatable', 'ColorController@datatable');
            Route::post('create', 'ColorController@create');
            Route::post('show', 'ColorController@show');
            Route::post('update/{id}', 'ColorController@update');
            Route::post('destroy', 'ColorController@destroy');
        });

        Route::prefix('pattern')->group(function() {
            Route::get('/', 'PatternController@index');
            Route::post('datatable', 'PatternController@datatable');
            Route::post('create', 'PatternController@create');
            Route::post('show', 'PatternController@show');
            Route::post('update/{id}', 'PatternController@update');
            Route::post('destroy', 'PatternController@destroy');
        });

        Route::prefix('grade')->group(function() {
            Route::get('/', 'GradeController@index');
            Route::post('datatable', 'GradeController@datatable');
            Route::post('create', 'GradeController@create');
            Route::post('show', 'GradeController@show');
            Route::post('update/{id}', 'GradeController@update');
            Route::post('destroy', 'GradeController@destroy');
        });

        Route::prefix('hs_code')->group(function() {
            Route::get('/', 'HsCodeController@index');
            Route::post('datatable', 'HsCodeController@datatable');
            Route::post('create', 'HsCodeController@create');
            Route::post('show', 'HsCodeController@show');
            Route::post('update/{id}', 'HsCodeController@update');
            Route::post('destroy', 'HsCodeController@destroy');
        });

        Route::prefix('unit')->group(function() {
            Route::get('/', 'UnitController@index');
            Route::post('datatable', 'UnitController@datatable');
            Route::post('create', 'UnitController@create');
            Route::post('show', 'UnitController@show');
            Route::post('update/{id}', 'UnitController@update');
            Route::post('destroy', 'UnitController@destroy');
        });

        Route::prefix('specification')->group(function() {
            Route::get('/', 'SpecificationController@index');
            Route::post('datatable', 'SpecificationController@datatable');
            Route::post('create', 'SpecificationController@create');
            Route::post('show', 'SpecificationController@show');
            Route::post('update/{id}', 'SpecificationController@update');
            Route::post('destroy', 'SpecificationController@destroy');
        });

        Route::prefix('warehouse')->group(function() {
            Route::get('/', 'WarehouseController@index');
            Route::post('datatable', 'WarehouseController@datatable');
        });
    });

    Route::prefix('product')->group(function() {
        Route::prefix('type')->group(function() {
            Route::get('/', 'TypeController@index');
            Route::post('datatable', 'TypeController@datatable');
            Route::match(['get', 'post'], 'create', 'TypeController@create');
            Route::match(['get', 'post'], 'update/{id}', 'TypeController@update');
            Route::post('show', 'TypeController@show');
            Route::post('destroy', 'TypeController@destroy');
        });

        Route::prefix('code')->group(function() {
            Route::get('/', 'CodeController@index');
            Route::post('datatable', 'CodeController@datatable');
            Route::post('generate_code', 'CodeController@generateCode');
            Route::match(['get', 'post'], 'create', 'CodeController@create');
            Route::match(['get', 'post'], 'update/{id}', 'CodeController@update');
            Route::post('show', 'CodeController@show');
            Route::post('destroy', 'CodeController@destroy');
        });
    });
});