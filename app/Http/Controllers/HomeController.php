<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Banner;
use App\Models\Product;
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
            ->limit(12)
            ->get();

        $product_new = Product::whereHas('productShading', function($query) {
                $query->havingRaw('SUM(qty) > ?', [18]);
            })
            ->latest()
            ->limit(12)
            ->get();

        $product_limited = Product::whereHas('productShading', function($query) {
                $query->havingRaw('SUM(qty) > ?', [0])
                    ->havingRaw('SUM(qty) <= ?', [18]);
            })
            ->latest()
            ->limit(12)
            ->get();

        $data = [
            'title'            => 'SMB',
            'banner'           => Banner::where('status', 1)->get(),
            'product_cheapest' => $product_cheapest,
            'product_limited'  => $product_limited,
            'product_new'      => $product_new,
            'brand'            => Brand::where('status', 1)->whereNotNull('image')->orderBy('order', 'asc')->get(),
            'content'          => 'home'
        ];

        return view('layouts.index', ['data' => $data]);
    }

}
