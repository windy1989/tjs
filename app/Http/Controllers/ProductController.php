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

        if($request->search) {
            $filter['other']['search'] = $request->search;
        } else {
            $filter['other']['search'] = null;
        }

        if($request->show) {
            $filter['other']['show'] = $request->show;
        } else {
            $filter['other']['show'] = 12;
        }

        if($request->stock) {
            $filter['other']['stock'] = $request->stock;
        } else {
            $filter['other']['stock'] = null;
        }

        if($request->sort) {
            $filter['other']['sort'] = $request->sort;
        } else {
            $filter['other']['sort'] = null;
        }

        $product = Product::where(function($query) use ($filter) {
                if($filter['other']['search']) {
                    $query->whereHas('type', function($query) use ($filter) {
                            $query->where('code', 'like', '%' . $filter['other']['search'] . '%');
                        })
                        ->orWhereHas('company', function($query) use ($filter) {
                            $query->where('name', 'like', '%' . $filter['other']['search'] . '%')
                                ->orWhere('code', 'like', '%' . $filter['other']['search'] . '%');
                        })
                        ->orWhereHas('country', function($query) use ($filter) {
                            $query->where('name', 'like', '%' . $filter['other']['search'] . '%')
                                ->orWhere('code', 'like', '%' . $filter['other']['search'] . '%');
                        })
                        ->orWhereHas('brand', function($query) use ($filter) {
                            $query->where('name', 'like', '%' . $filter['other']['search'] . '%')
                                ->orWhere('code', 'like', '%' . $filter['other']['search'] . '%');
                        })
                        ->orWhereHas('grade', function($query) use ($filter) {
                            $query->where('name', 'like', '%' . $filter['other']['search'] . '%')
                                ->orWhere('code', 'like', '%' . $filter['other']['search'] . '%');
                        });
                }

                if($filter['other']['stock']) {
                    $query->whereHas('productShading', function($query) use ($filter) {
                            if($filter['other']['stock'] == 'ready') {
                                $query->havingRaw('SUM(qty) > ?', [18]);
                            } else if($filter['other']['stock'] == 'limited') {
                                $query->havingRaw('SUM(qty) > ?', [2])
                                    ->havingRaw('SUM(qty) <= ?', [18]);
                            } else if($filter['other']['stock'] == 'indent') {
                                $query->havingRaw('SUM(qty) > ?', [0])
                                    ->havingRaw('SUM(qty) <= ?', [2]);
                            }
                        });
                }

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
                    $query->whereHas('type', function($query) use ($filter) {
                            $query->whereHas('color', function($query) use ($filter) {
                                    $query->whereIn('code', $filter['color']);
                                }); 
                        });
                }

                if($filter['pattern']) {
                    $query->whereHas('type', function($query) use ($filter) {
                            $query->whereHas('pattern', function($query) use ($filter) {
                                    $query->whereIn('code', $filter['pattern']);
                                });
                        });
                }
            })
            ->whereHas('productShading', function($query) {
                    $query->havingRaw('SUM(qty) > ?', [0]);
                })
            ->where('status', 1);

        if($filter['other']['sort']) {
            if($filter['other']['sort'] == 'newest') {
                $product->latest();
            } else {
                $product->select('products.*', 'pricing_policies.price_list')
                    ->leftJoin('pricing_policies', 'products.id', '=', 'pricing_policies.product_id')  
                    ->orderBy('price_list', $filter['other']['sort'] == 'low_to_high' ? 'asc' : 'desc');
            }
        }

        $data = [
            'title'    => 'Product',
            'brand'    => Brand::where('status', 1)->get(),
            'category' => Category::where('parent_id', 0)->where('status', 1)->get(),
            'color'    => Color::where('status', 1)->get(),
            'pattern'  => Pattern::where('status', 1)->get(),
            'product'  => $product->groupBy('products.id')->paginate($filter['other']['show'])->appends($request->except('page')),
            'filter'   => $filter,
            'content'  => 'product'
        ];

        return view('layouts.index', ['data' => $data]);
    }

    public function detail(Request $request, $id)
    {
        $product_id = base64_decode($id);
        $product    = Product::find($product_id);
        
        if(!$product) {
            return redirect('product');
        }

        $related_product = Product::where('type_id', $product->type_id)
            ->orWhere('brand_id', $product->brand_id)
            ->orWhereHas('type', function($query) use ($product) {
                    $query->where('category_id', $product->type->category_id);
                })
            ->limit(8)
            ->inRandomOrder()
            ->get();
        
        $data = [
            'title'           => $product->code(),
            'product'         => $product,
            'related_product' => $related_product,
            'content'         => 'product_detail'
        ];

        return view('layouts.index', ['data' => $data]);
    }

}
