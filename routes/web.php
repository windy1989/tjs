<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index');
Route::prefix('product')->group(function() {
    Route::get('/', 'ProductController@index');
    Route::get('detail/{id}', 'ProductController@detail');
    Route::post('check_stock', 'ProductController@checkStock');
    Route::post('add_to_cart', 'ProductController@addToCart');
    Route::post('cart_qty', 'ProductController@cartQty');
    Route::get('cart_destroy/{id}', 'ProductController@cartDestroy');
    Route::post('add_to_wishlist', 'ProductController@addToWishlist');
    Route::get('wishlist_to_cart/{id}', 'ProductController@wishlistToCart');
    Route::get('wishlist_destroy/{id}', 'ProductController@wishlistDestroy');
});

Route::prefix('account')->group(function() {
    Route::match(['get', 'post'], 'login', 'AccountController@login');
    Route::match(['get', 'post'], 'register', 'AccountController@register');
    Route::get('verification', 'AccountController@verification');
    Route::post('forgot_password', 'AccountController@forgotPassword');
    Route::match(['get', 'post'], 'reset_password', 'AccountController@resetPassword');
    Route::post('login_social_media', 'AccountController@loginSocialMedia');
    Route::get('login_social_media_callback/{param}', 'AccountController@loginSocialMediaCallback');
    Route::get('logout', 'AccountController@logout');
    Route::get('cart', 'AccountController@cart');
    Route::get('wishlist', 'AccountController@wishlist');
    Route::get('history_order', 'AccountController@historyOrder');
    Route::get('history_order/detail/{id}', 'AccountController@historyOrderDetail');
    Route::match(['get', 'post'], 'profile', 'AccountController@profile');
});

Route::prefix('information')->group(function() {
    Route::get('privacy_policy', 'InformationController@privacyPolicy');
    Route::get('terms_and_conditions', 'InformationController@termsAndConditions');
    Route::get('about_us', 'InformationController@aboutUs');
    Route::get('contact', 'InformationController@contact');
}); 

Route::prefix('checkout')->group(function() {
    Route::match(['get', 'post'], 'cash', 'CheckoutController@cash');
    Route::get('cash/cash_success', 'CheckoutController@cashSuccess');
    Route::match(['get', 'post'], 'cashless', 'CheckoutController@cashless');
}); 

Route::prefix('webhook')->group(function() {
    Route::post('xendit', 'WebHookController@xendit');
}); 

Route::prefix('admin')->namespace('Admin')->group(function() {
    Route::match(['get', 'post'], 'login', 'AuthController@login');
    Route::get('verification', 'AuthController@verification');
    
    Route::middleware('admin.login')->group(function() {
        Route::get('dashboard', 'DashboardController@index');

        Route::prefix('select2')->group(function() {
            Route::post('type', 'Select2Controller@type');
            Route::post('product', 'Select2Controller@product');
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

            Route::prefix('city')->group(function() {
                Route::get('/', 'CityController@index');
                Route::post('datatable', 'CityController@datatable');
                Route::post('create', 'CityController@create');
                Route::post('show', 'CityController@show');
                Route::post('update/{id}', 'CityController@update');
                Route::post('destroy', 'CityController@destroy');
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
                Route::post('formula', 'CodeController@formula');
                Route::post('create', 'CodeController@create');
                Route::post('show', 'CodeController@show');
                Route::post('update/{id}', 'CodeController@update');
                Route::post('destroy', 'CodeController@destroy');
                Route::get('detail/{id}', 'CodeController@detail');
            });
        });

        Route::prefix('cogs')->group(function() {
            Route::prefix('rate')->group(function() {
                Route::get('/', 'CurrencyRateController@index');
                Route::post('datatable', 'CurrencyRateController@datatable');
                Route::post('create', 'CurrencyRateController@create');
                Route::post('show', 'CurrencyRateController@show');
                Route::post('update/{id}', 'CurrencyRateController@update');
                Route::post('destroy', 'CurrencyRateController@destroy');
            });

            Route::prefix('price')->group(function() {
                Route::get('/', 'CurrencyPriceController@index');
                Route::post('datatable', 'CurrencyPriceController@datatable');
                Route::post('create', 'CurrencyPriceController@create');
                Route::post('show', 'CurrencyPriceController@show');
                Route::post('update/{id}', 'CurrencyPriceController@update');
                Route::post('destroy', 'CurrencyPriceController@destroy');
            });

            Route::prefix('agent')->group(function() {
                Route::get('/', 'AgentController@index');
                Route::post('datatable', 'AgentController@datatable');
                Route::post('create', 'AgentController@create');
                Route::post('show', 'AgentController@show');
                Route::post('update/{id}', 'AgentController@update');
                Route::post('destroy', 'AgentController@destroy');
            });

            Route::prefix('freight')->group(function() {
                Route::get('/', 'FreightController@index');
                Route::post('datatable', 'FreightController@datatable');
                Route::post('create', 'FreightController@create');
                Route::post('show', 'FreightController@show');
                Route::post('update/{id}', 'FreightController@update');
                Route::post('destroy', 'FreightController@destroy');
            });

            Route::prefix('import')->group(function() {
                Route::get('/', 'ImportController@index');
                Route::post('datatable', 'ImportController@datatable');
                Route::post('create', 'ImportController@create');
                Route::post('show', 'ImportController@show');
                Route::post('update/{id}', 'ImportController@update');
                Route::post('destroy', 'ImportController@destroy');
            });

            Route::prefix('emkl')->group(function() {
                Route::get('/', 'EmklController@index');
                Route::post('datatable', 'EmklController@datatable');
                Route::post('create', 'EmklController@create');
                Route::post('show', 'EmklController@show');
                Route::post('update/{id}', 'EmklController@update');
                Route::post('destroy', 'EmklController@destroy');
            });

            Route::prefix('emkl_rate')->group(function() {
                Route::get('/', 'EmklRateController@index');
                Route::post('datatable', 'EmklRateController@datatable');
                Route::post('create', 'EmklRateController@create');
                Route::post('show', 'EmklRateController@show');
                Route::post('update/{id}', 'EmklRateController@update');
                Route::post('destroy', 'EmklRateController@destroy');
            });

            Route::prefix('marketing_structure')->group(function() {
                Route::get('/', 'MarketingStructureController@index');
                Route::post('datatable', 'MarketingStructureController@datatable');
                Route::post('row_detail', 'MarketingStructureController@rowDetail');
                Route::post('create', 'MarketingStructureController@create');
                Route::post('show', 'MarketingStructureController@show');
                Route::post('update/{id}', 'MarketingStructureController@update');
                Route::post('destroy', 'MarketingStructureController@destroy');
            });
        });

        Route::prefix('price')->group(function() {
            Route::prefix('cogs')->group(function() {
                Route::get('/', 'CogsController@index');
                Route::post('datatable', 'CogsController@datatable');
                Route::get('get_complete_data', 'CogsController@getCompleteData');
                Route::match(['get', 'post'], 'create', 'CogsController@create');
                Route::post('show', 'CogsController@show');
            });

            Route::prefix('pricing_policy')->group(function() {
                Route::get('/', 'PricingPolicyController@index');
                Route::post('datatable', 'PricingPolicyController@datatable');
                Route::post('row_detail', 'PricingPolicyController@rowDetail');
                Route::post('create', 'PricingPolicyController@create');
                Route::post('show', 'PricingPolicyController@show');
                Route::post('update/{id}', 'PricingPolicyController@update');
                Route::post('destroy', 'PricingPolicyController@destroy');
            });
        });

        Route::prefix('customer')->group(function() {
            Route::get('/', 'CustomerController@index');
            Route::post('datatable', 'CustomerController@datatable');
        });

        Route::prefix('setting')->group(function() {
            Route::prefix('user')->group(function() {
                Route::get('/', 'UserController@index');
                Route::post('datatable', 'UserController@datatable');
                Route::post('row_detail', 'UserController@rowDetail');
                Route::post('create', 'UserController@create');
                Route::post('show', 'UserController@show');
                Route::post('update/{id}', 'UserController@update');
                Route::post('destroy', 'UserController@destroy');
                Route::post('reset_password', 'UserController@resetPassword');
            });
        });
    });
});