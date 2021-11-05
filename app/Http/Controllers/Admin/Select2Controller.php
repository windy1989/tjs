<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use App\Models\Product;
use App\Models\Warehouse;
use App\Models\Customer;
use App\Models\Currency;
use App\Models\Country;
use App\Models\City;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Select2Controller extends Controller {
    
    public function type(Request $request)
    {
        $response = [];
        $search   = $request->search;
        $data     = Type::select('id', 'code')
            ->where('code', 'like', "%$search%")
            ->get();

        foreach($data as $d) {
            $response[] = [
                'id'   => $d->id,
                'text' => $d->code
            ];
        }

        return response()->json(['items' => $response]);
    }
	
	public function warehouse(Request $request)
    {
        $response = [];
        $search   = $request->search;
        $data     = Warehouse::select('id', 'name')
            ->where('name', 'like', "%$search%")
			->orWhere('code', 'like', "%$search%")
			->where('status', 2)
            ->get();

        foreach($data as $d) {
            $response[] = [
                'id'   => $d->id,
                'text' => $d->name
            ];
        }

        return response()->json(['items' => $response]);
    }
	
	public function supplier(Request $request)
    {
        $response = [];
        $search   = $request->search;
        $data     = Supplier::select('id', 'name', 'code')
			->where('code', 'like', "%$search%")
			->orWhere('name', 'like', "%$search%")
            ->get();

        foreach($data as $d) {
            $response[] = [
                'id'   => $d->id,
                'text' => $d->name
            ];
        }

        return response()->json(['items' => $response]);
    }
	
	public function user(Request $request)
    {
        $response = [];
        $search   = $request->search;
        $data     = User::select('id', 'name')
            ->where('name', 'like', "%$search%")
            ->get();

        foreach($data as $d) {
            $response[] = [
                'id'   => $d->id,
                'text' => $d->name
            ];
        }

        return response()->json(['items' => $response]);
    }
	
	public function customer(Request $request)
    {
        $response = [];
        $search   = $request->search;
        $data     = Customer::select('id', 'name')
            ->where('name', 'like', "%$search%")
            ->get();

        foreach($data as $d) {
            $response[] = [
                'id'   => $d->id,
                'text' => $d->name
            ];
        }

        return response()->json(['items' => $response]);
    }
	
	public function country(Request $request)
    {
        $response = [];
        $search   = $request->search;
        $data     = Country::select('id', 'name')
            ->where('name', 'like', "%$search%")
			->where('status', 1)
            ->get();

        foreach($data as $d) {
            $response[] = [
                'id'   => $d->id,
                'text' => $d->name
            ];
        }

        return response()->json(['items' => $response]);
    }
	
	public function currency(Request $request)
    {
        $response = [];
        $search   = $request->search;
        $data     = Currency::select('id', 'name', 'code')
            ->where('code', 'like', "%$search%")
			->where('status', 1)
            ->get();

        foreach($data as $d) {
            $response[] = [
                'id'   => $d->id,
                'text' => $d->name.' - '.$d->code
            ];
        }

        return response()->json(['items' => $response]);
    }
	
	public function city(Request $request)
    {
        $response = [];
        $search   = $request->search;
        $data     = City::select('id', 'name')
            ->where('name', 'like', "%$search%")
            ->get();

        foreach($data as $d) {
            $response[] = [
                'id'   => $d->id,
                'text' => $d->name
            ];
        }

        return response()->json(['items' => $response]);
    }

    public function product(Request $request)
    {
        $response = [];
        $search   = $request->search;
        $data     = Product::whereHas('type', function($query) use ($search) {
                $query->whereRaw("MATCH(code) AGAINST('$search' IN BOOLEAN MODE)")
                    ->orWhereHas('category', function($query) use ($search) {
                            $query->whereRaw("MATCH(name) AGAINST('$search' IN BOOLEAN MODE)");
                        })
                    ->orWhereHas('color', function($query) use ($search) {
                            $query->whereRaw("MATCH(name) AGAINST('$search' IN BOOLEAN MODE)");
                        });
            })
            ->orWhereHas('brand', function($query) use ($search) {
                    $query->whereRaw("MATCH(name) AGAINST('$search' IN BOOLEAN MODE)");
                })
            ->orWhereHas('country', function($query) use ($search) {
                    $query->whereRaw("MATCH(name) AGAINST('$search' IN BOOLEAN MODE)");
                })
            ->get();

        foreach($data as $d) {
            $response[] = [
                'id'   => $d->id,
                'text' => $d->name()
            ];
        }

        return response()->json(['items' => $response]);
    }

}
