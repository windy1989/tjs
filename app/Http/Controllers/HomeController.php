<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller {
    
    public function index()
    {
        $brand = Brand::whereHas('product', function($query) {
                $query->where('status', 1)
                    ->whereHas('productShading', function($query) {
                            $query->havingRaw('SUM(qty) > ?', [2]);
                        })
                    ->havingRaw('COUNT(*) > ?', [4]);
            })
            ->where('status', 1)
            ->inRandomOrder()
            ->groupBy('id')
            ->limit(4)
            ->get();
        
        $category = Category::where('status', 1)
            ->whereHas('type', function($query) {
                $query->where('status', 1)
                    ->havingRaw('COUNT(*) > ?', [4])
                    ->whereHas('product', function($query) {
                            $query->havingRaw('COUNT(*) > ?', [4])
                                ->where('status', 1)
                                ->whereHas('productShading', function($query) {
                                        $query->havingRaw('SUM(qty) > ?', [18]);
                                    });
                        });
            })
            ->inRandomOrder()
            ->groupBy('id')
            ->limit(3)
            ->get();

        $product_new = Product::whereHas('productShading', function($query) {
                $query->havingRaw('SUM(qty) > ?', [18]);
            })
            ->latest()
            ->limit(8)
            ->get();

        $data = [
            'title'       => 'SMB',
            'banner'      => Banner::where('status', 1)->get(),
            'brand'       => $brand,
            'category'    => $category,
            'product_new' => $product_new,
            'content'     => 'home'
        ];

        return view('layouts.index', ['data' => $data]);
    }

}
