<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Type;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Pattern;
use App\Models\Product;
use App\Models\Category;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Models\ProductShading;

class ProductController extends Controller {
    
    public function index(Request $request)
    {
        $size = Type::select('length', 'width')
            ->where([
                ['length', '!=', null],
                ['length', '>', 0]
            ])
            ->where([
                ['width', '!=', null],
                ['width', '>', 0]
            ])
            ->where('status', 1)
            ->groupBy('length', 'width')
            ->get();

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

        if($request->size) {
            if(is_array($request->size)) {
                foreach($request->size as $s) {
                    $explode                    = explode('x', $s);
                    $filter['size'][]           = $s;
                    $filter['size']['length'][] = $explode[0];
                    $filter['size']['width'][]  = $explode[1];
                }
            } else {
                $filter['size'][] = $request->size;
            }
        } else {
            $filter['size'] = [];
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

                if($filter['size']) {
                    $query->whereHas('type', function($query) use ($filter) {
                            $query->whereIn('length', $filter['size']['length']);
                            $query->whereIn('width', $filter['size']['width']);
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
            ->where('status', 1)
            ->whereHas('productShading', function($query) {
                    $query->havingRaw('SUM(qty) > ?', [0]);
                });

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
            'size'     => $size,
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

        $related_product = Product::where(function($query) use ($product) {
                    $query->where('type_id', $product->type_id)
                        ->whereHas('productShading', function($query) {
                                $query->havingRaw('SUM(qty) > ?', [0]);
                            });
                })
            ->where(function($query) use ($product) {
                    $query->where('brand_id', $product->brand_id)
                        ->orWhereHas('type', function($query) use ($product) {
                                $query->where('category_id', $product->type->category_id);
                            });
                })
            ->where('id', '!=', $product->id)
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

    public function checkStock(Request $request)
    {
        $product_id    = base64_decode($request->product_id);
        $data_shading  = ProductShading::where('product_id', $product_id)->orderBy('qty', 'asc')->get();
        $total_stock   = ProductShading::where('product_id', $product_id)->sum('qty');
        $total_indent  = 0;
        $total_request = abs($request->qty);
        $total_ready   = $total_request;
        $shading       = [];

        if($total_request > $total_stock) {
            $total_indent = $total_request - $total_stock;
        }

        foreach($data_shading as $ds) {
            $minus     = $ds->qty - $total_request;
            $shading[] = [
                'shading'       => $ds->code,
                'initial_stock' => $ds->qty,
                'last_stock'    => $minus > 0 ? $minus : 0
            ];

            if($total_request > 0) {
                $ds->qty - $total_request;
            }
        }

        return response()->json([
            'total_stock'   => $total_stock,
            'total_ready'   => abs($total_ready - $total_indent),
            'total_indent'  => $total_indent,
            'total_request' => $total_request,
            'data_shading'  => $shading
        ]);
    }

    public function addToCart(Request $request)
    {
        if(!session('fo_id')) {
            return redirect('account/login');
        }

        $product_id = base64_decode($request->product_id);
        $cart       = Cart::where('customer_id', session('fo_id'))
            ->where('product_id', $product_id)
            ->first();

        if($cart) {
            Cart::where('customer_id', session('fo_id'))
                ->where('product_id', $product_id)
                ->update(['qty' => $cart->qty + $request->qty]);
        } else {
            Cart::create([
                'customer_id' => session('fo_id'),
                'product_id'  => $product_id,
                'qty'         => $request->qty
            ]);
        }

        return redirect()->back()->with(['success' => 'Product successfully entered the cart']);
    }

    public function cartQty(Request $request)
    {
        if(!session('fo_id')) {
            return response()->json('Unauthorized');
        }

        $id            = $request->id;
        $product_id    = base64_decode($request->product_id);
        $total_request = abs($request->qty);
        $cart_customer = Cart::where('customer_id', session('fo_id'))->get();
        $cart_row      = Cart::find($id);
        $total_indent  = 0;
        $total_price   = $cart_row->product->price() * $total_request;
        $grandtotal    = 0;
        $total_stock   = $cart_row->product->productShading->sum('qty');

        if($total_request > $total_stock) {
            $total_indent = $total_request - $total_stock;
        }

        foreach($cart_customer as $cc) {
            if($cc->id == $id) {
                $grandtotal += $cc->product->price() * $total_request;
            } else {
                $grandtotal += $cc->product->price() * $cc->qty;
            }
        }

        $cart_row->update(['qty' => $total_request]);
        return response()->json([
            'total_ready'  => abs($total_request - $total_indent),
            'total_indent' => $total_indent,
            'total_price'  => 'Rp ' . number_format($total_price, 0, ',', '.'),
            'grandtotal'   => 'Rp ' . number_format($grandtotal, 0, ',', '.')
        ]);
    }

    public function cartDestroy($id)
    {
        if(!session('fo_id')) {
            return redirect('account/login');
        }

        Cart::find(base64_decode($id))->delete();
        return redirect('account/cart');
    }

    public function addToWishlist(Request $request)
    {
        if(!session('fo_id')) {
            return redirect('account/login');
        }

        $product_id = base64_decode($request->product_id);
        $wishlist   = Wishlist::where('customer_id', session('fo_id'))
            ->where('product_id', $product_id)
            ->first();

        if(!$wishlist) {
            Wishlist::create([
                'customer_id' => session('fo_id'),
                'product_id'  => $product_id
            ]);
        }

        return redirect()->back();
    }

    public function wishlistToCart($id)
    {
        if(!session('fo_id')) {
            return redirect()->back();
        }

        $id       = base64_decode($id);
        $wishlist = Wishlist::find($id);

        Cart::create([
            'customer_id' => session('fo_id'),
            'product_id'  => $wishlist->product_id,
            'qty'         => 1
        ]);

        $wishlist->delete();
        return redirect()->back();
    }

    public function wishlistDestroy($id)
    {
        if(!session('fo_id')) {
            return redirect('account/login');
        }

        Wishlist::find(base64_decode($id))->delete();
        return redirect('account/wishlist');
    }

}
