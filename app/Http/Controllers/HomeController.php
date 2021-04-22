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
        $product_cheapest = Product::select('products.*', 'pricing_policies.price_list')
            ->whereHas('productShading', function($query) {
                $query->havingRaw('SUM(qty) > ?', [18]);
            })
            ->leftJoin('pricing_policies', 'products.id', '=', 'pricing_policies.product_id')
            ->orderBy('pricing_policies.price_list', 'asc')
            ->limit(8)
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
            ->where('parent_id', '!=', 0)
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

        $product_limited = Product::whereHas('productShading', function($query) {
                $query->havingRaw('SUM(qty) > ?', [2])
                    ->havingRaw('SUM(qty) <= ?', [18]);
            })
            ->latest()
            ->limit(8)
            ->get();

        $data = [
            'title'            => 'SMB',
            'banner'           => Banner::where('status', 1)->get(),
            'product_cheapest' => $product_cheapest,
            'product_limited'  => $product_limited,
            'product_new'      => $product_new,
            'content'          => 'home'
        ];

        return view('layouts.index', ['data' => $data]);
    }

}
