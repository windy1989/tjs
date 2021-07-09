<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index');
Route::prefix('webhook')->group(function() {
    Route::post('xendit', 'WebHookController@xendit');
}); 

Route::prefix('product')->group(function() {
    Route::get('/', 'ProductController@index');
    Route::get('detail/{id}', 'ProductController@detail');
    Route::get('check_stock', 'ProductController@checkStock');
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
    Route::post('history_order/confirmation_delivery', 'AccountController@confirmationDelivery');
    Route::match(['get', 'post'], 'profile', 'AccountController@profile');
});

Route::prefix('information')->group(function() {
    Route::get('how_to_buy', 'InformationController@howToBuy');
    Route::get('faq', 'InformationController@faq');
    Route::match(['get', 'post'], 'contact', 'InformationController@contact');
    Route::get('store', 'InformationController@store');
    Route::get('product_catalog', 'InformationController@productCatalog');
    Route::get('pay_in_store', 'InformationController@payInStore');
    Route::get('about_us', 'InformationController@aboutUs');
    Route::get('terms_of_use', 'InformationController@termsOfUse');
    Route::get('privacy_policy', 'InformationController@privacyPolicy');
    Route::get('terms_of_delivery', 'InformationController@termsOfDelivery');
}); 

Route::prefix('news')->group(function() {
    Route::get('/', 'NewsController@index');
    Route::get('detail/{slug}', 'NewsController@detail');
});

Route::prefix('career')->group(function() {
    Route::get('/', 'CareerController@index');
});

Route::prefix('checkout')->group(function() {
    Route::match(['get', 'post'], '{param}', 'CheckoutController@index');
    Route::get('notif/{param}', 'CheckoutController@notif');
    
    Route::prefix('process')->group(function() {
        Route::get('get_delivery', 'CheckoutController@getDelivery');
        Route::get('grandtotal', 'CheckoutController@grandtotal');
    });
}); 

Route::prefix('admin')->namespace('Admin')->group(function() {
    Route::match(['get', 'post'], 'login', 'AuthController@login');
    Route::get('verification', 'AuthController@verification');
    Route::post('forgot_password', 'AuthController@forgotPassword');
    Route::match(['get', 'post'], 'reset_password', 'AuthController@resetPassword');
    
    Route::middleware('admin.login')->group(function() {
        Route::match(['get', 'post'], 'profile', 'AuthController@profile');
        Route::match(['get', 'post'], 'my_activity', 'AuthController@myActivity');
        Route::get('logout', 'AuthController@logout');

        Route::prefix('dashboard')->group(function() {
            Route::get('/', 'DashboardController@index');
        });
        
        Route::prefix('notification')->group(function() {
            Route::get('/', 'NotificationController@index');
        });

        Route::prefix('approval')->group(function() {
            Route::get('/', 'ApprovalController@index');
            Route::get('datatable', 'ApprovalController@datatable');
            Route::match(['get', 'post'], 'detail/{id}', 'ApprovalController@detail');
        });

        Route::prefix('select2')->group(function() {
            Route::get('type', 'Select2Controller@type');
            Route::get('product', 'Select2Controller@product');
        });

        Route::prefix('master_data')->group(function() {
            Route::prefix('company')->group(function() {
                Route::get('/', 'CompanyController@index');
                Route::get('datatable', 'CompanyController@datatable');
                Route::post('create', 'CompanyController@create');
                Route::get('show', 'CompanyController@show');
                Route::post('update/{id}', 'CompanyController@update');
                Route::post('destroy', 'CompanyController@destroy');
            });

            Route::prefix('division')->group(function() {
                Route::get('/', 'DivisionController@index');
                Route::get('datatable', 'DivisionController@datatable');
                Route::post('create', 'DivisionController@create');
                Route::get('show', 'DivisionController@show');
                Route::post('update/{id}', 'DivisionController@update');
                Route::post('destroy', 'DivisionController@destroy');
            });

            Route::prefix('country')->group(function() {
                Route::get('/', 'CountryController@index');
                Route::get('datatable', 'CountryController@datatable');
                Route::post('create', 'CountryController@create');
                Route::get('show', 'CountryController@show');
                Route::post('update/{id}', 'CountryController@update');
                Route::post('destroy', 'CountryController@destroy');
            });

            Route::prefix('city')->group(function() {
                Route::get('/', 'CityController@index');
                Route::get('datatable', 'CityController@datatable');
                Route::post('create', 'CityController@create');
                Route::get('show', 'CityController@show');
                Route::post('update/{id}', 'CityController@update');
                Route::post('destroy', 'CityController@destroy');
            });

            Route::prefix('currency')->group(function() {
                Route::get('/', 'CurrencyController@index');
                Route::get('datatable', 'CurrencyController@datatable');
                Route::post('create', 'CurrencyController@create');
                Route::get('show', 'CurrencyController@show');
                Route::post('update/{id}', 'CurrencyController@update');
                Route::post('destroy', 'CurrencyController@destroy');
            });

            Route::prefix('supplier')->group(function() {
                Route::get('/', 'SupplierController@index');
                Route::get('datatable', 'SupplierController@datatable');
                Route::post('create', 'SupplierController@create');
                Route::get('show', 'SupplierController@show');
                Route::post('update/{id}', 'SupplierController@update');
                Route::post('destroy', 'SupplierController@destroy');
            });

            Route::prefix('banner')->group(function() {
                Route::get('/', 'BannerController@index');
                Route::get('datatable', 'BannerController@datatable');
                Route::post('create', 'BannerController@create');
                Route::get('show', 'BannerController@show');
                Route::post('update/{id}', 'BannerController@update');
                Route::post('destroy', 'BannerController@destroy');
            });

            Route::prefix('brand')->group(function() {
                Route::get('/', 'BrandController@index');
                Route::get('datatable', 'BrandController@datatable');
                Route::post('create', 'BrandController@create');
                Route::get('show', 'BrandController@show');
                Route::post('update/{id}', 'BrandController@update');
                Route::post('destroy', 'BrandController@destroy');
            });

            Route::prefix('category')->group(function() {
                Route::get('/', 'CategoryController@index');
                Route::get('datatable', 'CategoryController@datatable');
                Route::post('create', 'CategoryController@create');
                Route::get('show', 'CategoryController@show');
                Route::post('update/{id}', 'CategoryController@update');
                Route::post('destroy', 'CategoryController@destroy');
            });

            Route::prefix('surface')->group(function() {
                Route::get('/', 'SurfaceController@index');
                Route::get('datatable', 'SurfaceController@datatable');
                Route::post('create', 'SurfaceController@create');
                Route::get('show', 'SurfaceController@show');
                Route::post('update/{id}', 'SurfaceController@update');
                Route::post('destroy', 'SurfaceController@destroy');
            });

            Route::prefix('color')->group(function() {
                Route::get('/', 'ColorController@index');
                Route::get('datatable', 'ColorController@datatable');
                Route::post('create', 'ColorController@create');
                Route::get('show', 'ColorController@show');
                Route::post('update/{id}', 'ColorController@update');
                Route::post('destroy', 'ColorController@destroy');
            });

            Route::prefix('pattern')->group(function() {
                Route::get('/', 'PatternController@index');
                Route::get('datatable', 'PatternController@datatable');
                Route::post('create', 'PatternController@create');
                Route::get('show', 'PatternController@show');
                Route::post('update/{id}', 'PatternController@update');
                Route::post('destroy', 'PatternController@destroy');
            });

            Route::prefix('grade')->group(function() {
                Route::get('/', 'GradeController@index');
                Route::get('datatable', 'GradeController@datatable');
                Route::post('create', 'GradeController@create');
                Route::get('show', 'GradeController@show');
                Route::post('update/{id}', 'GradeController@update');
                Route::post('destroy', 'GradeController@destroy');
            });

            Route::prefix('hs_code')->group(function() {
                Route::get('/', 'HsCodeController@index');
                Route::get('datatable', 'HsCodeController@datatable');
                Route::post('create', 'HsCodeController@create');
                Route::get('show', 'HsCodeController@show');
                Route::post('update/{id}', 'HsCodeController@update');
                Route::post('destroy', 'HsCodeController@destroy');
            });

            Route::prefix('unit')->group(function() {
                Route::get('/', 'UnitController@index');
                Route::get('datatable', 'UnitController@datatable');
                Route::post('create', 'UnitController@create');
                Route::get('show', 'UnitController@show');
                Route::post('update/{id}', 'UnitController@update');
                Route::post('destroy', 'UnitController@destroy');
            });

            Route::prefix('loading_limit')->group(function() {
                Route::get('/', 'LoadingLimitController@index');
                Route::get('datatable', 'LoadingLimitController@datatable');
                Route::post('create', 'LoadingLimitController@create');
                Route::get('show', 'LoadingLimitController@show');
                Route::post('update/{id}', 'LoadingLimitController@update');
                Route::post('destroy', 'LoadingLimitController@destroy');
            });

            Route::prefix('warehouse')->group(function() {
                Route::get('/', 'WarehouseController@index');
                Route::get('datatable', 'WarehouseController@datatable');
            });
        });

        Route::prefix('delivery')->group(function() {
            Route::prefix('vendor')->group(function() {
                Route::get('/', 'VendorController@index');
                Route::get('datatable', 'VendorController@datatable');
                Route::post('create', 'VendorController@create');
                Route::get('show', 'VendorController@show');
                Route::post('update/{id}', 'VendorController@update');
                Route::post('destroy', 'VendorController@destroy');
            });

            Route::prefix('transport')->group(function() {
                Route::get('/', 'TransportController@index');
                Route::get('datatable', 'TransportController@datatable');
                Route::post('create', 'TransportController@create');
                Route::get('show', 'TransportController@show');
                Route::post('update/{id}', 'TransportController@update');
                Route::post('destroy', 'TransportController@destroy');
            });

            Route::prefix('price')->group(function() {
                Route::get('/', 'PriceController@index');
                Route::get('datatable', 'PriceController@datatable');
                Route::post('create', 'PriceController@create');
                Route::get('show', 'PriceController@show');
                Route::post('update/{id}', 'PriceController@update');
                Route::post('destroy', 'PriceController@destroy');
            });
        });

        Route::prefix('news')->group(function() {
            Route::prefix('category')->group(function() {
                Route::get('/', 'NewsCategoryController@index');
                Route::get('datatable', 'NewsCategoryController@datatable');
                Route::post('create', 'NewsCategoryController@create');
                Route::get('show', 'NewsCategoryController@show');
                Route::post('update/{id}', 'NewsCategoryController@update');
                Route::post('destroy', 'NewsCategoryController@destroy');
            });

            Route::prefix('news')->group(function() {
                Route::get('/', 'NewsController@index');
                Route::get('datatable', 'NewsController@datatable');
                Route::match(['get', 'post'], 'create', 'NewsController@create');
                Route::match(['get', 'post'], 'update/{id}', 'NewsController@update');
                Route::post('destroy', 'NewsController@destroy');
                Route::get('detail/{id}', 'NewsController@detail');
            });
        });

        Route::prefix('product')->group(function() {
            Route::prefix('type')->group(function() {
                Route::get('/', 'TypeController@index');
                Route::get('datatable', 'TypeController@datatable');
                Route::post('create', 'TypeController@create');
                Route::get('show', 'TypeController@show');
                Route::post('update/{id}', 'TypeController@update');
                Route::post('destroy', 'TypeController@destroy');
                Route::get('detail/{id}', 'TypeController@detail');
            });

            Route::prefix('code')->group(function() {
                Route::get('/', 'CodeController@index');
                Route::get('datatable', 'CodeController@datatable');
                Route::get('generate_code', 'CodeController@generateCode');
                Route::get('formula', 'CodeController@formula');
                Route::post('create', 'CodeController@create');
                Route::get('show', 'CodeController@show');
                Route::post('update/{id}', 'CodeController@update');
                Route::post('destroy', 'CodeController@destroy');
                Route::get('detail/{id}', 'CodeController@detail');
            });
        });

        Route::prefix('cogs')->group(function() {
            Route::prefix('rate')->group(function() {
                Route::get('/', 'CurrencyRateController@index');
                Route::get('datatable', 'CurrencyRateController@datatable');
                Route::post('create', 'CurrencyRateController@create');
                Route::get('show', 'CurrencyRateController@show');
                Route::post('update/{id}', 'CurrencyRateController@update');
                Route::post('destroy', 'CurrencyRateController@destroy');
            });

            Route::prefix('price')->group(function() {
                Route::get('/', 'CurrencyPriceController@index');
                Route::get('datatable', 'CurrencyPriceController@datatable');
                Route::post('create', 'CurrencyPriceController@create');
                Route::get('show', 'CurrencyPriceController@show');
                Route::post('update/{id}', 'CurrencyPriceController@update');
                Route::post('destroy', 'CurrencyPriceController@destroy');
            });

            Route::prefix('agent')->group(function() {
                Route::get('/', 'AgentController@index');
                Route::get('datatable', 'AgentController@datatable');
                Route::post('create', 'AgentController@create');
                Route::get('show', 'AgentController@show');
                Route::post('update/{id}', 'AgentController@update');
                Route::post('destroy', 'AgentController@destroy');
            });

            Route::prefix('freight')->group(function() {
                Route::get('/', 'FreightController@index');
                Route::get('datatable', 'FreightController@datatable');
                Route::post('create', 'FreightController@create');
                Route::get('show', 'FreightController@show');
                Route::post('update/{id}', 'FreightController@update');
                Route::post('destroy', 'FreightController@destroy');
            });

            Route::prefix('import')->group(function() {
                Route::get('/', 'ImportController@index');
                Route::get('datatable', 'ImportController@datatable');
                Route::post('create', 'ImportController@create');
                Route::get('show', 'ImportController@show');
                Route::post('update/{id}', 'ImportController@update');
                Route::post('destroy', 'ImportController@destroy');
            });

            Route::prefix('emkl')->group(function() {
                Route::get('/', 'EmklController@index');
                Route::get('datatable', 'EmklController@datatable');
                Route::post('create', 'EmklController@create');
                Route::get('show', 'EmklController@show');
                Route::post('update/{id}', 'EmklController@update');
                Route::post('destroy', 'EmklController@destroy');
            });

            Route::prefix('emkl_rate')->group(function() {
                Route::get('/', 'EmklRateController@index');
                Route::get('datatable', 'EmklRateController@datatable');
                Route::post('create', 'EmklRateController@create');
                Route::get('show', 'EmklRateController@show');
                Route::post('update/{id}', 'EmklRateController@update');
                Route::post('destroy', 'EmklRateController@destroy');
            });

            Route::prefix('marketing_structure')->group(function() {
                Route::get('/', 'MarketingStructureController@index');
                Route::get('datatable', 'MarketingStructureController@datatable');
                Route::get('row_detail', 'MarketingStructureController@rowDetail');
                Route::post('create', 'MarketingStructureController@create');
                Route::get('show', 'MarketingStructureController@show');
                Route::post('update/{id}', 'MarketingStructureController@update');
                Route::post('destroy', 'MarketingStructureController@destroy');
            });
        });

        Route::prefix('price')->group(function() {
            Route::prefix('cogs')->group(function() {
                Route::get('/', 'CogsController@index');
                Route::get('datatable', 'CogsController@datatable');
                Route::get('get_complete_data', 'CogsController@getCompleteData');
                Route::match(['get', 'post'], 'create', 'CogsController@create');
                Route::get('show', 'CogsController@show');
            });

            Route::prefix('pricing_policy')->group(function() {
                Route::get('/', 'PricingPolicyController@index');
                Route::get('datatable', 'PricingPolicyController@datatable');
                Route::get('row_detail', 'PricingPolicyController@rowDetail');
                Route::post('create', 'PricingPolicyController@create');
                Route::get('show', 'PricingPolicyController@show');
                Route::post('update/{id}', 'PricingPolicyController@update');
                Route::post('destroy', 'PricingPolicyController@destroy');
            });
        });

        Route::prefix('manage')->group(function() {
            Route::prefix('career')->group(function() {
                Route::get('/', 'CareerController@index');
                Route::get('datatable', 'CareerController@datatable');
                Route::match(['get', 'post'], 'create', 'CareerController@create');
                Route::match(['get', 'post'], 'update/{id}', 'CareerController@update');
                Route::post('destroy', 'CareerController@destroy');
                Route::get('detail/{id}', 'CareerController@detail');
            });

            Route::prefix('customer')->group(function() {
                Route::get('/', 'CustomerController@index');
                Route::get('datatable', 'CustomerController@datatable');
            });

            Route::prefix('voucher')->group(function() {
                Route::get('/', 'VoucherController@index');
                Route::get('datatable', 'VoucherController@datatable');
                Route::match(['get', 'post'], 'create', 'VoucherController@create');
                Route::match(['get', 'post'], 'update/{id}', 'VoucherController@update');
                Route::post('destroy', 'VoucherController@destroy');
                Route::get('detail/{id}', 'VoucherController@detail');
            });

            Route::prefix('order')->group(function() {
                Route::get('/', 'OrderController@index');
                Route::get('datatable', 'OrderController@datatable');
                Route::match(['get', 'post'], 'detail/{id}', 'OrderController@detail');
            });

            Route::prefix('sales_order')->group(function() {
                Route::get('/', 'OrderSoController@index');
                Route::get('datatable', 'OrderSoController@datatable');
                Route::get('get_delivery', 'OrderSoController@getDelivery');
                Route::match(['get', 'post'], 'detail/{id}', 'OrderSoController@detail');
            });

            Route::prefix('invoice')->group(function() {
                Route::get('/', 'OrderInvoiceController@index');
                Route::get('datatable', 'OrderInvoiceController@datatable');
                Route::match(['get', 'post'], 'detail/{id}', 'OrderInvoiceController@detail');
                Route::match(['get', 'post'], 'print/{id}', 'OrderInvoiceController@print');
            });

            Route::prefix('purchase_order')->group(function() {
                Route::get('/', 'OrderPoController@index');
                Route::get('datatable', 'OrderPoController@datatable');
                Route::match(['get', 'post'], 'detail/{id}', 'OrderPoController@detail');
                Route::match(['get', 'post'], 'print/{id}', 'OrderPoController@print');
            });

            Route::prefix('delivery_order')->group(function() {
                Route::get('/', 'OrderDoController@index');
                Route::get('datatable', 'OrderDoController@datatable');
                Route::get('information', 'OrderDoController@information');
                Route::match(['get', 'post'], 'print/{id}', 'OrderDoController@print');
            });
        });

        Route::prefix('project')->group(function() {
            Route::prefix('data')->group(function() {
                Route::get('/', 'ProjectController@index');
                Route::get('datatable', 'ProjectController@datatable');
                Route::post('create', 'ProjectController@create');
                Route::get('get_product', 'ProjectController@getProduct');
                Route::match(['get', 'post'], 'progress/{id}', 'ProjectController@progress');
                Route::get('detail/{id}', 'ProjectController@detail');
            });
        });

        Route::prefix('hrd')->group(function() {
            Route::prefix('job_desc')->group(function() {
                Route::get('/', 'JobDescController@index');
            });
        });

        Route::prefix('accounting')->group(function() {
            Route::prefix('coa')->group(function() {
                Route::get('/', 'CoaController@index');
                Route::get('datatable', 'CoaController@datatable');
                Route::post('create', 'CoaController@create');
                Route::get('show', 'CoaController@show');
                Route::post('update/{id}', 'CoaController@update');
                Route::post('destroy', 'CoaController@destroy');
            });

            Route::prefix('cash_bank')->group(function() {
                Route::get('/', 'CashBankController@index');
                Route::get('row_detail', 'CashBankController@rowDetail');
                Route::get('datatable', 'CashBankController@datatable');
                Route::post('create', 'CashBankController@create');
                Route::get('show', 'CashBankController@show');
                Route::post('update/{id}', 'CashBankController@update');
                Route::post('destroy', 'CashBankController@destroy');
            });

            Route::prefix('budgeting')->group(function() {
                Route::get('/', 'BudgetingController@index');
                Route::get('datatable', 'BudgetingController@datatable');
                Route::post('create', 'BudgetingController@create');
                Route::get('show', 'BudgetingController@show');
                Route::post('update/{id}', 'BudgetingController@update');
                Route::post('destroy', 'BudgetingController@destroy');
            });
        });

        Route::prefix('report')->group(function() {
            Route::prefix('balance_sheet')->group(function() {
                Route::get('/', 'ReportController@balanceSheet');
            });

            Route::prefix('profit_loss')->group(function() {
                Route::get('/', 'ReportController@profitLoss');
            });

            Route::prefix('ledger')->group(function() {
                Route::get('/', 'ReportController@ledger');
                Route::get('datatable', 'ReportController@ledgerDatatable');
                Route::get('row_detail', 'ReportController@ledgerRowDetail');
            });
        });

        Route::prefix('setting')->group(function() {
            Route::prefix('user')->group(function() {
                Route::get('/', 'UserController@index');
                Route::get('datatable', 'UserController@datatable');
                Route::get('row_detail', 'UserController@rowDetail');
                Route::post('create', 'UserController@create');
                Route::get('show', 'UserController@show');
                Route::post('update/{id}', 'UserController@update');
                Route::post('destroy', 'UserController@destroy');
                Route::post('reset_password', 'UserController@resetPassword');
            });
        });
    });
});