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
        $brand = Brand::with('product')
            ->withCount('product')
            ->whereHas('product', function($query) {
                $query->where('status', 1);
            })
            ->has('product', '>', 4)
            ->where('status', 1)
            ->inRandomOrder()
            ->limit(4)
            ->get();
        
        $category = Category::where('status', 1)
            ->whereExists(function($query) {
                $query->selectRaw(4)
                    ->from('products')
                    ->leftJoin('types', 'products.type_id', '=', 'types.id')
                    ->whereColumn('categories.id', 'types.category_id');
            })
            ->inRandomOrder()
            ->limit(3)
            ->get();

        $data = [
            'title'       => 'Smart Marble & Bath | SMB',
            'banner'      => Banner::where('status', 1)->get(),
            'brand'       => $brand,
            'category'    => $category,
            'product_new' => Product::where('status', 1)->latest()->limit(8)->get(),
            'content'     => 'home'
        ];

        return view('layouts.index', ['data' => $data]);
    }

}
