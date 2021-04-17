<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Color;
use App\Models\Pattern;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller {
    
    public function index(Request $request)
    {
        if($request->category) {
            if(is_array($request->category)) {
                foreach($request->category as $c) {
                    $filter['category'][] = $c;
                }
            } else {
                $filter['category'][] = $request->category;
            }
        } else {
            $filter['category'] = [];
        }

        if($request->brand) {
            if(is_array($request->brand)) {
                foreach($request->brand as $b) {
                    $filter['brand'][] = $b;
                }
            } else {
                $filter['brand'][] = $request->brand;
            }
        } else {
            $filter['brand'] = [];
        }

        if($request->color) {
            if(is_array($request->color)) {
                foreach($request->color as $c) {
                    $filter['color'][] = $c;
                }
            } else {
                $filter['color'][] = $request->color;
            }
        } else {
            $filter['color'] = [];
        }

        if($request->pattern) {
            if(is_array($request->pattern)) {
                foreach($request->pattern as $p) {
                    $filter['pattern'][] = $p;
                }
            } else {
                $filter['pattern'][] = $request->pattern;
            }
        } else {
            $filter['pattern'] = [];
        }

        $product = Product::where(function($query) use ($filter) {
                if($filter['category']) {
                    $query->whereHas('type', function($query) use ($filter) {
                            $query->whereHas('category', function($query) use ($filter) {
                                    $query->whereIn('slug', $filter['category']);
                                });
                        });
                }

                if($filter['brand']) {
                    $query->whereHas('brand', function($query) use ($filter) {
                            $query->whereIn('code', $filter['brand']);
                        });
                }

                if($filter['color']) {
                    $query->whereHas('color', function($query) use ($filter) {
                            $query->whereIn('code', $filter['color']);
                        });
                }

                if($filter['pattern']) {
                    $query->whereHas('pattern', function($query) use ($filter) {
                            $query->whereIn('code', $filter['pattern']);
                        });
                }
            })
            ->where('status', 1)
            ->paginate(12);

        $data = [
            'title'    => 'Smart Marble & Bath | Product',
            'brand'    => Brand::where('status', 1)->get(),
            'category' => Category::where('parent_id', 0)->where('status', 1)->get(),
            'color'    => Color::where('status', 1)->get(),
            'pattern'  => Pattern::where('status', 1)->get(),
            'product'  => $product,
            'filter'   => $filter,
            'content'  => 'product'
        ];

        return view('layouts.index', ['data' => $data]);
    }

}
